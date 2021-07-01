$(document).ready(function (){ 


    var files;
    $('.SocityFileUploadGallery').on('change', prepareUpload);
    function prepareUpload(event)
    {
        $('.pleaseWaitUpload').show();
        event.stopPropagation();
        event.preventDefault();
        var folder = $(this).attr('data-folder');
        var url = $(this).attr('data-url');
        files = event.target.files;
        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });
            data.append('folder', folder);
        $.ajax({
            url: url,
            type: 'POST',
            data:data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(data)
            {
                $('.pleaseWaitUpload').hide();
                if (data.status == 'success')
                {
                    $.each( data.attachments, function( key, file ) {

                        if($('#isSingle').val()  == 1){
                            var htmlData = '<div class=" animated fadeIn col-md-3 d-inline">' +
                                '<input type="hidden" value="'+ file.id +'"  name="attachment">' +
                                '<a class="img-link img-link-zoom-in img-thumb img-lightbox" href="'+file.img+'">' +
                                '<img class="img-fluid" style="width: 200px; height: 200px" src="'+file.img+'" alt="">' +
                                '</a>' +
                                '</div>';

                            $('.NewImages').html(htmlData);
                        }else {
                            var htmlData = '<div class=" animated fadeIn col-md-3 d-inline">' +
                                '<input type="hidden" value="'+ file.id +'"  name="attachment[]">' +
                                '<a class="img-link img-link-zoom-in img-thumb img-lightbox" href="'+file.img+'">' +
                                '<img class="img-fluid" style="width: 200px; height: 200px" src="'+file.img+'" alt="">' +
                                '</a>' +
                                '</div>';

                            $('.NewImages').append(htmlData);
                        }
                    });
                }
                if (data.status == 'validation')
                {
                    $('.pleaseWaitUploadError').show();
                    $('.pleaseWaitUploadError .message').html(data.message);
                    setTimeout(function(){
                        $('.pleaseWaitUploadError').hide();
                    }, 4000);
                }
                $('.pleaseWaitUpload').fadeOut('slow');
            },
            error: function()
            {
                $('.pleaseWaitUpload').fadeOut('slow');
            }
        });
    }

    $('.ManageImagesGallery').on('click' , '.deleteGlobalBtn', function () {
        var url = $(this).attr('data-url');
        if(url != ''){
            $('.ModelDeleteFormValidation').attr('action', url);
            $('#deleteModelGlobal').modal('show');
        }
    });

    $('.GlobalFormValidationAttachmentDelete')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            }
        })
        .on('success.form.fv', function(e) {
            var form = $(this);
            e.preventDefault();
            form.find('#success').addClass('hidden');
            form.find('#error').addClass('hidden');
            form.find('#please-wait').removeClass('hidden');
            $.ajax({
                type: "POST",
                cache: false,
                url: form.attr('action'),
                data: form.serialize(),
                success: function(json){
                    $('.ModelDeleteFormValidation').attr('action', '');
                    form.find('#please-wait').addClass('hidden');
                    if(json.status == 'success'){
                        var success = form.find('#success');
                        success.find('.message').text(json.message);
                        success.removeClass('hidden');


                        $('.attachment_'+json.id).remove();
                        setTimeout(function(){
                            $('#deleteModelGlobal').modal('hide');
                            $('button.disabled').removeAttr('disabled');
                            form.find('#success').addClass('hidden');
                        }, 2000);


                    } else if(json.status == 'false') {
                        var error = form.find('#error');
                        error.find('.message').text(json.message);
                        error.removeClass('hidden');

                        setTimeout(function(){
                            form.find('#error').addClass('hidden');
                        }, 3000);

                    } else if(json.status == 'validation'){
                        var error = form.find('#error');
                        error.find('.message').text(json.message);
                        error.removeClass('hidden');

                        setTimeout(function(){
                            form.find('#error').addClass('hidden');
                        }, 3000);

                    }else if(json.status == 'error'){
                        var error = form.find('#error');
                        error.find('.message').text(json.message);
                        error.removeClass('hidden');

                        setTimeout(function(){
                            form.find('#error').addClass('hidden');
                        }, 3000);
                    }
                },
                error : function(json){
                    var error = form.find('#error');
                    error.find('.message').text(json.message);
                    error.removeClass('hidden');

                    setTimeout(function(){
                        form.find('#error').addClass('hidden');
                    }, 3000);
                },
                dataType: "json"
            });
        });
});