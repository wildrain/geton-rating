<?php

namespace Geton\Rating;

/**
 * Assets class handler
 */
class Assets
{
    /**
     * Initialize assets
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    /**
     * Marlin scripts
     *
     * @return array
     */
    public function get_scripts()
    {
        return [
            'jquery.star-rating-svg' => [
                'src'     => GETON_RATING_ASSETS . '/js/jquery.star-rating-svg.js',
                'version' => filemtime(GETON_RATING_PATH . '/assets/js/jquery.star-rating-svg.js'),
                'deps'    => ['jquery']
            ],
            'gor-rating' => [
                'src'     => GETON_RATING_ASSETS . '/js/gor-rating.js',
                'version' => filemtime(GETON_RATING_PATH . '/assets/js/gor-rating.js'),
                'deps'    => ['jquery']
            ]
        ];
    }

    /**
     * Marlin styles
     *
     * @return array
     */
    public function get_styles()
    {
        return [
            'star-rating-svg' => [
                'src'     => GETON_RATING_ASSETS . '/css/star-rating-svg.css',
                'version' => filemtime(GETON_RATING_PATH . '/assets/css/star-rating-svg.css'),
            ],
            'gor-style' => [
                'src'     => GETON_RATING_ASSETS . '/css/gor-style.css',
                'version' => filemtime(GETON_RATING_PATH . '/assets/css/gor-style.css'),
            ]
        ];
    }

    /**
     * Register assets
     */
    public function register_assets()
    {
        global $post;

        $scripts = $this->get_scripts();
        $styles = $this->get_styles();

        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;
            $version = isset($script['version']) ? $script['version'] : GETON_RATING_VERSION;

            wp_register_script($handle, $script['src'], $deps, $version, true);
            wp_enqueue_script($handle);
        }

        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;
            $version = isset($style['version']) ? $style['version'] : GETON_RATING_VERSION;

            wp_register_style($handle, $style['src'], $deps, $version);
            wp_enqueue_style($handle);
        }

        $comments = geton_rating_get_comments($post->ID);

        wp_localize_script('gor-rating', 'gor_data', [
            'ajax_url'   => admin_url('admin-ajax.php'),
            'comments'   => $comments['comments'],
            'avg_rating' => $comments['avg_rating'],
        ]);
    }
}
