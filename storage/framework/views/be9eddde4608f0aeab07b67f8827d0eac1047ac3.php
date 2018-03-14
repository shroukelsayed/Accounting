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
   
    $(function($){
            
        $(":input[name='search']").blur( function () {
            $.ajax({
                url: '/receipts/search',
                type: "POST",
                data: {'receipt_id': $(":input[id='receipt_id']").val(),
                        'donator_address': $(":input[id='donator_address']").val(),
                        'donator_name': $(":input[id='donator_name']").val(),
                        'receipt_date': $(":input[id='receipt_date']").val(),
                        'amount': $(":input[id='amount']").val(),
                        'type': $(":input[id='type']").val(),
                        'cash': $(":input[id='cash']").val(), '_token': $('input[name=_token]').val()},

                success:function(html) {                 
                    $("#receipts_table").html(html).show('slow');
                }
            });
        });
       
    });


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
                        <tr>
                            <td></td>
                            <td>
                                <input  placeholder="عنوان المتبرع" type="textbox" dir="rtl" name="search" id="donator_address">
                            </td>
                            <td>
                                <input  placeholder="اسم المتبرع" type="textbox" dir="rtl" name="search" id="donator_name">
                            </td>
                            <td>
                                <input  placeholder="" type="date" name="search" id="receipt_date">
                            </td>
                            <td>
                                <select name="search" id="type">
                                    <option value="0"> all</option>
                                    <option value="1">مستغل </option>
                                    <option value="2">غير مستغل</option>
                                    <option value="3">ﻻغى</option>
                                    <option value="4">مشطوب</option>
                                </select>
                            </td>
                            <td>
                                <input  placeholder="المبلغ" type="textbox" dir="rtl" name="search" id="amount">
                            </td>
                            <td>
                                <select name="search" id="cash">
                                    <option value="0"> all</option>
                                    <option value="1">نقاً </option>
                                    <option value="2">شيكات</option>
                                </select> 
                            </td>
                            <td>
                                <input  placeholder="رقم اﻹيصال" type="search" dir="rtl" name="search" id="receipt_id">
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                <?php echo $__env->make('table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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