
@extends('layouts.admin')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Projects
            <a class="btn btn-success pull-right" href="{{ route('projects.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
<br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            @if($projects->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Project Code</th>
                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{$project->id}}</td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->code}}</td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('projects.show', $project->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('projects.edit', $project->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $projects->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection