@extends('layouts.admin')

@section('content')
    <br><br><br>
    <div class="page-header clearfix">
        <h1 class="pull-right">
             @lang('validation.accounting_tree') <i class="glyphicon glyphicon-align-justify"></i>
        </h1>
    </div>
    <br><br><br>
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
                                        <a  class="btn btn-success" href="{{ route('accounting-tree.show',$level_one->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a> 
                                        {{$level->title}}
                                    </h5>
                                @endforeach
                            </div>
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $level_one->id }},{{ $level_one->code }},{{ $level_one->level }});"><i class="glyphicon glyphicon-plus"></i> Add New </button>
                                    <div id="addChild-{{$level_one->code}}"></div>
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

<script type="">
    

function drawdev(parent_id,parent_code,parent_level){
            html ="<div class='modal fade' id='myModal' role='dialog'><form id='form' action='{{ url("add-child") }}' method='POST' ><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>Modal Header</h4></div>";

             html +='<div class="modal-body"><input type="hidden" name="parent_id" value="'+parent_id+'"><input type="hidden" name="parent_code" value="'+parent_code+'"><input type="hidden" name="parent_level" value="'+parent_level+'"><input type="hidden" name="_token" value="{{ csrf_token() }}">';

             html += '<div class="row"><div class="col-md-3"><label> Level Title</label></div><div class="col-md-9"><input type="text" name="level_title" class="form-control" required autofocus></div></div>';

             html += '<div class="row"><div class="col-md-3"></div><div class="col-md-6"><input type="radio" name="type" value="credit" checked> دائن<input type="radio" name="type" value="debit" > مدين <br></div><div class="col-md-3"></div></div></div>'; 

            html +="<div class='modal-footer'><button type='submit' class='btn btn-primary'>Save changes</button><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div></div></div></form></div>";
           
            $('#addChild-'+parent_code).append(html)

         }

</script>


@endsection