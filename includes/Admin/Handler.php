<?php

namespace Geton\Rating\Admin;

class Handler
{
    /**
     * Class initialize
     */
    function __construct()
    {
        add_filter('use_block_editor_for_post_type', [$this, 'disable_gutenberg_for_movie'], 10, 2);
    }

    /**
     * Disable gutenberg editor for movie post
     *
     * @param boolean $current_status
     * @param string $post_type
     * @return boolean
     */
    public function disable_gutenberg_for_movie($current_status, $post_type)
    {
        if ($post_type === 'movie') {
            return false;
        }

        return $current_status;
    }
}
