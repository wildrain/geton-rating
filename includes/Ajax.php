<?php

namespace Geton\Rating;

/**
 * Ajax class
 */
class Ajax
{
    /**
     * Initialize ajax class
     */
    public function __construct()
    {
        add_action('wp_ajax_geton_rating_form', [$this, 'submit_rating']);
        add_action('wp_ajax_nopriv_geton_rating_form', [$this, 'submit_rating']);
    }

    /**
     * Submit rating
     *
     * @return void
     */
    public function submit_rating()
    {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'geton-rating-form')) {
            wp_send_json_error([
                'message' => __('Nonce verification failed!', 'geton-rating')
            ]);
        }

        $payloads = [
            'review' => $_POST['review'],
            'rating' => $_POST['rating'],
        ];
        $comment_id = geton_rating_add_comment($_POST['post_id'], $payloads);

        wp_send_json_success([
            'comment_id' => $comment_id,
            'message'    => __('Comment added successfully', 'geton-rating')
        ]);
    }
}
