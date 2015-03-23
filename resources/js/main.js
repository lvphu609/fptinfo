$(function() {
    console.log('Ready to enjoy...');
    App.run();
});
var App = {
    init: function() {
        this.document = $(document);
        this.loading.hide();
    },

    loading: {
        show: function() {
            $('#loading').show();
        },
        hide: function() {
            $('#loading').hide();
        }
    },
    togleMenu: function(){
        $(document).on('click','.btn-navbar-collapse-right',function(){
             $('#navbarCollapse').collapse('hide');
             $('#navbarCollapseLeft').collapse('hide');
        });
         $(document).on('click','.btn-navbar-collapse-top',function(){
             $('#navbarCollapseRight').collapse('hide');
             $('#navbarCollapseLeft').collapse('hide');
        });
          $(document).on('click','.btn-navbar-collapse-left',function(){
             $('#navbarCollapse').collapse('hide');
             $('#navbarCollapseRight').collapse('hide');
        });
    },
    scrollTop: function(){
       $(function(){
            $(document).on( 'scroll', function(){
         
                if ($(window).scrollTop() > 100) {
                    $('.scroll-top-wrapper').addClass('show');
                } else {
                    $('.scroll-top-wrapper').removeClass('show');
                }
            });
         
            $('.scroll-top-wrapper').on('click', scrollToTop);
        });
         
        function scrollToTop() {
            verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
            element = $('body');
            offset = element.offset();
            offsetTop = offset.top;
            $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
        }
    },
    run: function() {
        this.init();
        this.togleMenu();
        this.scrollTop();
    }
};