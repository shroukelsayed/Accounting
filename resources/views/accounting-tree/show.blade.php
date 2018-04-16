@extends(  Auth::user()->role  == 1  ? 'layouts.admin' : 'layouts.app')

@section('content')
    <br><br><br><br><br><br><br>
    <div class="page-header">
        <h1 class="pull-right"> {{$level->title}} &nbsp <i class="fa fa-th-large"></i></h1><br>
    </div>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified indigo" role="tablist">
        @foreach($level->levelTwo as $level_two)
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel-{{$level_two->code}}" role="tab">
                {{$level_two->title}} &nbsp <i class="glyphicon glyphicon-star"></i> </a>
            </li>
        @endforeach
    </ul>
    <!-- Nav tabs -->
    <!-- Tab panels -->

    <div class="tab-content">
        @foreach($level->levelTwo as $level_two)
            <!--Panel 1-->
            <div class="tab-pane fade in" id="panel-{{$level_two->code}}" role="tabpanel">
                <!-- Nav tabs -->
                <div class="row pull-right">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <!-- Fixed Assets View  -->
                       @if(!empty($level_two->fixedAssets->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->fixedAssets as $fixedAsset)
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" role="tab"><i class="fa fa-download ml-2"></i> &nbsp {{$fixedAsset->title}}</a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $level_two->id }},{{ $level_two->code }},{{ $level_two->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                    <div id="addChild-{{$level_two->code}}"></div>
                                </li>
                            </ul>
                        @endif
                        <!-- Fixed Assets View  -->
                        
                        <!-- Current Assets View  -->
                        @if(!empty($level_two->currentAssets->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->currentAssets as $currentAsset)
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#panel-{{$currentAsset->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$currentAsset->title}}</a>
                                    </li>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <!--Panel 1-->
                                                <div class="tab-pane fade  " id="panel-{{$currentAsset->code}}" role="tabpanel">
                                                    @foreach($currentAsset->treasury as $treasury)
                                                        <h5 class="my-2 h5">{{$treasury->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->banks as $bank)
                                                        <a style="color: darkred;" class="nav-link " data-toggle="tab" href="#panel-{{$bank->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$bank->title}}</a>

                                                        <div class="tab-pane fade  " id="panel-{{$bank->code}}" role="tabpanel">

                                                            @foreach($bank->bankAccounts as $bankAccount)
                                                            <a style="color: darkblue;" class="nav-link " data-toggle="tab" href="#panel-{{$bankAccount->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$bankAccount->title}}</a>
                                                            <div class="tab-pane fade  " id="panel-{{$bankAccount->code}}" role="tabpanel">
                                                                @foreach($bankAccount->bankAccountItems as $bankAccountItem)
                                                                    <h5 class="my-2 h5">{{$bankAccountItem->title}}</h5>
                                                                @endforeach 
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $bankAccount->id }},{{ $bankAccount->code }},{{ $bankAccount->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                                <div id="addChild-{{$bankAccount->code}}"></div>
                                                            </div>
                                                            @endforeach
                                                        <hr> 
                                                        </div>
                                                    @endforeach
                                                    @foreach($currentAsset->advancedExpenses as $advancedExpense)
                                                        <h5 class="my-2 h5">{{$advancedExpense->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->depositsWithOthers as $depositsWithOther)
                                                        <h5 class="my-2 h5">{{$depositsWithOther->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->custodyAndAdvances as $custodyAndAdvance)
                                                        <h5 class="my-2 h5">{{$custodyAndAdvance->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->accuredRevenues as $accuredRevenue)
                                                        <h5 class="my-2 h5">{{$accuredRevenue->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->variousDebitors as $variousDebitor)
                                                        <h5 class="my-2 h5">{{$variousDebitor->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->otherDebitBalances as $otherDebitBalance)
                                                        <h5 class="my-2 h5">{{$otherDebitBalance->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->stores as $store)
                                                        <h5 class="my-2 h5">{{$store->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->receivableCheques as $receivableCheque)
                                                        <h5 class="my-2 h5">{{$receivableCheque->title}}</h5>
                                                    @endforeach 

                                                     @foreach($currentAsset->fawry as $fawry)
                                                        <a style="color: darkred;" class="nav-link " data-toggle="tab" href="#panel-{{$fawry->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$fawry->title}}</a>

                                                        <div class="tab-pane fade  " id="panel-{{$fawry->code}}" role="tabpanel">

                                                            @foreach($fawry->fawryItems as $fawryItem)
                                                            <a style="color: darkblue;" class="nav-link " data-toggle="tab" href="#panel-{{$fawryItem->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$fawryItem->title}}</a>
                                                            <div class="tab-pane fade  " id="panel-{{$fawryItem->code}}" role="tabpanel">
                                                                @foreach($fawryItem->fawryBanks as $fawryBank)
                                                                    <h5 class="my-2 h5">{{$fawryBank->title}}</h5>
                                                                @endforeach 
                                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $fawryItem->id }},{{ $fawryItem->code }},{{ $fawryItem->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                                <div id="addChild-{{$fawryItem->code}}"></div>
                                                            </div>
                                                            @endforeach

                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $fawry->id }},{{ $fawry->code }},{{ $fawry->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                            <div id="addChild-{{$fawry->code}}"></div>
                                                        <hr> 
                                                        </div>
                                                    @endforeach



                                                    
                                                    @foreach($currentAsset->sms as $sms)
                                                        <h5 class="my-2 h5">{{$sms->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->cibMachine as $cibMachine)
                                                        <h5 class="my-2 h5">{{$cibMachine->title}}</h5>
                                                    @endforeach 
                                                   
                                                    <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $currentAsset->id }},{{ $currentAsset->code }},{{ $currentAsset->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                    <div id="addChild-{{$currentAsset->code}}"></div> -->
                                                </div>
                                                <!--/.Panel 1-->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <li class="nav-item">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $level_two->id }},{{ $level_two->code }},{{ $level_two->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                        <div id="addChild-{{$level_two->code}}"></div>
                                    
                                </li>
                            </ul>
                        @endif
                        <!-- Current Assets View  -->

                        <!-- Current Liabilities View  -->
                        @if(!empty($level_two->currentLiabilities->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->currentLiabilities as $currentLiability)
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tab" href="#panel-{{$currentLiability->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$currentLiability->title}}</a>
                                    </li>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <!--Panel 1-->
                                                <div class="tab-pane fade  " id="panel-{{$currentLiability->code}}" role="tabpanel">
                                                    @foreach($currentLiability->suppliers as $supplier)
                                                        <h5 class="my-2 h5">{{$supplier->title}}</h5>
                                                    @endforeach

                                                    @foreach($currentLiability->accuredExpenses as $accuredExpense)
                                                        <h5 class="my-2 h5">{{$accuredExpense->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->payableCheques as $payableCheque)
                                                        <h5 class="my-2 h5">{{$payableCheque->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->taxes as $tax)
                                                        <h5 class="my-2 h5">{{$tax->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->socialInsurances as $socialInsurance)
                                                        <h5 class="my-2 h5">{{$socialInsurance->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->penalitiesFunds as $penalitiesFund)
                                                        <h5 class="my-2 h5">{{$penalitiesFund->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->friendshipFunds as $friendshipFund)
                                                        <h5 class="my-2 h5">{{$friendshipFund->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->amountsUnderAdjustments as $amountsUnderAdjustment)
                                                        <h5 class="my-2 h5">{{$amountsUnderAdjustment->title}}</h5>
                                                    @endforeach


                                                    @foreach($currentLiability->creditors as $creditor)
                                                        <h5 class="my-2 h5">{{$creditor->title}}</h5>
                                                    @endforeach

                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $currentLiability->id }},{{ $currentLiability->code }},{{ $currentLiability->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                    <div id="addChild-{{$currentLiability->code}}"></div>
                                                </div>
                                                <!--/.Panel 1-->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <li class="nav-item">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $level_two->id }},{{ $level_two->code }},{{ $level_two->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                    <div id="addChild-{{$level_two->code}}"></div>
                                </li>
                            </ul>
                        @endif                        
                        <!-- Current Liabilities View  -->


                       <!--  <button type="button" id="btn-{{$level_two->code}}" class="btn btn-xs btn-primary" onclick="drawNewChild({{ $level_two->id }},{{ $level_two->code }},{{ $level_two->level }});"><i class="glyphicon glyphicon-trash"></i> Add New</button>
                                    <div id="addChild-{{$level_two->code}}"></div>     
 -->
                    </div>
                </div>
                <!-- Nav tabs -->
            </div>
            <!--/.Panel 1-->
        @endforeach
    </div>
       

<script type="">
    

function drawdev(parent_id,parent_code,parent_level){
            html ="<div class='modal fade' id='myModal' role='dialog'><form id='form' action='{{ url("add-child") }}' method='POST' ><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>Modal Header</h4></div>;"

             html +='<div class="modal-body"><input type="hidden" name="parent_id" value="'+parent_id+'"><input type="hidden" name="parent_code" value="'+parent_code+'"><input type="hidden" name="parent_level" value="'+parent_level+'"><input type="hidden" name="_token" value="{{ csrf_token() }}">';

             html += '<div class="row"><div class="col-md-3"><label> Level Title</label></div><div class="col-md-9"><input type="text" name="level_title" class="form-control" required></div></div>';

             html += '<div class="row"><div class="col-md-3"></div><div class="col-md-6"><input type="radio" name="type" value="credit"> دائن<input type="radio" name="type" value="debit" > مدين <br></div><div class="col-md-3"></div></div></div>'; 

            html +="<div class='modal-footer'><button type='submit' class='btn btn-primary'>Save changes</button><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div></div></div></form></div>";
           
            $('#addChild-'+parent_code).append(html)

         }

</script>
@endsection


