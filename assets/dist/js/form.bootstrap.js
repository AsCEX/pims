$(document).ready(function()
{
    $('input.datepicker').datepicker({
        inline: true,
        dateFormat: "yy/mm/dd"
    });
})

saveForm = function(formObj, callback)
{
    if(!$(formObj).find('form').valid()){
        return false;
    }

    $(formObj).find('#btn-save').attr('disabled', true).attr('disabled','disabled');

    //var formObj = $(formObj).parent('.modal');
    $(formObj).find('.modal-status').html('');


    var form = $(formObj).find('form');
    url = form.attr('action');
    console.log(url);
    var data = $(formObj).find('form').serialize();
    $(formObj).find('form').find('.error').removeClass('error');

    $.ajax({
        url: url,
        data: data,
        method: 'POST',
        success: function(data){
            if (typeof(data) == 'object') {
                if (data.status == 'success') {

                    if($(formObj).find('input[name="close_after_save"]').val()){
                        $(formObj).find('input[name="reload_grid"]').val('true');
                        closeDialog(formObj);
                    }else if($(formObj).find('input[name="open_pdf"]').val()){
                        openReceipt(data.id);
                    }else{
                        var updateMsg;
                        if (data.action == 'update') {
                            $(formObj).find('.modal-status').html('Record Updated.');
                            $(formObj).find('input[name="reload_grid"]').val('true');
                            closeDialog(formObj);
                        } else {
                            var lastid = data.lastid;
                            urledit = $(formObj).find('form input[name="file-url"]').val();

                            if(!$(formObj).find('input[name="close_after_save"]').val()) {
                                $(formObj).modal('hide').data('modal', null);
                            }

                            var remain_url = $(formObj).find('form input[name="remain-url"]').val();

                            if(remain_url != undefined){
                                openEditFromSave(urledit);
                            }else{
                                if (urledit != undefined) {
                                    if(data.params != undefined || data.params != ""){
                                        closeDialog(formObj);
                                        var tmp_url = urledit.split('?');
                                        urledit = tmp_url[0];
                                        //urledit = urledit+'/' + data.params;
                                        urledit = urledit+'/' + lastid;
                                    }else{
                                        urledit = urledit+'/'+lastid;
                                    }

                                    openEditFromSave(urledit);

                                }
                            }
                        }

                    }
                } else {
                    var errors = data.errors;
                    $(formObj).find('.modal-status').html('There are errors in your form.');
                    $.each($(errors), function(x, error) {
                        var fld = $(formObj).find('form').find('[name="'+error.label+'"]');
                        $(fld).addClass('error');
                    });
                }
            } else {
                $(formObj).find('.modal-status').html('Processing Error.');
            }
            $(formObj).find('#btn-save').attr('disabled', false).removeClass('ui-state-disabled');
        }
    });

}

openEditFromSave = function(url)
{
    var url = url;
    var newDialog = $('.dialog-dummy').clone();
    $(newDialog).removeClass('dialog-dummy');
    $(newDialog).addClass('modal');
    $(newDialog).attr('title', 'Record Added.');

    var options = {backdrop: "static"};
    var editDialog = openDialog(newDialog, url, options);
    $(editDialog).find('.modal-status').html('Record Added.');
    $(editDialog).find('input[name="reload_grid"]').val('true');
}


openReceipt = function(rt_id)
{
    var url = "/reports/receipts?rt_id=" +  rt_id;
    var newDialog = $('.dialog-dummy').clone();
    $(newDialog).removeClass('dialog-dummy');
    $(newDialog).addClass('modal');
    $(newDialog).attr('title', 'Order Transaction Details');

    var options = {backdrop: "static", iframe: true, reload_on_close: true};
    var editDialog = openDialog(newDialog, url, options);
    //$(editDialog).find('.modal-status').html('Record Added.');
    //$(editDialog).find('input[name="reload_grid"]').val('true');
}
