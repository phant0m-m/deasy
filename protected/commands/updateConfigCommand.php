<?php

class UpdateConfigCommand extends CConsoleCommand
{
    public function run()
    {
        ConfigHelper::createConfig();
        ConfigHelper::applyConfig();
    }

}