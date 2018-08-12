
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
        {!! Form::open(['url' => 'save-store-item' , 'class' => 'form']) !!}
            <div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 900px;">

                {!! csrf_field() !!}
                <div style="text-align: right;">
                    <label>مؤسسة عمار اﻻرض</label><br>
                    <label> المشهرة برقم ٤٥٦٦ لسنة ٢٠١٢ </label>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <img id="profile" src="{{ asset('img/2.jpg') }}"  class="user-image" alt="User Image">
                    </div>
                    <div class="col-sm-6">
                        <div class="title" style="font-size:36px;text-align: center;">@lang('validation.add-store-item')</div>
                        
                    </div>
                    <div class="col-sm-3"></div>
                </div>                  
                <br>
                <div class="row">
                    
                </div>
                
                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-9">
                            {!! Form::date('delivery_date', \Carbon\Carbon::now()) !!}
                        </div>
                        <div class="col-sm-3">                              
                            {!! Form::label('delivery_date', 'تحريرا فى ') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" name="delivered_by" class="form-control" dir="rtl" >
                            @if ($errors->has('delivered_by'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('delivered_by') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('delivered_by', 'عنوان المورد') !!}
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="delivered_by" class="form-control" dir="rtl" >
                            @if ($errors->has('delivered_by'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('delivered_by') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('delivered_by', 'اسم المورد') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" name="notes" class="form-control" dir="rtl" >
                            @if ($errors->has('notes'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('notes', 'رقم فاتورة المورد ') !!}
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="delivered_by" class="form-control" dir="rtl" >
                            @if ($errors->has('delivered_by'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('delivered_by') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('delivered_by', 'رقم امر التوريد') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-9">
                            <input type="text" name="delivered_by" class="form-control" dir="rtl" >
                        </div>
                        <div class="col-sm-3">                              
                            {!! Form::label('delivery_date', 'رقم محضر الفحص والاستلام') !!}
                        </div>
                    </div>
                </div>

                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-4">
                            @if(isset($receipt) and $receipt->project_id)
                                {{ Form::select('project_id', $projects,$receipt->project_id,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
                            @else
                                {{ Form::select('project_id', $stores,null,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
                            @endif
                            @if ($errors->has('project_id'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('project_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('project', 'اسم المخزن') !!}
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="item_name" class="form-control" dir="rtl" >
                        </div>
                        <div class="col-sm-2">                              
                            {!! Form::label('item_name', 'اسم الصنف') !!}
                        </div>
                    </div>
                </div>

                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="number" name="notes" class="form-control" dir="rtl" min="1">
                            @if ($errors->has('notes'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('notes', 'عدد الوحدات') !!}
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="delivered_by" class="form-control" dir="rtl" >
                            @if ($errors->has('delivered_by'))
                                <span class="alert-danger">
                                    <strong>{{ $errors->first('delivered_by') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-2">
                            {!! Form::label('delivered_by', 'سعر الوحدة') !!}
                        </div>
                    </div>
                </div>
                <div class="form-group" style="text-align: right;">
                    <div class="row">
                        <div class="col-sm-10">
                            <input type="text" name="delivered_by" class="form-control" dir="rtl" >
                        </div>
                        <div class="col-sm-2">                              
                            {!! Form::label('delivery_date', 'اﻻجمالى') !!}
                        </div>
                    </div>
                </div>



                <br><br><br><br><br>
                <div class="form-group" style="text-align: center;">
                    <div class="row">
                        <div class="col-sm-6">
                            <label> إعتماد  </label><br><br>
                            <label> ---------------------</label>
                        </div>
                        <div class="col-sm-6">
                            <label>   أمين الخزينة </label><br><br>
                            <label> ---------------------</label><br>
                        </div>
                    </div>
                </div>

                <!-- <br>
                <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                <div style="text-align: center;">
                    <label> كل ايصال غير مختوم بختم الؤسسة يعتبر ﻻغى </label><br>
                    <label> ت: ١٩٠٥٤ </label>
                </div>
                <br> -->
                <br><br><br>
                {!! Form::submit(trans('validation.submit'), ['class' => 'btn btn-info','id' => 'submitForm']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
