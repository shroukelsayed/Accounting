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


   $('#myModal').modal('toggle');
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
                        @foreach($levels as $level)
                            <tr>                                
                                <td>
                                    
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-trash"></i> Add Child</button>
                                    <a class="btn btn-xs btn-warning" href="{{ route('accounting-tree.edit', $level->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                </td>
                                <td>{{$level->code}}</td>
                                <td>{{$level->title}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ url('add-child') }}" method="POST" >
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Add New Level</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{ $level->id }}">
                                                        <input type="hidden" name="code" value="{{ $level->code }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label> Level Title</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="level_title" class="form-control">
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                {!! $levels->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>



@endsection