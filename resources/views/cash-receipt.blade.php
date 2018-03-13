@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')
    @include('error')
        <div class="container">
                <!-- <div class="title" style="padding:50px;font-size: 60px;text-align: center;display: inline-block;">ايصال استلام تبرع</div> -->

            {!! Form::open(['url' => 'cash-receipt' , 'class' => 'form']) !!}
            	<div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 510px;">

               	 	<div class="title" style="font-size:36px;text-align: center;">@lang('validation.cash_receipt')</div>
		        	
		        	<div class="form-group" style="text-align: center;">
		        		{!! Form::label('receipt_type', 'شيكات') !!}
                		{!! Form::radio('receipt_type', 'شيكات') !!}
					    {!! Form::label('receipt_type', 'نقداً') !!}
						{!! Form::radio('receipt_type', 'نقداً', true) !!}
					    
					</div>

					<br>
		        	
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-6"></div>
							<div class="col-sm-6">
						    	{!! Form::label('delivery_date', 'وتحرر هذا ايصالاً باﻻستلام ') !!}<br>
								{!! Form::date('delivery_date', \Carbon\Carbon::now()) !!}
							</div>
						</div>
					</div>


					<br><br><br>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		{!! Form::text('name', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
					    		{!! Form::label('name', 'استلمت انا من السيد') !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    {!! Form::text('amount_alpha', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('amount_alpha', 'مبلغ وقدره ') !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		{!! Form::text('notes', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('notes', 'وذلك عن ') !!}
							</div>
						</div>
					</div>





				
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
								<!--  {!! Form::select('project', ['نهر الخير', 'ﻻ للجوع', 'نفسى اتعلم','مشروعى الصغير','ستر وغطا'],null,['class' => 'form-control']) !!}
					    {!! Form::select('project_item', ['فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'],null,['class' => 'form-control']) !!} -->

								{{ Form::select('project_item', array('نهر الخير' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'ﻻ للجوع' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'نفسى اتعلم' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'مشروعى الصغير' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'ستر وغطا' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															),null,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('project', 'وذلك عن مشروع') !!}
							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>


				
					
					<br><br><br>



				<!-- 	<div class="form-group" >
					    {!! Form::label('email', 'E-mail Address') !!}
					    {!! Form::text('email', null, ['class' => 'form-control']) !!}
					</div>
					<br>

					<div class="form-group" >
					    {!! Form::textarea('msg', null, ['class' => 'form-control']) !!}
					</div>

					<br> -->
					{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

            	</div>

			{!! Form::close() !!}

        </div>



        

    
@endsection
