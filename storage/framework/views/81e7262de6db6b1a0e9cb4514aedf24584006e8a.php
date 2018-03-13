 <?php
// var_dump(Auth::user());die;
 ?> 


<?php $__env->startSection('content'); ?>


    <br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><span style="float: right;">أهلاً بك </span></div>

                <div class="panel-body">
                    <span style="float: right;">اهلا بك فى الصفحة الرئيسية لنظام الحسابات الخاص بجمعية عمار اﻻرض </span>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(  Auth::user()->role  == 1  ? 'layouts.admin' : 'layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>