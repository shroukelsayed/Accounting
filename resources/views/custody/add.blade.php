
@extends('layouts.app')

@section('content')
    <style>
        #profile{
            border:2px solid white;
            width:150px;
            height:150px;
            margin-top:-8px;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('save-custody') }}" method="POST">
                    <div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 900px;">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-sm-3">
                                <img id="profile" src="{{ asset('img/2.jpg') }}"  class="user-image" alt="User Image">
                            </div>
                            <div class="col-sm-6">
                                <br><br>
                                <div class="title" style="font-size:36px;text-align: center;">@lang('validation.add-store-item')</div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>                  
                        <div class="row"></div>
                        <br><br><br><br><br><br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-2">
                                    @if(isset($receipt) and $receipt->amount)
                                        {!! Form::text('amount', number_format($receipt->amount, 2, '.', ','), ['class' => 'form-control', 'dir'=> "rtl",'size' =>"7"]) !!}
                                    @else
                                        {!! Form::text('amount', null, ['class' => 'form-control', 'dir'=> "rtl",'size' => "7"]) !!}
                                    @endif
                                    @if ($errors->has('amount'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::label('amount', 'المبلغ') !!}
                                </div>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-4">
                                    @if(isset($receipt) and $receipt->worker_id)
                                        {{ Form::select('worker_id', $workers,$receipt->worker_id,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
                                    @else
                                        {{ Form::select('worker_id', $workers,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم العامل'])  }}
                                    @endif

                                    @if ($errors->has('worker_id'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('worker_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('worker_id', 'الاسم ') !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label> ( فقط ﻻ غير )</label>
                                </div>
                                <div class="col-sm-8">
                                    @if(isset($receipt) and $receipt->alpha_amount)
                                        {!! Form::text('amount_alpha', $receipt->alpha_amount, ['class' => 'form-control', 'dir'=> "rtl", 'readonly' => "true"]) !!}
                                    @else
                                        {!! Form::text('amount_alpha', null, ['class' => 'form-control', 'dir'=> "rtl", 'readonly' => "true"]) !!}
                                    @endif
                                     @if ($errors->has('amount_alpha'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('amount_alpha') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('amount_alpha', 'مبلغ وقدره ') !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4">
                                    @if(isset($receipt) and $receipt->custody_date)
                                        {!! Form::date('custody_date', \Carbon\Carbon::parse($receipt->custody_date)) !!}
                                    @else
                                        {!! Form::date('custody_date', \Carbon\Carbon::now()) !!}
                                    @endif
                                    @if ($errors->has('custody_date'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('custody_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('custody_date', 'تاريخ سحب العهدة ') !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-10">
                                    @if(isset($receipt) and $receipt->report)
                                        {!! Form::text('report', $receipt->report, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
                                    @else
                                        {!! Form::text('report', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
                                    @endif
                                    @if ($errors->has('report'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('report') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('report', 'البيان ') !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-10">
                                    @if(isset($receipt) and $receipt->notes)
                                        {!! Form::text('notes', $receipt->notes, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
                                    @else
                                        {!! Form::text('notes', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
                                    @endif
                                    @if ($errors->has('notes'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('notes', 'ملاحظات ') !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4">
                                    <input type="text" name="supplier_name" class="form-control" dir="rtl" >
                                    @if ($errors->has('supplier_name'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('supplier_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::label('supplier_name', 'اسم المورد') !!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group" style="text-align: right;">
                            <div class="row">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                                <div class="col-sm-9"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
