
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 <div class="panel-heading"><span style="float: right;">@lang('validation.welcome')</span></div>

                <div class="panel-body">
                    <span style="float: right;">@lang('validation.slug')</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
