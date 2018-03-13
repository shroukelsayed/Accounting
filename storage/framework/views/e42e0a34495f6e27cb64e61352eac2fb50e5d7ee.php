<?php $__env->startSection('css'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="container">
                <!-- <div class="title" style="padding:50px;font-size: 60px;text-align: center;display: inline-block;">ايصال استلام تبرع</div> -->

            <?php echo Form::open(['route' => 'store' , 'class' => 'form']); ?>

            	<div class="content" style="border-style: solid; border-color:black; margin: 5px;padding: 25px; height: 810px;">

               	 	<div class="title" style="font-size:36px;text-align: center;">ايصال استلام تبرع</div>
		        	
		        	<div class="form-group" style="text-align: center;">
		        		<?php echo Form::label('receipt_type', 'شيكات'); ?>

                		<?php echo Form::radio('receipt_type', 'شيكات'); ?>

					    <?php echo Form::label('receipt_type', 'نقداً'); ?>

						<?php echo Form::radio('receipt_type', 'نقداً', true); ?>

					    
					</div>

					<br>
		        	<div class="form-group" style="text-align: right;">
						<div class="col-sm-4"></div>
						<div class="col-sm-2">
						    <?php echo Form::label('type', 'مشطوب'); ?>

						    <?php echo Form::checkbox('type'); ?>

					    </div>
					    <div class="col-sm-2">
						    <?php echo Form::label('type', 'ﻻغى'); ?>

						    <?php echo Form::checkbox('type'); ?>

						</div>
						<div class="col-sm-2">
						    <?php echo Form::label('type', 'غير مستغل'); ?>

						    <?php echo Form::checkbox('type'); ?>

						</div>
					    <div class="col-sm-2">
						    <?php echo Form::label('type', 'مستغل'); ?>

						    <?php echo Form::checkbox('type'); ?>

						</div>
					</div>
					<br><br><br>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
					    		<?php echo Form::text('name', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
					    		<?php echo Form::label('name', 'استلمت انا من السيد'); ?>

							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    <?php echo Form::text('donator_address', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('donator_address', 'المقيم بالعنوان'); ?>

							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    <?php echo Form::text('donator_phone', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('donator_phone', 'رقم التليفون '); ?>

							</div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-9">
							    <?php echo Form::text('amount_alpha', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('amount_alpha', 'مبلغ وقدره '); ?>

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





					<br>

					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
					    		<?php echo Form::text('notes', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('name', 'استحقاق عن شهر '); ?>

							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
					    		<?php echo Form::text('notes', null, ['class' => 'form-control', 'dir'=> "rtl"]); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('name', 'رقم الدفتر'); ?>

							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
							    <?php echo Form::select('age', ['Under 18', '19 to 30', 'Over 30'],null,['class' => 'form-control']); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('name', 'اسم محرر اﻻيصال'); ?>

							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
							    <?php echo Form::select('age', ['Under 18', '19 to 30', 'Over 30'],null,['class' => 'form-control']); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('name', 'اسم المندوب'); ?>

							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-3">
								<!--  <?php echo Form::select('project', ['نهر الخير', 'ﻻ للجوع', 'نفسى اتعلم','مشروعى الصغير','ستر وغطا'],null,['class' => 'form-control']); ?>

					    <?php echo Form::select('project_item', ['فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'],null,['class' => 'form-control']); ?> -->

								<?php echo e(Form::select('project_item', array('نهر الخير' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'ﻻ للجوع' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'نفسى اتعلم' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'مشروعى الصغير' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															  'ستر وغطا' => array('فورى', 'رسائل قصيرة', 'ماكينة CIB ','مولات ','اخرى'),
															),null,['class' => 'form-control' , 'placeholder' => 'اختر بند المشروع'])); ?>

							</div>
							<div class="col-sm-3">
							    <?php echo Form::label('project', 'وذلك عن مشروع'); ?>

							</div>
							<div class="col-sm-6"></div>
						</div>
					</div>


				
					<div class="form-group" style="text-align: right;">
						<div class="row">
							<div class="col-sm-6"></div>
							<div class="col-sm-6">
						    	<?php echo Form::label('delivery_date', 'وتحرر هذا ايصالاً باﻻستلام '); ?><br>
								<?php echo Form::date('delivery_date', \Carbon\Carbon::now()); ?>

							</div>
						</div>
					</div>
					<br>



				<!-- 	<div class="form-group" >
					    <?php echo Form::label('email', 'E-mail Address'); ?>

					    <?php echo Form::text('email', null, ['class' => 'form-control']); ?>

					</div>
					<br>

					<div class="form-group" >
					    <?php echo Form::textarea('msg', null, ['class' => 'form-control']); ?>

					</div>

					<br> -->
					<?php echo Form::submit('Submit', ['class' => 'btn btn-info']); ?>


            	</div>

			<?php echo Form::close(); ?>


        </div>



        

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>