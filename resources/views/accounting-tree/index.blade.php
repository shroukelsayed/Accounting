@extends('layouts.admin')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Levels
            <a class="btn btn-success pull-right" href="{{ route('accounting-tree.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>
    </div>
@endsection

@section('content')
   
    <br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">


            <!-- Nav tabs -->
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    <!-- Tab panels -->
                    <div class="tab-content vertical">
                        @foreach($levels as $level_one)
                            <!--Panel 1-->
                            <div class="tab-pane fade in " id="panel-{{$level_one->id}}" role="tabpanel">
                                @foreach($level_one->levelTwo as $level)
                                    <h5 class="my-2 h5">
                                        <!-- <a  id="btn" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#myModal-" ><i class="glyphicon glyphicon-plus"></i></a>  -->
                                        <a  class="btn btn-success" href="{{ route('accounting-tree.show',$level_one->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a> 
                                        {{$level->title}}
                                    </h5>
                                @endforeach
                            </div>
                            <!--/.Panel 1-->
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                        @foreach($levels as $level_one)
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#panel-{{$level_one->id}}" role="tab">{{$level_one->title}}
                                <i class="fa fa-th-large"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- Nav tabs -->

            @if($levels->count())
                {!! $levels->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif
        </div>
    </div>




@endsection