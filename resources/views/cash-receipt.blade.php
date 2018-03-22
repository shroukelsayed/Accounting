@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')
	<style>
	 	#profile{
			border:2px solid white;
			width:150px;
			height:150px;
			margin-top:-8px;
	  	}
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
	<script type="text/javascript">
   
		$(function($){
			
   			$('input:radio[name="receipt_type"]').change(function(){
		        if ($(this).is(':checked') && $(this).val() == '0') {
		           	$('#cheque').show();
				}else{
					$('#cheque').hide();
				}
		    });

   			$.ajax({
	                url: '/convert-number',
	                type: "POST",
	                data: {'number': $(":input[name='amount']").val(),
	                       '_token': $('input[name=_token]').val()},

	                success:function(data) {                 
	                    $(":input[name='amount_alpha']").val(data);
	                }
	            });

		    var receipt_type = $('input:radio[name="receipt_type"]:checked').val();
		    if(receipt_type == '0'){
	           	$('#cheque').show();
			}else{
				$('#cheque').hide();
			}
		    
   		});
	</script>
    @include('error')
        <div class="container">
                <!-- <div class="title" style="padding:50px;font-size: 60px;text-align: center;display: inline-block;">ايصال استلام تبرع</div> -->

            {!! Form::open(['url' => 'save-cash' , 'class' => 'form']) !!}
            	<div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 900px;">

            		{!! csrf_field() !!}
            		<input type="hidden" name="ids" value="{{$ids}}">
            		<div style="text-align: right;">
            			<label>مؤسسة عمار اﻻرض</label><br>
               			<label> المشهرة برقم ٤٥٦٦ لسنة ٢٠١٢ </label>
            		</div>
            		<div class="row">
            			<div class="col-sm-3">
            				<img id="profile" src="{{ asset('img/2.jpg') }}"  class="user-image" alt="User Image">
            			</div>
            			<div class="col-sm-6">
               	 			<div class="title" style="font-size:36px;text-align: center;">@lang('validation.cash_receipt')</div>
               	 			<div class="form-group" style="text-align: center;">
				        		@if(isset($receipt_type) and $receipt_type == 0)
					        		{!! Form::label('receipt_type', 'شيكات') !!}
			                		{!! Form::radio('receipt_type', '0',true) !!}
								    {!! Form::label('receipt_type', 'نقداً') !!}
									{!! Form::radio('receipt_type', '1',false,['disabled' => 'disabled']) !!}
								@else
									{!! Form::label('receipt_type', 'شيكات') !!}
			                		{!! Form::radio('receipt_type', '0',false,['disabled' => 'disabled']) !!}
								    {!! Form::label('receipt_type', 'نقداً') !!}
									{!! Form::radio('receipt_type', '1', true) !!}
								@endif
							</div>
							<div style="text-align: center;font-size:18px;">
		            			<label>{{$last_id}} &nbsp&nbsp&nbsp رقم</label><br>
		            		</div>
		               	</div>
		               	<div class="col-sm-3"></div>
		            </div>		        	
					<br>
					<div class="row">
						<div class="col-sm-3">
							<div>
		               	 		<label>جنيه</label>&nbsp&nbsp&nbsp&nbsp<label>قرش</label><br>
		               	 		@if(isset($amount))
		               	 			<input type="text" name="amount" size="7" value="{{$amount}}">
		               	 		@else
		               	 			<input type="text" name="amount" size="7">
		               	 		@endif
		               	 	</div>
		               	</div>
		               	<div class="col-sm-6"></div>
						<div class="col-sm-3"></div>
	               	</div>
		        	
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
								{!! Form::date('delivery_date', \Carbon\Carbon::now()) !!}
							</div>
							<div class="col-sm-3">								
						    	{!! Form::label('delivery_date', 'وتحرر هذا ايصالاً باﻻستلام ') !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		<input type="text" name="delivered_by" class="form-control" dir="rtl" required oninvalid="this.setCustomValidity('هذا الحقل مطلوب ')"  oninput="setCustomValidity('')" >
							</div>
							<div class="col-sm-3">
					    		{!! Form::label('delivered_by', 'استلمت انا من السيد') !!}
							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
		               	 		<input type="text" name="amount_alpha" dir="rtl" class="form-control" readonly>
							</div>
							<div class="col-sm-3">
							    {!! Form::label('amount_alpha', 'مبلغ وقدره ') !!}
							</div>
						</div>
					</div>

					<div id="cheque" hidden="true">
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-9">
					    			<input type="text" name="cheque_number" class="form-control" dir="rtl" required >
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_number', 'شيك رقم ') !!}
								</div>
							</div>
						</div>
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-3">
					    			<input type="text" name="cheque_bank" class="form-control" dir="rtl" required >
								</div>
								<div class="col-sm-3">
								    {!! Form::label('cheque_bank', 'مسحوب على بنك ') !!}
								</div>
								<div class="col-sm-3">
					    			<input type="date" name="cheque_date" class="form-control" dir="rtl" required >
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
					    		<input type="text" name="notes" class="form-control" dir="rtl" required oninvalid="this.setCustomValidity('هذا الحقل مطلوب ')"  oninput="setCustomValidity('')" >
							</div>
							<div class="col-sm-3">
							    {!! Form::label('notes', 'وذلك عن ') !!}
							</div>
						</div>
					</div>
				
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-3"></div>
							<div class="col-sm-6">
				            	<label style="color: darkblue;">وذلك عن مشروع</label><br>
				            	<table class="table table-bordered table-striped table-hover">
				            		<tr>
				            			<td style="color: darkblue;"> المبلغ</td>
				            			<td style="color: darkblue;"> المشروع</td>
				            		</tr>
									@foreach($projects_amount as $project => $amount)
										<tr>
					            			<td> {{$amount}} </td>
					            			<td> {{$project}} </td>
					            		</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>

					<div class="form-group" style="text-align: center;">
						<div class="row">
							<div class="col-sm-6">
					    		<label> إعتماد  </label><br>
				            	<label> ---------------------</label>
							</div>
							<div class="col-sm-6">
					    		<label>   أمين الخزينة </label><br>
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
					{!! Form::submit(trans('validation.submit'), ['class' => 'btn btn-info']) !!}
            	</div>
			{!! Form::close() !!}
        </div>
    
@endsection
