<?php

include_once('AutoLoader.php');

spl_autoload_register(array('AutoLoader', 'loadClass'));

AutoLoader::registerDirectory('../src');


