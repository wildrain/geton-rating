<?php

namespace Marlin\Frontend;

/**
 * Shortcode class
 */
class Shortcode
{
    /**
     * Initialize class
     */
    public function __construct()
    {
        add_shortcode('marlin_shortcode', [$this, 'marlin_shortcode']);
        add_shortcode('marlin_enquiry', [$this, 'marlin_enquiry']);
    }

    /**
     * Shortcode
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function marlin_shortcode($atts, $content = null)
    {
        wp_enqueue_script('marlin-script');
        wp_enqueue_style('marlin-style');

        ob_start();

        include __DIR__ . '/views/shortcode.php';

        return ob_get_clean();
    }

    /**
     * Shortcode
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function marlin_enquiry($atts, $content = null)
    {
        wp_enqueue_script('marlin-enquiry-script');
        wp_enqueue_style('marlin-style');

        wp_localize_script('marlin-enquiry-script', 'marlin', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'message' => __('Message from enquiry form', 'marlin'),
        ]);

        ob_start();

        include __DIR__ . '/views/enquiry.php';

        return ob_get_clean();
    }
}
