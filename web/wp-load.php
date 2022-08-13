<?php
/**
 * This file is here because some plugins like to do `require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');`
 * and our real wp-load is not found in the document root
 */
require_once( __DIR__ . '/wp/wp-load.php' );
