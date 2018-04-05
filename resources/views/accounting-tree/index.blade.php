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

    <br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">

            @foreach($levels as $level_one)
                <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $level_one->title}}<span></span></a>

                    <ul class="dropdown-submenu">
                        @foreach($level_one->levelTwo as $level)
                            <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $level->title}}<span></span></a>

                            @if($level->fixedAssets)
                                <ul class="dropdown-menu">
                                    @foreach($level->fixedAssets as $fixedAsset)
                                        <li><a href="#">{{ $fixedAsset->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endif
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