<?php
get_header();

global $post;
$comment_details = geton_rating_get_comments($post->ID);

$comments = $comment_details['comments'];
$avg_rating = $comment_details['avg_rating'];

?>
<div id="gor-content" class="gor-content">

    <h2><?php echo get_the_title($post->ID); ?></h2>
    <div class="average-rating">
        <strong class="avg-rating-count"><?php echo $avg_rating; ?></strong>
        <span class="gor-avg-rating"></span>
    </div>

    <h3><?php echo esc_html__('Reviews', 'gor-rating'); ?></h3>
    <ul class="gor-comments">

        <?php foreach ($comments as $comment) : ?>
            <li class="comment">
                <?php if (!empty($comment['rating'])) : ?>
                    <span class="rating gor-rating-<?php echo $comment['comment_id']; ?>"></span>
                    <strong class="rating-count"><?php echo $comment['rating']; ?>,</strong>
                <?php endif; ?>
                <span class="review"><?php echo $comment['review']; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="geton-rating-form" id="geton-rating-form">
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

</div>


<?php get_footer(); ?>