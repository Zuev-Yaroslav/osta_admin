$(function() {
    $('form#review-store').on('submit', function(e) {
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
                    console.log(key);
                    // $(`div.invalid-feedback.${key}`).prev().addClass('is-invalid');
                    $(`div.invalid-feedback.${key}`).css('display', 'block');
                    $(`div.invalid-feedback.${key}`).text(val);
                });
            }

        })
    })
    $('form#review-update').on('submit', function(e) {
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
                    console.log(key);
                    // $(`div.invalid-feedback.${key}`).prev().addClass('is-invalid');
                    $(`div.invalid-feedback.${key}`).css('display', 'block');
                    $(`div.invalid-feedback.${key}`).text(val);
                });
            }

        })
    })
    $('form.review-delete').on('submit', function(e) {
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
})