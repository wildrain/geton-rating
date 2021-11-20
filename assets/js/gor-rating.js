(function ($) {
  const ajaxUrl = gor_data.ajax_url;
  let comments = gor_data.comments;

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

  $('.gor-avg-rating').starRating({
    readOnly: true,
    initialRating: 3.31,
  });

  $.each(comments, function (index, comment) {
    if (!comment.rating) {
      return;
    }
    $(`.gor-rating-${comment.comment_id}`).starRating({
      readOnly: true,
      initialRating: `${comment.rating}`,
    });
  });

  $('#geton-rating-form form').on('submit', function (event) {
    event.preventDefault();

    let rating = $('.gor-rating').starRating('getRating');
    let data = $(this).serialize();
    if (rating) {
      data = `${data}&rating=${rating}`;
    }

    $.post(gor_data.ajax_url, data, function (response) {
      console.log('response ', response);
      location.reload();
    }).fail(function () {
      console.log('Something goes wrong');
    });
  });
})(jQuery);
