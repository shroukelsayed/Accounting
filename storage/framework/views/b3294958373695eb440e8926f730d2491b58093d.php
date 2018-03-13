<?php $__env->startSection('header'); ?>
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Projects
            <a class="btn btn-success pull-right" href="<?php echo e(route('projects.create')); ?>"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            <?php if($projects->count()): ?>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Project Code</th>
                            
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($projects as $project): ?>
                            <tr>
                                <td><?php echo e($project->id); ?></td>
                                <td><?php echo e($project->name); ?></td>
                                <td><?php echo e($project->code); ?></td>
                                
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="<?php echo e(route('projects.show', $project->id)); ?>"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="<?php echo e(route('projects.edit', $project->id)); ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                   
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $projects->render(); ?>

            <?php else: ?>
                <h3 class="text-center alert alert-info">Empty!</h3>
            <?php endif; ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>