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
	escapeHtml:function (unsafe) {
          return unsafe
               .replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#039;");
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
	popupSelectParentMenu: $('#modalShowSelectParentMenu'),
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

		$(document).on('click','.btn-clear-article-id',function(){
			$('#mn_article_id').val('');
			$('.popupSelectArticle').val('');
		});
	},
	selectPosition: function(){
		$(document).on('click','.selectPosition',function(){
			if($(this).val() != 'top'){
				$('.inputSlectParent').removeClass('hidden');
			}else{
				$('.inputSlectParent').addClass('hidden');
			}
		});
	},
	selectParentMenu: function(){
		var that = this;
		var url = $('#hidUrl').val(); 
		$(document).on('click','.popupSelectParentMenu',function(){
		   	// loadPageProcess.run(true);
		   	that.popupSelectParentMenu.modal('show');
	        var pos = $('.selectPosition').val();
	        var menuId = $('.menu-item-id').val();

	        $('#box_select_parent_menu').ajaxPaging({
	            url: url + 'ajax_menu_paging',
	            param: {
	              pos: pos,
	              menu_id: menuId
	            },
	            position: 'bottom',
	            search: {
	              use: true,
	              url: url + 'ajax_search_menu'
	            },
	            callBack: function () {
	                  

	            }
	        }); 
		});

		$(document).on('click','.cursor_pointer',function(){
			$(this).find('input.radio').prop('checked',true);
		});

		$(document).on('click','.btnSelectParent',function(){
			var radio = $("input[name='rdo_group_select_parent']:checked");
			var art_id = radio.val();
			$('#mn_parent_id').val(art_id);
			var title = $(radio).closest('tr').find('.title_art').html();
			$('.popupSelectParentMenu').val(title);
			that.popupSelectParentMenu.modal('hide');
		});

		$(document).on('click','.btn-clear-parent-menu',function(){
			$('#mn_parent_id').val('');
			$('.popupSelectParentMenu').val('');
		});
	},
	setup: function(){
		this.selectArticle();
		this.selectPosition();
		this.selectParentMenu();
	},
	run: function(){
		this.setup();
	}
	
}


var carouselList = {
	popupModelDeleteCarousel:  $('#modalDeleteItemCarousel'),
	deleteCarousel: function(){
		var that = this;

		$(document).on('click','.buttonDelete',function(){
			var id = $(this).attr('data-id');

			that.popupModelDeleteCarousel.find('.messageAlert').html('');

			that.popupModelDeleteCarousel.find('.btnConfirmDeleteCarousel').attr('data-id',id);

            that.popupModelDeleteCarousel.modal('show');
		});

		$(document).on('click','.btnConfirmDeleteCarousel',function(){
			loadPageProcess.run(true);
			var id = $(this).attr('data-id');
			var url = $('#hidUrl').val() + 'del_carousel';

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
					that.popupModelDeleteCarousel.modal('hide');
				}
				else{
					that.popupModelDeleteCarousel.find('.messageAlert').html(data.message);
				}
				
				loadPageProcess.run(false);
			});
		});

	},
	setup: function(){
		this.deleteCarousel();
	},
	run: function(){
		this.setup();
	}
}

var carouselPageCreate = {
	selectImage: function(){
		$("#image_link").observe_field(1, function( ) {
	        $('.popupSelectImage').val(this.value);
	        $('#myModalImage').modal('hide');
	    });
	},
	setup: function(){
		this.selectImage();
	},
	run: function(){
		this.setup();
	}
}