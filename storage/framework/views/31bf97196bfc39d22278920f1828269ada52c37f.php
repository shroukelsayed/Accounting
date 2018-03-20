<?php $__env->startSection('css'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
    <?php echo $__env->make('error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="container">
                <!-- <div class="title" style="padding:50px;font-size: 60px;text-align: center;display: inline-block;">ايصال استلام تبرع</div> -->

            <?php echo Form::open(['url' => 'save-cash' , 'class' => 'form']); ?>

            	<div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 900px;">

            		<?php echo csrf_field(); ?>

            		<input type="hidden" name="ids" value="<?php echo e($ids); ?>">
            		<div style="text-align: right;">
            			<label>مؤسسة عمار اﻻرض</label><br>
               			<label> المشهرة برقم ٤٥٦٦ لسنة ٢٠١٢ </label>
            		</div>
            		<div class="row">
            			<div class="col-sm-3">
            				<img id="profile" src="<?php echo e(asset('img/2.jpg')); ?>"  class="user-image" alt="User Image">
            			</div>
            			<div class="col-sm-6">
               	 			<div class="title" style="font-size:36px;text-align: center;"><?php echo app('translator')->get('validation.cash_receipt'); ?></div>
               	 			<div class="form-group" style="text-align: center;">
				        		<?php if(isset($receipt_type) and $receipt_type == 0): ?>
					        		<?php echo Form::label('receipt_type', 'شيكات'); ?>

			                		<?php echo Form::radio('receipt_type', '0',true); ?>

								    <?php echo Form::label('receipt_type', 'نقداً'); ?>

									<?php echo Form::radio('receipt_type', '1',false,['disabled' => 'disabled']); ?>

								<?php else: ?>
									<?php echo Form::label('receipt_type', 'شيكات'); ?>

			                		<?php echo Form::radio('receipt_type', '0',false,['disabled' => 'disabled']); ?>

								    <?php echo Form::label('receipt_type', 'نقداً'); ?>

									<?php echo Form::radio('receipt_type', '1', true); ?>

								<?php endif; ?>
							</div>
							<div style="text-align: center;font-size:18px;">
		            			<label><?php echo e($last_id); ?> &nbsp&nbsp&nbsp رقم</label><br>
		            		</div>
		               	</div>
		               	<div class="col-sm-3"></div>
		            </div>		        	
					<br>
					<div class="row">
						<div class="col-sm-3">
							<div>
		               	 		<label>جنيه</label>&nbsp&nbsp&nbsp&nbsp<label>قرش</label><br>
		               	 		<?php if(isset($amount)): ?>
		               	 			<input type="text" name="amount" size="7" value="<?php echo e($amount); ?>">
		               	 		<?php else: ?>
		               	 			<input type="text" name="amount" size="7">
		               	 		<?php endif; ?>
		               	 	</div>
		               	</div>
		               	<div class="col-sm-6"></div>
						<div class="col-sm-3"></div>
	               	</div>
		        	
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
								<?php echo Form::date('delivery_date', \Carbon\Carbon::now()); ?>

							</div>
							<div class="col-sm-3">								
						    	<?php echo Form::label('delivery_date', 'وتحرر هذا ايصالاً باﻻستلام '); ?>

							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		<?php echo Form::text('delivered_by', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
					    		<?php echo Form::label('delivered_by', 'استلمت انا من السيد'); ?>

							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    <?php echo Form::text('amount_alpha', null, ['class' => 'form-control', 'dir'=> "rtl",'disabled' => 'disabled']); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('amount_alpha', 'مبلغ وقدره '); ?>

							</div>
						</div>
					</div>

					<div id="cheque" hidden="true">
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-9">
									<?php if(isset($receipt) and $receipt->cheque_number): ?>
								    	<?php echo Form::text('cheque_number', $receipt->cheque_number, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

									<?php else: ?>
								    	<?php echo Form::text('cheque_number', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

								    <?php endif; ?>
								    <?php if($errors->has('cheque_number')): ?>
	                                    <span class="alert-danger">
	                                        <strong><?php echo e($errors->first('cheque_number')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
								</div>
								<div class="col-sm-3">
								    <?php echo Form::label('cheque_number', 'شيك رقم '); ?>

								</div>
							</div>
						</div>
						<div class="form-group" style="text-align: right;">
							<div class="row">
								<div class="col-sm-3">
									<?php if(isset($receipt) and $receipt->cheque_bank): ?>
								    	<?php echo Form::text('cheque_bank', $receipt->cheque_bank, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

								    <?php else: ?>
								    	<?php echo Form::text('cheque_bank', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

								    <?php endif; ?>
								    <?php if($errors->has('cheque_bank')): ?>
	                                    <span class="alert-danger">
	                                        <strong><?php echo e($errors->first('cheque_bank')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
								</div>
								<div class="col-sm-3">
								    <?php echo Form::label('cheque_bank', 'مسحوب على بنك '); ?>

								</div>
								<div class="col-sm-3">
									<?php if(isset($receipt) and $receipt->cheque_date): ?>
										<?php echo Form::date('cheque_date', \Carbon\Carbon::parse($receipt->cheque_date)); ?>

									<?php else: ?>
										<?php echo Form::date('cheque_date', \Carbon\Carbon::now()); ?>

									<?php endif; ?>
									<?php if($errors->has('cheque_date')): ?>
	                                    <span class="alert-danger">
	                                        <strong><?php echo e($errors->first('cheque_date')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
								</div>
								<div class="col-sm-3">
								    <?php echo Form::label('cheque_date', 'تاريخ الشيك '); ?>

								</div>
							</div>
						</div>
					</div>

					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		<?php echo Form::text('notes', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('notes', 'وذلك عن '); ?>

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
									<?php foreach($projects_amount as $project => $amount): ?>
										<tr>
					            			<td> <?php echo e($amount); ?> </td>
					            			<td> <?php echo e($project); ?> </td>
					            		</tr>
									<?php endforeach; ?>
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
					<?php echo Form::submit(trans('validation.submit'), ['class' => 'btn btn-info']); ?>

            	</div>
			<?php echo Form::close(); ?>

        </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>