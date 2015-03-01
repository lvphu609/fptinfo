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

    run: function() {
        this.init();
    }
};