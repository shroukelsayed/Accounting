
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
                                <td>{{$allocation->title}}</td>
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
@endsection
