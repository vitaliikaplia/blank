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
            $('.custom-settings-page-tabs a').on("click", function(e){
                let targetTab = $(this).attr('href');
                $('.custom-settings-page-tabs a').removeClass('nav-tab-active');
                $('.form-table-options').hide();
                $('#for_tab_' + targetTab.replace('#','')).show();
                $(this).addClass('nav-tab-active');
            });
            // check if hash in url
            if(window.location.hash){
                var hash = window.location.hash;
                $('.custom-settings-page-tabs a').each(function(){
                    let targetTab = $(this).attr('href');
                    if(targetTab == hash){
                        $('.custom-settings-page-tabs a').removeClass('nav-tab-active');
                        $('.form-table-options').hide();
                        $('#for_tab_' + targetTab.replace('#','')).show();
                        $(this).addClass('nav-tab-active');
                    }
                });
            }
        }

        if($('.inside .mailPreview').length){
            $('.inside .mailPreview').on('load', function() {
                try {
                    var iframe = $(this)[0]; // DOM-елемент
                    var contentHeight = iframe.contentWindow.document.body.scrollHeight;
                    $(this).height(contentHeight);
                } catch (e) {
                    console.warn('Не вдалося отримати висоту iframe (можливо, інший домен).');
                }
            });
        }

    });
})(jQuery);
