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
