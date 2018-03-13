<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <p>There were some problems with your input.</p>
        <ul>
            <?php foreach($errors->all() as $error): ?>
                <li><i class="glyphicon glyphicon-remove"></i> <?php echo e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>