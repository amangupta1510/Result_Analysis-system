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
