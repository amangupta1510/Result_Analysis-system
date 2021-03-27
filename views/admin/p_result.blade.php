@extends('layout/admin_dashboard')
@extends('layout/details')
@section('popup')
{{-- Form Delete Post --}}
<div id="delete" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">delete</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    @csrf
                    <h4 id="delete-name"></h4>
                    <p id="delete-id" class="hidden"></p>
                </form>
            </div>
            <div class="modal-footer">
                <button style="background-color: #fd6e70" class="btn btn-warning" type="submit" id="delete-student">
                    Delete
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
{{-- Form show --}}
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainstudent_show_paper.css')}}">
<div id="show" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title paper_title"></h5>
            </div>
            <div id="table" class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
{{--
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainshow_result.css')}}">
<div id="show" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="table" class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div> --}}
@endsection
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainresult.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Results</b>
                <div class="searchForm">
                    <form action="{{route('admin-paper_result')}}" method="get">
                        <input type="hidden" name="id" value="{{ Request::get('id') }}" />
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
                            <th class="column2">Name</th>
                            <th class="column3">Class</th>
                            <th class="column4">course</th>
                            <th class="column5">Paper</th>
                            <th class="column6"></th>
                            <th class="column7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        @if($user->active==1)
                        <tr class="user{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->name }}</strong></td>
                            <td class="column3"><strong>{{ $user->classid }}</strong></td>
                            <td class="column4"><strong>{{ $user->courseid }}</strong></td>
                            <td class="column5"><strong>{{ $user->paper }}</strong></td>
                            <td class="column6" style="padding: 5px 5px 5px 5px;cursor:pointer;">@if($user->rank!='')
                                <a>AIR {{$user->rank}} &nbsp;</a>@endif<strong><a href="{{ route('admin-result_analysis',['id' =>$user->id]) }}">RESULT</a>&nbsp;&nbsp;<a id="show-button" title="Show Responses" class="btn btn-success" style="color: #fff;zoom:.6" data-toggle="modal" data-target="#show" data-id="{{$user->pid}}" data-plid="{{$user->plid}}" data-type="{{$user->type}}" data-paper="{{$user->name}}" data-sid="{{$user->sid}}"><i class="fa fa-eye" style="color: #fff"></i></a></strong></td>
                            <td class="column7"><a data-link="{{ route('admin-send_result',['id'=>$user->plid,'sid'=>$user->sid,'type'=>$user->type]) }}" class="send_msg"><i class="fa fa-send" style="color: #ff9933"></i></a>&nbsp;&nbsp;<a id="delete-button" data-toggle="modal" data-target="#delete" data-name="{{$user->paper}}" data-id="{{$user->id}}">
                                    <i class="glyphicon glyphicon-trash" style="color: #ff5c33"></i></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <p>{{$users->onEachSide(1)->links()}}</p>
            </div>
        </div>
    </div>
    <style type="text/css">
    li {
        list-style: none;
    }

    </style>
    @endsection
    @section('js')
    <script type="text/javascript">
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var url = $(this).attr('href').split('page=')[1];
        var year = $('input[name=s]').val();
        var id = "{{app('request')->input('id')}}";
        var img = "{{ route('admin-paper_result_page',['id'=>':id','s'=>':year','page'=>':page']) }}";
        var img = img.replace('%3Ayear', year);
        var img = img.replace('%3Aid', id);
        var img = img.replace('%3Apage', url);
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#tbody').empty().html(data);
        })
        $("#loading").fadeOut(500);

    });
    //    $(document).on('click', '#show-button', function() {
    //     var loading = document.getElementById('loading');
    //     loading.style.display='';
    //     var id=$(this).data('id');
    //     var img ="{{ route('admin-resultshow',['id'=>':id']) }}";
    //     var img = img.replace('%3Aid',id);
    //     $.get(img,function(data){
    //           $('#table').empty().html(data);
    //     })
    //     });
    $(document).on('click', '#delete-button', function() {
        $('#delete').modal({ backdrop: 'false' });
        $('#delete-name').text('Are You sure want to delete (' + $(this).data('name') + ')....');
        $('#delete-id').text($(this).data('id'));

    });
    $(document).on('click', '#show-button', function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var id = $(this).data('id');
        var plid = $(this).data('plid');
        var type = $(this).data('type');
        var sid = $(this).data('sid');
        var paper = $(this).data('paper');
        $('.paper_title').text(paper);
        var img = "{{ route('admin-student_papershow',['id'=>':id','sid'=>':sid','type'=>':type','plid'=>':plid']) }}";
        var img = img.replace('%3Aid', id);
        var img = img.replace('%3Asid', sid);
        var img = img.replace('%3Aplid', plid);
        var img = img.replace('%3Atype', type);
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#table').empty().html(data);
        })
    });

    $('#delete-student').click(function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        $.ajax({
            type: 'POST',
            url: '{{ route('
            admin - delete_result ') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#delete-id').text(),
            },
            success: function(data) {
                $('.user' + $('#delete-id').text()).hide();
                $('#delete').modal('hide');
                $("#loading").fadeOut(500);
            }
        });
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
