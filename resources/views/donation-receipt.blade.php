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

		    var receipt_type = $('input:radio[name="receipt_type"]:checked').val();
		    if(receipt_type == '2'){
	    		$('#cash').hide();
	           	$('#cheque').show();
			}else{
	           	$('#cash').show();
				$('#cheque').hide();
			}
		    // console.log(receipt_type);
		    $('input:checkbox[name="is_approved"]').change(function(){
		        if ($(this).is(':checked')) {
		           	$('#collecting').show();
				}else{
					$('#collecting').hide();
				}
		    });

		    var is_approved = $('input:checkbox[name="is_approved"]:checked').val();
		    if(is_approved == '1'){
		        $('#collecting').show();
		    }
   		});
  	</script>
<?php
	// var_dump(isset($receipt) and $receipt->id != null);die();
	// var_dump( $receipt->cash);die();
 ?>
    <!-- @include('error') -->
        <div class="container">
                <!-- <div class="title" style="padding:50px;font-size: 60px;text-align: center;display: inline-block;">ايصال استلام تبرع</div> -->
            <div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 850px;">

            @if(isset($receipt) and $receipt->id != null)
            	{!! Form::open(['url' => 'save-receipt/'.$receipt->id , 'class' => 'form']) !!}

            	<div class="row">
            		<div class="col-sm-3">
		            	<label> تم التحصيل  </label>
		            	@if($receipt->is_approved)
		            		<input name="is_approved" type="checkbox" value="{{$receipt->id}}" checked="checked">
		            	@else
		            		<input name="is_approved" type="checkbox" value="{{$receipt->id}}">
		            	@endif
	            	</div>
	            </div>
            	<div class="row" id="collecting" style="display: none;">
            		<div class="col-sm-3">
            			@if($receipt->collecting_type == '2')
		            		{!! Form::label('collecting_type', 'بنك') !!}
			        		{!! Form::radio('collecting_type', '2',true) !!}
						    {!! Form::label('collecting_type', 'مؤسسة') !!}
							{!! Form::radio('collecting_type', '1') !!}
						@else
							{!! Form::label('collecting_type', 'بنك') !!}
			        		{!! Form::radio('collecting_type', '2') !!}
						    {!! Form::label('collecting_type', 'مؤسسة') !!}
							{!! Form::radio('collecting_type', '1',true) !!}
						@endif
	            		<label> نوع التحصيل  </label>
					</div>
	            </div>
            @else
            	{!! Form::open(['url' => 'save-receipt' , 'class' => 'form']) !!}
            @endif
            	{!! csrf_field() !!}
               	 	<div class="title" style="font-size:36px;text-align: center;">ايصال استلام تبرع</div>
		        	
		        	<div class="form-group" style="text-align: center;">
		        		@if(isset($receipt) and $receipt->cash == 2)
			        		{!! Form::label('receipt_type', 'شيكات') !!}
	                		{!! Form::radio('receipt_type', '2',true) !!}
						    {!! Form::label('receipt_type', 'نقداً') !!}
							{!! Form::radio('receipt_type', '1') !!}
						@else
							{!! Form::label('receipt_type', 'شيكات') !!}
	                		{!! Form::radio('receipt_type', '2') !!}
						    {!! Form::label('receipt_type', 'نقداً') !!}
							{!! Form::radio('receipt_type', '1', true) !!}
						@endif

					</div>

					<br>
		        	<div class="form-group" style="text-align: right;">
						<div class="col-sm-4"></div>
						<div class="col-sm-2">
						    {!! Form::label('type', 'مشطوب') !!}
						    @if(isset($receipt) and $receipt->type == 4)
                				{!! Form::radio('type', '4',true) !!}
                			@else
                				{!! Form::radio('type', '4') !!}
                			@endif
					    </div>
					    <div class="col-sm-2">
						    {!! Form::label('type', 'ﻻغى') !!}
                			@if(isset($receipt) and $receipt->type == 3)
                				{!! Form::radio('type', '3',true) !!}
                			@else
                				{!! Form::radio('type', '3') !!}
                			@endif
						</div>
						<div class="col-sm-2">
						    {!! Form::label('type', 'غير مستغل') !!}
                			@if(isset($receipt) and $receipt->type == 2)
                				{!! Form::radio('type', '2',true) !!}
                			@else
                				{!! Form::radio('type', '2') !!}
                			@endif
						</div>
					    <div class="col-sm-2">
						    {!! Form::label('type', 'مستغل') !!}
                			@if(isset($receipt) and $receipt->type == 1)
                				{!! Form::radio('type', '1',true) !!}
                			@else
                				{!! Form::radio('type', '1',true) !!}
                			@endif
						</div>
					</div>
					<br><br><br>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
								@if(isset($receipt) and $receipt->donator_name)
						    		{!! Form::text('donator_name', $receipt->donator_name, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
						    	@else
						    		{!! Form::text('donator_name', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
						    	@endif
					    		@if ($errors->has('donator_name'))
                                    <span class="alert-danger">
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
								@if(isset($receipt) and $receipt->donator_address)
							    	{!! Form::text('donator_address', $receipt->donator_address, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							    @else
							    	{!! Form::text('donator_address', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							    @endif
							    @if ($errors->has('donator_address'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('donator_address') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="col-sm-3">
							    {!! Form::label('donator_address', 'المقيم بالعنوان') !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
								@if(isset($receipt) and $receipt->donator_mobile)
							    	{!! Form::text('donator_phone', $receipt->donator_mobile, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								@else
							    	{!! Form::text('donator_phone', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							    @endif
							    @if ($errors->has('donator_phone'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('donator_phone') }}</strong>
                                    </span>
                                @endif
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
									@if(isset($receipt) and $receipt->alpha_amount)
								    	{!! Form::text('amount_alpha', $receipt->alpha_amount, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
									@else
								    	{!! Form::text('amount_alpha', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								    @endif
									 @if ($errors->has('amount_alpha'))
	                                    <span class="alert-danger">
	                                        <strong>{{ $errors->first('amount_alpha') }}</strong>
	                                    </span>
	                                @endif
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
									@if(isset($receipt) and $receipt->cheque_number)
								    	{!! Form::text('cheque_number', $receipt->cheque_number, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
									@else
								    	{!! Form::text('cheque_number', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								    @endif
								    @if ($errors->has('cheque_number'))
	                                    <span class="alert-danger">
	                                        <strong>{{ $errors->first('cheque_number') }}</strong>
	                                    </span>
	                                @endif
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_number', 'شيك رقم ') !!}
								</div>
							</div>
						</div>
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-3">
									@if(isset($receipt) and $receipt->cheque_bank)
								    	{!! Form::text('cheque_bank', $receipt->cheque_bank, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								    @else
								    	{!! Form::text('cheque_bank', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								    @endif
								    @if ($errors->has('cheque_bank'))
	                                    <span class="alert-danger">
	                                        <strong>{{ $errors->first('cheque_bank') }}</strong>
	                                    </span>
	                                @endif
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_bank', 'مسحوب على بنك ') !!}
								</div>
								<div class="col-sm-3">
									@if(isset($receipt) and $receipt->cheque_date)
										{!! Form::date('cheque_date', \Carbon\Carbon::parse($receipt->cheque_date)) !!}
									@else
										{!! Form::date('cheque_date', \Carbon\Carbon::now()) !!}
									@endif
									@if ($errors->has('cheque_date'))
	                                    <span class="alert-danger">
	                                        <strong>{{ $errors->first('cheque_date') }}</strong>
	                                    </span>
	                                @endif
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
							<div class="col-sm-3">
							    {!! Form::label('notes', 'وذلك عن ') !!}
							</div>
						</div>
					</div>





					<br>

					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
								@if(isset($receipt) and $receipt->receipt_for_month)
					    			{!! Form::text('receipt_for_month', $receipt->receipt_for_month, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								@else
					    			{!! Form::text('receipt_for_month', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
					    		@endif
					    		@if ($errors->has('receipt_for_month'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('receipt_for_month') }}</strong>
                                    </span>
                                @endif
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
								@if(isset($receipt) and $receipt->receipt_notebook)
					    			{!! Form::text('receipt_notebook', $receipt->receipt_notebook, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
								@else
					    			{!! Form::text('receipt_notebook', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
					    		@endif
					    		@if ($errors->has('receipt_notebook'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('receipt_notebook') }}</strong>
                                    </span>
                                @endif
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
							    @if ($errors->has('receipt_writter_id'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('receipt_writter_id') }}</strong>
                                    </span>
                                @endif
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
							    @if ($errors->has('receipt_delegate_id'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('receipt_delegate_id') }}</strong>
                                    </span>
                                @endif
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
                                @if(isset($receipt) and $receipt->project_id)
									{{ Form::select('project_id', $projects,$receipt->project_id,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
								@else
									{{ Form::select('project_id', $projects,null,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
								@endif
								@if ($errors->has('project_id'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('project_id') }}</strong>
                                    </span>
                                @endif
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
						    	@if ($errors->has('delivery_date'))
                                    <span class="alert-danger">
                                        <strong>{{ $errors->first('delivery_date') }}</strong>
                                    </span>
                                @endif
                                @if(isset($receipt) and $receipt->receipt_date)
									{!! Form::date('delivery_date',\Carbon\Carbon::parse($receipt->receipt_date)) !!}
								@else
									{!! Form::date('delivery_date', \Carbon\Carbon::now()) !!}
						    	@endif
						    	{!! Form::label('delivery_date', 'وتحرر هذا ايصالاً باﻻستلام ') !!}
								
							</div>
						</div>
					</div>
					<br>

            	{{ Form::reset('Clear form', ['class' => 'btn btn-reset']) }}
					{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

            	</div>
			{!! Form::close() !!}
			<!-- </form> -->
        </div>
  
@endsection