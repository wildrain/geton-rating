<?php

function geton_rating_add_comment($post_id, $payloads)
{
    if (!comments_open($post_id)) {
        return false;
    }

    $data = [
        'comment_post_ID' => $post_id,
        'comment_content' => $payloads['review'],
        'comment_meta'    => ['geton-rating' => $payloads['rating']]
    ];

    $comment_id = wp_insert_comment($data);

    if (!is_wp_error($comment_id)) {
        return $comment_id;
    }

    return false;
}

function geton_rating_get_comments($post_id)
{
    $count = 0;
    $total_rating = 0;
    $results = [
        'avg_rating' => 0,
        'comments' => [],
    ];

    $args = [
        'post_id' => $post_id,
    ];

    $comments = get_comments($args);

    if (empty($comments)) {
        return $results;
    }

    foreach ($comments as $comment) {
        $rating = get_comment_meta($comment->comment_ID, 'geton-rating', true);

        if (!empty($rating) && $rating !== '0.0') {
            $total_rating += $rating;
            $count++;
        }

        $results[] = [
            'comment_id'      => $comment->comment_ID,
            'comment_post_id' => $comment->comment_post_ID,
            'review'          => $comment->comment_content,
            'rating'          => $rating
        ];
    }

    return [
        'avg_rating' => round($total_rating / $count, 2),
        'comments'   => $results
    ];
}
