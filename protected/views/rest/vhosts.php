<?php
    foreach($dataProvider->getData() as $vhost) {
        echo ("{$vhost->getVhostIp()}\t{$vhost->getFullUrl()}\t### DEASY HOST CONFIG\n");
    }
