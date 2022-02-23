//@prepros-prepend plugins/jquery.ba-dotimeout.js

/**
 * Store options by ajax
 *
 * @param this_option_label
 * @param this_option_value
 * @param type
 */
function store_all_widget_options_by_ajax(this_option_label, this_option_value, type){

    jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        dataType: "json",
        cache: false,
        data: {
            action: "change_widget_option",
            type: type,
            label: this_option_label,
            val: this_option_value
        },
        beforeSend: function() {
            // console.log(this_option_label);
            // console.log(this_option_value);
        },
        success : function (out) {
            // console.log(out);
            jQuery(".widget-options-inner").removeClass('wait');
        }
    });

}

/**
 * Document ready functions
 */
(function ($) {
    $(document).ready(function () {

        /**
         * Store option by checkbox
         */
        $('.widget-options-inner .widget-options-checkbox').change(function () {
            $(".widget-options-inner").addClass('wait');
            store_all_widget_options_by_ajax($(this).attr("id"), $(this).is(":checked"), 'checkbox');
        });

        /**
         * Store option by number + text
         */
        $(".widget-options-inner .widget-options-number,.widget-options-inner .widget-options-text").bind('keyup', function(){
            $(".widget-options-inner").addClass('wait');
            $(this).doTimeout( 'text-type', 1000, function(){
                store_all_widget_options_by_ajax($(this).attr("id"), $(this).val().trim(), 'number');
            });
        });

        /**
         * Store option by textarea
         */
        $(".widget-options-inner .widget-options-textarea").bind('keyup', function(){
            $(".widget-options-inner").addClass('wait');
            $(this).doTimeout( 'text-type', 1000, function(){
                store_all_widget_options_by_ajax($(this).attr("id"), $(this).val().trim(), 'textarea');
            });
        });

    });
})(jQuery);
