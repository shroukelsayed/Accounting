
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
                            <th class="text-right"></th>
                            <th>عنوان المتبرع</th>
                            <th>اسم المتبرع</th>
                            <th>تاريخ اﻹيصال</th>
                            <th>النوع</th>
                            <th>المبلغ</th>
                            <th>نقاً / شيكات</th>                            
                            <th>رقم اﻹيصال</th>                            
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <input  placeholder="عنوان المتبرع" type="textbox" dir="rtl" name="receipt_id">
                            </td>
                            <td>
                                <input  placeholder="اسم المتبرع" type="textbox" dir="rtl" name="receipt_id">
                            </td>
                            <td>
                                <input  placeholder="" type="date" name="receipt_id">
                            </td>
                            <td>
                                <select name="type">
                                    <option value="0"> all</option>
                                    <option value="1">مستغل </option>
                                    <option value="2">غير مستغل</option>
                                    <option value="3">ﻻغى</option>
                                    <option value="4">مشطوب</option>
                                </select>
                            </td>
                            <td>
                                <input  placeholder="المبلغ" type="textbox" dir="rtl" name="receipt_id">
                            </td>
                            <td>
                                <select name="cash">
                                    <option value="0"> all</option>
                                    <option value="1">نقاً </option>
                                    <option value="2">شيكات</option>
                                </select> 
                            </td>
                            <td>
                                <input  placeholder="رقم اﻹيصال" type="textbox" dir="rtl" name="receipt_id">
                            </td>
                        </tr>
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
                                <td>{{$receipt->amount}}</td>
                                @if($receipt->cash == '1')
                                    <td>نقاً </td>
                                @else
                                    <td>شيكات</td>
                                @endif
                                <td>{{$receipt->id}}</td>
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