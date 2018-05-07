@extends(  Auth::user()->role  == 1  ? 'layouts.admin' : 'layouts.app')
@section('header')
<div class="page-header">
        <h1>Projects / Show #{{$project->id}}</h1>
        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <!-- <a class="btn btn-warning btn-group" role="group" href="{{ route('projects.edit', $project->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a> -->
                <!-- <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button> -->
            </div>
        </form>
    </div>
@endsection

@section('content')

<br><br><br><br><br><br><br>

    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div>
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{ $project->id}} </p>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <p class="form-control-static">{{ $project->name}} </p>
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> اسم المشروع</label>
                    </div>
                </div>
                <br>
                <div class="row">
                     <div class="col-md-9">
                        <p class="form-control-static">{{ $project->code}} </p>
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> كود المشروع</label>
                    </div>
                </div>
                <br>
            </form>

            <a class="btn btn-link" href="{{ route('projects.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection