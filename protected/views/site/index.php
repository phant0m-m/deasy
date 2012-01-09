<?php $this->pageTitle=Yii::app()->name; ?>

<h1>
    <i>The list of your domains</i>
    <?php echo CHtml::link("" , Yii::app()->createUrl("addVhost"), array('class'=>'addVhost' , 'title'=>'Add new Virtual host')); ?>
    <?php echo CHtml::link("" , Yii::app()->createUrl("makeVhostConfig"), array('class'=>'vhostConfig' , 'title'=>'Create config for you local system')); ?>
</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domain-list-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <div id="domainListForm">
        <div id="domainList">
            <?php $this->widget('zii.widgets.CListView', array(
            	'dataProvider'=>$dataProvider,
            	'itemView'=>'_vhostLine',
            	'template'=>"{items}\n{pager}",
            )); ?>
        </div>

        <div class="row buttons">
            <?php
                echo CHtml::ajaxSubmitButton('Remove selected vhosts',Yii::app()->createUrl("ajax/remVhostList"),array('beforeSend' => 'preRemoveVhostList','success'=>'onRemoveVhostList','dataType'=>'json'));
                echo CHtml::resetButton('Reset');
            ?>
       	</div>
    </div>
    <div>

    </div>
<?php $this->endWidget(); ?>