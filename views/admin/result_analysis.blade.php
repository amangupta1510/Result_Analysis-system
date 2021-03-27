@extends('layout/admin_dashboard')
@extends('layout/details')
@section('popup')
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainstudent_show_paper.css')}}">
<div id="show" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title paper_title"></h5>
            </div>
            <div id="table" class="modal-body" style="list-style: none;">
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
<div class="hidden disabledScroll" data-id="yes"></div>
@endsection
@section('analysis')
@foreach($papers as $p)
@foreach($results as $r)
@if($p->type=='normal')
<div class="disabledScroll" style="display: none;" data-id="yes"></div>
<div class="d-sm-flex justify-content-between align-items-center mb-4 pt-2">
    <h3 class="text-dark mb-0">Result Analysis<a class="d-sm-inline-block" style="font-size: 15px;"><b>&nbsp;({{$r->name}})&nbsp;</b></a>&nbsp;<a data-link="{{ route('admin-send_result',['id'=>$r->plid,'sid'=>$r->sid,'type'=>$r->type]) }}" class="btn btn-success send_msg">send result&nbsp;</a>&nbsp;<a id="show-button" title="Show Responses" class="btn btn-info" style="color: #fff;" data-toggle="modal" data-target="#show" data-id="{{$r->pid}}" data-plid="{{$r->plid}}" data-type="{{$r->type}}" data-sid="{{$r->sid}}"><i class="fa fa-eye" style="color: #fff"></i></a></h3><a class="d-sm-inline-block"><b>{{$p->pname.' Submited on '.date_format(date_create($r->timer),"d/m/Y, h:i a")}}</b></a>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Total Score</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalS}}</span><a style="font-size: 15px;"> (out of {{$r->total_marks}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($p->PQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Physics</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinP}}</span><a style="font-size: 15px;"> (out of{{$p->PQ*$p->PM}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($p->CQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-danger py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-danger font-weight-bold text-xs mb-1"><span>Chemistry</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinC}}</span><a style="font-size: 15px;"> (out of {{$p->CQ*$p->CM}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($p->MQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Mathmatics</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinM}}</span><a style="font-size: 15px;"> (out of {{$p->MQ*$p->MM}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($p->BQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-info py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Biology</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinB}}</span><a style="font-size: 15px;"> (out of {{$p->BQ*$p->BM}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<?php 
            
            $PQN=$r->PQ; $CQN=$r->CQ+$PQN; $MQN=$r->MQ+$CQN; $BQN=$r->BQ+$MQN; $TQ=$r->totalQ; $n=0; $NOS=0;
            if($r->PQ!=0){$NOS++;}if($r->CQ!=0){$NOS++;}if($r->MQ!=0){$NOS++;}if($r->BQ!=0){$NOS++;}
            $TforS = 60*$p->TT/$NOS;
            $TwiseP=0; $TwiseP=0; $TwiseC=0; $TwiseM=0; $TwiseB=0;
            $NeffiO=0; $NeffiP=0; $NeffiC=0; $NeffiM=0; $NeffiB=0;
            $TuseO =0; $TuseP = 0;  $TuseC = 0;  $TuseM = 0;  $TuseB = 0;
            $TuseOn =0; $TusePn = 0;  $TuseCn = 0;  $TuseMn = 0;  $TuseBn = 0;
            $TuseOu =0; $TusePu = 0;  $TuseCu = 0;  $TuseMu = 0;  $TuseBu = 0;
            $TuseOc =1; $TusePc = 1;  $TuseCc = 1;  $TuseMc = 1;  $TuseBc = 1;
            $timearray = array();$ansarray = array();
            for ($i = 1; $i <= $r->totalQ; $i++){
                $timearray[$i]="0";$ansarray[$i]="Unattempted";
            }
              
           
            foreach($answers as $a){
                    $n++;
                $timearray[$a->qid] = $a->time_used>300?300:$a->time_used;
                    if($a->qid<=$PQN)   {$TuseP = $TuseP+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseC = $TuseC+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseM = $TuseM+$a->time_used;}
                elseif($a->qid<=$BQN)   {$TuseB = $TuseB+$a->time_used;}
              if($a->answer=="Incorrect"&&($a->a8=="save"||$a->a8=="save_mark")){
                $ansarray[$a->qid] = "Incorrect";
                    if($a->qid<=$PQN)   {$TusePn = $TusePn+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseCn = $TuseCn+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseMn = $TuseMn+$a->time_used;}
                elseif($a->qid<=$BQN)   {$TuseBn = $TuseBn+$a->time_used;}
            }
            elseif (($a->answer=="Partially Correct"||$a->answer=="Correct") && ($a->a8=="save"||$a->a8=="save_mark")) {
                $ansarray[$a->qid] = "Correct";
                    if($a->qid<=$PQN)   {$TusePc = $TusePc+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseCc = $TuseCc+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseMc = $TuseMc+$a->time_used;}
                elseif($a->qid<=$BQN)   {$TuseBc = $TuseBc+$a->time_used;}
            }else{
                 $ansarray[$a->qid] = "Unattempted";
                   if($a->qid<=$PQN)   {$TusePu = $TusePu+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseCu = $TuseCu+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseMu = $TuseMu+$a->time_used;}
                elseif($a->qid<=$BQN)   {$TuseBu = $TuseBu+$a->time_used;}
            }
            if($a->a7=="Bonus"){ $ansarray[$a->qid] = "Bonus";}
            }
               //timewise efficiency formula
        if($r->PQ!=0){$TwiseP = (($TforS/$TusePc)-(($TusePn + $TusePu)/$TforS))*100;  $NeffiP=(($r->PQ - $r->totalWinP)/$r->PQ)*100;}
        if($r->CQ!=0){$TwiseC = (($TforS/$TuseCc)-(($TuseCn + $TuseCu)/$TforS))*100;  $NeffiC=(($r->CQ - $r->totalWinC)/$r->CQ)*100;}
        if($r->MQ!=0){$TwiseM = (($TforS/$TuseMc)-(($TuseMn + $TuseMu)/$TforS))*100;  $NeffiM=(($r->MQ - $r->totalWinM)/$r->MQ)*100;}
        if($r->BQ!=0){$TwiseB = (($TforS/$TuseBc)-(($TuseBn + $TuseBu)/$TforS))*100;  $NeffiB=(($r->BQ - $r->totalWinB)/$r->BQ)*100;}
                 $TwiseP = intval($TwiseP>100?100:($TwiseP<1?0:$TwiseP));
                 if($r->PQ!=0){$TwiseP = intval(($TwiseP + (($r->totalSinP/($p->PQ*$p->PM))*100))/2);}
                 $TwiseC = intval($TwiseC>100?100:($TwiseC<1?0:$TwiseC));
                 if($r->CQ!=0){$TwiseC = intval(($TwiseC + (($r->totalSinC/($p->CQ*$p->CM))*100))/2);}
                 $TwiseM = intval($TwiseM>100?100:($TwiseM<1?0:$TwiseM));
                 if($r->MQ!=0){$TwiseM = intval(($TwiseM + (($r->totalSinM/($p->MQ*$p->MM))*100))/2);}
                 $TwiseB = intval($TwiseB>100?100:($TwiseB<1?0:$TwiseB));
                 if($r->BQ!=0){$TwiseB = intval(($TwiseB + (($r->totalSinB/($p->BQ*$p->BM))*100))/2);}
                 $NeffiP = intval($NeffiP>100?100:($NeffiP<1?0:$NeffiP));
                 $NeffiC = intval($NeffiC>100?100:($NeffiC<1?0:$NeffiC));
                 $NeffiM = intval($NeffiM>100?100:($NeffiM<1?0:$NeffiM));
                 $NeffiB = intval($NeffiB>100?100:($NeffiB<1?0:$NeffiB));
                 $TwiseO = intval(($TwiseP + $TwiseC + $TwiseM + $TwiseB)/$NOS);
                 $NeffiO = intval(( $NeffiP +  $NeffiC +  $NeffiM + $NeffiB)/$NOS);
                  $TwiseO = intval($TwiseO>100?100:($TwiseO<1?0:$TwiseO));
                  $NeffiO = intval($NeffiO>100?100:($NeffiO<1?0:$NeffiO));
                 $TuseO = $TuseP + $TuseC + $TuseM + $TuseB;
                 $TuseOn = $TusePn + $TuseCn + $TuseMn + $TuseBn;
                 $TuseOu = $TusePu + $TuseCu + $TuseMu + $TuseBu;
                 $TuseOc = $TusePc + $TuseCc + $TuseMc + $TuseBc;
                
             ?>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Overall Performance</h6>
            </div>
            <div class="card-body" id="chart-1">
                <?php $perC = 100*$r->totalC/$r->totalQ; $perW = 100*$r->totalW/$r->totalQ; $perU = 100 - $perC -$perW;?>
                <div class="chart-area" id="chart-1_1"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Correct ({{$r->totalC}})&quot;,&quot;Incorrect ({{$r->totalW}})&quot;,&quot;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW}})&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#1cc88a&quot;,&quot;#e74a3b&quot;,&quot;#b7b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{intval($perC)}}&quot;,&quot;{{intval($perW)}}&quot;,&quot;{{intval($perU)}}&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Correct ({{$r->totalC}})</span><span class="mr-2"><i class="fas fa-circle text-danger"></i>&nbsp;Incorrect ({{$r->totalW}})</span><span class="mr-2"><i class="fas fa-circle" style="color: #b7b9cc;"></i>&nbsp;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW}})</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card text-center card_border mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Detailed Performance</h6>
            </div>
            <div class="card-body">
                <!-- stacked bar chart -->
                <div id="container">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="detailedperformance" width="676" height="338" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- //stacked bar chart -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Overall Time Utilisation</h6>
            </div>
            <div class="card-body" id="chart-2">
                <?php $perC = 100*$TuseOc/($p->TT*60); $perW = 100*$TuseOn/($p->TT*60); $perU = 100*$TuseOu/($p->TT*60);
                                $perR = 100-$perC-$perW-$perU?>
                <div class="chart-area" id="chart-2_1"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Correct ({{intval($TuseOc/60)}}) min&quot;,&quot;Incorrect ({{intval($TuseOn/60)}}) min&quot;,&quot;Unattempted ({{intval($TuseOu/60)}}) min&quot;,&quot;Unused Time ({{intval($p->TT-($TuseOn+$TuseOc+$TuseOu)/60)}}) min&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#8ad4eb&quot;,&quot;#f2c80f&quot;,&quot;#374649&quot;,&quot;#e5e5e5&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{intval($perC)}}&quot;,&quot;{{intval($perW)}}&quot;,&quot;{{intval($perU)}}&quot;,&quot;{{intval($perR)}}&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle" style="color: #8ad4eb;"></i>&nbsp;Time use in Correct ({{intval($TuseOc/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #f2c80f;"></i>&nbsp;Time use in Incorrect ({{intval($TuseOn/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #374649;"></i>&nbsp;Time use in Unattempted ({{intval($TuseOu/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #e5e5e5;"></i>&nbsp;Unused Time ({{intval((($p->TT*60) - $TuseOn - $TuseOc - $TuseOu)/60)}} min)</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card text-center card_border mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Timewise Detailed Performance</h6>
            </div>
            <div class="card-body">
                <!-- stacked bar chart -->
                <div id="container">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="timewisedetailedperformance" width="676" height="338" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- //stacked bar chart -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Timewise Efficiency</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Overall<span class="float-right">{{$TwiseO}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{$TwiseO}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseO}}%;"><span class="sr-only">{{$TwiseO}}%</span></div>
                </div>
                @if($p->PQ!=0&&$p->PM!=0&&$TuseP!=0)
                <h4 class="small font-weight-bold">Physics<span class="float-right">{{$TwiseP}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" aria-valuenow="{{$TwiseP}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseP}}%;"><span class="sr-only">{{$TwiseP}}%</span></div>
                </div>
                @endif
                @if($p->CQ!=0&&$p->CM!=0&&$TuseC!=0)
                <h4 class="small font-weight-bold">Chemistry<span class="float-right">{{$TwiseC}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" aria-valuenow="{{$TwiseC}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseC}}%;"><span class="sr-only">{{$TwiseC}}%</span></div>
                </div>
                @endif
                @if($p->MQ!=0&&$p->MM!=0&&$TuseM!=0)
                <h4 class="small font-weight-bold">Mathematics<span class="float-right">{{$TwiseM}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" aria-valuenow="{{$TwiseM}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseM}}%;"><span class="sr-only">{{$TwiseM}}%</span></div>
                </div>
                @endif
                @if($p->BQ!=0&&$p->BM!=0&&$TuseB!=0)
                <h4 class="small font-weight-bold">Biology<span class="float-right">{{$TwiseB}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" aria-valuenow="{{$TwiseB}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseB}}%;"><span class="sr-only">{{$TwiseB}}%</span></div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Efficiency Against -Ve Marking</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Overall<span class="float-right">{{$NeffiO}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{$NeffiO}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiO}}%;"><span class="sr-only">{{$NeffiO}}%</span></div>
                </div>
                @if($p->PQ!=0&&$p->PM!=0&&$TuseP!=0)
                <h4 class="small font-weight-bold">Physics<span class="float-right">{{$NeffiP}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" aria-valuenow="{{$NeffiP}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiP}}%;"><span class="sr-only">{{$NeffiP}}%</span></div>
                </div>
                @endif
                @if($p->CQ!=0&&$p->CM!=0&&$TuseC!=0)
                <h4 class="small font-weight-bold">Chemistry<span class="float-right">{{$NeffiC}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" aria-valuenow="{{$NeffiC}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiC}}%;"><span class="sr-only">{{$NeffiC}}%</span></div>
                </div>
                @endif
                @if($p->MQ!=0&&$p->MM!=0&&$TuseM!=0)
                <h4 class="small font-weight-bold">Mathematics<span class="float-right">{{$NeffiM}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" aria-valuenow="{{$NeffiM}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiM}}%;"><span class="sr-only">{{$NeffiM}}%</span></div>
                </div>
                @endif
                @if($p->BQ!=0&&$p->BM!=0&&$TuseB!=0)
                <h4 class="small font-weight-bold">Biology<span class="float-right">{{$NeffiB}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" aria-valuenow="{{$NeffiB}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiB}}%;"><span class="sr-only">{{$NeffiB}}%</span></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="card text-center card_border mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="text-primary font-weight-bold m-0">Questionwise Detailed Time Analysis</h6>
    </div>
    <div class="card-body">
        <!-- stacked bar chart -->
        <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle" style="color: rgba(28, 200, 138, 0.6)"></i>&nbsp;Correct ({{$r->totalC}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(255, 0, 0, 0.6)"></i>&nbsp;Incorrect ({{$r->totalW}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(183, 185, 204, 0.6);"></i>&nbsp;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW}})</span></div>
        <div style="display: flex; m">
            <lable class="pr-4">Full Paper<input type="radio" name="timeradio" onclick="timechart1()" value="All" checked=""></lable>
            @if($r->PQ!=0)<lable class="pr-4">Physics<input type="radio" name="timeradio" onclick="timechart2()" value="Physics"></lable>@endif
            @if($r->CQ!=0)<lable class="pr-4">Chemistry<input type="radio" name="timeradio" onclick="timechart3()" value="Chemistry"></lable>@endif
            @if($r->MQ!=0)<lable class="pr-4">Mathematics<input type="radio" name="timeradio" onclick="timechart4()" value="Mathematics"></lable>@endif
            @if($r->BQ!=0)<lable class="pr-4">Biology<input type="radio" name="timeradio" onclick="timechart5()" value="Biology"></lable>@endif
        </div>
    </div>
    <div id="container">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>
        <canvas id="Timechart1" width="500" height="200"></canvas>
        <canvas id="Timechart2" width="500" height="200" style="display: none;"></canvas>
        <canvas id="Timechart3" width="500" height="200" style="display: none;"></canvas>
        <canvas id="Timechart4" width="500" height="200" style="display: none;"></canvas>
        <canvas id="Timechart5" width="500" height="200" style="display: none;"></canvas>
    </div>
    <!-- //stacked bar chart -->
</div>
</div>
@section('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<style type="text/css">
.chartjs-render-monitor {
    animation: chartjs-render-animation 1ms;
}

</style>
<script type="text/javascript">
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

</script>
<script type="text/javascript">
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

if ($(window).width() < 776) {
    $('#timewisedetailedperformance').attr('height', '700');
    $('#detailedperformance').attr('height', '700');
    $('#chart-1').css('height', '300px');
    $('#chart-2').css('height', '350px');
    $('#chart-1_1').css('height', '13rem');
    $('#chart-2_1').css('height', '13rem');
    $('#Timechart1').attr('height', '450');
    $('#Timechart2').attr('height', '450');
    $('#Timechart3').attr('height', '450');
    $('#Timechart4').attr('height', '450');
    $('#Timechart5').attr('height', '450');

}

function timechart1() {
    $('#Timechart5').css('display', 'none');
    $('#Timechart4').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart1').css('display', '');
    var canvas1 = document.getElementById('Timechart1');
    var data1 = {

        labels: [<?php $avg= ($p->TT*60)/$p->NOQ;?>
            @for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$i}}", @endfor
        ],
        datasets: [{
            data: [@for($i = 1; $i <= $r - > totalQ; $i++)
                "{{$timearray[$i]}}", @endfor
            ],
            backgroundColor: [@for($i = 1; $i <= $r - > totalQ; $i++) @if($ansarray[$i] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$i] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$i] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$i] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endfor
            ]
        }, {
            label: "Average Time required",
            data: [@for($i = 1; $i <= $r - > totalQ; $i++)
                "{{$avg}}", @endfor
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/normal_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas1, {
        data: data1,
        options: option
    });


    //----------------------------------------------------------------------------------------------
}

function timechart2() {
    $('#Timechart5').css('display', 'none');
    $('#Timechart4').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart1').css('display', 'none');
    $('#Timechart2').css('display', '');
    var canvas2 = document.getElementById('Timechart2');
    var data2 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n <= $PQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n <= $PQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n <= $PQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n <= $PQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/normal_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas2, {
        data: data2,
        options: option
    });
    //---------------------------------------------------------------------------------------------------
}

function timechart3() {
    $('#Timechart5').css('display', 'none');
    $('#Timechart4').css('display', 'none');
    $('#Timechart1').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart3').css('display', '');
    var canvas3 = document.getElementById('Timechart3');
    var data3 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n > $PQN && $n <= $CQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $PQN && $n <= $CQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n > $PQN && $n <= $CQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $PQN && $n <= $CQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt('{{$PQN}}') + parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/normal_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };

    var myBarChart = Chart.Bar(canvas3, {
        data: data3,
        options: option
    });
    //-------------------------------------------------------------------------------------
}

function timechart4() {
    $('#Timechart5').css('display', 'none');
    $('#Timechart1').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart4').css('display', '');
    var canvas4 = document.getElementById('Timechart4');
    var data4 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n > $CQN && $n <= $MQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $CQN && $n <= $MQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n > $CQN && $n <= $MQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $CQN && $n <= $MQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };

    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt('{{$CQN}}') + parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/normal_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas4, {
        data: data4,
        options: option
    });
    //----------------------------------------------------------------------------------------------
}

function timechart5() {
    $('#Timechart1').css('display', 'none');
    $('#Timechart4').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart5').css('display', '');
    var canvas5 = document.getElementById('Timechart5');
    var data5 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n > $MQN && $n <= $BQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $MQN && $n <= $BQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n > $MQN && $n <= $BQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $MQN && $n <= $BQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt('{{$MQN}}') + parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/normal_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };

    var myBarChart = Chart.Bar(canvas5, {
        data: data5,
        options: option
    });

}

var canvas = document.getElementById('Timechart1');
var total = "{{$BQN}}";
var totalP = "{{$PQN}}";
var totalC = "{{$CQN}}";
var totalM = "{{$MQN}}";
var totalB = "{{$BQN}}";


var data = {

    labels: [<?php $avg= ($p->TT*60)/$p->NOQ;?>
        @for($i = 1; $i <= $r - > totalQ; $i++)
        "{{$i}}", @endfor
    ],
    datasets: [{
        data: [@for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$timearray[$i]}}", @endfor
        ],
        backgroundColor: [@for($i = 1; $i <= $r - > totalQ; $i++) @if($ansarray[$i] == "Correct")
            'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$i] == "Incorrect")
            'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$i] == "Unattempted")
            'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$i] == "Bonus")
            'rgba(255, 193, 7, 0.6)', @endif @endfor
        ]
    }, {
        label: "Average Time required",
        data: [@for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$avg}}", @endfor
        ],
        type: 'line'

    }]
};

var option = {
    tooltips: {
        enabled: false
    },
    legend: {
        display: false
    },
    scales: {
        yAxes: [{
            scaleLabel: {
                display: true,
                labelString: 'Time (Seconds)'
            }

        }],
        xAxes: [{
            barPercentage: 1.0,
            categoryPercentage: 1.0,
            gridLines: {
                display: false
            },
            scaleLabel: {
                display: true,
                labelString: 'Question numbers'
            }

        }]
    },
    events: ["click"],
    hover: {
        mode: 'nearest'
    },
    onClick: function(event, element) {
        var activeElement = element[0];
        var barIndex = activeElement._index;
        var xLabel = data.labels[barIndex];
        $(".spinner").show();
        $(".btn-cancel").show();
        $('.socket_title').text('Question :-' + xLabel);
        $('.socket_body').html('Wait...');
        $("#socket").show("closed");
        <?php $qwe = 'Quiz/normal_paper/'.$p->pname.'/question/:s'  ?>
        var asset = encodeURI('{{ asset("$qwe") }}');
        var asset1 = asset.replace(':s', xLabel + '.png');
        var asset2 = asset.replace(':s', xLabel + '_1.png');
        var asset3 = asset.replace(':s', xLabel + '_2.png');
        imageExists(asset1, function(exists) {
            if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
        });
        imageExists(asset2, function(exists) {
            var html = $('.socket_body_main').html();
            if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
        });
        imageExists(asset3, function(exists) {
            var html = $('.socket_body_main').html();
            if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
        });
        $('.socket_body').hide();
        $(".spinner").hide();
    }
};


var myBarChart = Chart.Bar(canvas, {
    data: data,
    options: option
});

function imageExists(url, callback) {
    var img = new Image();
    img.onload = function() { callback(true); };
    img.onerror = function() { callback(false); };
    img.src = url;
}
new Chart(document.getElementById("detailedperformance"), {
    type: 'bar',
    data: {
        labels: [@if($r - > PQ != 0)
            'Physics', @endif @if($r - > CQ != 0)
            'Chemistry', @endif @if($r - > MQ != 0)
            'Mathematics', @endif @if($r - > BQ != 0)
            'Biology', @endif 'Overall'
        ],
        datasets: [{
            data: [@if($r - > PQ != 0) { { $r - > totalCinP.
                    ',' } } @endif @if($r - > CQ != 0) { { $r - > totalCinC.
                    ',' } } @endif @if($r - > MQ != 0) { { $r - > totalCinM.
                    ',' } } @endif @if($r - > BQ != 0) { { $r - > totalCinB.
                    ',' } } @endif { { $r - > totalC } }],
            label: 'Correct ',
            backgroundColor: ['rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)'],
            borderWidth: 1
        }, {
            data: [@if($r - > PQ != 0) { { $r - > totalWinP.
                    ',' } } @endif @if($r - > CQ != 0) { { $r - > totalWinC.
                    ',' } } @endif @if($r - > MQ != 0) { { $r - > totalWinM.
                    ',' } } @endif @if($r - > BQ != 0) { { $r - > totalWinB.
                    ',' } } @endif { { $r - > totalW } }],
            label: 'Incorrect ',
            backgroundColor: ['rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)'],
            borderWidth: 1
        }, {
            data: [@if($r - > PQ != 0) { { $r - > PQ - $r - > totalCinP - $r - > totalWinP.
                    ',' } } @endif @if($r - > CQ != 0) { { $r - > CQ - $r - > totalCinC - $r - > totalWinC.
                    ',' } } @endif @if($r - > MQ != 0) { { $r - > MQ - $r - > totalCinM - $r - > totalWinM.
                    ',' } } @endif @if($r - > BQ != 0) { { $r - > BQ - $r - > totalCinB - $r - > totalWinB.
                    ',' } } @endif { { $r - > totalQ - ($r - > totalC + $r - > totalW) } }],
            label: 'Unattempted ',
            backgroundColor: ['rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)']
        }]
    },
    options: {
        // title: {
        //  display: true,
        //  text: 'Chart.js Bar Chart - Stacked'
        // },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

new Chart(document.getElementById("timewisedetailedperformance"), {
    type: 'bar',
    data: {
        labels: [@if($r - > PQ != 0)
            'Physics', @endif @if($r - > CQ != 0)
            'Chemistry', @endif @if($r - > MQ != 0)
            'Mathematics', @endif @if($r - > BQ != 0)
            'Biology', @endif
        ],
        datasets: [{
            data: [@if($r - > PQ != 0) { { intval($TusePc / 60).
                    ',' } } @endif @if($r - > CQ != 0) { { intval($TuseCc / 60).
                    ',' } } @endif @if($r - > MQ != 0) { { intval($TuseMc / 60).
                    ',' } } @endif @if($r - > BQ != 0) { { intval($TuseBc / 60).
                    ',' } } @endif],
            label: 'Time in Correct (min)',
            backgroundColor: ['rgba(132, 212, 235, 0.8)', 'rgba(132, 212, 235, 0.8)', 'rgba(132, 212, 235, 0.8)', 'rgba(132, 212, 235, 0.8)'],
            borderWidth: 1
            //#01b8aa
        }, {
            data: [@if($r - > PQ != 0) { { intval($TusePn / 60).
                    ',' } } @endif @if($r - > CQ != 0) { { intval($TuseCn / 60).
                    ',' } } @endif @if($r - > MQ != 0) { { intval($TuseMn / 60).
                    ',' } } @endif @if($r - > BQ != 0) { { intval($TuseBn / 60).
                    ',' } } @endif],
            label: 'Time in Incorrect (min)',
            backgroundColor: ['rgba(242, 200, 15, 0.8)', 'rgba(242, 200, 15, 0.8)', 'rgba(242, 200, 15, 0.8)', 'rgba(242, 200, 15, 0.8)', 'rgba(244, 209 , 36, 0.7)'],
            borderWidth: 1
            //#fd625e
        }, {
            data: [@if($r - > PQ != 0) { { intval($TusePu / 60).
                    ',' } } @endif @if($r - > CQ != 0) { { intval($TuseCu / 60).
                    ',' } } @endif @if($r - > MQ != 0) { { intval($TuseMu / 60).
                    ',' } } @endif @if($r - > BQ != 0) { { intval($TuseBu / 60).
                    ',' } } @endif],
            label: 'Time in Unattempted (min)',
            backgroundColor: ['rgba(95, 107, 109, 0.8)', 'rgba(95, 107, 109, 0.8)', 'rgba(95, 107, 109, 0.8)', 'rgba(95, 107, 109, 0.8)']
        }]
        //#5f6b6d
    },
    options: {
        // title: {
        // display: true,
        // text: 'Chart.js Bar Chart - Stacked'
        // },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

</script>
@endsection
@elseif($p->type=='advanced')
<?php 
            $PM = ($p->P1Q*$p->P1M)+($p->P2Q*$p->P2M)+($p->P3Q*$p->P3M)+($p->P4Q*$p->P4M)+($p->P5Q*$p->P5M)+($p->P6Q*$p->P6M);
            $CM = ($p->C1Q*$p->C1M)+($p->C2Q*$p->C2M)+($p->C3Q*$p->C3M)+($p->C4Q*$p->C4M)+($p->C5Q*$p->C5M)+($p->C6Q*$p->C6M);
            $MM = ($p->M1Q*$p->M1M)+($p->M2Q*$p->M2M)+($p->M3Q*$p->M3M)+($p->M4Q*$p->M4M)+($p->M5Q*$p->M5M)+($p->M6Q*$p->M6M);

            $PQN=$r->PQ; $CQN=$r->CQ + $PQN; $MQN=$r->MQ+$CQN; $TQ=$r->totalQ; $n=0; $NOS=0;
            if($PM!=0){$NOS++;}if($CM!=0){$NOS++;}if($MM!=0){$NOS++;}

            $TforS = 60*$p->TT/$NOS;  
            $TwiseP=0; $TwiseP=0; $TwiseC=0; $TwiseM=0; $TwiseB=0;
            $NeffiO=0; $NeffiP=0; $NeffiC=0; $NeffiM=0; $NeffiB=0;
            $TuseO =0; $TuseP = 0;  $TuseC = 0;  $TuseM = 0;  $TuseB = 0;
            $TuseOn =0; $TusePn = 0;  $TuseCn = 0;  $TuseMn = 0;  $TuseBn = 0;
            $TuseOu =0; $TusePu = 0;  $TuseCu = 0;  $TuseMu = 0;  $TuseBu = 0;
            $TuseOc =1; $TusePc = 1;  $TuseCc = 1;  $TuseMc = 1;  $TuseBc = 1;
            $timearray = array();$ansarray = array();
            for ($i = 1; $i <= $r->totalQ; $i++){
                $timearray[$i]="0";$ansarray[$i]="Unattempted";
            }
              
           
            foreach($answers as $a){
                    $n++;
                $timearray[$a->qid] = $a->time_used>300?300:$a->time_used;
                    if($a->qid<=$PQN)   {$TuseP = $TuseP+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseC = $TuseC+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseM = $TuseM+$a->time_used;}
              if($a->answer=="Incorrect"&&($a->ans_type=="save"||$a->ans_type=="save_mark")){
                $ansarray[$a->qid] = "Incorrect";
                    if($a->qid<=$PQN)   {$TusePn = $TusePn+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseCn = $TuseCn+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseMn = $TuseMn+$a->time_used;}
            }
            elseif (($a->answer=="Partially Correct"||$a->answer=="Correct")&&($a->ans_type=="save"||$a->ans_type=="save_mark")) {
                $ansarray[$a->qid] = "Correct";
                    if($a->qid<=$PQN)   {$TusePc = $TusePc+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseCc = $TuseCc+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseMc = $TuseMc+$a->time_used;}
            }else{
                 $ansarray[$a->qid] = "Unattempted";
                   if($a->qid<=$PQN)   {$TusePu = $TusePu+$a->time_used;}
                elseif($a->qid<=$CQN)   {$TuseCu = $TuseCu+$a->time_used;}
                elseif($a->qid<=$MQN)   {$TuseMu = $TuseMu+$a->time_used;}

            }
           if($a->a5=="0" && $a->a6=="0" && $a->a7=="0" && $a->a8=="0"){ $ansarray[$a->qid] = "Bonus";}
            }
               //timewise efficiency formula
        if($r->PQ!=0){$TwiseP = (($TforS/$TusePc)-(($TusePn + $TusePu)/$TforS))*100;  $NeffiP=(($r->PQ - $r->totalWinP)/$r->PQ)*100;}
        if($r->CQ!=0){$TwiseC = (($TforS/$TuseCc)-(($TuseCn + $TuseCu)/$TforS))*100;  $NeffiC=(($r->CQ - $r->totalWinC)/$r->CQ)*100;}
        if($r->MQ!=0){$TwiseM = (($TforS/$TuseMc)-(($TuseMn + $TuseMu)/$TforS))*100;  $NeffiM=(($r->MQ - $r->totalWinM)/$r->MQ)*100;}
                 $TwiseP = intval($TwiseP>100?100:($TwiseP<1?0:$TwiseP));
                 if($r->PQ!=0){$TwiseP = intval(($TwiseP + (($r->totalSinP/$PM)*100))/2);}
                 $TwiseC = intval($TwiseC>100?100:($TwiseC<1?0:$TwiseC));
                 if($r->CQ!=0){$TwiseC = intval(($TwiseC + (($r->totalSinC/$CM)*100))/2);}
                 $TwiseM = intval($TwiseM>100?100:($TwiseM<1?0:$TwiseM));
                 if($r->MQ!=0){$TwiseM = intval(($TwiseM + (($r->totalSinM/$MM)*100))/2);}
                 $NeffiP = intval($NeffiP>100?100:($NeffiP<1?0:$NeffiP));
                 $NeffiC = intval($NeffiC>100?100:($NeffiC<1?0:$NeffiC));
                 $NeffiM = intval($NeffiM>100?100:($NeffiM<1?0:$NeffiM));
                 $TwiseO = intval(($TwiseP + $TwiseC + $TwiseM)/$NOS);
                 $NeffiO = intval(( $NeffiP +  $NeffiC +  $NeffiM)/$NOS);
                  $TwiseO = intval($TwiseO>100?100:($TwiseO<1?0:$TwiseO));
                  $NeffiO = intval($NeffiO>100?100:($NeffiO<1?0:$NeffiO));
                 $TuseO = $TuseP + $TuseC + $TuseM;
                 $TuseOn = $TusePn + $TuseCn + $TuseMn;
                 $TuseOu = $TusePu + $TuseCu + $TuseMu;
                 $TuseOc = $TusePc + $TuseCc + $TuseMc;
               
             ?>
<div class="disabledScroll" style="display: none;" data-id="yes"></div>
<div class="d-sm-flex justify-content-between align-items-center mb-4 pt-2">
    <h3 class="text-dark mb-0">Result Analysis<a class="d-sm-inline-block" style="font-size: 15px;"><b>&nbsp;({{$r->name}})&nbsp;</b></a>&nbsp;<a data-link="{{ route('admin-send_result',['id'=>$r->plid,'sid'=>$r->sid,'type'=>$r->type]) }}" class="btn btn-success send_msg">send result&nbsp;</a>&nbsp;<a id="show-button" title="Show Responses" class="btn btn-info" style="color: #fff;" data-toggle="modal" data-target="#show" data-id="{{$r->pid}}" data-plid="{{$r->plid}}" data-type="{{$r->type}}" data-sid="{{$r->sid}}"><i class="fa fa-eye" style="color: #fff"></i></a></h3><a class="d-sm-inline-block"><b>{{$p->pname.' Submited on '.date_format(date_create($r->timer),"d/m/Y, h:i a")}}</b></a>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Total Score</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalS}}</span><a style="font-size: 15px;"> (out of {{$r->total_marks}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($p->PQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Physics</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinP}}</span><a style="font-size: 15px;"> (out of {{$PM}} )</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($p->CQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-danger py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-danger font-weight-bold text-xs mb-1"><span>Chemistry</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinC}}</span><a style="font-size: 15px;"> (out of{{$CM}} )</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($p->MQ!=0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Mathmatics</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalSinM}}</span><a style="font-size: 15px;"> (out of {{$MM}} )</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Overall Performance</h6>
            </div>
            <div class="card-body" id="chart-1" style="height: 440px;">
                <?php $perC = 100*$r->totalC/$r->totalQ; $perW = 100*$r->totalW/$r->totalQ; $perU = 100 - $perC -$perW;?>
                <div class="chart-area" id="chart-1_1"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Correct ({{$r->totalC}})&quot;,&quot;Incorrect ({{$r->totalW}})&quot;,&quot;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW}})&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#1cc88a&quot;,&quot;#e74a3b&quot;,&quot;#b7b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{intval($perC)}}&quot;,&quot;{{intval($perW)}}&quot;,&quot;{{intval($perU)}}&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Correct ({{$r->totalC}})</span><span class="mr-2"><i class="fas fa-circle text-danger"></i>&nbsp;Incorrect ({{$r->totalW}})</span><span class="mr-2"><i class="fas fa-circle" style="color: #b7b9cc;"></i>&nbsp;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW}})</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card text-center card_border mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Detailed Performance</h6>
            </div>
            <div class="card-body">
                <!-- stacked bar chart -->
                <div id="container">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="detailedperformance" width="676" height="338" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- //stacked bar chart -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Overall Time Utilisation</h6>
            </div>
            <div class="card-body" id="chart-2">
                <?php $perC = 100*$TuseOc/($p->TT*60); $perW = 100*$TuseOn/($p->TT*60); $perU = 100*$TuseOu/($p->TT*60);
                                $perR = 100-$perC-$perW-$perU?>
                <div class="chart-area" id="chart-2_1"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Correct ({{intval($TuseOc/60)}}) min&quot;,&quot;Incorrect ({{intval($TuseOn/60)}}) min&quot;,&quot;Unattempted ({{intval($TuseOu/60)}}) min&quot;,&quot;Unused Time ({{intval($p->TT-($TuseOn+$TuseOc+$TuseOu)/60)}}) min&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#8ad4eb&quot;,&quot;#f2c80f&quot;,&quot;#374649&quot;,&quot;#e5e5e5&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{intval($perC)}}&quot;,&quot;{{intval($perW)}}&quot;,&quot;{{intval($perU)}}&quot;,&quot;{{intval($perR)}}&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle" style="color: #8ad4eb;"></i>&nbsp;Time use in Correct ({{intval($TuseOc/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #f2c80f;"></i>&nbsp;Time use in Incorrect ({{intval($TuseOn/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #374649;"></i>&nbsp;Time use in Unattempted ({{intval($TuseOu/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #e5e5e5;"></i>&nbsp;Unused Time ({{intval((($p->TT*60) - $TuseOn - $TuseOc - $TuseOu)/60)}} min)</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card text-center card_border mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Timewise Detailed Performance</h6>
            </div>
            <div class="card-body">
                <!-- stacked bar chart -->
                <div id="container">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="timewisedetailedperformance" width="676" height="350" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- //stacked bar chart -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Timewise Efficiency</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Overall<span class="float-right">{{$TwiseO}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{$TwiseO}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseO}}%;"><span class="sr-only">{{$TwiseO}}%</span></div>
                </div>
                @if($p->PQ!=0&&$TuseP!=0)
                <h4 class="small font-weight-bold">Physics<span class="float-right">{{$TwiseP}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" aria-valuenow="{{$TwiseP}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseP}}%;"><span class="sr-only">{{$TwiseP}}%</span></div>
                </div>
                @endif
                @if($p->CQ!=0&&$TuseC!=0)
                <h4 class="small font-weight-bold">Chemistry<span class="float-right">{{$TwiseC}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" aria-valuenow="{{$TwiseC}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseC}}%;"><span class="sr-only">{{$TwiseC}}%</span></div>
                </div>
                @endif
                @if($p->MQ!=0&&$TuseM!=0)
                <h4 class="small font-weight-bold">Mathematics<span class="float-right">{{$TwiseM}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" aria-valuenow="{{$TwiseM}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseM}}%;"><span class="sr-only">{{$TwiseM}}%</span></div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Efficiency Against -Ve Marking</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Overall<span class="float-right">{{$NeffiO}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{$NeffiO}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiO}}%;"><span class="sr-only">{{$NeffiO}}%</span></div>
                </div>
                @if($p->PQ!=0&&$TuseP!=0)
                <h4 class="small font-weight-bold">Physics<span class="float-right">{{$NeffiP}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" aria-valuenow="{{$NeffiP}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiP}}%;"><span class="sr-only">{{$NeffiP}}%</span></div>
                </div>
                @endif
                @if($p->CQ!=0&&$TuseC!=0)
                <h4 class="small font-weight-bold">Chemistry<span class="float-right">{{$NeffiC}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" aria-valuenow="{{$NeffiC}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiC}}%;"><span class="sr-only">{{$NeffiC}}%</span></div>
                </div>
                @endif
                @if($p->MQ!=0&&$TuseM!=0)
                <h4 class="small font-weight-bold">Mathematics<span class="float-right">{{$NeffiM}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" aria-valuenow="{{$NeffiM}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiM}}%;"><span class="sr-only">{{$NeffiM}}%</span></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="card text-center card_border mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="text-primary font-weight-bold m-0">Questionwise Detailed Time Analysis</h6>
    </div>
    <div class="card-body">
        <!-- stacked bar chart -->
        <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle" style="color: rgba(28, 200, 138, 0.6)"></i>&nbsp;Correct ({{$r->totalC}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(255, 0, 0, 0.6)"></i>&nbsp;Incorrect ({{$r->totalW}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(183, 185, 204, 0.6);"></i>&nbsp;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW}})</span></div>
        <div style="display: flex; m">
            <lable class="pr-4">Full Paper<input type="radio" name="timeradio" onclick="timechart1()" value="All" checked=""></lable>
            @if($r->PQ!=0)<lable class="pr-4">Physics<input type="radio" name="timeradio" onclick="timechart2()" value="Physics"></lable>@endif
            @if($r->CQ!=0)<lable class="pr-4">Chemistry<input type="radio" name="timeradio" onclick="timechart3()" value="Chemistry"></lable>@endif
            @if($r->MQ!=0)<lable class="pr-4">Mathematics<input type="radio" name="timeradio" onclick="timechart4()" value="Mathematics"></lable>@endif
        </div>
    </div>
    <div id="container">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>
        <canvas id="Timechart1" width="500" height="200"></canvas>
        <canvas id="Timechart2" width="500" height="200" style="display: none;"></canvas>
        <canvas id="Timechart3" width="500" height="200" style="display: none;"></canvas>
        <canvas id="Timechart4" width="500" height="200" style="display: none;"></canvas>
    </div>
    <!-- //stacked bar chart -->
</div>
</div>
@section('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<style type="text/css">
.chartjs-render-monitor {
    animation: chartjs-render-animation 1ms;
}

</style>
<script type="text/javascript">
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

</script>
<script type="text/javascript">
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
if ($(window).width() < 776) {
    $('#timewisedetailedperformance').attr('height', '700');
    $('#detailedperformance').attr('height', '700');
    $('#chart-1').css('height', '300px');
    $('#chart-2').css('height', '350px');
    $('#chart-1_1').css('height', '13rem');
    $('#chart-2_1').css('height', '13rem');
    $('#Timechart1').attr('height', '450');
    $('#Timechart2').attr('height', '450');
    $('#Timechart3').attr('height', '450');
    $('#Timechart4').attr('height', '450');
}

function timechart1() {
    $('#Timechart4').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart1').css('display', '');
    var canvas1 = document.getElementById('Timechart1');
    var data1 = {

        labels: [<?php $avg= ($p->TT*60)/$p->NOQ;?>
            @for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$i}}", @endfor
        ],
        datasets: [{
            data: [@for($i = 1; $i <= $r - > totalQ; $i++)
                "{{$timearray[$i]}}", @endfor
            ],
            backgroundColor: [@for($i = 1; $i <= $r - > totalQ; $i++) @if($ansarray[$i] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$i] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$i] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$i] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endfor
            ]
        }, {
            label: "Average Time required",
            data: [@for($i = 1; $i <= $r - > totalQ; $i++)
                "{{$avg}}", @endfor
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/advanced_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas1, {
        data: data1,
        options: option
    });


    //----------------------------------------------------------------------------------------------
}

function timechart2() {
    $('#Timechart4').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart1').css('display', 'none');
    $('#Timechart2').css('display', '');
    var canvas2 = document.getElementById('Timechart2');
    var data2 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n <= $PQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n <= $PQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n <= $PQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n <= $PQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/advanced_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas2, {
        data: data2,
        options: option
    });
    //---------------------------------------------------------------------------------------------------
}

function timechart3() {
    $('#Timechart4').css('display', 'none');
    $('#Timechart1').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart3').css('display', '');
    var canvas3 = document.getElementById('Timechart3');
    var data3 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n > $PQN && $n <= $CQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $PQN && $n <= $CQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n > $PQN && $n <= $CQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $PQN && $n <= $CQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt('{{$PQN}}') + parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/advanced_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };

    var myBarChart = Chart.Bar(canvas3, {
        data: data3,
        options: option
    });
    //-------------------------------------------------------------------------------------
}

function timechart4() {
    $('#Timechart1').css('display', 'none');
    $('#Timechart3').css('display', 'none');
    $('#Timechart2').css('display', 'none');
    $('#Timechart4').css('display', '');
    var canvas4 = document.getElementById('Timechart4');
    var data4 = {

        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n > $CQN && $n <= $MQN)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $CQN && $n <= $MQN)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n > $CQN && $n <= $MQN) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $CQN && $n <= $MQN)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };

    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt('{{$CQN}}') + parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/advanced_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas4, {
        data: data4,
        options: option
    });
    //----------------------------------------------------------------------------------------------
}

var canvas = document.getElementById('Timechart1');
var total = "{{$MQN}}";
var totalP = "{{$PQN}}";
var totalC = "{{$CQN}}";
var totalM = "{{$MQN}}";;


var data = {

    labels: [<?php $avg= ($p->TT*60)/$p->NOQ;?>
        @for($i = 1; $i <= $r - > totalQ; $i++)
        "{{$i}}", @endfor
    ],
    datasets: [{
        data: [@for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$timearray[$i]}}", @endfor
        ],
        backgroundColor: [@for($i = 1; $i <= $r - > totalQ; $i++) @if($ansarray[$i] == "Correct")
            'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$i] == "Incorrect")
            'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$i] == "Unattempted")
            'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$i] == "Bonus")
            'rgba(255, 193, 7, 0.6)', @endif @endfor
        ]
    }, {
        label: "Average Time required",
        data: [@for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$avg}}", @endfor
        ],
        type: 'line'

    }]
};

var option = {
    tooltips: {
        enabled: false
    },
    legend: {
        display: false
    },
    scales: {
        yAxes: [{
            scaleLabel: {
                display: true,
                labelString: 'Time (Seconds)'
            }

        }],
        xAxes: [{
            barPercentage: 1.0,
            categoryPercentage: 1.0,
            gridLines: {
                display: false
            },
            scaleLabel: {
                display: true,
                labelString: 'Question numbers'
            }

        }]
    },
    events: ["click"],
    hover: {
        mode: 'nearest'
    },
    onClick: function(event, element) {
        var activeElement = element[0];
        var barIndex = activeElement._index;
        var xLabel = data.labels[barIndex];
        $(".spinner").show();
        $(".btn-cancel").show();
        $('.socket_title').text('Question :-' + xLabel);
        $('.socket_body').html('Wait...');
        $("#socket").show("closed");
        <?php $qwe = 'Quiz/advanced_paper/'.$p->pname.'/question/:s'  ?>
        var asset = encodeURI('{{ asset("$qwe") }}');
        var asset1 = asset.replace(':s', xLabel + '.png');
        var asset2 = asset.replace(':s', xLabel + '_1.png');
        var asset3 = asset.replace(':s', xLabel + '_2.png');
        imageExists(asset1, function(exists) {
            if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
        });
        imageExists(asset2, function(exists) {
            var html = $('.socket_body_main').html();
            if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
        });
        imageExists(asset3, function(exists) {
            var html = $('.socket_body_main').html();
            if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
        });
        $('.socket_body').hide();
        $(".spinner").hide();
    }
};

var myBarChart = Chart.Bar(canvas, {
    data: data,
    options: option
});

function imageExists(url, callback) {
    var img = new Image();
    img.onload = function() { callback(true); };
    img.onerror = function() { callback(false); };
    img.src = url;
}


new Chart(document.getElementById("detailedperformance"), {
    type: 'bar',
    data: {
        labels: [@if($r - > PQ != 0)
            'Physics', @endif @if($r - > CQ != 0)
            'Chemistry', @endif @if($r - > MQ != 0)
            'Mathematics', @endif 'Overall'
        ],
        datasets: [{
            data: [@if($r - > PQ != 0) { { $r - > totalCinP.
                    ',' } } @endif @if($r - > CQ != 0) { { $r - > totalCinC.
                    ',' } } @endif @if($r - > MQ != 0) { { $r - > totalCinM.
                    ',' } } @endif { { $r - > totalC } }],
            label: 'Correct ',
            backgroundColor: ['rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)', 'rgba(28, 200, 138, 0.6)'],
            borderWidth: 1
        }, {
            data: [@if($r - > PQ != 0) { { $r - > totalWinP.
                    ',' } } @endif @if($r - > CQ != 0) { { $r - > totalWinC.
                    ',' } } @endif @if($r - > MQ != 0) { { $r - > totalWinM.
                    ',' } } @endif { { $r - > totalW } }],
            label: 'Incorrect ',
            backgroundColor: ['rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)', 'rgba(255, 0, 0, 0.6)'],
            borderWidth: 1
        }, {
            data: [@if($r - > PQ != 0) { { $r - > PQ - $r - > totalCinP - $r - > totalWinP.
                    ',' } } @endif @if($r - > CQ != 0) { { $r - > CQ - $r - > totalCinC - $r - > totalWinC.
                    ',' } } @endif @if($r - > MQ != 0) { { $r - > MQ - $r - > totalCinM - $r - > totalWinM.
                    ',' } } @endif { { $r - > totalQ - ($r - > totalC + $r - > totalW) } }],
            label: 'Unattempted ',
            backgroundColor: ['rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)', 'rgba(183, 185, 204, 0.6)']
        }]
    },
    options: {
        // title: {
        //  display: true,
        //  text: 'Chart.js Bar Chart - Stacked'
        // },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

new Chart(document.getElementById("timewisedetailedperformance"), {
    type: 'bar',
    data: {
        labels: [@if($r - > PQ != 0)
            'Physics', @endif @if($r - > CQ != 0)
            'Chemistry', @endif @if($r - > MQ != 0)
            'Mathematics'
            @endif
        ],
        datasets: [{
            data: [@if($r - > PQ != 0) { { intval($TusePc / 60).
                    ',' } } @endif @if($r - > CQ != 0) { { intval($TuseCc / 60).
                    ',' } } @endif @if($r - > MQ != 0) { { intval($TuseMc / 60) } } @endif],
            label: 'Time in Correct (min)',
            backgroundColor: ['rgba(132, 212, 235, 0.8)', 'rgba(132, 212, 235, 0.8)', 'rgba(132, 212, 235, 0.8)', 'rgba(132, 212, 235, 0.8)'],
            borderWidth: 1
            //#01b8aa
        }, {
            data: [@if($r - > PQ != 0) { { intval($TusePn / 60).
                    ',' } } @endif @if($r - > CQ != 0) { { intval($TuseCn / 60).
                    ',' } } @endif @if($r - > MQ != 0) { { intval($TuseMn / 60) } } @endif],
            label: 'Time in Incorrect (min)',
            backgroundColor: ['rgba(242, 200, 15, 0.8)', 'rgba(242, 200, 15, 0.8)', 'rgba(242, 200, 15, 0.8)', 'rgba(242, 200, 15, 0.8)'],
            borderWidth: 1
            //#fd625e
        }, {
            data: [@if($r - > PQ != 0) { { intval($TusePu / 60).
                    ',' } } @endif @if($r - > CQ != 0) { { intval($TuseCu / 60).
                    ',' } } @endif @if($r - > MQ != 0) { { intval($TuseMu / 60) } } @endif],
            label: 'Time in Unattempted (min)',
            backgroundColor: ['rgba(95, 107, 109, 0.8)', 'rgba(95, 107, 109, 0.8)', 'rgba(95, 107, 109, 0.8)', 'rgba(95, 107, 109, 0.8)']
        }]
        //#5f6b6d
    },
    options: {
        // title: {
        // display: true,
        // text: 'Chart.js Bar Chart - Stacked'
        // },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

</script>
@endsection
@elseif($p->type=='custom')
<?php 
 
  $color = array("success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success", "danger" , "warning" , "primary" , "success");


 $NOS=count(json_decode($r->custom_structure));
 $TforS = 60*$p->TT/$NOS;  
$timearray = array();
$ansarray = array(); 
$TQ=$r->totalQ; $n=0;
            for ($i = 1; $i <= $r->totalQ; $i++){
                $timearray[$i]="0";$ansarray[$i]="Unattempted";
            }

          $Tuse=array();$TuseC=array();$TuseN=array();$TuseU=array();$TuseP=array();$s_no=0;
           foreach(json_decode($r->custom_structure) as $sub){
            if($sub->question > 0){
              $Tuse[$s_no]=$sub->time_usedC + $sub->time_usedW + $sub->time_usedU + $sub->time_usedP;
              $TuseC[$s_no]=$sub->time_usedC>0?$sub->time_usedC:1;
              $TuseN[$s_no]=$sub->time_usedW>0?$sub->time_usedW:1;
              $TuseU[$s_no]=$sub->time_usedU>0?$sub->time_usedU:1;
              $TuseP[$s_no]=$sub->time_usedP>0?$sub->time_usedP:1;
            }
          }
           foreach($answers as $a){
          $timearray[$a->qid] = $a->time_used>300?300:$a->time_used;
          if($a->answer =="Incorrect"&&($a->ans_type=="save"||$a->ans_type=="save_mark")){$ansarray[$a->qid] = "Incorrect";}
          elseif (($a->answer=="Partially Correct"||$a->answer=="Correct")&&($a->ans_type=="save"||$a->ans_type=="save_mark")) {$ansarray[$a->qid] = "Correct";}
          elseif ($a->answer=="Pending"&&($a->ans_type=="save"||$a->ans_type=="save_mark")) {$ansarray[$a->qid] = "Pending";}
          else{$ansarray[$a->qid] = "Unattempted"; }
          if($a->a5=="0" && $a->a6=="0" && $a->a7=="0" && $a->a8=="0"){ $ansarray[$a->qid] = "Bonus";}
            }

          $Twise = array(); $Neffi = array(); $no=0;$TwiseO=0;$NeffiO=0;$TuseO =1;$TuseOn =1;$TuseOu =1;$TuseOc =1;$TuseOp =1;
 foreach(json_decode($r->custom_structure) as $sub){
             if($sub->question>0){
                $Twise[$no] = (($TforS/$TuseC[$no])-(($TuseN[$no] + $TuseU[$no])/$TforS))*100;
                $Twise[$no] = intval($Twise[$no]>100?100:($Twise[$no]<1?0:$Twise[$no]));
                 $Twise[$no] = intval(($Twise[$no] + (($sub->totalS/($sub->total_marks>0?$sub->total_marks:1))*100))/2);
                  $Neffi[$no]=(($sub->question - $sub->totalW)/$sub->question)*100;
                  $Neffi[$no] = intval($Neffi[$no]>100?100:($Neffi[$no]<1?0:$Neffi[$no]));
                  $TwiseO += $Twise[$no];
                  $NeffiO += $Neffi[$no]; 
                  $TuseO  += $Tuse[$no];
                  $TuseOn += $TuseN[$no];
                  $TuseOu += $TuseU[$no];
                  $TuseOc += $TuseC[$no];
                  $TuseOp += $TuseP[$no];
                  $no++;
               }
              
            }
                 $TwiseO = intval($TwiseO/$NOS);
                 $NeffiO = intval($NeffiO/$NOS);
                  $TwiseO = intval($TwiseO>100?100:($TwiseO<1?0:$TwiseO));
                  $NeffiO = intval($NeffiO>100?100:($NeffiO<1?0:$NeffiO));

             ?>
<div class="disabledScroll" style="display: none;" data-id="yes"></div>
<div class="d-sm-flex justify-content-between align-items-center mb-4 pt-2">
    <h3 class="text-dark mb-0">Result Analysis<a class="d-sm-inline-block" style="font-size: 15px;"><b>&nbsp;({{$r->name}})&nbsp;</b></a>&nbsp;<a data-link="{{ route('admin-send_result',['id'=>$r->plid,'sid'=>$r->sid,'type'=>$r->type]) }}" class="btn btn-success send_msg">send result&nbsp;</a>&nbsp;<a id="show-button" title="Show Responses" class="btn btn-info" style="color: #fff;" data-toggle="modal" data-target="#show" data-id="{{$r->pid}}" data-plid="{{$r->plid}}" data-type="{{$r->type}}" data-sid="{{$r->sid}}"><i class="fa fa-eye" style="color: #fff"></i></a></h3><a class="d-sm-inline-block"><b>{{$p->pname.' Submited on '.date_format(date_create($r->timer),"d/m/Y, h:i a")}}</b></a>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Total Score</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$r->totalS}}</span><a style="font-size: 15px;"> (out of {{$r->total_marks}})</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $no=0;?>
    @foreach(json_decode($r->custom_structure) as $sub)
    @if($sub->question>0)
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-{{$color[$no]}} py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-{{$color[$no]}} font-weight-bold text-xs mb-1"><span>{{$sub->subject}}</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>{{$sub->totalS}}</span><a style="font-size: 15px;"> (out of {{$sub->total_marks}} )</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $no++;?>
    @endif
    @endforeach
</div>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Overall Performance</h6>
            </div>
            <div class="card-body" id="chart-1" style="height: 440px;">
                <?php $perC = 100*$r->totalC/$r->totalQ; $perP = 100*$r->totalP/$r->totalQ; $perW = 100*$r->totalW/$r->totalQ; $perU = 100 - $perC -$perW-$perP;?>
                <div class="chart-area" id="chart-1_1"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Correct ({{$r->totalC}})&quot;,&quot;Incorrect ({{$r->totalW}})&quot;,&quot;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW-$r->totalP}})&quot;,&quot;Pending ({{$r->totalP}})&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#1cc88a&quot;,&quot;#e74a3b&quot;,&quot;#b7b9cc&quot;,&quot;#f6c23e&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{intval($perC)}}&quot;,&quot;{{intval($perW)}}&quot;,&quot;{{intval($perU)}}&quot;,&quot;{{intval($perP)}}&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Correct ({{$r->totalC}})</span><span class="mr-2"><i class="fas fa-circle text-danger"></i>&nbsp;Incorrect ({{$r->totalW}})</span><span class="mr-2"><i class="fas fa-circle" style="color: #b7b9cc;"></i>&nbsp;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW -$r->totalP}})</span><span class="mr-2"><i class="fas fa-circle text-warning"></i>&nbsp;Pending ({{$r->totalP}})</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card text-center card_border mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Detailed Performance</h6>
            </div>
            <div class="card-body">
                <!-- stacked bar chart -->
                <div id="container">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="detailedperformance" width="676" height="338" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- //stacked bar chart -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Overall Time Utilisation</h6>
            </div>
            <div class="card-body" id="chart-2">
                <?php $perC = 100*$TuseOc/($p->TT*60); $perW = 100*$TuseOn/($p->TT*60); $perU = 100*$TuseOu/($p->TT*60); $perP = 100*$TuseOp/($p->TT*60);
                                $perR = 100-$perC-$perW-$perU-$perP?>
                <div class="chart-area" id="chart-2_1"><canvas data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Correct ({{intval($TuseOc/60)}}) min&quot;,&quot;Incorrect ({{intval($TuseOn/60)}}) min&quot;,&quot;Unattempted ({{intval($TuseOu/60)}}) min&quot;,&quot;Pending ({{intval($TuseOp/60)}}) min&quot;,&quot;Unused Time ({{intval($p->TT-($TuseOn+$TuseOc+$TuseOu)/60)}}) min&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#8ad4eb&quot;,&quot;#f2c80f&quot;,&quot;#374649&quot;,&quot;#ec407a&quot;,&quot;#e5e5e5&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;{{intval($perC)}}&quot;,&quot;{{intval($perW)}}&quot;,&quot;{{intval($perU)}}&quot;,&quot;{{intval($perP)}}&quot;,&quot;{{intval($perR)}}&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:true},&quot;title&quot;:{}}}"></canvas></div>
                <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle" style="color: #8ad4eb;"></i>&nbsp;Time use in Correct ({{intval($TuseOc/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #f2c80f;"></i>&nbsp;Time use in Incorrect ({{intval($TuseOn/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #374649;"></i>&nbsp;Time use in Unattempted ({{intval($TuseOu/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #ec407a;"></i>&nbsp;Time use in Pending ({{intval($TuseOp/60)}} min)</span><br><span class="mr-2"><i class="fas fa-circle" style="color: #e5e5e5;"></i>&nbsp;Unused Time ({{intval((($p->TT*60) - $TuseOn - $TuseOc - $TuseOu -$TuseOp)/60)}} min)</span></div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xl-8">
        <div class="card text-center card_border mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Timewise Detailed Performance</h6>
            </div>
            <div class="card-body">
                <!-- stacked bar chart -->
                <div id="container">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="timewisedetailedperformance" width="676" height="350" class="chartjs-render-monitor"></canvas>
                </div>
                <!-- //stacked bar chart -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Timewise Efficiency</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Overall<span class="float-right">{{$TwiseO}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{$TwiseO}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$TwiseO}}%;"><span class="sr-only">{{$TwiseO}}%</span></div>
                </div>
                <?php $no=0;?>
                @foreach(json_decode($r->custom_structure) as $sub)
                @if($sub->question>0)
                <h4 class="small font-weight-bold">{{$sub->subject}}<span class="float-right">{{$Twise[$no]}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-{{$color[$no]}}" aria-valuenow="{{$Twise[$no]}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$Twise[$no]}}%;"><span class="sr-only">{{$Twise[$no]}}%</span></div>
                </div>
                <?php $no++;?>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Efficiency Against -Ve Marking</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Overall<span class="float-right">{{$NeffiO}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" aria-valuenow="{{$NeffiO}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$NeffiO}}%;"><span class="sr-only">{{$NeffiO}}%</span></div>
                </div>
                <?php $no=0;?>
                @foreach(json_decode($r->custom_structure) as $sub)
                @if($sub->question>0)
                <h4 class="small font-weight-bold">{{$sub->subject}}<span class="float-right">{{$Neffi[$no]}}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-{{$color[$no]}}" aria-valuenow="{{$Neffi[$no]}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$Neffi[$no]}}%;"><span class="sr-only">{{$Neffi[$no]}}%</span></div>
                </div>
                <?php $no++;?>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="card text-center card_border mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="text-primary font-weight-bold m-0">Questionwise Detailed Time Analysis</h6>
    </div>
    <div class="card-body">
        <!-- stacked bar chart -->
        <div class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle" style="color: rgba(28, 200, 138, 0.6)"></i>&nbsp;Correct ({{$r->totalC}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(255, 0, 0, 0.6)"></i>&nbsp;Incorrect ({{$r->totalW}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(142,36,170, 0.8)"></i>&nbsp;Pending ({{$r->totalP}})</span><span class="mr-2"><i class="fas fa-circle" style="color: rgba(183, 185, 204, 0.6);"></i>&nbsp;Unattempted ({{$r->totalQ - $r->totalC - $r->totalW - $r->totalP}})</span></div>
        <div style="display: flex; ">
            <lable class="pr-4">Full Paper<input type="radio" name="timeradio" onclick="timechart1()" value="All" checked=""></lable>
            <?php $no=0;?>
            @foreach(json_decode($r->custom_structure) as $sub)
            @if($sub->question>0)
            <lable class="pr-4">{{$sub->subject}}<input type="radio" name="timeradio" id="timechart_open_{{$no}}" value="{{$sub->subject}}"></lable>
            <?php $no++;?>
            @endif
            @endforeach
        </div>
    </div>
    <div id="container">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>
        <canvas id="Timechart1" class="Timechart_div" width="500" height="200"></canvas>
        <?php $no=0;?>
        @foreach(json_decode($r->custom_structure) as $sub)
        @if($sub->question>0)
        <canvas id="Timechart_{{$no}}" class="Timechart_div" width="500" height="200" style="display: none;"></canvas>
        <?php $no++;?>
        @endif
        @endforeach
    </div>
    <!-- //stacked bar chart -->
</div>
</div>
@section('js')
<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<style type="text/css">
.chartjs-render-monitor {
    animation: chartjs-render-animation 1ms;
}

</style>
<script type="text/javascript">
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

</script>
<script type="text/javascript">
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

if ($(window).width() < 776) {
    $('#timewisedetailedperformance').attr('height', '700');
    $('#detailedperformance').attr('height', '700');
    $('#chart-1').css('height', '300px');
    $('#chart-2').css('height', '350px');
    $('#chart-1_1').css('height', '13rem');
    $('#chart-2_1').css('height', '13rem');
    $('.Timechart_div').attr('height', '450');
}

function timechart1() {
    $('.Timechart_div').css('display', 'none');
    $('#Timechart1').css('display', '');
    var canvas1 = document.getElementById('Timechart1');
    var data1 = {

        labels: [<?php $avg= ($p->TT*60)/$p->NOQ;?>
            @for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$i}}", @endfor
        ],
        datasets: [{
            data: [@for($i = 1; $i <= $r - > totalQ; $i++)
                "{{$timearray[$i]}}", @endfor
            ],
            backgroundColor: [@for($i = 1; $i <= $r - > totalQ; $i++) @if($ansarray[$i] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$i] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$i] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$i] == "Pending")
                'rgba(142,36,170, 0.8)', @elseif($ansarray[$i] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endfor
            ]
        }, {
            label: "Average Time required",
            data: [@for($i = 1; $i <= $r - > totalQ; $i++)
                "{{$avg}}", @endfor
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/custom_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas1, {
        data: data1,
        options: option
    });


    //----------------------------------------------------------------------------------------------
}
<?php $no=0;$qn_start=0;$qn_end=0;?>
@foreach(json_decode($r - > custom_structure) as $sub)
@if($sub - > question > 0)
<?php $qn_end =  $qn_start + intval($sub->question);?>
document.getElementById("timechart_open_{{$no}}").onclick = function() {
    $('.Timechart_div').css('display', 'none');
    $('#Timechart_{{$no}}').css('display', '');
    var canvas2 = document.getElementById('Timechart_{{$no}}');
    var data2 = {
        labels: [<?php $n=0;?>
            @foreach($timearray as $k)
            <?php $n++;?>
            @if($n > $qn_start && $n <= $qn_end)
            "{{$n}}", @endif @endforeach
        ],
        datasets: [{
            data: [<?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $qn_start && $n <= $qn_end)
                "{{$value}}", @endif @endforeach
            ],
            backgroundColor: [<?php $n=0;?>
                @foreach($timearray as $k)
                <?php $n++;?>
                @if($n > $qn_start && $n <= $qn_end) @if($ansarray[$n] == "Correct")
                'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$n] == "Incorrect")
                'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$n] == "Unattempted")
                'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$n] == "Pending")
                'rgba(142,36,170, 0.8)', @elseif($ansarray[$n] == "Bonus")
                'rgba(255, 193, 7, 0.6)', @endif @endif @endforeach
            ]
        }, {
            label: "Average Time required",
            data: ["{{$avg}}", <?php $n=0;?>
                @foreach($timearray as $key => $value)
                <?php $n++;?>
                @if($n > $qn_start && $n <= $qn_end)
                "{{$avg}}", @endif @endforeach
            ],
            type: 'line'

        }]
    };
    var option = {
        tooltips: {
            enabled: false
        },
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Time (Seconds)'
                }

            }],
            xAxes: [{
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                gridLines: {
                    display: false
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Question numbers'
                }

            }]
        },
        events: ["click"],
        hover: {
            mode: 'nearest'
        },
        onClick: function(event, element) {
            var activeElement = element[0];
            var barIndex = activeElement._index;
            var xLabel = parseInt(data.labels[barIndex]);
            $(".spinner").show();
            $(".btn-cancel").show();
            $('.socket_title').text('Question :-' + xLabel);
            $('.socket_body').html('Wait...');
            $("#socket").show("closed");
            <?php $qwe = 'Quiz/custom_paper/'.$p->pname.'/question/:s'  ?>
            var asset = encodeURI('{{ asset("$qwe") }}');
            var asset1 = asset.replace(':s', xLabel + '.png');
            var asset2 = asset.replace(':s', xLabel + '_1.png');
            var asset3 = asset.replace(':s', xLabel + '_2.png');
            imageExists(asset1, function(exists) {
                if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
            });
            imageExists(asset2, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
            });
            imageExists(asset3, function(exists) {
                var html = $('.socket_body_main').html();
                if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
            });
            $('.socket_body').hide();
            $(".spinner").hide();
        }
    };


    var myBarChart = Chart.Bar(canvas2, {
        data: data2,
        options: option
    });
};
<?php $qn_start += intval($sub->question); $no++;?>
@endif
@endforeach

var canvas = document.getElementById('Timechart1');

var data = {

    labels: [<?php $avg= ($p->TT*60)/$p->NOQ;?>
        @for($i = 1; $i <= $r - > totalQ; $i++)
        "{{$i}}", @endfor
    ],
    datasets: [{
        data: [@for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$timearray[$i]}}", @endfor
        ],
        backgroundColor: [@for($i = 1; $i <= $r - > totalQ; $i++) @if($ansarray[$i] == "Correct")
            'rgba(28, 200, 138, 0.6)', @elseif($ansarray[$i] == "Incorrect")
            'rgba(255, 0, 0, 0.6)', @elseif($ansarray[$i] == "Unattempted")
            'rgba(183, 185, 204, 0.6)', @elseif($ansarray[$i] == "Pending")
            'rgba(142,36,170, 0.8)', @elseif($ansarray[$i] == "Bonus")
            'rgba(255, 193, 7, 0.6)', @endif @endfor
        ]
    }, {
        label: "Average Time required",
        data: [@for($i = 1; $i <= $r - > totalQ; $i++)
            "{{$avg}}", @endfor
        ],
        type: 'line'

    }]
};

var option = {
    tooltips: {
        enabled: false
    },
    legend: {
        display: false
    },
    scales: {
        yAxes: [{
            scaleLabel: {
                display: true,
                labelString: 'Time (Seconds)'
            }

        }],
        xAxes: [{
            barPercentage: 1.0,
            categoryPercentage: 1.0,
            gridLines: {
                display: false
            },
            scaleLabel: {
                display: true,
                labelString: 'Question numbers'
            }

        }]
    },
    events: ["click"],
    hover: {
        mode: 'nearest'
    },
    onClick: function(event, element) {
        var activeElement = element[0];
        var barIndex = activeElement._index;
        var xLabel = data.labels[barIndex];
        $(".spinner").show();
        $(".btn-cancel").show();
        $('.socket_title').text('Question :-' + xLabel);
        $('.socket_body').html('Wait...');
        $("#socket").show("closed");
        <?php $qwe = 'Quiz/custom_paper/'.$p->pname.'/question/:s'  ?>
        var asset = encodeURI('{{ asset("$qwe") }}');
        var asset1 = asset.replace(':s', xLabel + '.png');
        var asset2 = asset.replace(':s', xLabel + '_1.png');
        var asset3 = asset.replace(':s', xLabel + '_2.png');
        imageExists(asset1, function(exists) {
            if (exists) { $('.socket_body_main').empty().html('<img style="max-width:100%;" src="' + asset1 + '"/>'); } else { $('.socket_body').text('Sorry!!! Question not Available'); }
        });
        imageExists(asset2, function(exists) {
            var html = $('.socket_body_main').html();
            if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset2 + '"/>'); }
        });
        imageExists(asset3, function(exists) {
            var html = $('.socket_body_main').html();
            if (exists) { $('.socket_body_main').html(html + '<img style="max-width:100%;" src="' + asset3 + '"/>'); }
        });
        $('.socket_body').hide();
        $(".spinner").hide();
    }
};

var myBarChart = Chart.Bar(canvas, {
    data: data,
    options: option
});

function imageExists(url, callback) {
    var img = new Image();
    img.onload = function() { callback(true); };
    img.onerror = function() { callback(false); };
    img.src = url;
}


new Chart(document.getElementById("detailedperformance"), {
    type: 'bar',
    data: {
        labels: [
            @foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
            '{{$sub->subject}}', @endif @endforeach 'Overall'
        ],
        datasets: [{
            data: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { $sub - > totalC.
                    ',' } } @endif @endforeach { { $r - > totalC } }],
            label: 'Correct ',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(28, 200, 138, 0.6)', @endif @endforeach 'rgba(28, 200, 138, 0.6)'
            ],
            borderWidth: 1
        }, {
            data: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { $sub - > totalW.
                    ',' } } @endif @endforeach { { $r - > totalW } }],
            label: 'Incorrect ',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(255, 0, 0, 0.6)', @endif @endforeach 'rgba(255, 0, 0, 0.6)'
            ],
            borderWidth: 1
        }, {
            data: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { $sub - > totalP.
                    ',' } } @endif @endforeach { { $r - > totalP } }],
            label: 'Pending ',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(246,194,62, 0.6)', @endif @endforeach 'rgba(246,194,62, 0.6)'
            ],
            borderWidth: 1
        }, {
            data: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { $sub - > question - ($sub - > totalC + $sub - > totalW + $sub - > totalP).
                    ',' } } @endif @endforeach { { $r - > totalQ - ($r - > totalC + $r - > totalW + $r - > totalP) } }],
            label: 'Unattempted ',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(183, 185, 204, 0.6)', @endif @endforeach 'rgba(183, 185, 204, 0.6)'
            ]
        }]
    },
    options: {
        // title: {
        //  display: true,
        //  text: 'Chart.js Bar Chart - Stacked'
        // },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

new Chart(document.getElementById("timewisedetailedperformance"), {
    type: 'bar',
    data: {
        labels: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
            '{{$sub->subject}}', @endif @endforeach
        ],
        datasets: [{
            data: [<?php $no=0;?>
                @foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { intval($TuseC[$no] / 60).
                        ',' } }
                <?php $no++;?>
                @endif @endforeach
            ],
            label: 'Time in Correct (min)',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(132, 212, 235, 0.8)', @endif @endforeach
            ],
            borderWidth: 1
            //#01b8aa
        }, {
            data: [<?php $no=0;?>
                @foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { intval($TuseN[$no] / 60).
                        ',' } }
                <?php $no++;?>
                @endif @endforeach
            ],
            label: 'Time in Incorrect (min)',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(242, 200, 15, 0.8)', @endif @endforeach
            ],
            borderWidth: 1
            //#fd625e
        }, {
            data: [<?php $no=0;?>
                @foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { intval($TuseP[$no] / 60).
                        ',' } }
                <?php $no++;?>
                @endif @endforeach
            ],
            label: 'Time in Pending (min)',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(236,64,122, 0.8)', @endif @endforeach
            ],
            borderWidth: 1
            //#fd625e
        }, {
            data: [<?php $no=0;?>
                @foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0) { { intval($TuseU[$no] / 60).
                        ',' } }
                <?php $no++;?>
                @endif @endforeach
            ],
            label: 'Time in Unattempted (min)',
            backgroundColor: [@foreach(json_decode($r - > custom_structure) as $sub) @if($sub - > question > 0)
                'rgba(95, 107, 109, 0.8)', @endif @endforeach
            ]
        }]
        //#5f6b6d
    },
    options: {
        // title: {
        // display: true,
        // text: 'Chart.js Bar Chart - Stacked'
        // },
        tooltips: {
            mode: 'index',
            intersect: false
        },
        responsive: true,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }
});

</script>
@endsection
@endif
@endforeach
@endforeach
@endsection
