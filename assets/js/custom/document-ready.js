/**
 * Document ready
 */
(function ($) {
    $(document).ready(function () {

        /**
         * Add os and browser classes for body
         */
        if(pgwBrowser.browser.group){
            $("body").addClass(pgwBrowser.browser.group.replace(" ","").toLowerCase());
        }
        if(pgwBrowser.os.group){
            $("body").addClass(pgwBrowser.os.group.replace(" ","").toLowerCase());
        }

    });
})(jQuery);
