(function ($) {
  const ajaxUrl = gor_data.ajax_url;
  let comments = gor_data.comments;
  let avgRating = gor_data.avg_rating;

  /**
   * loading
   * @param string selector
   */
  function block(selector = '#gor-rating') {
    $(selector).block({
      message: null,
      overlayCSS: {
        background: '#fff',
        opacity: 0.6,
      },
    });
  }

  /**
   * Unloading
   * @param string selector
   */
  function unblock(selector = '#gor-rating') {
    $(selector).unblock();
  }

  /**
   * Init input rating
   */
  $('.gor-rating').starRating({
    starSize: 25,
    initialRating: 0,
    disableAfterRate: false,
    onHover: function (currentIndex, currentRating, $el) {
      $('.live-rating').text(currentIndex);
    },
    onLeave: function (currentIndex, currentRating, $el) {
      $('.live-rating').text(currentRating);
    },
  });

  /**
   * Init avg rating
   */
  $('.gor-avg-rating').starRating({
    readOnly: true,
    initialRating: avgRating,
  });

  /**
   * Show review rating
   */
  $.each(comments, function (index, comment) {
    if (!comment.rating || comment.rating === '0.0') {
      return;
    }
    $(`.gor-rating-${comment.comment_id}`).starRating({
      readOnly: true,
      initialRating: `${comment.rating}`,
    });
  });

  /**
   * Move to rating form
   */
  $('button.add-review').click(function () {
    $('html,body').animate(
      {
        scrollTop: $('.geton-rating-form').offset().top,
      },
      'slow'
    );
  });

  /**
   * Submit rating
   */
  $('#geton-rating-form form').on('submit', function (event) {
    event.preventDefault();

    let rating = $('.gor-rating').starRating('getRating');
    let data = $(this).serialize();
    if (rating) {
      data = `${data}&rating=${rating}`;
    }

    block('.submit-section');

    $.post(ajaxUrl, data, function (response) {
      unblock('.submit-section');
      location.reload();
    }).fail(function () {
      console.log('Something goes wrong');
    });
  });
})(jQuery);
