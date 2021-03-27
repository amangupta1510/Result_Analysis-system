<?php
namespace App\Http\Controllers;
use Validator;
use Response;
use File;
use Storage;
use disk;
use Auth;
use PDF;
use Zip;
use Session;
use newImage;
use ZanySoft\Zip\ZipManager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\http\Requests;
use Illuminate\Http\Request;
use App\paper_link;
use App\student;
use App\result;
use App\teacher;
use App\time_left;
use App\admin;
use App\dpp;
use App\enquiry;
use App\dpp_link;
use App\advance_paper;
use App\custom_paper;
use App\answer;
use App\new_answer;
use App\normal_paper;
use App\online;
use App\question;
use App\new_question;
use App\chatbox;
use App\ts_folder;
use App\ts_folder_link;
use App\task_board;
use App\lecture;
use App\lecture_folder;
use App\lecture_link;
use App\lecture_subfolder;
use App\message;
use App\message_template;
use App\notification;
use App\notification_template;
use App\image;
use App\token;
use DB;
use Carbon\Carbon;

class AdminResultController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function paperresult(Request $request)
    {
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $where = ['plid' => $request->get('id') , 'active' => '1'];
            $users = result::where('name', 'like', '%' . $studentsearch . '%')->orWhere('classid', 'like', '%' . $studentsearch . '%')->orWhere('courseid', 'like', '%' . $studentsearch . '%')->orWhere('coursetypeid', 'like', '%' . $studentsearch . '%')->orWhere('groupid', 'like', '%' . $studentsearch . '%');
            $users = $users->where($where)->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.p_result', compact('users'));
        }
        else
        {
            $where = ['plid' => $request->get('id') , 'active' => '1'];
            $users = result::where($where)->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.p_result', compact('users'));
        }
    }
    public function paperresult_page(Request $request)
    {
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $where = ['plid' => $request->get('id') , 'active' => '1'];
            $users = result::where('name', 'like', '%' . $studentsearch . '%')->orWhere('classid', 'like', '%' . $studentsearch . '%')->orWhere('courseid', 'like', '%' . $studentsearch . '%')->orWhere('coursetypeid', 'like', '%' . $studentsearch . '%')->orWhere('groupid', 'like', '%' . $studentsearch . '%');
            $users = $users->where($where)->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.p_result_reload', compact('users'));
        }
        else
        {
            $where = ['plid' => $request->get('id') , 'active' => '1'];
            $users = result::where($where)->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.p_result_reload', compact('users'));
        }
    }

    public function pending_response(Request $request)
    {
        $where = ['plid' => $request->get('id') , 'active' => '1'];
        $where1 = ['pid' => $request->get('pid') , 'qtype' => 'custom', 'active' => '1'];
        $questions = new_question::where($where1)->get();
        $answers = new_answer::where($where)->get();
        return view('admin.pending_response', compact('questions', 'answers'));
    }

    public function update_response(Request $request)
    {
        $where1 = ['id' => $request->id, 'active' => '1'];
        $answers = new_answer::find($request->id);
        $array = json_decode($answers->answers);
        foreach ($array as $a)
        {
            if ($a->qid == $request->qid)
            {
                $a->answer = $request->answer;
                $a->marks = $request->marks;
                break;
            }
        }
        $answers->answers = json_encode($array);
        $answers->save();
        return response()
            ->json($request->answer);
    }

    public function resultshow(Request $request)
    {
        $where = ['id' => $request->get('id') , 'active' => '1'];
        $users = result::where($where)->orderBy('id', 'desc')
            ->paginate(10);
        return view('layout.resultview', compact('users'));
    }

    public function send_result(Request $request)
    {
        $link = paper_link::find($request->get('id'));
        if ($request->get('type') == 'normal')
        {
            $paper = normal_paper::find($link->pid);
            $PM = ($paper->PQ * $paper->PM);
            $CM = ($paper->CQ * $paper->CM);
            $MM = ($paper->MQ * $paper->MM);
            $BM = ($paper->BQ * $paper->BM);

        }
        elseif ($request->get('type') == 'advanced')
        {
            $paper = advance_paper::find($link->pid);
            $PM = ($paper->P1Q * $paper->P1M) + ($paper->P2Q * $paper->P2M) + ($paper->P3Q * $paper->P3M) + ($paper->P4Q * $paper->P4M) + ($paper->P5Q * $paper->P5M) + ($paper->P6Q * $paper->P6M);
            $CM = ($paper->C1Q * $paper->C1M) + ($paper->C2Q * $paper->C2M) + ($paper->C3Q * $paper->C3M) + ($paper->C4Q * $paper->C4M) + ($paper->C5Q * $paper->C5M) + ($paper->C6Q * $paper->C6M);
            $MM = ($paper->M1Q * $paper->M1M) + ($paper->M2Q * $paper->M2M) + ($paper->M3Q * $paper->M3M) + ($paper->M4Q * $paper->M4M) + ($paper->M5Q * $paper->M5M) + ($paper->M6Q * $paper->M6M);
            $BM = 0;
        }
        $results = result::where(['plid' => $request->get('id') , 'active' => '1'])
            ->orderBy('totalS', 'desc')
            ->get();
        $results = $results->sortByDesc('totalS');
        $rank = 1;
        foreach ($results as $user)
        {
            $student = student::find($user->sid);
            $l = "";
            $n = 0;
            if ($user->type != "custom")
            {
                if ($user->PQ != 0)
                {
                    $l = $l . '
Physics : ' . $user->totalSinP . '/' . $PM;
                    $n++;
                }
                if ($user->CQ != 0)
                {
                    $l = $l . '
Chemistry : ' . $user->totalSinC . '/' . $CM;
                    $n++;
                }
                if ($user->MQ != 0)
                {
                    $l = $l . '
Maths : ' . $user->totalSinM . '/' . $MM;
                    $n++;
                }
                if ($user->BQ != 0)
                {
                    $l = $l . '
Biology : ' . $user->totalSinB . '/' . $BM;
                    $n++;
                }
                if ($n < 2)
                {
                    $l = "";
                }
            }
            else
            {
                foreach (json_decode($user->custom_structure) as $p)
                {
                    if ($p->question > 0)
                    {
                        $l = $l . "
  " . $p->subject . "  :  " . $p->totalS . "/" . $p->total_marks;
                    }
                }
            }

            $msg = urlencode('Inspire Academy
Online Class Test Results
Paper : ' . $user->paper . '
Exam Date : ' . date_format(date_create($user->timer) , "d/m/Y") . '
Name : ' . $user->name . '
Total Marks : ' . $user->totalS . '/' . $user->total_marks . '
Rank : ' . $rank . $l);
            if ($request->get('sid') == 'none' && $request->get('msg_type') == 'message')
            {
                $ch = file_get_contents(env('messege_api').'&numbers=' . $student->mobile . '&message=' . $msg);
            }
            else
            {
                if ($request->get('sid') == $user->sid && $request->get('msg_type') == 'message')
                {
                    $ch = file_get_contents(env('messege_api').'&numbers=' . $student->mobile . '&message=' . $msg);
                }

                if ($request->get('sid') == 'none' && $request->get('msg_type') == 'notification')
                {
                    //---------------------------------------------------------------------Notification section--------------------------------------------
                    $body = "Paper : " . $user->paper . "
Exam Date : " . date_format(date_create($user->timer) , 'd/m/Y') . "
Rank : " . $rank . "
Your Score is : " . $user->totalS . "/" . $user->total_marks;
                    if ($user->type != "custom")
                    {
                        if ($user->PQ != 0)
                        {
                            $body = $body . "
 Physics         :  " . $user->totalSinP . "   Marks";
                        }
                        if ($user->CQ != 0)
                        {
                            $body = $body . "
 Chemistry     :  " . $user->totalSinC . "   Marks";
                        }
                        if ($user->MQ != 0)
                        {
                            $body = $body . "
 Mathmatics :  " . $user->totalSinM . "   Marks";
                        }
                        if ($user->BQ != 0)
                        {
                            $body = $body . "
 Biology          :  " . $user->totalSinB . "   Marks";
                        }
                    }
                    else
                    {
                        foreach (json_decode($user->custom_structure) as $p)
                        {
                            if ($p->question > 0)
                            {
                                $body = $body . "
  " . $p->subject . "  :  " . $p->totalS . "/" . $p->total_marks;
                            }
                        }
                    }

                    $acd_id = Auth::user()->acd_id;
                    $acd_name = Auth::user()->acd_name;
                    $notification_type = 'right_icon_long';
                    $title = 'Your Online Class Test Results.';
                    $body = $body;
                    $title_long = 'Your Online Class Test Results.';
                    $body_long = $body;
                    $title_line = null;
                    $body_line1 = null;
                    $body_line2 = null;
                    $body_line3 = null;
                    $body_line4 = null;
                    $body_line5 = null;
                    $body_line6 = null;
                    $body_line7 = null;
                    $body_line8 = null;
                    $body_line9 = null;
                    $body_line10 = null;
                    $summary = "Results";
                    $icon = asset('') . env('NOTI_ICON');
                    $image = asset('') . env('NOTI_ICON');

                    $browser_token = array();
                    $br_tk = 0;
                    $app_tk = 0;
                    $app_token = array();
                    $url = 'https://fcm.googleapis.com/fcm/send';

                    $use = token::where(['user_id' => $user->sid, 'user_type' => 'student', 'active' => '1'])
                        ->get();
                    foreach ($use as $user)
                    {
                        if ($user->token_type == "Application")
                        {
                            $app_token[$app_tk] = $user->token;
                            $app_tk++;
                        }
                        else
                        {
                            $browser_token[$br_tk] = $user->token;
                            $br_tk++;
                        }
                    }

                    $headers = array(
                        "Authorization: key=" . env('FCM_SERVER_KEY') ,
                        'Content-Type: application/json'
                    );
                    $app_tokens = array_chunk($app_token, 999, true);
                    foreach ($app_tokens as $token)
                    {
                        $app_fields = array(
                            'registration_ids' => $token,
                            'data' => array(
                                "title" => $title,
                                "body" => $body,
                                "title_long" => $title_long,
                                "body_long" => $body_long,
                                "title_line" => $title_line,
                                "body_line1" => $body_line1,
                                "body_line2" => $body_line2,
                                "body_line3" => $body_line3,
                                "body_line4" => $body_line4,
                                "body_line5" => $body_line5,
                                "body_line6" => $body_line6,
                                "body_line7" => $body_line7,
                                "body_line8" => $body_line8,
                                "body_line9" => $body_line9,
                                "body_line10" => $body_line10,
                                "summary" => $summary,
                                "icon" => $icon,
                                "sound" => "notification",
                                "noti_id" => rand(3, 8) ,
                                "channel_id" => "Notification",
                                "image" => $image,
                                "type" => $notification_type,
                                "click_action" => "https://deltatrek.in/user/login"
                            )
                        );

                        $fields = json_encode($app_fields);
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        $rsl = curl_exec($ch);
                        curl_close($ch);
                    }
                    $browser_tokens = array_chunk($browser_token, 999, true);
                    foreach ($browser_tokens as $token)
                    {
                        if ($notification_type == 'no_icon')
                        {
                            $title = $title;
                            $body = $body;
                            $image = '';
                            $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                        }
                        elseif ($notification_type == 'right_icon' || $notification_type == 'left_icon')
                        {
                            $title = $title;
                            $body = $body;
                            $image = '';
                            $icon = $icon;
                        }
                        elseif ($notification_type == 'right_icon_long')
                        {
                            $title = $title_long;
                            $body = $body_long;
                            $image = '';
                            $icon = $icon;
                        }
                        elseif ($notification_type == 'no_icon_long')
                        {
                            $title = $title_long;
                            $body = $body_long;
                            $image = '';
                            $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                        }
                        elseif ($notification_type == 'no_icon_image')
                        {
                            $title = $title;
                            $body = $body;
                            $image = $image;
                            $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                        }
                        elseif ($notification_type == 'right_icon_image_hide' || $notification_type == 'right_icon_image_show')
                        {
                            $title = $title;
                            $body = $body;
                            $image = $image;
                            $icon = $icon;
                        }
                        elseif ($notification_type == 'no_icon_lines')
                        {
                            $title = $title_line;
                            $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                            $image = '';
                            $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                        }
                        elseif ($notification_type == 'right_icon_lines')
                        {
                            $title = $title_line;
                            $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                            $image = '';
                            $icon = $icon;
                        }
                        $browser_fields = array(
                            'registration_ids' => $token,
                            'notification' => array(
                                "title" => $title,
                                "body" => $body,
                                "icon" => $icon,
                                "sound" => "notification",
                                "noti_id" => rand(3, 8) ,
                                "image" => $image,
                                "click_action" => "https://deltatrek.in/user/login"
                            )
                        );

                        $fields = json_encode($browser_fields);
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        $rsl = curl_exec($ch);
                        curl_close($ch);
                    }

                }
                else
                {
                    if ($request->get('sid') == $user->sid && $request->get('msg_type') == 'notification')
                    {
                        //---------------------------------------------------------------------Notification section--------------------------------------------
                        $body = "Paper : " . $user->paper . "
Exam Date : " . date_format(date_create($user->timer) , 'd/m/Y') . "
Rank : " . $rank . "
Your Score is : " . $user->totalS . "/" . $user->total_marks;
                        if ($user->type != "custom")
                        {
                            if ($user->PQ != 0)
                            {
                                $body = $body . "
 Physics         :  " . $user->totalSinP . "   Marks";
                            }
                            if ($user->CQ != 0)
                            {
                                $body = $body . "
 Chemistry     :  " . $user->totalSinC . "   Marks";
                            }
                            if ($user->MQ != 0)
                            {
                                $body = $body . "
 Mathmatics :  " . $user->totalSinM . "   Marks";
                            }
                            if ($user->BQ != 0)
                            {
                                $body = $body . "
 Biology          :  " . $user->totalSinB . "   Marks";
                            }
                        }
                        else
                        {
                            foreach (json_decode($user->custom_structure) as $p)
                            {
                                if ($p->question > 0)
                                {
                                    $body = $body . "
  " . $p->subject . "  :  " . $p->totalS . "/" . $p->total_marks;
                                }
                            }
                        }

                        $acd_id = Auth::user()->acd_id;
                        $acd_name = Auth::user()->acd_name;
                        $notification_type = 'right_icon_long';
                        $title = 'Your Online Class Test Results.';
                        $body = $body;
                        $title_long = 'Your Online Class Test Results.';
                        $body_long = $body;
                        $title_line = null;
                        $body_line1 = null;
                        $body_line2 = null;
                        $body_line3 = null;
                        $body_line4 = null;
                        $body_line5 = null;
                        $body_line6 = null;
                        $body_line7 = null;
                        $body_line8 = null;
                        $body_line9 = null;
                        $body_line10 = null;
                        $summary = "Results";
                        $icon = asset('') . env('NOTI_ICON');
                        $image = asset('') . env('NOTI_ICON');

                        $browser_token = array();
                        $br_tk = 0;
                        $app_tk = 0;
                        $app_token = array();
                        $url = 'https://fcm.googleapis.com/fcm/send';

                        $use = token::where(['user_id' => $user->sid, 'user_type' => 'student', 'active' => '1'])
                            ->get();
                        foreach ($use as $user)
                        {
                            if ($user->token_type == "Application")
                            {
                                $app_token[$app_tk] = $user->token;
                                $app_tk++;
                            }
                            else
                            {
                                $browser_token[$br_tk] = $user->token;
                                $br_tk++;
                            }
                        }

                        $headers = array(
                            "Authorization: key=" . env('FCM_SERVER_KEY') ,
                            'Content-Type: application/json'
                        );
                        $app_tokens = array_chunk($app_token, 999, true);
                        foreach ($app_tokens as $token)
                        {
                            $app_fields = array(
                                'registration_ids' => $token,
                                'data' => array(
                                    "title" => $title,
                                    "body" => $body,
                                    "title_long" => $title_long,
                                    "body_long" => $body_long,
                                    "title_line" => $title_line,
                                    "body_line1" => $body_line1,
                                    "body_line2" => $body_line2,
                                    "body_line3" => $body_line3,
                                    "body_line4" => $body_line4,
                                    "body_line5" => $body_line5,
                                    "body_line6" => $body_line6,
                                    "body_line7" => $body_line7,
                                    "body_line8" => $body_line8,
                                    "body_line9" => $body_line9,
                                    "body_line10" => $body_line10,
                                    "summary" => $summary,
                                    "icon" => $icon,
                                    "sound" => "notification",
                                    "noti_id" => rand(3, 8) ,
                                    "channel_id" => "Notification",
                                    "image" => $image,
                                    "type" => $notification_type,
                                    "click_action" => "https://deltatrek.in/user/login"
                                )
                            );

                            $fields = json_encode($app_fields);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                            $rsl = curl_exec($ch);
                            curl_close($ch);
                        }
                        $browser_tokens = array_chunk($browser_token, 999, true);
                        foreach ($browser_tokens as $token)
                        {
                            if ($notification_type == 'no_icon')
                            {
                                $title = $title;
                                $body = $body;
                                $image = '';
                                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                            }
                            elseif ($notification_type == 'right_icon' || $notification_type == 'left_icon')
                            {
                                $title = $title;
                                $body = $body;
                                $image = '';
                                $icon = $icon;
                            }
                            elseif ($notification_type == 'right_icon_long')
                            {
                                $title = $title_long;
                                $body = $body_long;
                                $image = '';
                                $icon = $icon;
                            }
                            elseif ($notification_type == 'no_icon_long')
                            {
                                $title = $title_long;
                                $body = $body_long;
                                $image = '';
                                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                            }
                            elseif ($notification_type == 'no_icon_image')
                            {
                                $title = $title;
                                $body = $body;
                                $image = $image;
                                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                            }
                            elseif ($notification_type == 'right_icon_image_hide' || $notification_type == 'right_icon_image_show')
                            {
                                $title = $title;
                                $body = $body;
                                $image = $image;
                                $icon = $icon;
                            }
                            elseif ($notification_type == 'no_icon_lines')
                            {
                                $title = $title_line;
                                $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                                $image = '';
                                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                            }
                            elseif ($notification_type == 'right_icon_lines')
                            {
                                $title = $title_line;
                                $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                                $image = '';
                                $icon = $icon;
                            }
                            $browser_fields = array(
                                'registration_ids' => $token,
                                'notification' => array(
                                    "title" => $title,
                                    "body" => $body,
                                    "icon" => $icon,
                                    "sound" => "notification",
                                    "noti_id" => rand(3, 8) ,
                                    "image" => $image,
                                    "click_action" => "https://deltatrek.in/user/login"
                                )
                            );

                            $fields = json_encode($browser_fields);
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                            $rsl = curl_exec($ch);
                            curl_close($ch);
                        }
                    }
                }
            }
            $rank++;
        }
        return Response::json('done');
    }

    public function result_analysis(Request $request)
    {
        $where = ['id' => $request->get('id') , 'active' => '1'];
        $results = result::where($where)->get();
        foreach ($results as $key => $user)
        {
            $id = $user->pid . 'X' . $user->plid . 'X' . $user->sid;
            $pid = $user->pid;
            $ptype = $user->type;
        }
        $answers = array();
        $answer = new_answer::where('pplsid', $id)->get();
        foreach ($answer as $k)
        {
            $answers = json_decode($k->answers);
        }
        if ($ptype == 'advanced')
        {
            $papers = advance_paper::where('id', $pid)->get();
        }
        elseif ($ptype == 'custom')
        {
            $papers = custom_paper::where('id', $pid)->get();
        }
        else
        {
            $papers = normal_paper::where('id', $pid)->get();
        }
        return view('admin.result_analysis', compact('results', 'answers', 'papers'));
    }

    public function paperlist(Request $request)
    {
        $counts = result::where('active', '1')->select('plid', 'type', 'totalP')
            ->get();
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $users = paper_link::where('paper', 'like', '%' . $studentsearch . '%')->orWhere('classid', 'like', '%' . $studentsearch . '%')->orWhere('courseid', 'like', '%' . $studentsearch . '%')->orWhere('coursetypeid', 'like', '%' . $studentsearch . '%')->orWhere('groupid', 'like', '%' . $studentsearch . '%');
            $users = $users->where(['active' => '1', 'test_series' => NULL])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.results', compact('users', 'counts'));
        }
        else
        {
            $users = paper_link::where(['active' => '1', 'test_series' => NULL])->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.results', compact('users', 'counts'));
        }
    }

    public function paperlist_page(Request $request)
    {
        $counts = result::where('active', '1')->select('plid', 'type', 'totalP')
            ->get();
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $users = paper_link::where('paper', 'like', '%' . $studentsearch . '%')->orWhere('classid', 'like', '%' . $studentsearch . '%')->orWhere('courseid', 'like', '%' . $studentsearch . '%')->orWhere('coursetypeid', 'like', '%' . $studentsearch . '%')->orWhere('groupid', 'like', '%' . $studentsearch . '%');
            $users = $users->where(['active' => '1', 'test_series' => NULL])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.results_reload', compact('users', 'counts'));
        }
        else
        {
            $users = paper_link::where(['active' => '1', 'test_series' => NULL])->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.results_reload', compact('users', 'counts'));
        }
    }

    public function deleteresult(Request $request)
    {
        $teacher = result::find($request->id);
        $teacher->active = '0';
        $time = time_left::where(['plid' => $teacher->plid, 'sid' => $teacher
            ->sid])
            ->update(['result' => NULL]);
        $teacher->save();
        return response()
            ->json($teacher);
    }

    public function pl_summary(Request $request)
    {
        $id = $request->get('id');
        $no = 0;
        $no = result::where(['plid' => $id, 'active' => '1'])->count();
        if ($no > 0)
        {
            $users = result::where(['plid' => $id, 'active' => '1'])->orderBy('totalS', 'desc')
                ->get();
            $users = $users->sortByDesc('totalS');
            foreach ($users as $user)
            {
                $name = $user->paper;
            }

            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadview('admin.result_summary', compact('users', 'name'));
            return $pdf->download($name . ' full result summary.pdf');
        }
        return back();
    }

}

