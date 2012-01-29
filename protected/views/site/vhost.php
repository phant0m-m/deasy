<?php if(Yii::app()->user->hasFlash('vhostChanged')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('vhostChanged'); ?>
    </div>
<?php endif; ?>

<h1>Specify your virtual host detailes</h1>

<div class="form">
<?php echo $form; ?>
</div>
