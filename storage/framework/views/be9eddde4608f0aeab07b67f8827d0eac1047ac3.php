<?php $__env->startSection('css'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Donation Receipts
            <!-- <a class="btn btn-success pull-right" href="<?php echo e(route('projects.create')); ?>"><i class="glyphicon glyphicon-plus"></i> Create</a> -->
        </h1>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.pack.min.js"></script>
<script type="text/javascript">
   
        // $(function($){
            
            // person_search = document.getElementById("person_search");
 //            $(":input[name='receipt_id']").blur( function () {
 //                            // console.log("Not Found");

 //                // if( $(":input[name='receipt_id']").val() == ""){
 //                //     person_search.innerHTML == "";
 //                // }
 //                $.ajax({
 //                    url: '/receipts/search',
 //                    type: "POST",
 //                    data: {'receipt_id': $(":input[name='receipt_id']").val(), '_token': $('input[name=_token]').val()},

 //                    success: function (data) {
 //                        if(data.length==0 || $(":input[name='receipt_id']").val() == "" ){
 //                            console.log("Not Found");
 //                            person_search.innerHTML = "";
 //                        }else{

 //                        }
 //                    }
 //                });
 //            });
       
 //        // $("#receipt_id").blur(function(){
 //        //     alert("This input field has lost its focus.");
 //        // });

 // });


    </script>

<br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php if($receipts->count()): ?>
                <?php echo Form::open(['url' => 'cash-receipt' , 'class' => 'form']); ?>

                <?php echo csrf_field(); ?>

                
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th class="text-right"></th>
                            <th>عنوان المتبرع</th>
                            <th>اسم المتبرع</th>
                            <th>تاريخ اﻹيصال</th>
                            <th>النوع</th>
                            <th>المبلغ</th>
                            <th>نقاً / شيكات</th>                            
                            <th>رقم اﻹيصال</th>                            
                        </tr>
                    </thead>

                    <tbody>
                      <!--   <tr>
                            <td></td>
                            <td>
                                <input  placeholder="عنوان المتبرع" type="textbox" dir="rtl" name="donator_address">
                            </td>
                            <td>
                                <input  placeholder="اسم المتبرع" type="textbox" dir="rtl" name="donator_name">
                            </td>
                            <td>
                                <input  placeholder="" type="date" name="receipt_date">
                            </td>
                            <td>
                                <select name="type">
                                    <option value="0"> all</option>
                                    <option value="1">مستغل </option>
                                    <option value="2">غير مستغل</option>
                                    <option value="3">ﻻغى</option>
                                    <option value="4">مشطوب</option>
                                </select>
                            </td>
                            <td>
                                <input  placeholder="المبلغ" type="textbox" dir="rtl" name="amount">
                            </td>
                            <td>
                                <select name="cash">
                                    <option value="0"> all</option>
                                    <option value="1">نقاً </option>
                                    <option value="2">شيكات</option>
                                </select> 
                            </td>
                            <td>
                                <input  placeholder="رقم اﻹيصال" type="search" dir="rtl" name="receipt_id" id="receipt_id">
                            </td>
                        </tr> -->
                        <?php foreach($receipts as $receipt): ?>
                            <tr>
                                 <td class="text-right">
                                    
                                   &nbsp&nbsp <a class="btn btn-xs btn-warning" href="<?php echo e(url('receipts', $receipt->id)); ?>"><i class="glyphicon glyphicon-edit"></i><?php echo app('translator')->get('validation.edit'); ?></a>
                                   &nbsp&nbsp<input name="checked[]" type="checkbox" value="<?php echo e($receipt->id); ?>">
                                </td>
                                <td><?php echo e($receipt->donator_address); ?></td>
                                <td><?php echo e($receipt->donator_name); ?></td>
                                <td><?php echo e(Carbon\Carbon::parse($receipt->receipt_date)->format('d-m-Y')); ?></td>
                                <?php if($receipt->type ==4 ): ?>
                                    <td>مشطوب</td>
                                <?php elseif($receipt->type ==3): ?>
                                    <td>ﻻغى</td>
                                <?php elseif($receipt->type ==2): ?>
                                    <td>غير مستغل</td>
                                <?php else: ?>
                                    <td>مستغل</td>
                                <?php endif; ?>
                                <td><?php echo e($receipt->amount); ?></td>
                                <?php if($receipt->cash == '1'): ?>
                                    <td>نقاً </td>
                                <?php else: ?>
                                    <td>شيكات</td>
                                <?php endif; ?>
                                <td><?php echo e($receipt->id); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo Form::submit('Submit', ['class' => 'btn btn-info']); ?>

                <?php echo Form::close(); ?>

            <?php else: ?>
                <h3 class="text-center alert alert-info">Empty!</h3>
            <?php endif; ?>

        </div>
        <div class="col-md-1"></div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>