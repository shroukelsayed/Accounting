<?php $__env->startSection('css'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<br><br><br><br><br><br>
    <?php echo $__env->make('error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Users / Edit #<?php echo e($user->id); ?></h1>
    </div>
    <div class="row">
        <div class="col-md-12">

            <form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="user_name" class="form-control" dir="rtl" value="<?php echo e($user->name); ?>">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> اسم المستخدم</label>
                    </div>
                </div>
                <br>
                <div class="row">
                     <div class="col-md-9">
                        <input type="text" name="email" class="form-control" dir="rtl" value="<?php echo e($user->email); ?>">
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> البريد اﻻلكترونى</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control" dir="rtl" >
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> كلمة المرور</label>
                    </div>
                </div>
                <br>
                <div class="row">
                     <div class="col-md-9">
                        <select name="role" class="form-control">
                            <option value="1">admin</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label style="float: right;"> الصلاحية</label>
                    </div>
                </div>
                <br><br>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="<?php echo e(route('users.index')); ?>"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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

<?php echo $__env->make(  Auth::user()->role  == 1  ? 'layouts.admin' : 'layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>