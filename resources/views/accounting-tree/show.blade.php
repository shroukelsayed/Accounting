@extends(  Auth::user()->role  == 1  ? 'layouts.admin' : 'layouts.app')

@section('content')
    <br><br><br><br><br><br><br>
    <div class="page-header">
        <h1 class="pull-right"> {{$level->title}} &nbsp <i class="fa fa-th-large"></i></h1><br>
    </div>

<?php
    // var_dump(in_array($currentAsset->code,array('1202','1203,'1204','1207','1208','1210'))))
?>
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
                <div class="row push-left">
                <div class="col-md-7"></div>
                    <div class="col-md-4">
                        <!-- Fixed Assets View  -->
                        @if(!empty($level_two->fixedAssets->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->fixedAssets as $fixedAsset)
                                    <li class="nav-item">
                                        <h5><i class="fa fa-download ml-2"></i> {{$fixedAsset->code}} &nbsp&nbsp {{$fixedAsset->title}} </h5>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $level_two->id }},{{ $level_two->code }},{{ $level_two->level }});"><i class="glyphicon glyphicon-plus"></i> اضافة اصل ثابت </button>
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
                                        <a class="nav-link " data-toggle="collapse" data-target="#panel-{{$currentAsset->code}}" href="#panel-{{$currentAsset->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$currentAsset->title}} <i class="fa fa-plus"></i>
                                            @if(in_array($currentAsset->code,array('1202','1203' ,'1204','1207','1208','1210')))
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $currentAsset->id }},{{ $currentAsset->code }},{{ $currentAsset->level }});"><i class="glyphicon glyphicon-plus"></i> </button>
                                                <div id="addChild-{{$currentAsset->code}}"></div>
                                            @endif

                                        </a>

                                    </li>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div id="panel-{{$currentAsset->code}}" class="collapse">
                                                <!--Panel 1-->
                                                <div class="tab-pane" id="panel-{{$currentAsset->code}}" role="tabpanel">
                                                    <ul>
                                                    @foreach($currentAsset->treasury as $treasury)
                                                        <li>
                                                            <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$treasury->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$treasury->title}}</a>
                                                            <div class="collapse" id="panel-{{$treasury->code}}" role="tabpanel">
                                                                @foreach($treasury->treasuryCurrencies as $treasuryCurrencie)
                                                                    <h5> &nbsp{{$treasuryCurrencie->title}}</h5>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    @endforeach 
                                                    </ul>

                                                    @if(!empty($currentAsset->banks->toArray()))
                                                    <ul>
                                                        @foreach($currentAsset->banks as $bank)
                                                            <li>
                                                            <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$bank->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$bank->title}}</a>

                                                            <div class="collapse  " id="panel-{{$bank->code}}" role="tabpanel">
                                                            <ul>
                                                            @foreach($bank->bankAccounts as $bankAccount)
                                                                <li>
                                                                <a style="color: darkblue;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$bankAccount->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$bankAccount->title}}</a>
                                                                <div class="collapse" id="panel-{{$bankAccount->code}}" role="tabpanel">
                                                                    <ul>
                                                                        @foreach($bankAccount->bankAccountItems as $bankAccountItem)
                                                                            <li>
                                                                                <h5 class="my-2 h5">{{$bankAccount->code}}{{$bankAccountItem->code}}{{$bankAccountItem->title}}</h5>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul> 
                                                                </div>
                                                                </li>
                                                            @endforeach
                                                            </ul>
                                                            <br><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $bank->id }},{{ $bank->code }},{{ $bank->level }});"><i class="glyphicon glyphicon-plus"></i> Add New Account</button>
                                                            <div id="addChild-{{$bank->code}}"></div>
                                                            </div>
                                                            </li>
                                                        @endforeach
                                                        </ul>
                                                    @endif
                                                    <ul>
                                                    @foreach($currentAsset->advancedExpenses as $advancedExpense)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$advancedExpense->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$advancedExpense->title}}</a>
                                                        <div class="collapse" id="panel-{{$advancedExpense->code}}" role="tabpanel">
                                                            @foreach($advancedExpense->expensesItems as $expensesItem)
                                                                <h5 class="my-2 h5">{{$expensesItem->title}}</h5>
                                                            @endforeach
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach
                                                    </ul> 
                                                    @foreach($currentAsset->depositsWithOthers as $depositsWithOther)
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$depositsWithOther->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$depositsWithOther->title}}</a>

                                                        <div class="collapse " id="panel-{{$depositsWithOther->code}}" role="tabpanel">
                                                            @foreach($depositsWithOther->depositsWithOtherItems as $depositsWithOtherItem)
                                                                <h5> &nbsp{{$depositsWithOtherItem->title}}</h5>
                                                                
                                                            @endforeach
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $depositsWithOther->id }},{{ $depositsWithOther->code }},{{ $depositsWithOther->level }});"><i class="glyphicon glyphicon-plus"></i> اضافة تأمينات لدى الغير </button>
                                                            <div id="addChild-{{$depositsWithOther->code}}"></div>
                                                        </div>
                                                    @endforeach 
                                                    <ul>
                                                    @foreach($currentAsset->custodyAndAdvances as $custodyAndAdvance)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$custodyAndAdvance->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$custodyAndAdvance->title}}</a>
                                                        <div class="collapse" id="panel-{{$custodyAndAdvance->code}}" role="tabpanel">
                                                            @foreach($custodyAndAdvance->workers as $worker)
                                                                <h5 class="my-2 h5">{{$worker->title}}</h5>
                                                            @endforeach
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach 
                                                    </ul>
                                                    <ul>
                                                    @foreach($currentAsset->accuredRevenues as $accuredRevenue)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$accuredRevenue->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$accuredRevenue->title}}</a>
                                                        <div class="collapse" id="panel-{{$accuredRevenue->code}}" role="tabpanel">
                                                            @foreach($accuredRevenue->accuredRevenuesItems as $accuredRevenuesItem)
                                                                <h5 class="my-2 h5">{{$accuredRevenuesItem->title}}</h5>
                                                            @endforeach  
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach 
                                                    </ul>
                                                    @foreach($currentAsset->variousDebitors as $variousDebitor)
                                                        <h5 class="my-2 h5">{{$variousDebitor->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->otherDebitBalances as $otherDebitBalance)
                                                        <h5 class="my-2 h5">{{$otherDebitBalance->title}}</h5>
                                                    @endforeach 
                                                    <ul>
                                                    @foreach($currentAsset->stores as $store)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$store->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$store->title}}</a>
                                                        <div class="collapse" id="panel-{{$store->code}}" role="tabpanel">
                                                            @foreach($store->storeItems as $storeItem)
                                                                <h5> &nbsp{{$storeItem->title}}</h5>
                                                            @endforeach
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $store->id }},{{ $store->code }},{{ $store->level }});"><i class="glyphicon glyphicon-plus"></i> Add Store Item </button>
                                                            <div id="addChild-{{$store->code}}"></div>
                                                        </div>
                                                        </li>
                                                    @endforeach 
                                                    </ul>
                                                    @foreach($currentAsset->receivableCheques as $receivableCheque)
                                                        <h5 class="my-2 h5">{{$receivableCheque->title}}</h5>
                                                    @endforeach 
                                                    <ul>
                                                    @foreach($currentAsset->fawry as $fawry)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$fawry->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$fawry->title}}</a>
                                                        <div class="collapse" id="panel-{{$fawry->code}}" role="tabpanel">
                                                            <ul>
                                                                @foreach($fawry->fawryItems as $fawryItem)
                                                                <li>
                                                                    <a style="color: darkblue;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$fawryItem->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$fawryItem->title}}</a>
                                                                    @if(!is_null($fawryItem->fawryItemBanks))
                                                                        <div class="collapse" id="panel-{{$fawryItem->code}}" role="tabpanel">
                                                                            <ul>
                                                                                @foreach ($fawryItem->fawryItemBanks as $bank)
                                                                                    <li><h5>{{$bank->title}}</h5></li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                    @foreach($currentAsset->sms as $sms)
                                                        <h5 class="my-2 h5">{{$sms->title}}</h5>
                                                    @endforeach 
                                                    @foreach($currentAsset->cibMachine as $cibMachine)
                                                        <h5 class="my-2 h5">{{$cibMachine->title}}</h5>
                                                    @endforeach 
                                                    @if(in_array($currentAsset->code,array('1202','1203' ,'1204','1207','1208','1210')))
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $currentAsset->id }},{{ $currentAsset->code }},{{ $currentAsset->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                        <div id="addChild-{{$currentAsset->code}}"></div>
                                                    @endif
                                                </div>
                                                <!--/.Panel 1-->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @endif
                        <!-- Current Assets View  -->

                        <!-- Current Liabilities View  -->
                        @if(!empty($level_two->currentLiabilities->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->currentLiabilities as $currentLiability)
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="collapse" data-target="#panel-{{$currentLiability->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$currentLiability->title}}</a>
                                    </li>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <div class="tab-content">
                                                <!--Panel 1-->
                                                <div class="collapse" id="panel-{{$currentLiability->code}}" role="tabpanel">
                                                    @foreach($currentLiability->suppliers as $supplier)
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$supplier->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$supplier->title}}</a>

                                                        <div class="collapse" id="panel-{{$supplier->code}}" role="tabpanel">
                                                            @foreach($supplier->suppliersCreditors as $suppliersCreditor)
                                                                <h5> &nbsp{{$suppliersCreditor->title}}</h5>
                                                                
                                                            @endforeach
                                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $supplier->id }},{{ $supplier->code }},{{ $supplier->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                            <div id="addChild-{{$supplier->code}}"></div>
                                                        </div>
                                                    @endforeach

                                                    <ul>
                                                    @foreach($currentLiability->accuredExpenses as $accuredExpense)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$accuredExpense->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$accuredExpense->title}}</a>
                                                        <div class="collapse" id="panel-{{$accuredExpense->code}}" role="tabpanel">
                                                            @foreach($accuredExpense->expensesItems as $expensesItem)
                                                                <h5 class="my-2 h5">{{$expensesItem->title}}</h5>
                                                            @endforeach
                                                            
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                    @foreach($currentLiability->payableCheques as $payableCheque)
                                                        <h5 class="my-2 h5">{{$payableCheque->title}}</h5>
                                                    @endforeach

                                                    @foreach($currentLiability->taxes as $tax)
                                                        <h5 class="my-2 h5">{{$tax->title}}</h5>
                                                    @endforeach

                                                    <ul>
                                                    @foreach($currentLiability->socialInsurances as $socialInsurance)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$socialInsurance->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$socialInsurance->title}}</a>
                                                        <div class="collapse" id="panel-{{$socialInsurance->code}}" role="tabpanel">
                                                            @foreach($socialInsurance->socialInsuranceItems as $socialInsuranceItem)
                                                                <h5 class="my-2 h5">{{$socialInsuranceItem->title}}</h5>
                                                            @endforeach
                                                            
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                    <ul>
                                                    @foreach($currentLiability->penalitiesFunds as $penalitiesFund)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$penalitiesFund->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$penalitiesFund->title}}</a>
                                                        <div class="collapse" id="panel-{{$penalitiesFund->code}}" role="tabpanel">
                                                            @foreach($penalitiesFund->workers as $worker)
                                                                <h5 class="my-2 h5">{{$worker->title}}</h5>
                                                            @endforeach
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                    <ul>
                                                    @foreach($currentLiability->friendshipFunds as $friendshipFund)
                                                        <li>
                                                        <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$friendshipFund->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$friendshipFund->title}}</a>
                                                        <div class="collapse" id="panel-{{$friendshipFund->code}}" role="tabpanel">
                                                            @foreach($friendshipFund->workers as $worker)
                                                                <h5 class="my-2 h5">{{$worker->title}}</h5>
                                                            @endforeach
                                                        <hr> 
                                                        </div>
                                                        </li>
                                                    @endforeach
                                                    </ul>

                                                    @foreach($currentLiability->amountsUnderAdjustments as $amountsUnderAdjustment)
                                                        <h5 class="my-2 h5">{{$amountsUnderAdjustment->title}}</h5>
                                                    @endforeach

                                                    @foreach($currentLiability->creditors as $creditor)
                                                        <h5 class="my-2 h5">{{$creditor->title}}</h5>
                                                    @endforeach

                                                    @if(in_array($currentLiability->code,array('2102','2103' ,'2104','2108','2109')))
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $currentLiability->id }},{{ $currentLiability->code }},{{ $currentLiability->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                                        <div id="addChild-{{$currentLiability->code}}"></div>
                                                    @endif
                                                    
                                                </div>
                                                <!--/.Panel 1-->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        @endif                        
                        <!-- Current Liabilities View  -->

                        <!-- level Three Operation Expenses  View  -->
                        @if(!empty($level_two->levelThreeOperationExpenses->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->levelThreeOperationExpenses as $levelThreeOperationExpense)
                                    <li>
                                    <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$levelThreeOperationExpense->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$levelThreeOperationExpense->title}}</a>
                                    <div class="collapse" id="panel-{{$levelThreeOperationExpense->code}}" role="tabpanel">
                                        <ul>
                                        @foreach($levelThreeOperationExpense->LevelFour as $levelFour)
                                            <li>
                                            <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$levelFour->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$levelFour->title}}</a>
                                            <div class="collapse" id="panel-{{$levelFour->code}}" role="tabpanel">
                                                @foreach($levelFour->expensesItems as $expensesItem)
                                                    <h5 class="my-2 h5">{{$expensesItem->title}}</h5>
                                                @endforeach
                                                
                                            <hr> 
                                            </div>
                                            </li>
                                        @endforeach
                                        </ul>

                                    </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- level Three Operation Expenses  View  -->

                        <!-- level Three General Expenses  View  -->
                        @if(!empty($level_two->levelThreeGeneralExpenses->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->levelThreeGeneralExpenses as $levelThreeGeneralExpense)
                                    <li>
                                    <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$levelThreeGeneralExpense->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$levelThreeGeneralExpense->title}}</a>
                                    <div class="collapse" id="panel-{{$levelThreeGeneralExpense->code}}" role="tabpanel">
                                        <ul>
                                        @foreach($levelThreeGeneralExpense->LevelFour as $levelFour)
                                            <li>
                                            <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$levelFour->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$levelFour->title}}</a>
                                            <div class="collapse" id="panel-{{$levelFour->code}}" role="tabpanel">
                                                @foreach($levelFour->expensesItems as $expensesItem)
                                                    <h5 class="my-2 h5">{{$expensesItem->title}}</h5>
                                                @endforeach
                                                
                                            <hr> 
                                            </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $levelThreeGeneralExpense->id }},{{ $levelThreeGeneralExpense->code }},{{ $levelThreeGeneralExpense->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                        <div id="addChild-{{$levelThreeGeneralExpense->code}}"></div>
                                    </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- level Three General Expenses  View  -->

                        <!-- level Revenues  View  -->
                        @if(!empty($level_two->levelThreeRevenues->toArray()))
                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                @foreach($level_two->levelThreeRevenues as $levelThreeRevenue)
                                    <li>
                                    <a style="color: darkred;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$levelThreeRevenue->code}}" role="tab"> <i class="fa fa-download ml-2"></i>  &nbsp &nbsp{{$levelThreeRevenue->code}} &nbsp  &nbsp{{$levelThreeRevenue->title}}</a>
                                    <div class="collapse" id="panel-{{$levelThreeRevenue->code}}" role="tabpanel">
                                        <ul>
                                        @foreach($levelThreeRevenue->LevelFour as $levelFour)
                                            <li>
                                            <a style="color: darkblue;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$levelFour->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$levelFour->title}}</a>
                                            <div class="collapse" id="panel-{{$levelFour->code}}" role="tabpanel">
                                                <ul>
                                                @foreach($levelFour->coupons as $coupon)
                                                    <li>
                                                    <h5 class="my-2 h5">&nbsp&nbsp{{$coupon->pivot->code}} &nbsp&nbsp{{$coupon->title}}</h5>
                                                    </li>
                                                @endforeach 
                                                </ul>
                                                @foreach($levelFour->notebookLicenses as $notebookLicense)
                                                    <h5 class="my-2 h5">&nbsp&nbsp{{$notebookLicense->code}} &nbsp&nbsp{{$notebookLicense->title}}</h5>
                                                @endforeach 

                                                @foreach($levelFour->revenueSms as $revenueSms)
                                                    <h5 class="my-2 h5">&nbsp&nbsp{{$revenueSms->code}} &nbsp&nbsp{{$revenueSms->title}}</h5>
                                                @endforeach 

                                                @foreach($levelFour->revenueMalls as $revenueMall)
                                                    <h5 class="my-2 h5">&nbsp&nbsp{{$revenueMall->code}} &nbsp&nbsp{{$revenueMall->title}}</h5>
                                                @endforeach 

                                                <ul>
                                                @foreach($levelFour->revenueFawries as $revenueFawry)
                                                    <li>
                                                        <a style="color:green;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$revenueFawry->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$revenueFawry->title}}</a>
                                                        <div class="collapse" id="panel-{{$revenueFawry->code}}" role="tabpanel">
                                                            <ul>
                                                            @foreach($revenueFawry->revenueFawryItems as $revenueFawryItem)
                                                                <li>
                                                                <h5 class="my-2 h5">&nbsp&nbsp{{$revenueFawryItem->pivot->code}} &nbsp&nbsp{{$revenueFawryItem->pivot->title}}</h5>
                                                                </li>
                                                            @endforeach 
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                </ul>

                                                <ul>
                                                @foreach($levelFour->revenueBanks as $revenueBank)
                                                    <li>
                                                        <a style="color:green;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$revenueBank->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$revenueBank->title}}</a>
                                                        <div class="collapse" id="panel-{{$revenueBank->code}}" role="tabpanel">
                                                            <ul>
                                                            @foreach($revenueBank->revenueBankAccounts as $revenueBankAccount)
                                                                <li>
                                                                <h5 class="my-2 h5">&nbsp&nbsp{{$revenueBankAccount->pivot->code}} &nbsp&nbsp{{$revenueBankAccount->pivot->title}}</h5>
                                                                </li>
                                                            @endforeach 
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                </ul>

                                                <ul>
                                                @foreach($levelFour->revenueBenefits as $revenueBenefit)
                                                    <li>
                                                        <a style="color:green;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$revenueBenefit->code}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$revenueBenefit->title}}</a>
                                                        <div class="collapse" id="panel-{{$revenueBenefit->code}}" role="tabpanel">
                                                            <ul>
                                                            @foreach($revenueBenefit->revenueBenefitItems as $revenueBenefitItem)
                                                                <li>
                                                                <h5 class="my-2 h5">&nbsp&nbsp{{$revenueBenefitItem->pivot->code}} &nbsp&nbsp{{$revenueBenefitItem->pivot->title}}</h5>
                                                                </li>
                                                            @endforeach 
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endforeach 
                                                </ul>
                                                
                                            </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- level Revenues  View  -->

                        <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $level_two->id }},{{ $level_two->code }},{{ $level_two->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
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

        var c = "" + parent_code + "";

        html ="<div class='modal fade' id='myModal' role='dialog'><form id='form' action='{{ url("add-child") }}' method='POST' ><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>Modal Header</h4></div>";

        html +='<div class="modal-body"><input type="hidden" name="parent_id" value="'+parent_id+'"><input type="hidden" name="parent_code" value="'+parent_code+'"><input type="hidden" name="parent_level" value="'+parent_level+'"><input type="hidden" name="_token" value="{{ csrf_token() }}">';

        html += '<div class="row"><div class="col-md-3"><label> Level Title</label></div><div class="col-md-9"><input type="text" name="level_title" class="form-control" required autofocus></div></div>';

        html += '<div class="row"><div class="col-md-3"></div><div class="col-md-6"><input type="radio" name="type" value="credit" checked> دائن<input type="radio" name="type" value="debit" > مدين <br></div><div class="col-md-3"></div></div></div>'; 

        if (c.substring(0, 4) == "1209") {
            // ...
            console.log(parent_code);

        }
        
        html +="<div class='modal-footer'><button type='submit' class='btn btn-primary'>Save changes</button><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div></div></div></form></div>";
           
        $('#addChild-'+parent_code).append(html)

    }

</script>
@endsection


