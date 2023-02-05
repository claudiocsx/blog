<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::setDefaultNamespace('sistemas\Crontrolador');

SimpleRouter::get(URL_SITE, 'SiteControlador@index');
SimpleRouter::get(URL_SITE.'sobre', 'SiteControlador@sobre');

SimpleRouter::start();
