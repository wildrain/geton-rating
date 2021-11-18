<?php

namespace  Geton\Rating;

/**
 * Generator class
 */
class Generator
{
    /**
     * Init class
     */
    function __construct()
    {
        add_action('init', array($this, 'register_post_type'), 10, 1);
    }

    public function register_post_type()
    {
        // Set UI labels for Custom Post Type
        register_post_type(
            'movies',
            // CPT Options
            array(
                'labels' => array(
                    'name' => __('Movies'),
                    'singular_name' => __('Movie')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'movie'),
                'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
                'show_in_rest' => true,
            )
        );
    }
}
