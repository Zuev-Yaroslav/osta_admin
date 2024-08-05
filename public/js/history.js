$(function() {
    $('form#history-update').on('submit', function(e) {
        e.preventDefault();
        $('div.invalid-feedback').css('display', 'none');
        var data = new FormData(this);
        data.append('text_ru', $('textarea#text_ru').val())
        data.append('text_tt', $('textarea#text_tt').val())

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
})