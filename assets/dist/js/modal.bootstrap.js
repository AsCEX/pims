$(document).ready(function()
{
	var dialogHTML = '<div class="dialog-dummy">'
						+'<div class="modal-dialog">'
							+'<div class="modal-content">'
							+'<div class="modal-header">'
								+'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
							+'</div>'
							+'<div class="modal-body"></div>'
							+'<div class="modal-footer"></div>'
							+'</div>'
							+'<!-- /.modal-content -->'
						+'</div>'
					+'</div>';


	$(dialogHTML).appendTo('html body');


	$(document).on('click', '.display-modal', function(e){

			var newDialog = $('.dialog-dummy').clone();
			$(newDialog).removeClass('dialog-dummy');
			$(newDialog).addClass('modal');
			$(newDialog).attr('title', $(this).attr('title'));
			var url = $(this).attr('href');

			var options = {backdrop: "static"};

			if($(this).data('type') == "pdf"){
				options.iframe = true;
			}

			openDialog(newDialog, url, options);

		e.preventDefault();
	});

	$(document).on('click', '.display-modal-pdf', function(e){
		openReceiptDialog($(this).attr('href'));

		e.preventDefault();
	});
})



getData = function(url){
	var url=url;
	return $.ajax({
		async: false,
		url: url
	});
}


openDialog = function(obj, url, options)
{
	var ajax = getData(url);
	var obj = obj;

	if(options.iframe){
		/*var save_btn = $('<button/>', {
			text: 'Print',
			id: 'btn-save',
			class: 'btn btn-primary',
			click: function () {
				window.frames['modal-pdf'].print();
			}
		});*/

		var close_btn = $('<button/>', {
			text: 'close',
			class: 'btn btn-default',
			click: function () {
				if(options.reload_on_close){
					window.location.reload();
				}else{
					closeDialog(obj);
				}
			}
		});

	}else{
		var save_btn = $('<button/>', {
			text: 'save',
			id: 'btn-save',
			class: 'btn btn-primary',
			click: function () { saveForm(obj); }
		});

		var close_btn = $('<button/>', {
			text: 'close',
			class: 'btn btn-default',
			click: function () { closeDialog(obj); }
		});
	}

	$(obj).find('.modal-footer').append('<div class="modal-status"></div>');
	$(obj).find('.modal-footer').append(save_btn);
	$(obj).find('.modal-footer').append(close_btn);


	$(obj).find('.modal-header').prepend('<h4 class="modal-title pull-left">' + obj.attr('title') + '</h4>');

	if(options.iframe){
		html = "<iframe src='" + url + "' id='modal-pdf' name='modal-pdf' style='height: 750px;width:100%;'/>";
		$(obj).find('.modal-dialog').css('width', '75%');
		$(obj).find('.modal-body').html(html);
	}else{
		ajax.success(function(data){
			$(obj).find('.modal-body').html(data);
		})
		$(obj).find('.modal-body').find('form').append('<input type="hidden" value="'+url+'" style="display:none;" name="file-url">');
	}


	$(obj).modal( options ).on('hidden.bs.modal', function () {
	$(this).data('bs.modal', null);
	$(this).remove();
});
	return obj;

}

closeDialog = function(obj)
{

	if ($(obj).find('form').find('input[name="reload_grid"]').val()) {
		var grid = $(obj).find('form').find('input[name="parent_grid"]').val();
		reloadGrid(grid);
	}

	$( obj ).modal('hide');

}


openReceiptDialog = function(rt_id)
{
	var url = "/reports/receipts?rt_id=" +  rt_id;
	var newDialog = $('.dialog-dummy').clone();
	$(newDialog).removeClass('dialog-dummy');
	$(newDialog).addClass('modal');
	$(newDialog).attr('title', 'Order Transaction Details');

	var options = {backdrop: "static", iframe: true, reload_on_close: false};
	var editDialog = openDialog(newDialog, url, options);
	//$(editDialog).find('.modal-status').html('Record Added.');
	//$(editDialog).find('input[name="reload_grid"]').val('true');
}

function getParameterByName(url, name){
	qvars = url.split('?');
	loc_search = '?' + qvars[1];

	name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(loc_search);
	return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}