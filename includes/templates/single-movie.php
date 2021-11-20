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
        <strong class="avg-rating-count"><?php echo esc_attr($avg_rating); ?></strong>
        <span class="gor-avg-rating"></span>

        <div class="button-section">
            <button class="add-review">Add Review</button>
        </div>
    </div>


    <h3><?php echo esc_html__('Reviews', 'geton-rating'); ?></h3>
    <ul class="gor-comments">
        <?php foreach ($comments as $comment) : ?>
            <li class="comment">
                <?php if (!empty($comment['rating']) && $comment['rating'] !== '0.0') : ?>
                    <span class="rating gor-rating-<?php echo esc_attr($comment['comment_id']); ?>"></span>
                    <strong class="rating-count"><?php echo esc_attr($comment['rating']); ?>,</strong>
                <?php endif; ?>
                <span class="review"><?php echo wp_kses($comment['review'], wp_kses_allowed_html()); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="geton-rating-form" id="geton-rating-form">
        <h2><?php echo esc_html__('What\'s your rating', 'geton-rating'); ?></h2>

        <form action="" method="post">
            <div class="form-row">
                <h3><?php echo esc_html__('Rating', 'geton-rating'); ?></h3>
                <span class="gor-rating"></span>
                <span class="live-rating"></span>
            </div>

            <div class="form-row">
                <h3><?php echo esc_html__('Review', 'geton-rating'); ?></h3>
                <textarea name="review" id="review" placeholder="<?php echo esc_html__('Start typing...', 'geton-rating'); ?>" rows="6" cols="50" required></textarea>
            </div>

            <div class="form-row submit-section">
                <?php wp_nonce_field('geton-rating-form'); ?>
                <input type="hidden" name="post_id" value="<?php echo esc_attr($post->ID); ?>">
                <input type="hidden" name="action" value="geton_rating_form">
                <input type="submit" name="send_rating" value="<?php esc_attr_e('Submit Review', 'geton-rating'); ?>">
            </div>

        </form>
    </div>

</div>


<?php get_footer(); ?>