@extends('layouts.admin')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Projects / Edit #{{$project->id}}</h1>
    </div>
@endsection

@section('content')

<br><br><br><br><br><br><br>

    @include('error')



    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="name" class="form-control" dir="rtl" value="{{$project->name}}">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> اسم المشروع</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="code" class="form-control" dir="rtl" value="{{$project->code}}">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> كود المشروع</label>
                    </div>
                </div>
                <br><br><br>


                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('projects.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
