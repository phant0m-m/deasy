<?php

class DirectoryExistValidator extends CValidator
{
    protected function validateAttribute($object,$attribute)
    {
            $valid = is_dir($object->$attribute);

            if(!$valid)
            {
                    $message=$this->message!==null?$this->message : Yii::t('yii',"No directory '{$object->$attribute}' exists.");
                    $this->addError($object,$attribute,$message);
            }
    }

}
