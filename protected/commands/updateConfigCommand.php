<?php
/**
 * The command provides an ability to update server config
 * @author Phant0m_m
 */
class UpdateConfigCommand extends CConsoleCommand
{
    public function run($args)
    {
        ConfigHelper::createConfig();
        ConfigHelper::applyConfig();
    }

}
