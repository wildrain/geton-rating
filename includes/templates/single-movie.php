<?php get_header(); ?>

<div class="geton-rating-form" id="geton-rating-form">

    <?php
    global $post;
    $reviews = geton_rating_get_comments($post->ID);
    ?>

    <form action="" method="post">

        <span class="my-rating"></span>
        <span class="live-rating"></span>

        <div class="form-row">
            <label for="review"><?php _e('Review', 'geton-rating'); ?></label>
            <textarea name="review" id="review" required></textarea>
        </div>

        <div class="form-row">
            <?php wp_nonce_field('geton-rating-form'); ?>
            <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
            <input type="hidden" name="action" value="geton_rating_form">
            <input type="submit" name="send_rating" value="<?php esc_attr_e('Send Review', 'geton-rating'); ?>">
        </div>

    </form>
</div>




<?php get_footer(); ?>