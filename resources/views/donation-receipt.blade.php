@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
<script type="text/javascript">
   
		$(function($){
			
   			$('input:radio[name="receipt_type"]').change(function(){
		        if ($(this).is(':checked') && $(this).val() == '2') {
					$('#cash').hide();
		           	$('#cheque').show();
				}else{
		           	$('#cash').show();
					$('#cheque').hide();
				}
		    });

   		});
  	</script>
  	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- @include('error') -->
        <div class="container">
                <!-- <div class="title" style="padding:50px;font-size: 60px;text-align: center;display: inline-block;">ايصال استلام تبرع</div> -->

            <form action="{{ url('save-receipt') }}" method="POST" >
            <!-- {!! Form::open(['url' => 'save-receipt' , 'class' => 'form']) !!} -->
            	{!! csrf_field() !!}
            	<div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 850px;">

               	 	<div class="title" style="font-size:36px;text-align: center;">ايصال استلام تبرع</div>
		        	
		        	<div class="form-group" style="text-align: center;">
		        		{!! Form::label('receipt_type', 'شيكات') !!}
                		{!! Form::radio('receipt_type', '2') !!}
					    {!! Form::label('receipt_type', 'نقداً') !!}
						{!! Form::radio('receipt_type', '1', true) !!}
					</div>

					<br>
		        	<div class="form-group" style="text-align: right;">
						<div class="col-sm-4"></div>
						<div class="col-sm-2">
						    {!! Form::label('type', 'مشطوب') !!}
                			{!! Form::radio('type', '4',true) !!}
					    </div>
					    <div class="col-sm-2">
						    {!! Form::label('type', 'ﻻغى') !!}
                			{!! Form::radio('type', '3',true) !!}
						</div>
						<div class="col-sm-2">
						    {!! Form::label('type', 'غير مستغل') !!}
                			{!! Form::radio('type', '2',true) !!}
						</div>
					    <div class="col-sm-2">
						    {!! Form::label('type', 'مستغل') !!}
                			{!! Form::radio('type', '1',true) !!}
						</div>
					</div>
					<br><br><br>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		{!! Form::text('donator_name', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
					    		@if ($errors->has('donator_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('donator_name') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-3">
					    		{!! Form::label('donator_name', 'استلمت انا من السيد') !!}
							</div>

						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    {!! Form::text('donator_address', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('donator_address', 'المقيم بالعنوان') !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    {!! Form::text('donator_phone', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('donator_phone', 'رقم التليفون ') !!}
							</div>
						</div>
					</div>

					<div id="cash">
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
					</div>


					<div id="cheque" hidden="true">
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-9">
								    {!! Form::text('cheque_number', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_number', 'شيك رقم ') !!}
								</div>
							</div>
						</div>
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-3">
								    {!! Form::text('cheque_bank', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_bank', 'مسحوب على بنك ') !!}
								</div>
								<div class="col-sm-3">
									{!! Form::date('cheque_date', \Carbon\Carbon::now()) !!}
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_date', 'تاريخ الشيك ') !!}
								</div>
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





					<br>

					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
					    		{!! Form::text('receipt_for_month', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('receipt_for_month', 'استحقاق عن شهر ') !!}
							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
					    		{!! Form::text('receipt_notebook', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('receipt_notebook', 'رقم الدفتر') !!}
							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
							    {!! Form::select('receipt_writter_id', ['Under 18', '19 to 30', 'Over 30'],null,['class' => 'form-control']) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('receipt_writter_id', 'اسم محرر اﻻيصال') !!}
							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
							    {!! Form::select('receipt_delegate_id', ['Under 18', '19 to 30', 'Over 30'],null,['class' => 'form-control']) !!}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('receipt_delegate_id', 'اسم المندوب') !!}
							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
								<!--  {!! Form::select('project', ['نهر الخير', 'ﻻ للجوع', 'نفسى اتعلم','مشروعى الصغير','ستر وغطا'],null,['class' => 'form-control']) !!}
					    {!! Form::select('project_item', ['فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'],null,['class' => 'form-control']) !!} -->

								{{ Form::select('project_id', $projects,null,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
							</div>
							<div class="col-sm-3">
							    {!! Form::label('project', 'وذلك عن مشروع') !!}
							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>


				
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-6"></div>
							<div class="col-sm-6">
						    	{!! Form::label('delivery_date', 'وتحرر هذا ايصالاً باﻻستلام ') !!}<br>
								{!! Form::date('delivery_date', \Carbon\Carbon::now()) !!}
							</div>
						</div>
					</div>
					<br>

            	{{ Form::reset('Clear form', ['class' => 'btn btn-reset']) }}
					{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

            	</div>
			<!-- {!! Form::close() !!} -->
			</form>
        </div>
  
@endsection