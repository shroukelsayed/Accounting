<?php $__env->startSection('css'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header'); ?>
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Projects / Create </h1>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<br><br><br><br><br><br>

    <?php echo $__env->make('error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row">
        <div class="col-md-12">

            <form action="<?php echo e(route('projects.store')); ?>" method="POST">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="name" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> اسم المشروع</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="code" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> كود المشروع</label>
                    </div>
                </div>
                <br><br><br>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="<?php echo e(route('projects.index')); ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>