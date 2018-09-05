<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 <div class="panel-heading"><span style="float: right;"><?php echo app('translator')->getFromJson('validation.welcome'); ?></span></div>

                <div class="panel-body">
                    <span style="float: right;"><?php echo app('translator')->getFromJson('validation.slug'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>