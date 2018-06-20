@extends('layouts.app')
@section('header')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

@endsection
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')
 <style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
    }
</style>
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
			$('select[name="from_level_three"]').hide();
			$('select[name="from_level_four"]').hide();
			$('select[name="from_level_five"]').hide();
			$('select[name="from_level_six"]').hide();

			$('select').change(function () {
		        var val = $(this).val();
		        // console.log(val.length);
	        	var model;

	        	if(val.length == 2){
	        		model = $('#from_level_three');
			  	}else if(val.length == 4){
	        		model = $('#from_level_four');
				}else if(val.length == 6){
	        		model = $('#from_level_five');
				}else{
	        		model = $('#from_level_six');
				}

	        	$.get("{{ url('get-levels')}}", 
					{ option: $(this).val() }, 
					function(data) {
	 					console.log(data);

						model.empty();
				        model.append("<option value=''>Plz Select</option>");

						$.each(data, function(index, element) {
	 					// console.log(element.code);
	 						if(val.length == 9 )
				            	model.append("<option value='"+ element.pivot.code +"'>" + element.title + " " + element.pivot.title + "</option>");
	 						else
				           		model.append("<option value='"+ element.code +"'>" + element.title + "</option>");
				    	});
				
						if(val.length == 2){
							$('select[name="from_level_three"]').show();
					  	}else if(val.length == 4){
							$('select[name="from_level_four"]').show();
						}else if(val.length == 6){
							$('select[name="from_level_five"]').show();
						}else if(val.length == 9){
							$('select[name="from_level_six"]').show();
						}
				});

		    });

		

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
  	 
<?php
	// var_dump(isset($receipt) and $receipt->id != null);die();
	// var_dump( isset($receipt) and $receipt->type == 2);die();
 ?>
    <!-- @include('error') -->
        <div class="container">
            <div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 1200px;">
      <!--       <div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 1200px;background-image:url('../img/2.png'); "> -->

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
            		
            		<div class="row">
		               	<div class="col-sm-3"></div>
            			<div class="col-sm-6">
		               	 	<div class="title" style="font-size:26px;text-align: center;">
            					<br><br><label>مؤسسة عمار اﻻرض</label><br>
							</div>
				        	<div class="form-group" style="text-align: center;">
				        		<label>بتاريخ</label> &nbsp&nbsp&nbsp&nbsp
				        		<label> &nbsp&nbsp&nbsp&nbspقيد يوميــة رقم </label>
							</div>
		               	</div>
		               	<div class="col-sm-3" style="text-align: right;">
	            			<img id="profile" src="{{ asset('img/2.jpg') }}"  class="user-image" alt="User Image">
	            		</div>
		            </div>
               	 	<br>
               	 	<div>
               	 		<table class="table table-condensed table-striped table-bordered">
               	 			<thead class="thead-dark">
               	 				<tr>
               	 					<th class="text-center">ملاحظات</th>
               	 					<th class="text-center">البيــــان</th>
               	 					<th class="text-center">تحليلى</th>
               	 					<th class="text-center" colspan="2" width="15%">دائن </th>
               	 					<th class="text-center" colspan="2" width="15%">مدين</th>
               	 				</tr>
               	 				<tr>
               	 					<th class="text-center"></th>
               	 					<th class="text-center"></th>
               	 					<th class="text-center"></th>
               	 					<th class="text-center" width="10%">جنيه</th>
               	 					<th class="text-center">قرش</th>
               	 					<th class="text-center" width="10%">جنيه</th>
               	 					<th class="text-center">قرش</th>
               	 				</tr>
               	 			</thead>
               	 			<tbody>
               	 				<tr style="height: 500px;">
               	 					<td>
               	 						@if(isset($receipt) and $receipt->notes)
							    			{!! Form::textarea('notes', $receipt->notes, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
										@else
							    			{!! Form::textarea('notes', null, ['class' => 'form-control', 'dir'=> "rtl"]) !!}
							    		@endif
							    		@if ($errors->has('notes'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('notes') }}</strong>
		                                    </span>
		                                @endif
               	 					</td>
               	 					<td>
               	 						<label dir="rtl">من حساب : </label>
               	 						@if(isset($receipt) and $receipt->notes)
							    			{{ Form::select('level_one', $levels,$receipt->receipt_writter_id,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
										@else
											{{ Form::select('level_one', $levels,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم الحساب'])  }}
											
											<select name="from_level_three" id="from_level_three" class="form-control"></select>
		                                	<select name="from_level_four" id="from_level_four" class="form-control"></select>
		                                	<select name="from_level_five" id="from_level_five" class="form-control"></select>
		                                	<select name="from_level_six" id="from_level_six" class="form-control"></select>

							    		@endif
							    		@if ($errors->has('notes'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('notes') }}</strong>
		                                    </span>
		                                @endif
		                                <br><br><br><br><br><br>
               	 							<label dir="rtl">الى حساب : </label>
											{{ Form::select('level_one', $levels,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم الحساب'])  }}
		                                	
		                                <br>

               	 					</td>
               	 					<td>
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
               	 					</td>
               	 					<td>
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
               	 					</td>
               	 					<td>
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
               	 					</td>
               	 					<td>
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
               	 					</td>
               	 					<td>
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
               	 					</td>
               	 				</tr>
               	 				<tr>
               	 					<td colspan="2"></td>
               	 					<td colspan="2" width="30%">
										@if(isset($receipt) and $receipt->receipt_writter_id)
											{{ Form::select('receipt_writter_id', $workers,$receipt->receipt_writter_id,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
										@else
											{{ Form::select('receipt_writter_id', $workers,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم محرر اﻻيصال'])  }}
										@endif

									    @if ($errors->has('receipt_writter_id'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('receipt_writter_id') }}</strong>
		                                    </span>
		                                @endif
               	 					</td>
               	 					<td colspan="3" class="text-center">اعداد وتسجيل : </td>
               	 				</tr>
               	 				<tr>
               	 					<td colspan="2"></td>
               	 					<td colspan="2">
										@if(isset($receipt) and $receipt->receipt_writter_id)
											{{ Form::select('receipt_writter_id', $workers,$receipt->receipt_writter_id,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
										@else
											{{ Form::select('receipt_writter_id', $workers,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم محرر اﻻيصال'])  }}
										@endif

									    @if ($errors->has('receipt_writter_id'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('receipt_writter_id') }}</strong>
		                                    </span>
		                                @endif
               	 					</td>
               	 					<td colspan="3" class="text-center">مراجعة : </td>
               	 				</tr>
               	 			</tbody>
               	 		</table>
               	 	</div>

            		{{ Form::reset('Clear form', ['class' => 'btn btn-reset','id' => 'resetForm']) }}
					{!! Form::submit(trans('validation.submit'), ['class' => 'btn btn-info' ,'id' => 'submitForm']) !!}

            	</div>
			{!! Form::close() !!}
			<button class="print-window"> Print</button>
        </div>
  
@endsection
