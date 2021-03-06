<?php
/**
 * Helper, allows to create the config, put it into
 * appropriate place and restart web server
 * @author Phant0m_m
 */
class ConfigHelper
{
    /**
     * @static
     * Create the new config file;
     */
    public static function createConfig()
    {
        $configTemplate = file_get_contents(Yii::app()->params['configTemplatePath']);
        $config = '';

        $vhosts = Vhost::model()->findAll('',array('order by hostname DESC'));
        foreach ($vhosts as $vhost) {
            $config .= preg_replace(array('~\[__SERVER_NAME__\]~','~\[__ROOT_PATH__\]~'),
                array($vhost->getFullUrl() , $vhost->path_to),
                is_object($vhost->config) ? $vhost->config->config : $configTemplate
            );
        }
        file_put_contents(Yii::app()->params['configOutputPath'],$config);
    }

    /**
     * Apply the new config file
     * @static
     * @return bool
     * @todo move to the separate bash script
     */
    public static function applyConfig()
    {
        if (!file_exists(Yii::app()->params['configOutputPath'])) {
            return false;
        }

        if (!file_exists(Yii::app()->params['configDestinationPath'])) {
            copy(Yii::app()->params['configOutputPath'],Yii::app()->params['configDestinationPath']);
            exec(Yii::app()->params['serverRestartCommand']);
            return true;
        }

        exec('diff '.Yii::app()->params['configOutputPath'].' '.Yii::app()->params['configDestinationPath'],$output);
        if (sizeof($output) > 0) {
            copy(Yii::app()->params['configOutputPath'],Yii::app()->params['configDestinationPath']);
            exec(Yii::app()->params['serverRestartCommand']);
            return true;
        }

        return true;
    }
}