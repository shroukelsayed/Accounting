
@extends('layouts.app')

@section('content')
<div class="container">
    <br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            @if($allocations->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>اسم المخصص</th>
                            <th>المبلغ</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($allocations as $allocation)
                            <tr>
                                <td>{{$allocation->id}}</td>
                                <td>
                                    <a style="color: darkblue;" class="nav-link " data-toggle="collapse" data-target="#panel-{{$allocation->id}}" role="tab"> <i class="fa fa-download ml-2"></i> &nbsp{{$allocation->title}}</a>
                                        <div class="collapse" id="panel-{{$allocation->id}}" role="tabpanel">
                                            <ul class="nav  md-pills pills-primary flex-column" role="tablist">
                                                @foreach($allocation->children as $child)
                                                    <li class="nav-item">
                                                        <h5><i class="fa fa-download ml-2"></i>  &nbsp&nbsp {{$child->title}} </h5>
                                                    </li>
                                                @endforeach
                                                <li class="nav-item">
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="drawdev({{ $allocation->id }});"><i class="glyphicon glyphicon-plus"></i> Add Allocation Child</button>
                                                    <div id="addChild-{{$allocation->id}}"></div>
                                                </li>
                                            </ul>
                                            
                                        </div>

                                </td>
                                <td>{{$allocation->amount}}</td>
                              
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $allocations->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('save-allocation') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="title" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> اسم المخصص</label>
                    </div>
                </div>
                <br>
                <div class="row">
                     <div class="col-md-9">
                        <input type="text" name="amount" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> المبلغ</label>
                    </div>
                </div>
                <br>
                <br>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a class="btn btn-link pull-right" href="{{ url('allocation') }}"><i class="glyphicon glyphicon-backward"></i> السابق</a>
                </div>
            </form>

        </div>
    </div>

</div>


<script type="">
    

    function drawdev(parent_id){


        html ="<div class='modal fade' id='myModal' role='dialog'><form id='form' action='{{ url("save-allocation") }}' method='POST' ><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>Modal Header</h4></div>";

        html +='<div class="modal-body"><input type="hidden" name="parent_id" value="'+parent_id+'"><input type="hidden" name="_token" value="{{ csrf_token() }}">';

        html += '<div class="row"><div class="col-md-3"><label> Level Title</label></div><div class="col-md-9"><input type="text" name="title" class="form-control" required autofocus></div></div>';

        html += '<div class="row"><div class="col-md-3"><label> Level Amount</label></div><div class="col-md-9"><input type="text" name="amount" class="form-control" required autofocus></div></div>';

        html += '<div class="row"><div class="col-md-3"></div><div class="col-md-6"><input type="radio" name="type" value="credit" checked> دائن<input type="radio" name="type" value="debit" > مدين <br></div><div class="col-md-3"></div></div></div>'; 


        html +="<div class='modal-footer'><button type='submit' class='btn btn-primary'>Save changes</button><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></div></div></div></form></div>";
           
        $('#addChild-'+parent_id).append(html)

    }

</script>
@endsection
