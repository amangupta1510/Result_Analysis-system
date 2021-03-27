<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
html {
    margin: 15px;
    padding: 15px;
    zoom: 50%;
}

</style>
<h2 style="text-decoration: underline;text-align: center;font:bold;font-size: 25px">{{$name}}'s Results</h2>
<table id="table" class="table table-bordered" style="zoom:70%;">
    @if($type=="All")
    <thead style="color: #fff;background-color: #d9534f;border-color: #d43f3a;">
        <tr>
            <th scope="col">Sr. no.</th>
            <th scope="col" colspan="2">Paper</th>
            <th scope="col">Physics</th>
            <th scope="col">Chemistry</th>
            <th scope="col">Math</th>
            <th scope="col">Biology</th>
            <th scope="col">Score</th>
            <th scope="col">Max marks</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$no++}}</th>
            <td colspan="2">{{$user->paper}}</td>
            @if($user->PQ!='0')<td>{{$user->totalSinP}}</td>@else<td>--</td>@endif
            @if($user->CQ!='0')<td>{{$user->totalSinC}}</td>@else<td>--</td>@endif
            @if($user->MQ!='0')<td>{{$user->totalSinM}}</td>@else<td>--</td>@endif
            @if($user->BQ!='0')<td>{{$user->totalSinB}}</td>@else<td>--</td>@endif
            <th scope="row">{{$user->totalS}}</th>
            <td>{{$user->total_marks}}</td>
        </tr>
        @endforeach
    </tbody>
    @elseif($type=="Physics")
    <thead style="color: #fff;background-color: #d9534f;border-color: #d43f3a;">
        <tr>
            <th scope="col">Sr. no.</th>
            <th scope="col" colspan="2">Paper</th>
            <th scope="col">Physics</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach($users as $user)
        @if($user->PQ!='0')
        <tr>
            <th scope="row">{{$no++}}</th>
            <td colspan="2">{{$user->paper}}</td>
            <td>{{$user->totalSinP}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
    @elseif($type=="Chemistry")
    <thead style="color: #fff;background-color: #d9534f;border-color: #d43f3a;">
        <tr>
            <th scope="col">Sr. no.</th>
            <th scope="col" colspan="2">Paper</th>
            <th scope="col">Chemistry</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach($users as $user)
        @if($user->CQ!='0')
        <tr>
            <th scope="row">{{$no++}}</th>
            <td colspan="2">{{$user->paper}}</td>
            <td>{{$user->totalSinC}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
    @elseif($type=="Math")
    <thead style="color: #fff;background-color: #d9534f;border-color: #d43f3a;">
        <tr>
            <th scope="col">Sr. no.</th>
            <th scope="col" colspan="2">Paper</th>
            <th scope="col">Math</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach($users as $user)
        @if($user->MQ!='0')
        <tr>
            <th scope="row">{{$no++}}</th>
            <td colspan="2">{{$user->paper}}</td>
            <td>{{$user->totalSinM}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
    @elseif($type=="Biology")
    <thead style="color: #fff;background-color: #d9534f;border-color: #d43f3a;">
        <tr>
            <th scope="col">Sr. no.</th>
            <th scope="col" colspan="2">Paper</th>
            <th scope="col">Biology</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;?>
        @foreach($users as $user)
        @if($user->BQ!='0')
        <tr>
            <th scope="row">{{$no++}}</th>
            <td colspan="2">{{$user->paper}}</td>
            <td>{{$user->totalSinB}}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
    @endif
</table>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
