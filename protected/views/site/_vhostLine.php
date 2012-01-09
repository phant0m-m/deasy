<?php
/**
 * @author Phant0m_m
 */
?>
    <div class="vhostRecord" id="vhost_<?php echo $data->id; ?>" ><?php
        echo CHtml::checkBox('vhostToRemove[]',false,array('value' => $data->id));
        echo CHtml::link($data->getFullUrl(),'http://' . $data->getFullUrl() , array('target'=>'_blank' , 'title'=>$data->info));
        echo CHtml::link("" , Yii::app()->createUrl("editVhost",array($data->id=>null)), array('class'=>'editDomainButton' , 'title'=>'Edit vhost settings'));
        echo CHtml::ajaxLink("" , Yii::app()->createUrl("ajax/remVhost",array($data->id=>null)), array('beforeSend' => 'preRemoveVhost','success'=>'onRemoveVhost','dataType'=>'json') , array('class'=>'removeDomainButton' , 'title'=>'Remove vhost')); ?>
    </div>