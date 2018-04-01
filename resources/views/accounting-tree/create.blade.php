@extends('layouts.admin')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Users / Create </h1>
    </div>
@endsection

@section('content')
    
    <br><br><br><br><br><br>
   
    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('accounting-tree.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="title" class="form-control" dir="rtl">
                        @if ($errors->has('title'))
                            <span class="alert-danger">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> اسم المستوى</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="code" class="form-control" dir="rtl">
                        @if ($errors->has('code'))
                            <span class="alert-danger">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> كود المستوى</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <input type="radio" name="type" value="credit"> دائن
                        <input type="radio" name="type" value="debit" > مدين <br>
                        @if ($errors->has('type'))
                            <span class="alert-danger">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> نوع المستوى</label>
                    </div>
                </div>
                <br>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a class="btn btn-link pull-right" href="{{ route('accounting-tree.index') }}"><i class="glyphicon glyphicon-backward"></i> السابق</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
