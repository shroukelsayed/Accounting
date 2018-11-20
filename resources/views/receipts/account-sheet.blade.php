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
</style>
<style>


  .autocomplete {
    /*the container must be positioned relative:*/
    position: relative;
    display: inline-block;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff; 
    border-bottom: 1px solid #d4d4d4; 
  }

  .autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: #e9e9e9; 
  }

  .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: DodgerBlue !important; 
    color: #ffffff; 
  }
</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
  	 
<?php
	// $l = $levels['12'];
	// var_dump($levels);die();
	// var_dump(isset($receipt) and $receipt->id != null);die();
	// var_dump( isset($receipt) and $receipt->type == 2);die();
 ?>
        <div class="container">
            <div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 1200px;">
            @if(isset($receipt) and $receipt->id != null)
            	{!! Form::open(['url' => 'save-account-sheet/'.$receipt->id , 'class' => 'form']) !!}
            	
            @else
            	{!! Form::open(['url' => 'save-account-sheet' , 'class' => 'form']) !!}
            @endif
            	{!! csrf_field() !!}
            		
            		<div class="row">
		               	<div class="col-sm-3"></div>
            			<div class="col-sm-6">
		               	 	<div class="title" style="font-size:26px;text-align: center;">
            					<br><br><label>مؤسسة عمار اﻻرض</label><br>
							</div>
				        	<div class="form-group" style="text-align: center;">
				        		{!! Form::date('sheet_date', \Carbon\Carbon::now()) !!}
				        		&nbsp&nbsp&nbsp&nbsp
				        		<label>بتاريخ</label> &nbsp&nbsp&nbsp&nbsp
				        		<label> ( {{$last_id}} ) </label>
				        		<label> &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp قيد يوميــة رقم </label>
				        		<input type="hidden" name="last_id" value="{{$last_id}}">
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
               	 					<th class="text-center"  width="15%">دائن </th>
               	 					<th class="text-center"  width="15%">مدين</th>
               	 					<!-- <th class="text-center" colspan="2" width="15%">مدين</th> -->
               	 				</tr>
               	 				<tr>
               	 					<th class="text-center"></th>
               	 					<th class="text-center"></th>
               	 					<th class="text-center"></th>
               	 					<th class="text-center" width="10%">جنيه</th>
               	 					<!-- <th class="text-center">قرش</th> -->
               	 					<th class="text-center" width="10%">جنيه</th>
               	 					<!-- <th class="text-center">قرش</th> -->
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
               	 						<div class="autocomplete">
               	 							<input  type="text"  id="searchfrom" class="search" name="searchDatafrom"
               	 							 placeholder="Search" autocomplete="off" />
               	 							 <input id='valuefrom' name='valuefrom' type='hidden' value=''>
									     </div>
							    		@if ($errors->has('notes'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('notes') }}</strong>
		                                    </span>
		                                @endif
		                                <br><br><br><br><br><br>
               	 							<label dir="rtl">الى حساب : </label>
	               	 						<div class="autocomplete">
	               	 							<input  type="text"  id="searchto" class="search" name="searchDatato"
	               	 							 placeholder="Search" autocomplete="off" />
               	 							 	<input id='valueto' name='valueto' type='hidden' value=''>
										     </div>
		                                	
		                                	<!-- <select name="to_level_three" id="to_level_three" class="form-control to" style="display: none;"></select>
		                                	<select name="to_level_four" id="to_level_four" class="form-control to" style="display: none;"></select>
		                                	<select name="to_level_five" id="to_level_five" class="form-control to" style="display: none;"></select>
		                                	<select name="to_level_six" id="to_level_six" class="form-control to" style="display: none;"></select> -->

		                                <br>

               	 					</td>
               	 					<td>
               	 						@if(isset($projects_amount))
							            	<table class="table table-bordered  table-hover">
							            		<tr>
							            			<td style="color: darkblue;"> المشروع</td>
							            			<td style="color: darkblue;"> المبلغ</td>
							            		</tr>
												@foreach($projects_amount as $project => $amount)
													<tr>
								            			<td> {{$project}} </td>
								            			<td> {{$amount}} </td>
								            		</tr>
												@endforeach
											</table>
										@endif

               	 						
               	 					</td>
               	 					<td>
               	 						@if(isset($cashReceipt) and $cashReceipt->amount)
								    		{!! Form::text('amount', number_format($cashReceipt->amount, 2, '.', ','), ['class' => 'form-control', 'dir'=> "rtl",'size' =>"7"]) !!}
				               	 		@else
								    		{!! Form::text('amount', null, ['class' => 'form-control', 'dir'=> "rtl",'size' => "7"]) !!}
				               	 		@endif
				               	 		@if ($errors->has('amount'))
				                            <span class="alert-danger">
				                                <strong>{{ $errors->first('amount') }}</strong>
				                            </span>
				                        @endif
               	 					</td>
               	 					<!-- <td>
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
               	 					</td> -->
               	 					<td>
               	 						@if(isset($cashReceipt) and $cashReceipt->amount)
								    		{!! Form::text('amount', number_format($cashReceipt->amount, 2, '.', ','), ['class' => 'form-control', 'dir'=> "rtl",'size' =>"7"]) !!}
				               	 		@else
								    		{!! Form::text('amount', null, ['class' => 'form-control', 'dir'=> "rtl",'size' => "7"]) !!}
				               	 		@endif
				               	 		@if ($errors->has('amount'))
				                            <span class="alert-danger">
				                                <strong>{{ $errors->first('amount') }}</strong>
				                            </span>
				                        @endif
               	 					</td>
               	 					<!-- <td>
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
               	 					</td> -->
               	 				</tr>
               	 				<tr>
               	 					<td colspan="3">
               	 						<input type="text" name="amount_alpha" dir="rtl" readonly size="70">
               	 					</td>
               	 					<td>
               	 						<label> {{ number_format($cashReceipt->amount, 2, '.', ',') }} </label>
               	 					</td>
               	 					<td>
               	 						<label> {{ number_format($cashReceipt->amount, 2, '.', ',') }} </label>
               	 					</td>
               	 				</tr>
               	 				<tr>
               	 					<td colspan="2"></td>
               	 					<td colspan="2" width="30%">
										@if(isset($receipt) and $receipt->registered_by)
											{{ Form::select('registered_by', $workers,$receipt->registered_by,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
										@else
											{{ Form::select('registered_by', $workers,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم محرر اﻻيصال'])  }}
										@endif

									    @if ($errors->has('registered_by'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('registered_by') }}</strong>
		                                    </span>
		                                @endif
               	 					</td>
               	 					<td colspan="3" class="text-center">اعداد وتسجيل : </td>
               	 				</tr>
               	 				<tr>
               	 					<td colspan="2"></td>
               	 					<td colspan="2">
										@if(isset($receipt) and $receipt->receipt_writter_id)
											{{ Form::select('reviewed_by', $workers,$receipt->reviewed_by,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])  }}
										@else
											{{ Form::select('reviewed_by', $workers,null,['class' => 'form-control' , 'placeholder' => 'اختر اسم محرر اﻻيصال'])  }}
										@endif

									    @if ($errors->has('reviewed_by'))
		                                    <span class="alert-danger">
		                                        <strong>{{ $errors->first('reviewed_by') }}</strong>
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

<script type="text/javascript">
	$(function($){
		$('.search').keyup(function(){
			var id  = $(this).attr('id')
			var val = $(this).val();
			// console.log(id);
			var type ='';
			if ($.isNumeric(val) && val.length >3) {
				type='number';
			}else if(val.length > 3 && val.trim() != ""){
				type='string';
			}

			if (type != '') {
    		var inp = document.getElementById(id);

			$.ajax({
	            url: '/search-level',
	            type: "GET",
	            data: {'type': type,
	                   'search_text': val},
	            success:function(data) { 
	            	if(data != ""){
	            		var a, b, i ;
	            		a = document.createElement("DIV");
					    a.setAttribute("id", "autocomplete-list");
					    a.setAttribute("class", "autocomplete-items");
      					inp.parentNode.appendChild(a);

					    for (var i = 0; i < data.length; i++) {
					    	b = document.createElement("DIV");
					          b.innerHTML = "<strong>" + data[i].level_title + "</strong>";
					          b.innerHTML += "<input id='value' type='hidden' value='" + data[i].level_code + "'>";
					         b.addEventListener("click", function(e) {
					         	var code = this.getElementsByTagName("input")[0].value;
					         	console.log(code);
					         	var content = this.getElementsByTagName("strong")[0];
					         	console.log(id);
					         	if (id =='searchfrom')
					         		$('#valuefrom').val(code);
					         	else
					         		$('#valueto').val(code);

				               	inp.value = $(content).text();
				               	$(inp).attr('data-attr', code);
				          	});
				          a.appendChild(b);
					    }

					    function closeAllLists(elmnt) {
						    var x = document.getElementsByClassName("autocomplete-items");
						    for (var i = 0; i < x.length; i++) {
						      if (elmnt != x[i] && elmnt != inp) {
						        x[i].parentNode.removeChild(x[i]);
						      }
						    }
						}

						document.addEventListener("click", function (e) {
						      closeAllLists(e.target);
						});
	            	}
			        else    
			        	console.log("error")
			            // $('#search-result-container').html("<div class='search-result'>No Result Found...</div>");
	            }
	        });
			}else{
		       	$('#livesearch').hide();
		       	$('#livesearch').html("");
			}
		});

	/**************************/
		$.ajax({
            url: '/convert-number',
            type: "POST",
            data: {'number': $(":input[name='amount']").val(),
                   '_token': $('input[name=_token]').val()},
            success:function(data) {                 
                $(":input[name='amount_alpha']").val(data);
            }
        });
		// $('.from').change(function () {
	 //        var val = $(this).val();
  //       	var model;
		// 	console.log(val);
		// 	if(val == ""){
		// 		$('select[name="from_level_three"]').hide();
		// 		$('select[name="from_level_four"]').hide();
		// 		$('select[name="from_level_five"]').hide();
		// 		$('select[name="from_level_six"]').hide();
		// 	}else{
		// 		if(val.length == 2){
	 //        		model = $('#from_level_three');
		// 	  	}else if(val.length == 4){
	 //        		model = $('#from_level_four');
		// 		}else if(val.length == 6){
	 //        		model = $('#from_level_five');
		// 		}else{
	 //        		model = $('#from_level_six');
		// 		}
	 //        	$.get("{{ url('get-levels')}}", 
		// 			{ option: $(this).val() }, 
		// 			function(data) {
		// 				model.empty();
		// 		        model.append("<option value=''>Plz Select</option>");
		// 				$.each(data, function(index, element) {
	 // 						if(val.length == 9 )
		// 		            	model.append("<option value='"+ element.pivot.code +"'>" + element.title + " " + element.pivot.title + "</option>");
	 // 						else
		// 		           		model.append("<option value='"+ element.code +"'>" + element.title + "</option>");
		// 		    	});				
		// 				if(val.length == 2){
		// 					$('select[name="from_level_three"]').show();
		// 					$('select[name="from_level_four"]').hide();
		// 					$('select[name="from_level_five"]').hide();
		// 					$('select[name="from_level_six"]').hide();
		// 			  	}else if(val.length == 4){
		// 					$('select[name="from_level_four"]').show();
		// 					$('select[name="from_level_five"]').hide();
		// 					$('select[name="from_level_six"]').hide();
		// 				}else if(val.length == 6){
		// 					$('select[name="from_level_five"]').show();
		// 					$('select[name="from_level_six"]').hide();
		// 				}else if(val.length == 9){
		// 					$('select[name="from_level_six"]').show();
		// 				}
		// 		});
		// 	}
	 //    });
	 //    $('.to').change(function () {
	 //        var val = $(this).val();
  //       	var model;
  //       	if(val == ""){
  //       		$('select[name="to_level_three"]').hide();
		// 		$('select[name="to_level_four"]').hide();
		// 		$('select[name="to_level_five"]').hide();
		// 		$('select[name="to_level_six"]').hide();
  //       	}else{
  //       		if(val.length == 2){
	 //        		model = $('#to_level_three');
		// 	  	}else if(val.length == 4){
	 //        		model = $('#to_level_four');
		// 		}else if(val.length == 6){
	 //        		model = $('#to_level_five');
		// 		}else{
	 //        		model = $('#to_level_six');
		// 		}
	 //        	$.get("{{ url('get-levels')}}", 
		// 			{ option: $(this).val() }, 
		// 			function(data) {
		// 				model.empty();
		// 		        model.append("<option value=''>Plz Select</option>");
		// 				$.each(data, function(index, element) {
	 // 						if(val.length == 9 )
		// 		            	model.append("<option value='"+ element.pivot.code +"'>" + element.title + " " + element.pivot.title + "</option>");
	 // 						else
		// 		           		model.append("<option value='"+ element.code +"'>" + element.title + "</option>");
		// 		    	});				
		// 				if(val.length == 2){
		// 					$('select[name="to_level_three"]').show();
		// 					$('select[name="to_level_four"]').hide();
		// 					$('select[name="to_level_five"]').hide();
		// 					$('select[name="to_level_six"]').hide();
		// 			  	}else if(val.length == 4){
		// 					$('select[name="to_level_four"]').show();
		// 					$('select[name="to_level_five"]').hide();
		// 					$('select[name="to_level_six"]').hide();
		// 				}else if(val.length == 6){
		// 					$('select[name="to_level_five"]').show();
		// 					$('select[name="to_level_six"]').hide();
		// 				}else if(val.length == 9){
		// 					$('select[name="to_level_six"]').show();
		// 				}
		// 		});
  //       	}
        	
	    // });
        $('.print-window').click(function() {
        	$('#submitForm').hide();
        	$('#resetForm').hide();
        	$('.print-window').hide();
		    window.print();
		});
   	});
</script>
@endsection