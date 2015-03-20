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
    run: function() {
        this.init();
        this.togleMenu();
    }
};