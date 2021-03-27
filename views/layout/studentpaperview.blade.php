@if($type=="normal")
@foreach($questions as $user)
<li><b>Question {{$user->qid}}</b></li>
@if($user->quesimg!='')
<li><img style="width: 100%" src="{{ asset("$user->quesimg").'?'.$user->remember_token }}" />
    <?php $names = pathinfo($user->quesimg);
$img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
    @if(file_exists($img_1))<img style="width: 100%" src="{{ asset("$img_1").'?'.$user->remember_token  }}" class="img-responsive">@endif
    @if(file_exists($img_2))<img style="width: 100%" src="{{ asset("$img_2").'?'.$user->remember_token  }}" class="img-responsive">@endif</li>
@else
<li style="color: #d9d9d9">Question Not Available</li>
@endif
<li class="l1" id="{{$user->qid}}" style="color: #555555;">Your Answer : Not Answered</li>
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : {{$user->q1}}</li>
<li><b>Solution {{$user->qid}}</b></li>
@if($user->solimg!='')
<li><img style="width: 100%" src="{{ asset("$user->solimg").'?'.$user->remember_token }}" />
    <?php $names = pathinfo($user->solimg);
$img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
    @if(file_exists($img_1))<img style="width: 100%" src="{{ asset("$img_1").'?'.$user->remember_token  }}" class="img-responsive">@endif
    @if(file_exists($img_2))<img style="width: 100%" src="{{ asset("$img_2").'?'.$user->remember_token  }}" class="img-responsive">@endif</li>
@else
<li style="color: #d9d9d9">Solution Not Available</li>
@endif
<li style=" height: 3px;background-color: rgba(244,132,83,0.8);"></li>
@endforeach
<script type="text/javascript">
@foreach($answers as $ans)

var qid = "{{$ans->qid}}";
var a = "{{$ans->a1}}";
var ans = "{{$ans->answer}}";
var w = "{{$ans->a8}}";
if (w == "save" || w == "save_mark") {
    @if($ans - > a7 == "Bonus")
    $('#{{$ans->qid}}').html('Your Answer : Bonus&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
    $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity:0.8;border-radius: 5px;border:2px solid rgb(255, 193, 7,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgb(255, 193, 7,0.4);');
    $('#q{{$ans->qid}}').attr('style', 'color: #555555;opacity:0.8;border-radius: 5px;border:2px solid rgb(255, 193, 7,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgb(255, 193, 7,0.4);');
    @else
    $('#{{$ans->qid}}').html('Your Answer :{{$ans->a1}}&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
    if (ans == 'Correct') {
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity:0.8;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
    } else {
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgba(253,92,99,0.4);');
    }
    @endif
    $('#q{{$ans->qid}}').html('Correct Answer : {{$ans->a7}}');

} else {
    $('#{{$ans->qid}}').text('Your Answer : Not Answered');
    $('#q{{$ans->qid}}').text('Correct Answer : {{$ans->a7}}');
    $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgba(70,184,218,0.4);');
}

@endforeach

</script>
<style type="text/css">
.l1 {
    margin-top: 8px;
    color: #555555;
    opacity: 0.8;
    border-radius: 5px;
    border: 2px solid rgba(70, 184, 218, 0.8);
    padding: 0px 0px 0px 5px;
    height: 25px;
    background-color: rgba(70, 184, 218, 0.4);
}

.l2 {
    color: #555555;
    border-radius: 5px;
    border: 2px solid rgb(6, 217, 149, 0.8);
    opacity: 0.8;
    margin-top: 2px;
    padding: 0px 0px 0px 5px;
    max-height: 25px;
    background-color: rgb(6, 220, 149, 0.4);
}

</style>
@elseif($type=="advanced")
@foreach($questions as $user)
<li><b>Question {{$user->qid}}</b></li>
@if($user->quesimg!='')
<li><img style="width: 100%" src="{{ asset("$user->quesimg").'?'.$user->remember_token }}" />
    <?php $names = pathinfo($user->quesimg);
$img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
    @if(file_exists($img_1))<img style="width: 100%" src="{{ asset("$img_1").'?'.$user->remember_token  }}" class="img-responsive">@endif
    @if(file_exists($img_2))<img style="width: 100%" src="{{ asset("$img_2").'?'.$user->remember_token  }}" class="img-responsive">@endif</li>
@else
<li style="color: #d9d9d9">Question Not Available</li>
@endif
<li class="l1" id="{{$user->qid}}" style="color: #555555;">Your Answer : Not Answered</li>
@if($user->type=='single'||$user->type=='integer'||$user->type=='passage'||$user->type=='match_column')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : {{$user->q1}}</li>
@elseif($user->type=='multiple')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answers : {{$user->q1 . $user->q2 . $user->q3 . $user->q4 }}</li>
@elseif($user->type=='numerical')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : Between {{$user->q1}} To {{$user->q2}}</li>
@endif
<li><b>Solution {{$user->qid}}</b></li>
@if($user->solimg!='')
<li><img style="width: 100%" src="{{ asset("$user->solimg").'?'.$user->remember_token }}" />
    <?php $names = pathinfo($user->solimg);
$img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
    @if(file_exists($img_1))<img style="width: 100%" src="{{ asset("$img_1").'?'.$user->remember_token  }}" class="img-responsive">@endif
    @if(file_exists($img_2))<img style="width: 100%" src="{{ asset("$img_2").'?'.$user->remember_token  }}" class="img-responsive">@endif</li>
@else
<li style="color: #d9d9d9">Solution Not Available</li>
@endif
<li style=" height: 3px;background-color: rgba(244,132,83,0.8);"></li>
@endforeach
<script type="text/javascript">
@foreach($answers as $ans)

var qid = "{{$ans->qid}}";
var qtype = "{{$ans->qtype}}";
var w = "{{$ans->ans_type}}";
var ans = "{{$ans->answer}}";
var bonus = "{{$ans->a5 . $ans->a6 . $ans->a7 . $ans->a8}}";
if (w == "save" || w == "save_mark") {
    if (qtype == 'single' || qtype == 'integer' || qtype == 'passage' || qtype == 'match_column') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(255, 193, 7,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(255, 193, 7,0.4);');
            $('#q{{$ans->qid}}').attr('style', 'color: #555555;opacity:0.8;border-radius: 5px;border:2px solid rgb(255, 193, 7,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgb(255, 193, 7,0.4);');
        } else {
            $('#{{$ans->qid}}').html('Your Answer : {{$ans->a1}}&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
            $('#q{{$ans->qid}}').text('Correct Answer : {{$ans->a5}}');
            if (ans == 'Correct') {
                $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
            } else {
                $('#{{$ans->qid}}').attr('style', ' margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(253,92,99,0.4);');
            }
        }


    } else if (qtype == 'multiple') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
        } else {
            $('#{{$ans->qid}}').html('Your Answers : {{$ans->a1 . $ans->a2 . $ans->a3 . $ans->a4}}&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
            $('#q{{$ans->qid}}').text('Correct Answers : {{$ans->a5 . $ans->a6 . $ans->a7 . $ans->a8}}');
        }
        if (ans == 'Correct' || ans == 'Partially Correct') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
        } else {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(253,92,99,0.4);');
        }
    } else if (qtype == 'numerical') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
        } else {
            $('#{{$ans->qid}}').html('Your Answer : {{$ans->a1}}&nbsp;<i class="pt-1" style="float:right;font-size:10px;"><b>(Time Used : {{$ans->time_used}} sec)&nbsp;</b></i>');
            $('#q{{$ans->qid}}').text('Correct Answer : Between {{$ans->a5}} To {{$ans->a6}}');
        }

        if (ans == 'Correct') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
        } else {
            $('#{{$ans->qid}}').attr('style', ' margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(253,92,99,0.4);');
        }
    }
} else {
    if (qtype == 'single' || qtype == 'integer' || qtype == 'passage' || qtype == 'match_column') {
        $('#{{$ans->qid}}').text('Your Answer : Not Answered');
        $('#q{{$ans->qid}}').text('Correct Answer : {{$ans->a5}}');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    } else if (qtype == 'multiple') {
        $('#{{$ans->qid}}').text('Your Answer : Not Answered');
        $('#q{{$ans->qid}}').text('Correct Answers : {{$ans->a5 . $ans->a6 . $ans->a7 . $ans->a8}}');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    } else if (qtype == 'numerical') {
        $('#{{$ans->qid}}').text('Your Answer : Not Answered');
        $('#q{{$ans->qid}}').text('Correct Answer : Between {{$ans->a5}} To {{$ans->a6}}');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    }
}

@endforeach

</script>
<style type="text/css">
.l1 {
    margin-top: 8px;
    color: #555555;
    opacity: 0.8;
    border-radius: 5px;
    border: 2px solid rgba(70, 184, 218, 0.8);
    padding: 0px 0px 0px 5px;
    height: 25px;
    background-color: rgba(70, 184, 218, 0.4);
}

.l2 {
    color: #555555;
    border-radius: 5px;
    border: 2px solid rgb(6, 217, 149, 0.8);
    opacity: 0.8;
    margin-top: 2px;
    padding: 0px 0px 0px 5px;
    max-height: 25px;
    background-color: rgb(6, 220, 149, 0.4);
}

</style>
@elseif($type=="custom")
@foreach($questions as $user)
<li><b>Question {{$user->qid}}</b></li>
@if($user->quesimg!='')
<li><img style="width: 100%" src="{{ asset("$user->quesimg").'?'.$user->remember_token }}" />
    <?php $names = pathinfo($user->quesimg);
$img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
    @if(file_exists($img_1))<img style="width: 100%" src="{{ asset("$img_1").'?'.$user->remember_token  }}" class="img-responsive">@endif
    @if(file_exists($img_2))<img style="width: 100%" src="{{ asset("$img_2").'?'.$user->remember_token  }}" class="img-responsive">@endif</li>
@else
<li style="color: #d9d9d9">Question Not Available</li>
@endif
<li class="l1" id="{{$user->qid}}" style="color: #555555;">Your Answer : Not Answered <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;0)&nbsp;</b></span></li>
@if($user->type=='single'||$user->type=='integer')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : {{$user->q1}}</li>
@elseif($user->type=='multiple')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answers : {{$user->q1 . $user->q2 . $user->q3 . $user->q4 }}</li>
@elseif($user->type=='numerical')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : Between {{$user->q1}} To {{$user->q2}}</li>
@endif
<li><b>Solution {{$user->qid}}</b></li>
@if($user->solimg!='')
<li><img style="width: 100%" src="{{ asset("$user->solimg").'?'.$user->remember_token }}" />
    <?php $names = pathinfo($user->solimg);
$img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
    @if(file_exists($img_1))<img style="width: 100%" src="{{ asset("$img_1").'?'.$user->remember_token  }}" class="img-responsive">@endif
    @if(file_exists($img_2))<img style="width: 100%" src="{{ asset("$img_2").'?'.$user->remember_token  }}" class="img-responsive">@endif</li>
@else
<li style="color: #d9d9d9">Solution Not Available</li>
@endif
<li style=" height: 3px;background-color: rgba(244,132,83,0.8);"></li>
@endforeach
<script type="text/javascript">
@foreach($answers as $ans)

var qid = "{{$ans->qid}}";
var qtype = "{{$ans->qtype}}";
var w = "{{$ans->ans_type}}";
var ans = "{{$ans->answer}}";
var bonus = "{{$ans->a5 . $ans->a6 . $ans->a7 . $ans->a8}}";
if (w == "save" || w == "save_mark") {
    if (qtype == 'single' || qtype == 'integer') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(255, 193, 7,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(255, 193, 7,0.4);');
            $('#q{{$ans->qid}}').attr('style', 'color: #555555;opacity:0.8;border-radius: 5px;border:2px solid rgb(255, 193, 7,0.8); padding: 0px 0px 5px 5px;height: 25px;background-color: rgb(255, 193, 7,0.4);');
        } else {
            $('#{{$ans->qid}}').html('Your Answer : {{$ans->a1}} <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : {{$ans->a5}}');
            if (ans == 'Correct') {
                $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
            } else {
                $('#{{$ans->qid}}').attr('style', ' margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(253,92,99,0.4);');
            }
        }


    } else if (qtype == 'multiple') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
        } else {
            $('#{{$ans->qid}}').html('Your Answers : {{$ans->a1 . $ans->a2 . $ans->a3 . $ans->a4}} <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answers : {{$ans->a5 . $ans->a6 . $ans->a7 . $ans->a8}}');
        }
        if (ans == 'Correct' || ans == 'Partially Correct') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
        } else {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(253,92,99,0.4);');
        }
    } else if (qtype == 'numerical') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
        } else {
            $('#{{$ans->qid}}').html('Your Answer : {{$ans->a1}} <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Between {{$ans->a5}} To {{$ans->a6}}');
        }

        if (ans == 'Correct') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;height: 25px;background-color: rgb(6, 220, 149,0.4);');
        } else {
            $('#{{$ans->qid}}').attr('style', ' margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(253,92,99,0.4);');
        }
    } else if (qtype == 'text') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
        } else {
            $('#{{$ans->qid}}').html('Your Answer : {{$ans->a1}} <span style="font-size:13px;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Between {{$ans->a5}} To {{$ans->a6}}');
        }

        if (ans == 'Correct') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;background-color: rgb(6, 220, 149,0.4);');
        } else if (ans == 'Pending') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(253, 110, 212,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;background-color: rgb(227, 253, 110,0.6);');
            $('#{{$ans->qid}}').html('Your Answer : {{$ans->a1}} <span style="font-size:13px;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;Pending)&nbsp;</b></span>');
        } else {
            $('#{{$ans->qid}}').attr('style', ' margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;background-color: rgba(253,92,99,0.4);');
        }
    } else if (qtype == 'scan' || qtype == 'upload') {
        if (bonus == "0000") {
            $('#{{$ans->qid}}').html('Your Answer : Bonus <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
            $('#q{{$ans->qid}}').text('Correct Answer : Bonus');
        } else {
            $('#{{$ans->qid}}').html('Your Answer : <a class="show_response btn btn-outline-danger btn-success mt-1 mb-1" style="padding:1px 5px;font-size:12px;color:#fff;" data-link="{{$ans->a1}}" data-id="{{$ans->qid}}">Your Response</a> <span style="font-size:13px;float:right;" class="pt-1">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
        }

        if (ans == 'Correct') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(6, 217, 149,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;background-color: rgb(6, 220, 149,0.4);');
        } else if (ans == 'Pending') {
            $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;border-radius: 5px;border:2px solid rgb(253, 110, 212,0.8); opacity: 0.8; padding: 0px 0px 0px 5px;background-color: rgb(227, 253, 110,0.6);');
            $('#{{$ans->qid}}').html('Your Answer : <a class="show_response btn btn-outline-danger btn-success mt-1 mb-1" style="padding:1px 5px;font-size:12px;color:#fff;" data-link="{{$ans->a1}}" data-id="{{$ans->qid}}">Your Response</a> <span style="font-size:13px;float:right;" class="pt-1">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;Pending)&nbsp;</b></span>');
        } else {
            $('#{{$ans->qid}}').attr('style', ' margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(253,92,99,0.8); padding: 0px 0px 0px 5px ;background-color: rgba(253,92,99,0.4);');
        }
    }
} else {
    if (qtype == 'single' || qtype == 'integer') {
        $('#{{$ans->qid}}').html('Your Answer : Not Answered <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
        $('#q{{$ans->qid}}').text('Correct Answer : {{$ans->a5}}');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    } else if (qtype == 'multiple') {
        $('#{{$ans->qid}}').html('Your Answer : Not Answered <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
        $('#q{{$ans->qid}}').text('Correct Answers : {{$ans->a5 . $ans->a6 . $ans->a7 . $ans->a8}}');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    } else if (qtype == 'numerical') {
        $('#{{$ans->qid}}').html('Your Answer : Not Answered <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
        $('#q{{$ans->qid}}').text('Correct Answer : Between {{$ans->a5}} To {{$ans->a6}}');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    } else {
        $('#{{$ans->qid}}').html('Your Answer : Not Answered <span style="font-size:13px;float:right;">&nbsp;&nbsp;<b>(Marks&nbsp;:&nbsp;{{$ans->marks}})&nbsp;</b></span>');
        $('#{{$ans->qid}}').attr('style', 'margin-top: 8px;color: #555555;opacity: 0.8;border-radius: 5px;border:2px solid rgba(70,184,218,0.8); padding: 0px 0px 0px 5px ;height: 25px;background-color: rgba(70,184,218,0.4);');
    }
}

@endforeach

function imageExists(url, callback) {
    var img = new Image();
    img.onload = function() { callback(true); };
    img.onerror = function() { callback(false); };
    img.src = url;
}
$("body").delegate(".show_response", "click", function() {
    $(".spinner").show();
    $(".btn-cancel").show();
    $('.socket_title').text('Question :-' + $(this).data('id') + ' Response');
    $('.socket_body').html('Wait...');
    $("#socket").show("closed");
    var asset = encodeURI('{{ asset('
        ') }}' + $(this).data('link'));
    imageExists(asset, function(exists) {
        if (exists) {
            $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset + '"/>');
            $('.socket_body').html('');
            $(".spinner").hide();
        } else {
            $('.socket_body_main').empty().html('');
            $('.socket_body').html('\n \n Sorry!!! Your Response not Available');
            $(".spinner").hide();
        }
    });

})

</script>
<style type="text/css">
.l1 {
    margin-top: 8px;
    color: #555555;
    opacity: 0.8;
    border-radius: 5px;
    border: 2px solid rgba(70, 184, 218, 0.8);
    padding: 0px 0px 0px 5px;
    background-color: rgba(70, 184, 218, 0.4);
}

.l2 {
    color: #555555;
    border-radius: 5px;
    border: 2px solid rgb(6, 217, 149, 0.8);
    opacity: 0.8;
    margin-top: 2px;
    padding: 0px 0px 0px 5px;
    background-color: rgb(6, 220, 149, 0.4);
}

</style>
@endif
<script type="text/javascript">
$("#loading").fadeOut(500);

</script>
