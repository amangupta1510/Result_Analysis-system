@extends('layout/admin_dashboard')
@extends('layout/details')
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainpaperlist.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Results</b>
                <div class="searchForm">
                    <form action="{{route('admin-paper_list_result')}}" method="get">
                        <input id="searchField" type="text" name="s" value="{{ app('request')->input('s')}}" placeholder="Search here" />
                        <div class="close">
                            <span class="front"></span>
                            <span class="back"></span>
                        </div>
                    </form>
                </div>
            </h4>
        </div>
    </div>
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100" id="tbody">
                <table>
                    <thead>
                        <tr class="table100-head">
                            <th class="column1">S.No</th>
                            <th class="column2">Paper Name</th>
                            <th class="column3">Class</th>
                            <th class="column4">Course</th>
                            <th class="column5">Course Type</th>
                            <th class="column6">Group</th>
                            <th class="column7">Total</th>
                            <th class="column8">Results</th>
                            <th class="column9">Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        <?php $rn=0;$total=0;$ok='hide';?>
                        @foreach($counts as $count)
                        @if($count->plid==$user->id)
                        @if($count->type=='custom'&&intval($count->totalP)>0)
                        <?php $ok='show'; $total+=$count->totalP; ?>
                        @endif
                        <?php $rn++ ?>
                        @endif
                        @endforeach
                        @if($user->active==1)
                        <tr class="{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->paper }}</strong></td>
                            <td class="column3"><strong>{{ $user->classid }}</strong></td>
                            <td class="column4"><strong>{{ $user->courseid }}</strong></td>
                            <td class="column5"><strong>{{ $user->coursetypeid }}</strong></td>
                            <td class="column6"><strong>{{ $user->groupid }}</strong></td>
                            <td class="column7"><strong>{{ $rn }} {{$rn>1?'Results':'Result'}}</strong>@if($ok=='show')&nbsp;<a class="btn btn-danger btn-outline-dark" href="{{ route('admin-pending_response',['id'=>$user->id,'pid'=>$user->pid]) }}" style="padding: 3px 4px;font-size: 12px;color:#fff;">Pending&nbsp;<i style="font-size: 10px;">({{$total}})</i></a>@endif</td>
                            <td class="column8"><a style="color: #fff" class="btn btn-warning" href="{{ route('admin-paper_result',['id'=>$user->id]) }}">Result</a></td>
                            <td class="column9"><a data-link="{{ route('admin-send_result',['id'=>$user->id,'sid'=>'none','type'=>$user->type]) }}" class="send_msg"><i class="fa fa-send" style="color: #ff9933"></i></a>&nbsp;&nbsp;<a href="{{ route('admin-paper_link_summary',['id'=>$user->id]) }}"><i style="color: #fd6e70" class="glyphicon glyphicon-download"></i></a></td>
                        </tr>
                        @endif
                    </tbody>
                    @endforeach
                </table>
                <p>{{$users->onEachSide(1)->links()}}</p>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript">
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var url = $(this).attr('href').split('page=')[1];
        var year = $('input[name=s]').val();
        var img = "{{ route('admin-paper_list_result_page',['s'=>':year','page'=>':page']) }}";
        var img = img.replace('%3Ayear', year);
        var img = img.replace('%3Apage', url);
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#tbody').empty().html(data);
        })
        $("#loading").fadeOut(500);

    });
    $('#searchField').keydown(function(e) {
        if (e.keyCode === 13) { // If Enter key pressed
            $(this).trigger('submit');
        }
    });
    $(".search-btn").click(function() {
        $(".search-input").toggleClass("active").focus;
        $(this).toggleClass("animate");
        $(".input").val("");
    });

    $("body").delegate(".send_msg", "click", function() {
        var img1 = $(this).data('link') + "&msg_type=message";
        var img2 = $(this).data('link') + "&msg_type=notification";
        $(".spinner").hide();
        $('.socket_title').text('Result Send...');
        $('.socket_body').empty().html('<p>Sure want to send result<p><br><a style="color:#fff; font-size:13px;margin:4px 5px;" class="btn btn-success send_msg_submit" data-link="' + img1 + '" style="margin:10px;" >Send Message</a>&nbsp;&nbsp;<a style="color:#fff; font-size:13px;margin:4px 5px;" class="btn btn-danger send_msg_submit" data-link="' + img2 + '" style="margin:10px;" >Send Notification</a>');
        $("#socket").show("closed");
    });

    $("body").delegate(".send_msg_submit", "click", function() {
        var btn = $(this);
        var txt = btn.text();
        btn.attr("disabled", true).text("Sending...");
        setTimeout(function() { btn.attr("disabled", false).text(txt); }, 5000);
        var img = $(this).data('link');
        $.get(img, function(data) {
            $("#socket").hide(500);
        });
    });

    </script>
    @endsection
