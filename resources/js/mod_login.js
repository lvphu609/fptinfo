var adminLogin = {
  init:function(){    
    
  }, 
  rememberAccount: function(){
    $(document).on('click', '#remember', function() {
       var value = $(this).val();
       if(parseInt(value)==0){
         $(this).val('1');
       }
       else{
         $(this).val('0');
       }
     });
  },
  formSubmit:function(){
    $('#fpt-login-form').submit(function(e){
       $('input[name=encrypt-password]').val($.md5($('input[name=password]').val()))
    });
  },
  setup: function(){
    this.init();
    this.rememberAccount();
    this.formSubmit();
  },
  run: function(){
    this.setup();
  }
}

var adminPage = {
  setup: function(){

  },
  run: function(){
    this.setup();
  }
}