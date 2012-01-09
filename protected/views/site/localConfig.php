<?php $this->pageTitle=Yii::app()->name; ?>

<h1>
    <i>The list of your domains</i>
    <?php echo CHtml::link("" , "#", array('id'=>'copyConfig' , 'title'=>'Copy to clipboard')); ?>
</h1>

<div id="localConfig">
<p id='preVhostList'>
####################################################################### <br/>
# virtual hosts from <b><?php echo $baseHostname; ?> </b> block start.
</p>
<br/>
    <?php $this->widget('zii.widgets.CListView', array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>'_localConfigLine',
        'template'=>"{items}",
    )); ?>
<br/>
<p id='postVhostList'>
# virtual hosts from <b><?php echo $baseHostname; ?> </b> block end.    <br/>
#######################################################################
</p>
</div>