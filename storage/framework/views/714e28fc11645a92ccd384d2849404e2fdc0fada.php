<?php $__env->startSection('header'); ?>
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Users
            <a class="btn btn-success pull-right" href="<?php echo e(route('users.create')); ?>"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            <?php if($users->count()): ?>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>اسم المستخدم</th>
                            <th>البريد اﻻلكترونى</th>
                            <th>الصلاحية</th>
                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?php echo e($user->id); ?></td>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->role); ?></td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="<?php echo e(route('users.show', $user->id)); ?>"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="<?php echo e(route('users.edit', $user->id)); ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                        <!-- <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button> -->
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $users->render(); ?>

            <?php else: ?>
                <h3 class="text-center alert alert-info">Empty!</h3>
            <?php endif; ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>