@foreach($users as $user)
<ul id="r1">
    <label><strong>RESULT</strong></label>
    <li class="top">Total Marks &nbsp;&nbsp; &nbsp;&nbsp; :&nbsp; {{$user->total_marks}}</li>
    <li class="1st">Total Score &nbsp;&nbsp; &nbsp;&nbsp; :&nbsp; {{$user->totalS}}</li>
    <li class="1st">Time Used &nbsp;:&nbsp; {{$user->lefttime}} min.</li>
    <li class="1st">Total Correct&nbsp; &nbsp;&nbsp;:&nbsp; {{$user->totalC}}</li>
    <li class="1st">Total&nbsp; Incorrect&nbsp;:&nbsp; {{$user->totalW}}</li>
    <li class="1st">Total &nbsp;Attempt &nbsp; :&nbsp; {{$user->totalA}}</li>
</ul>
@if($user->PQ!=0)
<ul id="r2">
    <label><strong>PHYSICS</strong></label>
    <li class="phy">Correct&nbsp; &nbsp;&nbsp;:&nbsp; {{$user->totalCinP}}</li>
    <li class="phy">Incorrect &nbsp;:&nbsp; {{$user->totalWinP}}</li>
    <li class="phy">Score &nbsp; &nbsp; &nbsp; :&nbsp; {{$user->totalSinP}}</li>
</ul>
@else
<li id="r2" style="display: none;"></li>
@endif
@if($user->CQ!=0)
<ul id="r3">
    <label><strong>CHEMISTRY</strong></label>
    <li class="chem">Correct&nbsp; &nbsp;&nbsp;:&nbsp; {{$user->totalCinC}}</li>
    <li class="chem">Incorrect &nbsp;:&nbsp; {{$user->totalWinC}}</li>
    <li class="chem">Score &nbsp; &nbsp; &nbsp; :&nbsp; {{$user->totalSinC}}</li>
</ul>
@else
<li id="r3" style="display: none;"></li>
@endif
@if($user->MQ!=0)
<ul id="r4">
    <label><strong>MATHEMATICS</strong></label>
    <li class="math">Correct&nbsp; &nbsp;&nbsp;&nbsp;: {{$user->totalCinM}}</li>
    <li class="math">Incorrect &nbsp;:&nbsp; {{$user->totalWinM}}</li>
    <li class="math">Score &nbsp; &nbsp; &nbsp; :&nbsp; {{$user->totalSinM}}</li>
</ul>
@else
<li id="r4" style="display: none;"></li>
@endif
@if($user->BQ!=0)
<ul id="r5">
    <label><strong>BIOLOGY</strong></label>
    <li class="bio">Correct&nbsp; &nbsp;&nbsp;&nbsp;: {{$user->totalCinB}}</li>
    <li class="bio">Incorrect &nbsp;:&nbsp; {{$user->totalWinB}}</li>
    <li class="bio">Score &nbsp; &nbsp; &nbsp; :&nbsp; {{$user->totalSinB}}</li>
</ul>
@else
<li id="r5" style="display: none;"></li>
@endif
@endforeach
<script type="text/javascript">
$("#loading").fadeOut(500);

</script>
