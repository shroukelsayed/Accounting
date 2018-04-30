@extends('layouts.admin')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')
    
    <br><br><br>
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Add Revenue Fawry Item </h1>
    </div>
    <br><br><br>
   
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('add-revenue-fawry-item') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="title" class="form-control" dir="rtl" autofocus>
                        @if ($errors->has('title'))
                            <span class="alert-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;">item name</label>
                    </div>
                </div>
                <br>
                
                <br>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a class="btn btn-link pull-right" href="{{ route('accounting-tree.index') }}"><i class="glyphicon glyphicon-backward"></i> السابق</a>
                </div>
            </form>

        </div>
    </div>
@endsection
