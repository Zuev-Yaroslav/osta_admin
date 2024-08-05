$(() => {
    const loadImg = (input, img) => {
        if ($(input.target).val() == '') {
            $(img).prop('src', '');
            $(img).addClass('d-none')
        }
        else {
            let file = $(input.target).prop('files')[0];
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                $(img).prop('src', reader.result);
                $(img).removeClass('d-none')
            }
        }
    }
    var switcher = false;
    $('#SelectPossible').on('click', function () {

        switch (switcher) {
            case false:
                $(this).text('Отменить')
                $('.checkbox-id').removeClass('d-none')
                $('#DeleteMultiple').removeClass('d-none')
                switcher = true;
                break;
            case true:
                $(this).text('Множественный выбор')
                $('.checkbox-id').addClass('d-none')
                $('#DeleteMultiple').addClass('d-none')
                switcher = false;
                break;
        }
    })
    $('input.checkbox-id').on('change', function() {
        
        if ($('input.checkbox-id:checked').length > 0){
            $('#DeleteMultiple').prop('disabled', false)
        }
        else{
            $('#DeleteMultiple').prop('disabled', true)
        }
    })
    $('#DeleteMultiple').on('click', function(e) {
        e.preventDefault();
        if (!confirm('Точно хотите удалить?')) {
            return;
        }

        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData();
        data.append('_method', 'delete')
        data.append('_token', $('meta[name=csrf-token]').prop('content'))
        $.each($('input.checkbox-id'), (index, value) => {
            if ($(value).prop('checked')) {
                const deleteRecord = async () => {
                    await $.ajax({
                        url: $(value).data('delete-url'),
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: (res) => {
                            // setTimeout(() => {
                                
                            // }, 500);
                        },
                        error: (err) => {
                            // var i = 0;
                            $.each(err.responseJSON.errors, (key, val) => {
                                console.log(key);
                            });
                        }
            
                    })
                }
                deleteRecord()
            }
        })
        location.reload();
    })
    $('#error-dismiss').on('click', function() {
        $('#error').modal('toggle');
    })
    $(document).on('change', '.image-input', (e) => {
        loadImg(e, '#image-preview')
    })
    $.when($('.editor').ckeditor({
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
            { name: 'about', items: [ 'About' ] }
        ],
        // stylesSet: [
        //     { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style dadadad',} },
        // ],
        removeButtons: 'Save,NewPage,ExportPdf,Preview,Print,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,HiddenField,Bold,Italic,Underline,Strike,Subscript,Superscript,RemoveFormat,CopyFormatting,Outdent,Indent,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,ShowBlocks,BGColor,TextColor',
        // removePlugins: 'easyimage,cloudservices',
        filebrowserImageBrowseUrl: '/admin/text-images'
    }).promise).then(() => {
        
    })
    $(document).on('click', '.image-delete', function() {
        $(this).parent().parent().remove()
    })
})