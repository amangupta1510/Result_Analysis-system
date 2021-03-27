<?php $n=1;?>
@foreach($users as $user)
<li><b>Question {{$user->qid}}</b>&nbsp;<a class="btn btn-danger responses_list" data-qid="{{$user->qid}}" data-link="{{ route('admin-ques_analysis',['qid'=>$user->qid,'pid'=>$pid,'type'=>$type,'plid'=>$plid]) }}" style="color: #fff;margin-top:0px;padding:2px 4px; font-size: 10px;">Responses</a></li>
@if($user->quesimg!='')
<li>
    <div class="{{'hide'.$n++}}"><a style="margin-top: 5px;float: right;"><i class="glyphicon glyphicon-trash delete_ques" data-q="{{$user->qid}}" data-no="{{$n-1}}" data-ty="fst" data-id="{{$user->quesimg}}" style="color: #ff5c33"></i></a><img style="width: 95%" src="{{ asset("$user->quesimg").'?'.$user->remember_token}}" />
        <?php $name = pathinfo($user->quesimg);
$img_1 = $name['dirname'].'/'.$name['filename'].'_1.'.$name['extension']; $img_2 = $name['dirname'].'/'.$name['filename'].'_2.'.$name['extension'];?>
        @if(file_exists($img_1))<div class="{{'hide'.$n++}}"><a style="margin-top: 5px;float: right;"><i class="glyphicon glyphicon-trash delete_ques" data-q="{{$user->qid}}" data-no="{{$n-1}}" data-ty="scnd" data-id="{{$img_1}}" style="color: #ff5c33"></i></a><img style="width: 95%" src="{{ asset("$img_1").'?'.$user->remember_token }}" class="img-responsive"></div>@endif
        @if(file_exists($img_2))<div class="{{'hide'.$n++}}"><a style="margin-top: 5px;float: right;"><i class="glyphicon glyphicon-trash delete_ques" data-q="{{$user->qid}}" data-no="{{$n-1}}" data-ty="scnd" data-id="{{$img_2}}" style="color: #ff5c33"></i></a><img style="width: 95%" src="{{ asset("$img_2").'?'.$user->remember_token }}" class="img-responsive"></div>@endif
</li>
@else
<li style="color: #d9d9d9">Question Not Available</li>
@endif
@if($user->type=='normal')
@if($user->q1!=NULL)
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : {{$user->q1}}</li>
@else
<li class="l3" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : Not Available</li>
@endif
@else
@if($user->q1==NULL&&$user->q2==NULL&&$user->q3==NULL&&$user->q4==NULL)
<li class="l3" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : Not Available</li>
@else
@if($user->type=='single'||$user->type=='integer'||$user->type=='passage'||$user->type=='match_column')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : {{$user->q1}}</li>
@elseif($user->type=='multiple')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answers : @if('0000'==$user->q1 . $user->q2 . $user->q3 . $user->q4) Bonus @else {{$user->q1 . $user->q2 . $user->q3 . $user->q4}} @endif</li>
@elseif($user->type=='numerical')
<li class="l2" id="q{{$user->qid}}" style="color: #555555;">Correct Answer : @if('0000'==$user->q1 . $user->q2 . $user->q3 . $user->q4) Bonus @else {{'Between '.$user->q1.' To '.$user->q2}} @endif</li>
@endif
@endif
@endif
<li><b>Solution {{$user->qid}}</b></li>
@if($user->solimg!='')
<li>
    <div class="{{'hide'.$n++}}"><a style="margin-top: 5px;float: right;"><i class="glyphicon glyphicon-trash delete_sol" data-q="{{$user->qid}}" data-no="{{$n-1}}" data-ty="fst" data-id="{{$user->solimg}}" style="color: #ff5c33"></i></a><img style="width: 95%" src="{{ asset("$user->solimg").'?'.$user->remember_token}}" /></div>
    <?php $name = pathinfo($user->solimg);
$img_1 = $name['dirname'].'/'.$name['filename'].'_1.'.$name['extension']; $img_2 = $name['dirname'].'/'.$name['filename'].'_2.'.$name['extension'];?>
    @if(file_exists($img_1))<div class="{{'hide'.$n++}}"><a style="margin-top: 5px;float: right;"><i class="glyphicon glyphicon-trash delete_sol" data-q="{{$user->qid}}" data-no="{{$n-1}}" data-ty="scnd" data-id="{{$img_1}}" style="color: #ff5c33"></i></a><img style="width: 95%" src="{{ asset("$img_1").'?'.$user->remember_token }}" class="img-responsive"></div>@endif
    @if(file_exists($img_2))<div class="{{'hide'.$n++}}"><a style="margin-top: 5px;float: right;"><i class="glyphicon glyphicon-trash delete_sol" data-q="{{$user->qid}}" data-no="{{$n-1}}" data-ty="scnd" data-id="{{$img_2}}" style="color: #ff5c33"></i></a><img style="width: 95%" src="{{ asset("$img_2").'?'.$user->remember_token }}" class="img-responsive"></div>@endif
</li>
@else
<li style="color: #d9d9d9">Solution Not Available</li>
@endif
<li style=" height: 3px;background-color: rgba(244,132,83,0.8);"></li>
<script type="text/javascript">
$("#loading").fadeOut(500);

</script>
@endforeach
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript">
$('.delete_ques').on('click', function() {
    var img = $(this).data('id');
    var n = $(this).data('no');
    var dt = $(this).data('ty');
    var q = $(this).data('q');
    var no = 'hide' + n;
    var img_type = 'ques';
    var answer = window.confirm("Are you sure to delete Question no.(" + q + ") ?")
    if (answer) {
        var loading = document.getElementById('loading');
        $("#loading").attr('style', 'z-index:99999;display:none;');
        loading.style.display = '';
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "delete_image",
            data: { img: img, img_type: img_type },
            success: function(data) {
                $('.' + no).empty().html('<li style="color: #d9d9d9">Question Not Available</li>');
                $("#loading").fadeOut(500);
            },

        });
        if (dt == 'scnd') {
            $('.' + no).empty().html('<li style="color: #d9d9d9">Question Not Available</li>');
            $("#loading").fadeOut(500);
        }
    }
});
$('.delete_sol').on('click', function() {
    var img = $(this).data('id');
    var n = $(this).data('no');
    var dt = $(this).data('ty');
    var q = $(this).data('q');
    var no = 'hide' + n;
    var img_type = 'sol';
    var answer = window.confirm("Are you sure to delete Solution no.(" + q + ") ?")
    if (answer) {
        var loading = document.getElementById('loading');
        $("#loading").attr('style', 'z-index:99999;display:none;');
        loading.style.display = '';
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "delete_image",
            data: { img: img, img_type: img_type },
            success: function(data) {
                $('.' + no).empty().html('<li style="color: #d9d9d9">Solution Not Available</li>');
                $("#loading").fadeOut(500);
            },
        });
        if (dt == 'scnd') {
            $('.' + no).empty().html('<li style="color: #d9d9d9">Solution Not Available</li>');
            $("#loading").fadeOut(500);
        }
    }
});
$("body").delegate(".responses_list", "click", function() {
    var link = $(this).data("link");
    var qid = $(this).data("qid");
    $(".spinner").hide();
    $('.socket_title').text('Question ' + qid + ' Responses');
    $.get(link, function(data) {
        $('.socket_body').empty().html(data);
        $("#socket").show("closed");
    });
});

</script>
<style type="text/css">
.l2 {
    margin-top: 8px;
    color: #555555;
    opacity: 0.8;
    border-radius: 5px;
    border: 2px solid rgb(6, 217, 149, 0.8);
    padding: 0px 0px 5px 5px;
    height: 25px;
    background-color: rgb(6, 220, 149, 0.4);
}

.l3 {
    margin-top: 8px;
    color: #555555;
    opacity: 0.8;
    border-radius: 5px;
    border: 2px solid rgba(253, 92, 99, 0.8);
    padding: 0px 0px 5px 5px;
    height: 25px;
    background-color: rgba(253, 92, 99, 0.4);
}

</style>
