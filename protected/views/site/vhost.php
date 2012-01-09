<?php if(Yii::app()->user->hasFlash('vhostChanged')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('vhostChanged'); ?>
    </div>
<?php endif; ?>

<h1>Specify your virtual host detailes</h1>

<div class="form">

<?php echo CHtml::errorSummary($model); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vhost-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'hostname'); ?>
		<?php echo $form->textField($model,'hostname',array('size'=>50,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'hostname'); ?>
	</div>

    <div class="row">
    	<?php echo $form->labelEx($model,'path_to'); ?>
    	<?php echo $form->textField($model,'path_to',array('size'=>60,'maxlength'=>256)); ?>
    	<?php echo $form->error($model,'path_to'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'aliases'); ?>
		<?php echo $form->textField($model,'aliases',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'aliases'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->