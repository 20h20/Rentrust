<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DEBUG_LOG', true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', false);
Config::define('SCRIPT_DEBUG', false); // prevent ACF break
Config::define('DISALLOW_INDEXING', false);

ini_set('display_errors', '0');

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);

Config::define('WPCF7_AUTOP', false);
Config::define('GITHUB_TOKEN', env('GITHUB_TOKEN'));