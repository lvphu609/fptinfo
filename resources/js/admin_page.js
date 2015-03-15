$(document).ready(function(){
	//first load
	loadPageProcess.run(false);
});

var loadPageProcess = {
	run: function(visible){
		var load = $('#loading');
		if (visible) {
		    load.show();
		}
		else {
		    load.hide();
		}
	}
}

var articlePageCreate = {
	submitForm: function(){
		$(document).on('click','.btn-save-data-article',function(){
			loadPageProcess.run(true);
			// $('#content_html').val(tinyMCE.get('box-content-article').getContent());			
			tinyMCE.triggerSave();
    		$('#formArticle').submit();
		});
	},
	setup: function(){
		this.submitForm();
	},
	run: function(){
		this.setup();
	}
}

var articlePageList = {
	popupModelDeleteArticle:  $('#modalDeleteItemArticle'),
	deleteArticle: function(){
		var that = this;

		$(document).on('click','.buttonDelete',function(){
			var id = $(this).attr('data-id');

			that.popupModelDeleteArticle.find('.messageAlert').html('');

			that.popupModelDeleteArticle.find('.btnConfirmDeleteArticle').attr('data-id',id);

            that.popupModelDeleteArticle.modal('show');
		});

		$(document).on('click','.btnConfirmDeleteArticle',function(){
			loadPageProcess.run(true);
			var id = $(this).attr('data-id');
			var url = $('#hidUrl').val() + 'del_article';

			var data = {
				id: id
			};
			var ajax = $.ajax({
				url: url,
				data: data,
				method: 'POST',
				dataType: 'json',
				statusCode: {
				  404: function () {
				    loadPageProcess.run(false);
				    console.log("page not found");
				  },
				  500: function (data) {
				    loadPageProcess.run(false);
				    console.log(data);
				  }
				}
			});

			ajax.done(function (data) {
				if(data.status == "success"){
					$('.art-' + id).remove();
					that.popupModelDeleteArticle.modal('hide');
				}
				else{
					that.popupModelDeleteArticle.find('.messageAlert').html(data.message);
				}
				
				loadPageProcess.run(false);
			});
		});

	},
	setup: function(){
		this.deleteArticle();
	},
	run: function(){
		this.setup();
	}
}

var menuPageList ={
	popupModelDeleteArticle:  $('#modalDeleteItemMenu'),
	deleteMenu: function(){
		var that = this;

		$(document).on('click','.buttonDelete',function(){
			var id = $(this).attr('data-id');

			that.popupModelDeleteArticle.find('.messageAlert').html('');

			that.popupModelDeleteArticle.find('.btnConfirmDeleteMenu').attr('data-id',id);

            that.popupModelDeleteArticle.modal('show');
		});

		$(document).on('click','.btnConfirmDeleteMenu',function(){
			loadPageProcess.run(true);
			var id = $(this).attr('data-id');
			var url = $('#hidUrl').val() + 'del_menu';

			var data = {
				id: id
			};
			var ajax = $.ajax({
				url: url,
				data: data,
				method: 'POST',
				dataType: 'json',
				statusCode: {
				  404: function () {
				    loadPageProcess.run(false);
				    console.log("page not found");
				  },
				  500: function (data) {
				    loadPageProcess.run(false);
				    console.log(data);
				  }
				}
			});

			ajax.done(function (data) {
				if(data.status == "success"){
					$('.art-' + id).remove();
					that.popupModelDeleteArticle.modal('hide');
				}
				else{
					that.popupModelDeleteArticle.find('.messageAlert').html(data.message);
				}
				
				loadPageProcess.run(false);
			});
		});

	},
	setup: function(){
		this.deleteMenu();
	},
	run: function(){
		this.setup();
	}
}


var menuPageCreate ={
	popupSelectArticle: $('#modalShowSelectArticle'),
	selectArticle: function(){
		var that = this;
		var url = $('#hidUrl').val(); 
		$(document).on('click','.popupSelectArticle',function(){
		   	// loadPageProcess.run(true);
		   	that.popupSelectArticle.modal('show');
	        $('#box_select_articles').ajaxPaging({
	            url: url + 'ajax_article_paging',
	            param: {
	              // id: curr_id
	            },
	            position: 'bottom',
	            search: {
	              use: true,
	              url: url + 'search_article'
	            },
	            callBack: function () {
	                  

	            }
	        }); 
		});

		$(document).on('click','.cursor_pointer',function(){
			$(this).find('input.radio').prop('checked',true);
		});

		$(document).on('click','.btnSelectArt',function(){
			var radio = $("input[name='rdo_group_select_art']:checked");
			var art_id = radio.val();
			$('#mn_article_id').val(art_id);
			var title = $(radio).closest('tr').find('.title_art').html();
			$('.popupSelectArticle').val(title);
			that.popupSelectArticle.modal('hide');
		});
	},
	setup: function(){
		this.selectArticle();
	},
	run: function(){
		this.setup();
	}
}
