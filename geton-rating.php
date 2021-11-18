<?php

/**
 * Plugin Name:       Geton Ratings
 * Plugin URI:        https://wildrain.com
 * Description:       Geton Rating Plugin
 * Version:           1.0.0
 * Author:            WildRain
 * Author URI:        https://wildrain.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       geton-rating
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Main plugin class
 */
final class Geton_Rating
{
    /**
     * Plugin version
     * 
     * @var string
     */
    const version = '1.0.0';

    /**
     * contractor
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initialize singleton instance
     *
     * @return \Geton_Rating
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('GETON_RATING_VERSION', self::version);
        define('GETON_RATING_FILE', __FILE__);
        define('GETON_RATING_PATH', __DIR__);
        define('GETON_RATING_URL', plugins_url('', GETON_RATING_FILE));
        define('GETON_RATING_ASSETS', GETON_RATING_URL . '/assets');
    }

    /**
     * Plugin information
     *
     * @return void
     */
    public function activate()
    {
        $installer = new Geton\Rating\Installer();

        $installer->run();
    }

    /**
     * Load plugin files
     *
     * @return void
     */
    public function init_plugin()
    {
        new Geton\Rating\Assets();
        new Geton\Rating\Ajax();

        if (is_admin()) {
            new Geton\Rating\Admin();
        } else {
            new Geton\Rating\Frontend();
        }
    }
}

/**
 * Initialize main plugin
 *
 * @return \Geton_Rating
 */
function geton_rating()
{
    return Geton_Rating::init();
}

geton_rating();
