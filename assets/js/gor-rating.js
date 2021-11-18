(function($) {
  $('#marlin-enquiry-form form').on('submit', function(event) {
    event.preventDefault();

    var data = $(this).serialize();

    console.log(data);

    $.post(marlin.ajax_url, data, function(response) {
      console.log('response ', response);
    }).fail(function() {
      console.log(marlin.message);
    });
  });
})(jQuery);
