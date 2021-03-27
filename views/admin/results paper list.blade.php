@extends('layout/admin_dashboard')
@extends('layout/details')
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainstudent.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Results</b>
                <div class="searchForm">
                    <form action="{{route('admin-paper_list_search')}}" method="get">
                        <input type="hidden" name="id" value="{{ Request::get('id') }}" />
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
            <div class="table100">
                <table>
                    <thead>
                        <tr class="table100-head">
                            <th class="column1">S.No</th>
                            <th class="column2">Paper Name</th>
                            <th class="column3">Class</th>
                            <th class="column4">Course</th>
                            <th class="column5">Course Type</th>
                            <th class="column6">Group</th>
                            <th class="column7">Results</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        <tr class="{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->paper }}</strong></td>
                            <td class="column3"><strong>{{ $user->classid }}</strong></td>
                            <td class="column4"><strong>{{ $user->courseid }}</strong></td>
                            <td class="column5"><strong>{{ $user->coursetypeid }}</strong></td>
                            <td class="column6"><strong>{{ $user->groupid }}</strong></td>
                            <td class="column7"><a style="color: #fff" class="btn btn-warning" href="{{ url('p_result?id='.$user->id) }}">Result</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>{{$users->onEachSide(1)->links()}}</p>
            </div>
        </div>
    </div>
    @endsection
