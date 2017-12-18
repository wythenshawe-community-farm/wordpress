/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
(function ($) {

  $(function () {

    $('#customize-theme-controls').on('click', 'a[data-open-control]', function (e) {

      e.preventDefault();

      var control = $(this).attr('data-open-control');

      if (wp && wp.customize && wp.customize.control) {
        wp.customize.control(control).focus();
      }

    });

  });

})(jQuery);