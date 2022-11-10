(function ($, Drupal, once) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      check_even_odd();
      window.setInterval(function () {
        check_even_odd();
      }, 1000);

      function check_even_odd() {
        if (Date.now() % 2) {
          $("div#even-or-odd").html("Server time contains an even number");
        }
        else {
          $("div#even-or-odd").html("Server time contains an odd number");
        }
      }
    }
  };
})(jQuery, Drupal, once);
