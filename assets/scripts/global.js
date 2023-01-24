(function($) {

  function scrollToAnchor (url) {
    var urlHash = url.split('#')[1];
    if (urlHash &&  $('#' + urlHash).length) {
      $('html, body').animate({
        scrollTop: $('#' + urlHash).offset().top - 100
      }, 500 );
      return false;
    }
  }

  $(document).ready(function(){

    scrollToAnchor(window.location.href);

    var $root = $('html, body');

    $('a[href^="#"]').click(function () {
      $root.animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top - 100
      }, 500);

      return false;
    });


  });

}(jQuery));