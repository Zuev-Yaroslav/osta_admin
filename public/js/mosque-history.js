$(function() {
    var delete_imgs_ids = [];
    const errorValidation = (key, val) => {
        if (key.indexOf('.alt_ru') !== -1 && key.indexOf('images.') !== -1 && key.indexOf('new_images.') === -1) {
            let number = parseInt(key.replace(/\D+/g, ""));
            // $(`div.invalid-feedback.images_i_alt`).prev().addClass('is-invalid');
            $(`div.invalid-feedback.images_${number}_alt_ru`).css('display', 'block');
            $(`div.invalid-feedback.images_${number}_alt_ru`).text(val);
        }
        if (key.indexOf('.alt_tt') !== -1 && key.indexOf('images.') !== -1 && key.indexOf('new_images.') === -1) {
            let number = parseInt(key.replace(/\D+/g, ""));
            // $(`div.invalid-feedback.images_i_alt`).prev().addClass('is-invalid');
            $(`div.invalid-feedback.images_${number}_alt_tt`).css('display', 'block');
            $(`div.invalid-feedback.images_${number}_alt_tt`).text(val);
        }
        if (key.indexOf('images.') !== -1 && key.indexOf('new_images.') === -1) {
            let number = parseInt(key.replace(/\D+/g, ""));
            // $(`div.invalid-feedback.images_i_alt`).prev().addClass('is-invalid');
            $(`div.invalid-feedback.images${number}`).css('display', 'block');
            // $(`div.invalid-feedback.images_i_alt_tt`).eq(number).text(val);
        }
        // $(`div.invalid-feedback.${key}`).prev().addClass('is-invalid');
        $(`div.invalid-feedback.${key}`).css('display', 'block');
        $(`div.invalid-feedback.${key}`).text(val);
    }

    $('form.mosque-history-delete').on('submit', function(e) {
        e.preventDefault();
        if (!confirm('Точно хотите удалить?')) {
            return;
        }
        var data = new FormData(this);
        
        $.ajax({
            url: $(this).prop('action'),
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            success: (res) => {
                location.reload();
            },
            error: (err) => {
                
            }

        })
    })
    if ($("#actions").length === 0) return;
    Dropzone.autoDiscover = false;
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    const MyDropzone = new Dropzone('#actions', {
        url: "/target-url", // Set the url
        // thumbnailWidth: 80,
        // thumbnailHeight: 80,
        previewTemplate: previewTemplate,
        acceptedFiles: "image/*",
        autoProcessQueue: false,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button",
    })
    MyDropzone.on('addedfile', function(file) {
        $.each(MyDropzone.getAcceptedFiles(), (index, value) => {
            if (file.name === value.name) {
                MyDropzone.removeFile(file)
            }
        })
    })
    $('#previews').sortable({
        axis: 'y',
        handle: '.grab.preview',
        containment: '#previews',
        stop: () => {
            var newQueue = [];
            var queue = MyDropzone.getAcceptedFiles();
            // console.log($('#previews .dz-image-preview .filename'));
            $('#previews .dz-image-preview [data-dz-name]').each(function (count, el) 
            {
                queue.forEach(function (file) {
                    if (el.innerHTML === file.name )
                        newQueue.push(file);
                });
            });
           MyDropzone.files = newQueue;  
        },
    })
    $('#images').sortable({
        items: '.image',
        containment: 'body',
        handle: '.grab',
        stop: () => {
            $('input.sort_index').each((index, el) => {
                $('input.sort_index').eq(index).val(index);
            })
            console.log($('input.sort_index'));
        },
    })
    $('form#mosque-history-store').on('submit', function(e) {
        e.preventDefault();
        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData(this);

        data.delete('alt_ru');
        data.delete('alt_tt')
        
        $.each(MyDropzone.getAcceptedFiles(), (index, value) => {
            data.append(`images[${index}][image]`, value);
            data.append(`images[${index}][alt_ru]`, $('input[name=alt_ru]').eq(index).val());
            data.append(`images[${index}][alt_tt]`, $('input[name=alt_tt]').eq(index).val());
        })

        $.ajax({
            url: $(this).prop('action'),
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name=token]').prop('content')
            // },
            beforeSend: () => {
                $('#loading').modal('toggle');
            },
            success: (res) => {
                setTimeout(() => {
                    
                    $('#success').modal('toggle');
                }, 500);
            },
            complete: () => {
                setTimeout(() => {
                    
                    $('#loading').modal('toggle');
                }, 500);
            },
            error: (err) => {
                // var i = 0;
                setTimeout(() => {
                    $('p#error-message').text(err.responseJSON.message)
                    $('#error').modal('toggle')
                }, 500)
                $.each(err.responseJSON.errors, (key, val) => {
                    errorValidation(key, val)
                    if (key.indexOf('.alt_ru') !== -1 && key.indexOf('images.') !== -1) {
                        let number = parseInt(key.replace(/\D+/g, ""));
                        // $(`div.invalid-feedback.new_images_i_alt`).prev().addClass('is-invalid');
                        $(`div.invalid-feedback.new_images_i_alt_ru`).eq(number).css('display', 'block');
                        $(`div.invalid-feedback.new_images_i_alt_ru`).eq(number).text(val);
                    }
                    if (key.indexOf('.alt_tt') !== -1 && key.indexOf('images.') !== -1) {
                        let number = parseInt(key.replace(/\D+/g, ""));
                        // $(`div.invalid-feedback.new_images_i_alt`).prev().addClass('is-invalid');
                        $(`div.invalid-feedback.new_images_i_alt_tt`).eq(number).css('display', 'block');
                        $(`div.invalid-feedback.new_images_i_alt_tt`).eq(number).text(val);
                    }
                });
            }

        })
    })

    $('form#mosque-history-update').on('submit', function(e) {
        e.preventDefault();
        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData(this);

        data.delete('alt_ru');
        data.delete('alt_tt')

        $.each(MyDropzone.getAcceptedFiles(), (index, value) => {
            data.append(`new_images[${index}][image]`, value);
            data.append(`new_images[${index}][alt_ru]`, $('input[name=alt_ru]').eq(index).val());
            data.append(`new_images[${index}][alt_tt]`, $('input[name=alt_tt]').eq(index).val());
        })
        $.each(delete_imgs_ids, (index, value) => {
            data.append('delete_imgs_ids[]', value)
        })

        $.ajax({
            url: $(this).prop('action'),
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $('#loading').modal('toggle');
            },
            success: (res) => {
                setTimeout(() => {
                    
                    $('#success').modal('toggle');
                }, 500);
            },
            complete: () => {
                setTimeout(() => {
                    
                    $('#loading').modal('toggle');
                }, 500);
            },
            error: (err) => {
                // var i = 0;
                setTimeout(() => {
                    $('p#error-message').text(err.responseJSON.message)
                    $('#error').modal('toggle')
                }, 500)

                $.each(err.responseJSON.errors, (key, val) => {
                    errorValidation(key, val)
                    if (key.indexOf('.alt_ru') !== -1 && key.indexOf('new_images.') !== -1) {
                        let number = parseInt(key.replace(/\D+/g, ""));
                        // $(`div.invalid-feedback.images_i_alt`).prev().addClass('is-invalid');
                        $(`div.invalid-feedback.new_images_i_alt_ru`).eq(number).css('display', 'block');
                        $(`div.invalid-feedback.new_images_i_alt_ru`).eq(number).text(val);
                    }
                    if (key.indexOf('.alt_tt') !== -1 && key.indexOf('new_images.') !== -1) {
                        let number = parseInt(key.replace(/\D+/g, ""));
                        // $(`div.invalid-feedback.new_images_i_alt`).prev().addClass('is-invalid');
                        $(`div.invalid-feedback.new_images_i_alt_tt`).eq(number).css('display', 'block');
                        $(`div.invalid-feedback.new_images_i_alt_tt`).eq(number).text(val);
                    }
                });
            }

        })
    })
    $(document).on('click', '.image-delete', function () {
        // $(this).parent().parent().remove()
        delete_imgs_ids.push($(this).data('id'))
    })
})