@extends('layout/admin_dashboard')
@extends('layout/details')
@section('popup')
<div id="delete" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Recycle</h4>
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
                    Recycle
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
<div id="p_delete" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Permanent Delete</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    @csrf
                    <h4 id="p_delete-name"></h4>
                    <p id="p_delete-id" class="hidden"></p>
                </form>
            </div>
            <div class="modal-footer">
                <button style="background-color: #fd6e70" class="btn btn-warning" type="submit" id="pp_delete-student">
                    Delete result
                </button>
                <button class="btn btn-danger" type="submit" id="p_delete-student">
                    Delete result + answers
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
@endsection
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainresult_recycle_admin.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Results</b>
                <div class="searchForm">
                    <form action="{{route('admin-recycle_result')}}" method="get">
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
                            <th class="column7">Recycle</th>
                            <th class="column8">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        @if($user->active==0)
                        <tr class="user{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->name }}</strong></td>
                            <td class="column3"><strong>{{ $user->classid }}</strong></td>
                            <td class="column4"><strong>{{ $user->courseid }}</strong></td>
                            <td class="column5"><strong>{{ $user->paper }}</strong></td>
                            <td class="column6">@if($user->rank!='')
                                <a>AIR {{$user->rank}}</a>@endif</td>
                            <td class="column7"> <a id="delete-button" data-toggle="modal" data-target="#delete" data-name="{{$user->name}}" data-id="{{$user->id}}">
                                    <i class="fa fa-recycle fa-2x" style="color: #30dd8a"></i></a></td>
                            <td class="column8"> <a id="p_delete-button" data-toggle="modal" data-target="#p_delete" data-name="{{$user->name}}" data-id="{{$user->id}}">
                                    <i class="glyphicon glyphicon-trash" style="color: #ff5c33"></i></a></td>
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
        var img = "{{ route('admin-recycle_result_page',['s'=>':year','page'=>':page']) }}";
        var img = img.replace('%3Ayear', year);
        var img = img.replace('%3Apage', url);
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#tbody').empty().html(data);
        })
        $("#loading").fadeOut(500);
    });
    $(document).on('click', '#delete-button', function() {
        $('#delete').modal({ backdrop: 'false' });
        $('#delete-name').text('Are You sure want to Recycle (' + $(this).data('name') + ')....');
        $('#delete-id').text($(this).data('id'));

    });

    $('#delete-student').click(function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        $.ajax({
            type: 'POST',
            url: '{{ route('
            admin - recycle_result_submit ') }}',
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
    $(document).on('click', '#p_delete-button', function() {
        $('#p_delete').modal({ backdrop: 'false' });
        $('#p_delete-name').text('Are You sure want to Permanent Delete (' + $(this).data('name') + ')....');
        $('#p_delete-id').text($(this).data('id'));

    });
    $('#p_delete-student').click(function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        $.ajax({
            type: 'POST',
            url: '{{ route('
            admin - p_delete_result_submit ') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#p_delete-id').text(),
            },
            success: function(data) {
                $('.user' + $('#p_delete-id').text()).hide();
                $('#p_delete').modal('hide');
                $("#loading").fadeOut(500);
            }
        });
    });
    $('#pp_delete-student').click(function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        $.ajax({
            type: 'POST',
            url: '{{ route('
            admin - pp_delete_result_submit ') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#p_delete-id').text(),
            },
            success: function(data) {
                $('.user' + $('#p_delete-id').text()).hide();
                $('#p_delete').modal('hide');
                $("#loading").fadeOut(500);
            }
        });
    });

    //------------------------------------------------search----------------------------------//

    $('#searchField').keydown(function(e) {
        if (e.keyCode === 13) { // If Enter key pressed
            $(this).trigger('submit');
        }
    });
    //--------------------------------------------end search------------------------------//

    </script>
    <script type="text/javascript">
    $(". search-btn").click(function() {
        $(".search-input").toggleClass("active").focus;
        $(this).toggleClass("animate");
        $(".input").val("");
    });

    </script>
    @endsection
