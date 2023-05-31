<?php
/*
  Plugin Name: Disable Plugin Deactivation
  Plugin URI: http://www.clariontech.com
  Description: Disable Plugin Deactivation
  Version: 2.2.0
  Author: Yogesh Pawar, Clarion Technologies
  Author URI: http://www.clariontech.com
  License: GPLv2 or later
  Text Domain: Disable Plugin Deactivation
 */

//Plugin Constant
defined('ABSPATH') or die('Restricted direct access!');

if (!class_exists('Disable_Plugin_Deactivation')) {
    require_once 'classes/class.plugin.deactivation.php';
}
?>