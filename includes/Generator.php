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
        register_post_type(
            'movie',
            [
                'labels' => [
                    'name'          => __('Movies', 'geton-rating'),
                    'singular_name' => __('Movie', 'geton-rating')
                ],
                'public'       => true,
                'has_archive'  => true,
                'rewrite'      => ['slug' => 'movie'],
                'supports'     => ['title', 'editor',  'author', 'thumbnail', 'comments', 'custom-fields'],
                'show_in_rest' => true,
            ]
        );
    }
}
