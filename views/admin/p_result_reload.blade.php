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
