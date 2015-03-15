$(function( $ ){
	function AjaxPaging( settings )
	{
		/*
		 * Name: settings
		 * Value: {key: value}
		 * Description: init settings from user
		 */
		 this.settings = settings;
		 
		/*
		 * Name: target
		 * Value: tag name, id, class, ...
		 * Description: target to append result data
		 */
		this.target = null;
		
		/*
		 * Name: url
		 * Value: url
		 * Description: url to get data from server
		 */
		this.url = null;
		
		/*
		 * Name: position
		 * Value: top, bottom
		 * Description: position to view page number, top or bottom content
		 */
		this.position = 'bottom';
    
    this.align = 'center';
    this.number_paging_control = 1;
		
		/*
		 * Name: param
		 * Value: {name: value}
		 * Description: variable must be sent to server
		 */
		this.param = {};
		
		/*
		 * Name: process
		 * Value: true, false
		 * Description: show loading process
		 */
		this.process = true;
		
		/*
		 * Name: search
		 * Value: {name: value}
		 * Description: add search form
		 */
		this.search = {
			use: false,
			url: ''
		};
		
		this.callBack = null;
		this.totalField = 0;
		this.numFieldPerPage = 0;
	}
	
	/*
	 * Name: readSettings
	 * Parameter: null
	 * Return: boolean
	 * Description: read user settings and set to object variable
	 */
	AjaxPaging.prototype.readSettings = function(){
		var self = this;
		var settings = self.settings;
		if (settings == undefined || typeof(settings) != 'object') 
		{
			//console.log('Missing parameter');
			return false;
		}
		
		if (settings.target === null)
		{
			//console.log('Target is incorrect');
			return false;
		}
		
		if (settings.url === null || $.trim(settings.url) == '')
		{
			//console.log('Url is incorrect');
			return false;
		}		
		
		if (settings.position !== undefined && (settings.position == 'top' || settings.position == 'bottom'))
		{
			this.position = settings.position;
		}
    
    if (settings.align !== undefined && (settings.align == 'left' || settings.align == 'center' || settings.align == 'right'))
		{
			this.align = settings.align;
		}
    
    if (settings.number_paging_control !== undefined && (settings.number_paging_control == 1 || settings.number_paging_control == 2))
		{
			this.number_paging_control = settings.number_paging_control;
		}
		
		if (settings.process !== undefined && typeof(settings.process) == 'boolean')
		{
			this.process = settings.process;
		}
		
		if (typeof(settings.param) == 'object')
		{
			this.param = settings.param;
		}
		
		if (typeof(settings.search) == 'object' && settings.search.use && $.trim(settings.search.url) !== '')
		{
			this.search = settings.search;
		}
		
		if (settings.callBack !== undefined)
		{
			this.callBack = settings.callBack;
		}
		
		this.target = settings.target;
		this.url = $.trim(settings.url);
		return true;
	};
	
	/*
	 * Name: renderHtml
	 * Parameter: null
	 * Return: html
	 * Description: append data to html
	 */
	AjaxPaging.prototype.renderHtml = function(){
		var self = this
		var target = self.target;
		var position = self.position;
    var align = self.align;
    var number_paging_control = self.number_paging_control;
		var process = self.process;
		var content = $('<div>');
		var paging = $('<div>');		
    var paging2 = $('<div>');		
		
		target.html('');
		target.css('position', 'relative');
		
		content.addClass('ajaxPagingContent');
		content.css({
			width: '100%',
			height: '100%',
			overflow: 'auto'
		});
		
		var pageButton = '<ul class="pagination pagination-sm" style="margin-top:10px;">';
			pageButton += '<li><a href="#" class="first">&laquo;</a></li>';
      pageButton += '<li><a href="#" class="previous">&lsaquo;</a></li>';
			pageButton += '<li class="disabled"><a href="#" class="one">...</a></li>';
			pageButton += '<li><a href="#" class="two page">1</a></li>';
			pageButton += '<li class="active"><a href="#" class="three">2</a></li>';
			pageButton += '<li><a href="#" class="four page">3</a></li>';
			pageButton += '<li class="disabled"><a href="#" class="five">...</a></li>';
      pageButton += '<li><a href="#" class="next">&rsaquo;</a></li>';
			pageButton += '<li><a href="#" class="last">&raquo;</a></li>';
			pageButton += '</ul>';
			
		paging.html(pageButton);
		paging.addClass('ajaxPagingPageControl');
		paging.css({
			position: 'absolute',
			left: '0px',
			width: '100%',
//			height: '80px',
			textAlign: align,
			overflow: 'hide'
		});
    
    paging2.html(pageButton);
		paging2.addClass('ajaxPagingPageControl');
		paging2.css({
			position: 'absolute',
			left: '0px',
			width: '100%',
			height: '80px',
			textAlign: align,
			overflow: 'hide'
		});
		
		var search = self.search;
		if (typeof(search) == 'object' && search.use && $.trim(search.url) != '')
		{
			var pageSearch = '<div class="row">';
				pageSearch += '<div class="col-md-4 col-md-offset-4">';
				pageSearch += '<input type="text" class="form-control input-sm ajaxPagingPageSearch" placeholder="Tìm kiếm...">';
                pageSearch += '</div>';              
                pageSearch += '</div>';              
            paging.append($(pageSearch));
		}
		
		if(number_paging_control == 2)
    {
      target.css('padding-top', '50px');
			paging.css('top', '0px');			
      
      target.css('padding-bottom', '60px');
      paging2.css('bottom', '0px');		
    }
    else
    {
      if (position == 'top')
      {
        target.css('padding-top', '50px');
        paging.css('top', '-10px');			
      }
      else
      {
        target.css('padding-bottom', '60px');
        paging.css('bottom', '-10px');			     
      }
		}
		
		if (process)
		{
			var loading = $('<div>');
			
			loading.addClass('ajaxPagingLoading')
			loading.css({
				position: 'absolute',
				top: '0px',
				left: '0px',
				width: '100%',
				height: '100%',
				textAlign: 'center',
				paddingTop: '3%',
				color: '#268ed0',
//				backgroundColor: 'rgba(0,0,25,.5)',
				zIndex: '99999'
			});
			loading.text('Chờ chút xíu...');
			target.append(loading);
		}
    if(number_paging_control == 2)
    {
      target.append(content).append(paging).append(paging2);
    }
    else
    {
      target.append(content).append(paging);
    }
	};
	
	/*
	 * Name: resetPaging
	 * Parameter: null
	 * Return: null
	 * Description: reset all button in paging
	 */
	AjaxPaging.prototype.resetPaging = function(){
		var self = this;
		var target = self.target;
		
		target.find('.ajaxPagingPageControl').find('ul').show();
		target.find('.first').parent().removeClass('disabled');
    target.find('.previous').parent().removeClass('disabled');
		target.find('.one').show();
		target.find('.two').show();
		target.find('.four').show();
		target.find('.five').show();
    target.find('.next').parent().removeClass('disabled');
		target.find('.last').parent().removeClass('disabled');
		target.find('.ajaxPagingPageSearch').val('');
	};
	
	/*
	 * Name: controlPaging
	 * Parameter: page
	 * Return: null
	 * Description: control paging button
	 */
	AjaxPaging.prototype.controlPaging = function(page){
		var self = this;
		var target = self.target;
		var total = parseInt(self.totalField);
		var numPerPage = parseInt(self.numFieldPerPage);
		var first = target.find('.first');
    var previous = target.find('.previous');
		var one = target.find('.one');
		var two = target.find('.two');
		var three = target.find('.three');
		var four = target.find('.four');
		var five = target.find('.five');
    var next = target.find('.next');
		var last = target.find('.last');

		var numPage = 0;
		if (total%numPerPage == 0)
		{
			numPage = total/numPerPage;
		}
		else
		{
			numPage = (total - total%numPerPage)/numPerPage + 1;
		}

		if (numPage <= 1)
		{
			target.find('.ajaxPagingPageControl').hide();
		}
		else if (page == 1)
		{
			self.resetPaging();
			first.parent().addClass('disabled');
      previous.parent().addClass('disabled');
			one.hide();
			two.hide();
			three.text(1);
			four.text(2);
			if (numPage <= 2)
			{
				five.hide();
			}
		}
		else if (page == numPage)
		{
			self.resetPaging();
			if (numPage <= 2)
			{
				one.hide();
			}
			two.text(page - 1);
			three.text(page);
			four.hide();
			five.hide();
			last.parent().addClass('disabled');
      next.parent().addClass('disabled');
		}
		else
		{
			self.resetPaging();
			if (page - 2 <=0)
			{
				one.hide();
			}
			two.text(page - 1);
			three.text(page);
			four.text(page + 1);
			if (page + 2 > numPage)
			{
				five.hide();
			}
		}
	};
		
	/*
	 * Name: renderEvent
	 * Parameter: null
	 * Return: null
	 * Description: render all event in object
	 */
	AjaxPaging.prototype.renderEvent = function(){
		var self = this;
		var target = self.target;

    target.off('click', '.page');
    target.off('click', '.first');
    target.off('click', '.previous');
    target.off('click', '.next');
    target.off('click', '.last');
    target.off('keyup', '.ajaxPagingPageSearch');		    
    
		target.on('click', '.page', function(){		
      var page = parseInt($(this).text());
			self.getData(page);
		});
    
		target.on('click', '.first', function(){
			if ($(this).parent().hasClass('disabled'))
			{
				return;
			}
			self.getData(1);
		});
    
    target.on('click', '.previous', function(){
			if ($(this).parent().hasClass('disabled'))
			{
				return;
			}
      var page = parseInt($(this).closest('ul').find('li.active').text());
			self.getData(page - 1);
		});
    
		target.on('click', '.last', function(){
			if ($(this).parent().hasClass('disabled'))
			{
				return;
			}
			var total = parseInt(self.totalField);
			var numPerPage = parseInt(self.numFieldPerPage);
			var numPage = (total - total%numPerPage)/numPerPage;
            if (total%numPerPage !== 0)
            {
                numPage += 1;
            }
			self.getData(numPage);
		});
    
    target.on('click', '.next', function(){
			if ($(this).parent().hasClass('disabled'))
			{
				return;
			}			
      var page = parseInt($(this).closest('ul').find('li.active').text());
			self.getData(page+1);      
		});
		
		target.on('keyup', '.ajaxPagingPageSearch', function(e){
			var key = $.trim($(this).val());
			if (e.which == 13 && key !== '')
			{				
				self.getDataByKey(key);
			}
			else if (key === '')
			{
				self.getData(1);
			}
		});
	};
	
	/*
	 * Name: getData
	 * Parameter: page
	 * Return: {html, totalField, numFieldPerPage}
	 * Description: get data from server
	 */
	AjaxPaging.prototype.getData = function(page){		
		var self = this;
		var target = self.target;
		var loading = target.find('.ajaxPagingLoading');
		var url = self.url;
		var param = $.extend({
			page: page
		}, self.param);
		
		loading.show();
		var req = $.ajax({
			url: url,
			data: param,
			method: 'post',
			dataType: 'json',
			statusCode: {
				404: function(){
					loading.hide();
					//console.log('404 ' + url + ' can not found!');
				},
				500: function(){
					loading.hide();
					//console.log('500 Server error!');
				}
			}
		});
		
		req.fail(function( jqXHR, textStatus ) {
			loading.hide();
			//console.log( "Request failed: " + textStatus );
		});
		
		req.done(function(data){
			self.totalField = data.totalField;
			self.numFieldPerPage = data.numFieldPerPage;
			self.controlPaging(page);
			target.find('.ajaxPagingContent').html(data.html);
            
			self.callBack();
			loading.hide();
		});
	};
	
	/*
	 * Name: getDataByKey
	 * Parameter: page
	 * Return: {html, totalField, numFieldPerPage}
	 * Description: get data from server
	 */
	AjaxPaging.prototype.getDataByKey = function(key){
		var self = this;
		var target = self.target;
		var loading = target.find('.ajaxPagingLoading');
		var url = self.search.url;
		var param = $.extend({
			key: key
		}, self.param);
		
		loading.show();
		var req = $.ajax({
			url: url,
			data: param,
			method: 'post',
			dataType: 'html',
			statusCode: {
				404: function(){
					loading.hide();
					//console.log('404 ' + url + ' can not found!');
				},
				500: function(){
					loading.hide();
					//console.log('500 Server error!');
				}
			}
		});
		
		req.fail(function( jqXHR, textStatus ) {
			loading.hide();
			//console.log( "Request failed: " + textStatus );
		});
		
		req.done(function(data){
			target.find('.ajaxPagingPageControl').find('ul').hide();
			target.find('.ajaxPagingContent').html(data);
			self.callBack();
			loading.hide();
		});
	};
	
	AjaxPaging.prototype.init = function(){
		var self = this;
		
		self.readSettings();
		self.renderHtml();
		self.getData(1);
		self.renderEvent();
	};

	$.fn.ajaxPaging = function( options ){
		var settings = $.extend({
			target: this
		}, options);

		var obj = new AjaxPaging(settings);
		obj.init();
        obj = null;
        delete obj;
		return this;
	};
}( jQuery ));