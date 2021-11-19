<?php

namespace Geton\Rating;

/**
 * Frontend class
 */
class Frontend
{
    /**
     * Initialize class
     */
    public function __construct()
    {
        add_filter('single_template', [$this, 'override_single_template']);
    }

    /**
     * Override single template
     *
     * @param string $single_template
     * @return string
     */
    public function override_single_template($single_template)
    {
        global $post;

        $file = dirname(__FILE__) . '/templates/single-' . $post->post_type . '.php';

        if (file_exists($file)) {
            $single_template = $file;
        }

        return $single_template;
    }
}
