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
                        'donator_mobile': $(":input[id='donator_mobile']").val(),
                        'donator_name': $(":input[id='donator_name']").val(),
                        'project_name': $(":input[id='project_name']").val(),
                        'receipt_date': $(":input[id='receipt_date']").val(),
                        'amount': $(":input[id='amount']").val(),
                        'type': $(":input[id='type']").val(),
                        'cash': $(":input[id='cash']").val(), '_token': $('input[name=_token]').val()},

                success:function(html) {                 
                    $("#receipts_table").html(html).show('slow');
                }
            });
        });
       $('.checked').change(function(){
            var cheque = $('.checked');
            if($(this).is(':checked')) {
                if($(this).attr('data-attr') == 'cheque'){
                    $.each(cheque,function () {
                        if($(this).attr('data-attr') == 'cash')
                            $(this).attr('disabled',true)
                    });
                }else{
                     $.each(cheque,function () {
                        if($(this).attr('data-attr') == 'cheque')
                            $(this).attr('disabled',true)
                    });
                }
            }else{
                if($('.checked:checked').length == 0){
                    $(".checked").attr('disabled',false);
                }
            }
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
                            <th class="text-center">اختر</th>
                            <th class="text-center">عنوان المتبرع</th>
                            <th class="text-center">تليفون المتبرع</th>
                            <th class="text-center">اسم المتبرع</th>
                            <th class="text-center">اسم المشروع</th>
                            <th class="text-center">تاريخ اﻹيصال</th>
                            <th class="text-center">النوع</th>
                            <th class="text-center">المبلغ</th>
                            <th class="text-center">نقاً / شيكات</th>                            
                            <th class="text-center">رقم اﻹيصال</th>                            
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp <a class="btn btn-danger" href="#" name="clear"><i class="glyphicon glyphicon-edit"></i><?php echo app('translator')->get('validation.edit'); ?></a>
                            </td>
                            <td>
                                <input class="form-control" placeholder="عنوان المتبرع" type="textbox" dir="rtl" name="search" id="donator_address">
                            </td>
                             <td>
                                <input class="form-control" placeholder="تليفون المتبرع" type="textbox" dir="rtl" name="search" id="donator_mobile">
                            </td>
                            <td>
                                <input class="form-control" placeholder="اسم المتبرع" type="textbox" dir="rtl" name="search" id="donator_name">
                            </td>
                            <td>
                                <input class="form-control" placeholder="اسم المشروع" type="textbox" dir="rtl" name="search" id="project_name">
                            </td>
                            <td>
                                <input class="form-control" placeholder="" type="date" name="search" id="receipt_date">
                            </td>
                            <td>
                                <select name="search" id="type" class="form-control">
                                    <option value="0"> all</option>
                                    <option value="1">مستغل </option>
                                    <option value="2">غير مستغل</option>
                                    <option value="3">ﻻغى</option>
                                    <option value="4">مشطوب</option>
                                </select>
                            </td>
                            <td>
                                <input class="form-control" placeholder="المبلغ" type="textbox" dir="rtl" name="search" id="amount" maxlength="10" size="10">
                            </td>
                            <td>
                                <select name="search" id="cash" class="form-control">
                                    <option value="2"> all</option>
                                    <option value="1">نقاً </option>
                                    <option value="0">شيكات</option>
                                </select> 
                            </td>
                            <td>
                                <input class="form-control" placeholder="رقم اﻹيصال" type="search" dir="rtl" name="search" id="receipt_id" size="5">
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                <?php echo $__env->make('table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::submit('إنشاء ايصال استلام نقدية', ['class' => 'btn btn-info']); ?>

                <?php echo Form::close(); ?>

            <?php else: ?>
                <h3 class="text-center alert alert-info">Empty!</h3>
            <?php endif; ?>

        </div>
        <div class="col-md-1"></div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>