<?php get_header(); ?>

<div class="average-rating">
    <span class="gor-avg-rating"></span>
</div>


<div class="geton-rating-form" id="geton-rating-form">

    <?php
    global $post;
    $comments = geton_rating_get_comments($post->ID)['comments'];
    ?>

    <ul class="gor-comments">
        <?php foreach ($comments as $comment) : ?>
            <li class="comment">
                <?php if (!empty($comment['rating'])) : ?>
                    <span class="rating gor-rating-<?php echo $comment['comment_id']; ?>"></span>
                    <span class="rating-count"><?php echo $comment['rating']; ?></span>
                <?php endif; ?>
                <span class="review"><?php echo $comment['review']; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="" method="post">

        <span class="gor-rating"></span>
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