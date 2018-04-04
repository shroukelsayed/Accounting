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
   
    $(function($){
            
        // $('#addChild').click(function(){
        //      $.ajax({
        //         url: '/add-child',
        //         type: "POST",
        //         data: {'id': $(":input[name='id']").val(),
        //                'code': $(":input[name='code']").val(),
        //                'title': $(":input[name='level_title']").val(),
        //                '_token': $('input[name=_token]').val()},

        //         success:function(data) {                 
        //             console.log(data);
        //         }
        //     });


        // });    
           
    });


</script>
    <br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            @if($levels->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>    
                            <th>OPTIONS</th>
                            <th> كود المستوى </th>
                            <th> اسم المستوى </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($levels as $level_one)
                            <li class="dropdown" dir="rtl"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $level_one->title}}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($level_one->levelTwo as $level)
                                        <li><a href="#">{{ $level->title}}</a></li>
                                    
                                <tr>                                
                                    <td>
                                        
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal-{{$level->id}}"><i class="glyphicon glyphicon-trash"></i> Add Child</button>
                                        <a class="btn btn-xs btn-warning" href="{{ route('accounting-tree.edit', $level->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                        <form action="{{ url('add-child') }}" method="POST" >
                                            <div class="modal fade" id="myModal-{{ $level->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Add New Level</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="parent_id" value="{{ $level->id }}">
                                                            <input type="hidden" name="parent_code" value="{{ $level->code }}">
                                                            <input type="hidden" name="parent_level" value="{{ $level->level }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label> Level Title</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="level_title" class="form-control" required>
                                                                </div>
                                                            </div>
                                                             <div class="row">
                                                                <div class="col-md-3">
                                                                    <label> Level Code</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="level_code" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3"></div>
                                                                <div class="col-md-6">
                                                                    <input type="radio" name="type" value="credit"> دائن
                                                                    <input type="radio" name="type" value="debit" > مدين <br>
                                                                </div>
                                                                <div class="col-md-3"></div>
                                                            </div>          
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" id="addChild" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>{{$level->code}}</td>
                                    <td>{{$level->title}}</td>
                                </tr>
                            @endforeach
                        </ul>
                        @endforeach
                    </tbody>
                </table>
               
                {!! $levels->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>




@endsection