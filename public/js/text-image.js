$(function () {
    let switcher = false;
    $('#SelectPossible').click(function () {
        switch (switcher) {
            case false:
                $(this).text('Отменить')
                $('.select-img').parent().removeClass('d-none')
                $('.img-div').find('img').css('opacity', '0.5')
                $('.img-div').removeClass('show-modal')
                $('.img-div').addClass('to-select')
                $('#DeleteImage').removeClass('d-none')
                $('.edit-image-btn').addClass('d-none')
                $('.choose-image-btn').addClass('d-none')
                switcher = true;
                break;
            case true:
                $(this).text('Множественный выбор')
                $('.select-img').parent().addClass('d-none')
                $('.img-div').find('img').css('opacity', '1')
                $('.img-div').addClass('show-modal')
                $('.img-div').removeClass('to-select')
                $('#DeleteImage').addClass('d-none')
                $('.edit-image-btn').removeClass('d-none')
                $('.choose-image-btn').removeClass('d-none')
                switcher = false;
                break;
        }
    })
    $(document).on('click', '.to-select', function(){
        let checkbox = $(this).find('input[type=checkbox]')
        switch (checkbox.prop('checked')) {
            case true:
                checkbox.attr('checked', false)
                break;
            case false:
                checkbox.attr('checked', true)
                break;
        }
    })
    $('form#text-image-store').on('submit', function (e) {
        e.preventDefault();
        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData(this);

        $('#loading').modal('toggle')
        $.ajax({
            url: $(this).prop('action'),
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            success: (res) => {
                setTimeout(() => {
                    var params = new URLSearchParams(document.location.search);
                    params.set("page", "1")
                    location.href = `${$(this).prop('action')}?${params.toString()}`;
                }, 500);
            },
            error: (err) => {
                // var i = 0;
                setTimeout(() => {
                    $('#loading').modal('toggle')
                }, 500);
                $.each(err.responseJSON.errors, (key, val) => {
                    console.log(key);
                    // $(`div.invalid-feedback.${key}`).prev().addClass('is-invalid');
                    $(`div.invalid-feedback.${key}`).css('display', 'block');
                    $(`div.invalid-feedback.${key}`).text(val);
                });
            }

        })
    })
    $('form.text-image-update').on('submit', function (e) {
        e.preventDefault();
        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData(this);

        $.ajax({
            url: $(this).prop('action'),
            type: 'POST',
            dataType: 'json',
            data: data,
            processData: false,
            contentType: false,
            success: (res) => {
                setTimeout(() => {
                    location.reload();
                }, 500);
            },
            error: (err) => {
                // var i = 0;
                $.each(err.responseJSON.errors, (key, val) => {
                    console.log(key);
                    // $(`div.invalid-feedback.${key}`).prev().addClass('is-invalid');
                    $(this).find(`div.invalid-feedback.${key}`).css('display', 'block');
                    $(this).find(`div.invalid-feedback.${key}`).text(val);
                });
            }

        })
    })
    $('button#DeleteImage').on('click', function (e) {
        e.preventDefault();
        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData();
        data.append('_method', 'delete')
        data.append('_token', $('meta[name=csrf-token]').prop('content'))
        $.each($('input.select-img'), (index, value) => {
            if ($(value).prop('checked')) {
                $.ajax({
                    url: $(value).data('delete-url'),
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    },
                    error: (err) => {
                        // var i = 0;
                        $.each(err.responseJSON.errors, (key, val) => {
                            console.log(key);
                        });
                    }
        
                })
            }
        })
    })
})