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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
         modaldia = $("#addChild");
        
            $("#btn").click(function () {
                modaldia.dialog({
                    autoOpen: false,
                    width: 750,
                    modal: true
                   
                });
                modaldia.dialog('open');
                // modaldia.load("/home/Ajaxform", function () {
                //    //tryed loading date picker here 
                //     //var startDate = $("#EffectiveStartDate");
                //     //startDate.unbind();
                //     //startDate.datepicker();
                // });

            });

        });
        
        function drawNewChild(parent_id,parent_code,parent_level){
            // addChild=document.getElementById("addChild");
            // addChild.innerHTML= "";

            var html = " <form action='{{ url("add-child") }}' method='POST' >";
            html += '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
            html += '<div class="modal-dialog" role="document"><div class="modal-content">';
            html += '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">Add New Level</h4></div>';

            html += '<div class="modal-body"><input type="hidden" name="parent_id" value="'+parent_id+'"><input type="hidden" name="parent_code" value="'+parent_code+'"><input type="hidden" name="parent_level" value="'+parent_level+'"><input type="hidden" name="_token" value="{{ csrf_token() }}">';

            html += '<div class="row"><div class="col-md-3"><label> Level Title</label></div><div class="col-md-9"><input type="text" name="level_title" class="form-control" required></div></div>';
            html += '<div class="row"><div class="col-md-3"><label> Level Code</label></div><div class="col-md-9"><input type="text" name="level_code" class="form-control" required></div></div>';
            html += '<div class="row"><div class="col-md-3"></div><div class="col-md-6"><input type="radio" name="type" value="credit"> دائن<input type="radio" name="type" value="debit" > مدين <br></div><div class="col-md-3"></div></div>';
            html += '<div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="submit" id="addChild" class="btn btn-primary">Save changes</button></div></div></div></div></form>';
            
            return html;



            // html= '';
            // html= '';
            // html= '';

            // alert(parent_id);
            // alert(parent_code);
            // alert(parent_id);
        }


        // $(function($){
            
        // });
    </script>

    <br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">

            @foreach($levels as $level_one)
                <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $level_one->title }}<span></span></a>
                    <ul class="dropdown-submenu">
                        @foreach($level_one->levelTwo as $level)
                            <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>{{ $level->title }} </span></a>
                            <!-- Modal for adding new child -->                    
                            <!-- Modal for adding new child -->   

                            @if(!empty($level->fixedAssets->toArray()))
                                <ul class="dropdown-menu">
                                    @foreach($level->fixedAssets as $fixedAsset)
                                        <li><a href="#">{{ $fixedAsset->title}}</a></li>
                                    @endforeach
                                </ul>
                            @endif

                            @if(!empty($level->currentAssets->toArray()))
                                <ul class="dropdown-menu">
                                    @foreach($level->currentAssets as $currentAsset)
                                         <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>{{ $currentAsset->title}}</span></a>
                                            <!-- Modal for adding new child -->
                                             <!-- <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal-{{$level->id}}"><i class="glyphicon glyphicon-trash"></i> Add Child</button> -->

                            <button type="button" id="btn" class="btn btn-xs btn-danger"  data-toggle="modal" data-target="#myModal" onclick="drawNewChild({{ $currentAsset->id }},{{ $currentAsset->code }},{{ $currentAsset->level }});"><i class="glyphicon glyphicon-plus"></i></button> 

                            <div id="addChild"></div>    

                                   
                            <!-- Modal for adding new child -->  
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

            @if($levels->count())
                {!! $levels->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif
        </div>
    </div>




@endsection