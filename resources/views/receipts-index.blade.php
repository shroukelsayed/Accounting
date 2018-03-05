
@extends('layouts.app')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Donation Receipts
            <!-- <a class="btn btn-success pull-right" href="{{ route('projects.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a> -->
        </h1>

    </div>
@endsection

@section('content')
<br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @if($receipts->count())
                {!! Form::open(['url' => 'cash-receipt' , 'class' => 'form']) !!}
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-right">OPTIONS</th>
                            <th>عونان المتبرع</th>
                            <th>اسم المتبرع</th>
                            <th>تاريخ اﻹيصال</th>
                            <th>النوع</th>
                            <th>ملاحظات</th>
                            <th>المبلغ</th>
                            <th>رقم اﻹيصال</th>                            
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($receipts as $receipt)
                            <tr>
                                 <td class="text-right">
                                    
                                   &nbsp&nbsp <a class="btn btn-xs btn-warning" href="{{ url('receipts', $receipt->id) }}"><i class="glyphicon glyphicon-edit"></i>@lang('validation.edit')</a>
                                   &nbsp&nbsp<input name="checked[]" type="checkbox" value="{{$receipt->id}}">
                                </td>
                                <td>{{$receipt->donator_address}}</td>
                                <td>{{$receipt->donator_name}}</td>
                                <td>{{ Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y')}}</td>
                                @if($receipt->type ==4 )
                                    <td>مشطوب</td>
                                @elseif($receipt->type ==3)
                                    <td>ﻻغى</td>
                                @elseif($receipt->type ==2)
                                    <td>غير مستغل</td>
                                @else
                                    <td>مستغل</td>
                                @endif
                                <td>{{$receipt->notes}}</td>
                                <td>{{$receipt->amount}}</td>
                                <td>{{$receipt->id}}</td>
                                
                                <!-- <td>{{$receipt->donator_mobile}}</td> -->

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
                {!! Form::close() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
        <div class="col-md-1"></div>

    </div>

@endsection