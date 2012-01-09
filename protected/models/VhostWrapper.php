<?php

class VhostWrapper extends Vhost
{
    public function getVhostIp()
    {
        return Yii::app()->params['serverIp'];
    }
}
