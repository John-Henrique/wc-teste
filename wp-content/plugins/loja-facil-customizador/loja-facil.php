<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://johnhenrique.com.br/
 * @since             1.0.0
 * @package           Loja_Facil
 *
 * @wordpress-plugin
 * Plugin Name:       Loja Fácil
 * Plugin URI:        loja-facil-customizador
 * Description:       Customiza algumas partes do WordPress para deixar o painel mais profissional
 * Version:           1.0.13
 * Author:            John-Henrique
 * Author URI:        https://johnhenrique.com.br/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       loja-facil
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LOJA_FACIL_VERSION', '1.0.13' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-loja-facil-activator.php
 */
function activate_loja_facil() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-loja-facil-activator.php';
	Loja_Facil_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-loja-facil-deactivator.php
 */
function deactivate_loja_facil() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-loja-facil-deactivator.php';
	Loja_Facil_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_loja_facil' );
register_deactivation_hook( __FILE__, 'deactivate_loja_facil' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-loja-facil.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_loja_facil() {

	$plugin = new Loja_Facil();
	$plugin->run();

}
run_loja_facil();
