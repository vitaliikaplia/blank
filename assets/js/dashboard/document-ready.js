/**
 * document ready
 */
(function ($) {
    $(document).ready(function () {

        if($('.custom-options-form').length){
            $(window).trigger("custom-options-form");
            $('.custom-options-form').on("change", function(e){
                $(window).trigger("custom-options-form");
            });
        }

    });
})(jQuery);
