(function ($) {
  setStarRating();
  function setStarRating() {
    $('.my-rating').starRating({
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
  }

  $('#geton-rating-form form').on('submit', function (event) {
    event.preventDefault();

    let rating = $('.my-rating').starRating('getRating');
    let data = $(this).serialize();

    if (rating) {
      data = `${data}&rating=${rating}`;
    }

    let self = $(this);

    console.log(data, 'data');

    $.post(gor_data.ajax_url, data, function (response) {
      console.log('response ', response);
    }).fail(function () {
      console.log('Something goes wrong');
    });
  });
})(jQuery);
