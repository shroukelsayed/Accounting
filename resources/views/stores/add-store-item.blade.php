
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
                                {!! Form::date('item_added_at', \Carbon\Carbon::now()) !!}
                            </div>
                            <div class="col-sm-3">                              
                                {!! Form::label('item_added_at', 'تحريرا فى ') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" name="supplier_address" class="form-control" dir="rtl" >
                                @if ($errors->has('supplier_address'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('supplier_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::label('supplier_address', 'عنوان المورد') !!}
                            </div>
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
                    <div class="form-group" style="text-align: right;">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" name="supplier_bill_number" class="form-control" dir="rtl" >
                                @if ($errors->has('supplier_bill_number'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('supplier_bill_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::label('supplier_bill_number', 'رقم فاتورة المورد ') !!}
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="supply_order_number" class="form-control" dir="rtl" >
                                @if ($errors->has('supply_order_number'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('supply_order_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::label('supply_order_number', 'رقم امر التوريد') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="text" name="receipt_record_number" class="form-control" dir="rtl" >
                            </div>
                            <div class="col-sm-3">                              
                                {!! Form::label('receipt_record_number', 'رقم محضر الفحص والاستلام') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="text-align: right;">
                        <div class="row">
                            <div class="col-sm-4">
                                @if(isset($receipt) and $receipt->project_id)
                                    {{ Form::select('store_id', $projects,$receipt->project_id,['class' => 'form-control' , 'placeholder' => 'اختر اسم المخزن'])  }}
                                @else
                                    {{ Form::select('store_id', $stores,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم المخزن'])  }}
                                @endif
                                @if ($errors->has('store_id'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('store_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::label('store_id', 'اسم المخزن') !!}
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
                                <input type="number" name="units_number" class="form-control" dir="rtl" min="1">
                                @if ($errors->has('units_number'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('units_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::label('units_number', 'عدد الوحدات') !!}
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="unit_price" class="form-control" dir="rtl" >
                                @if ($errors->has('unit_price'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('unit_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                {!! Form::label('unit_price', 'سعر الوحدة') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="text-align: right;">
                        <div class="row">
                            <div class="col-sm-10">
                                <input type="text" name="total_units_price" class="form-control" dir="rtl" >
                            </div>
                            <div class="col-sm-2">                              
                                {!! Form::label('total_units_price', 'اﻻجمالى') !!}
                            </div>
                        </div>
                    </div>



                    <br><br><br><br><br>
                    <div class="form-group" style="text-align: center;">
                        <div class="row">
                            <div class="col-sm-6">
                                <label> أمين المخزن   </label><br><br>
                                <label> ---------------------</label>
                            </div>
                            <!-- <div class="col-sm-6">
                                <label>   أمين الخزينة </label><br><br>
                                <label> ---------------------</label><br>
                            </div> -->
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

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
    <script type="text/javascript">
   
        $(function($){
        
            $(":input[name='amount']").blur( function () {
                $.ajax({
                    url: '/convert-number',
                    type: "POST",
                    data: {'number': $(":input[name='amount']").val(),
                           '_token': $('input[name=_token]').val()},

                    success:function(data) {                 
                        $(":input[name='amount_alpha']").val(data);
                    }
                });
            });

            $('.print-window').click(function() {
                $('#submitForm').hide();
                $('#resetForm').hide();

                $('.print-window').hide();

                window.print();
            });
        });
        

    </script>
@endsection
