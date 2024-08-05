$(function() {
    $('form.application-delete').on('submit', function(e) {
        e.preventDefault();
        if (!confirm('Точно хотите удалить?')) {
            return;
        }
        var data = new FormData(this);
        $.each($('input.checkbox-id'), (index, value) => {
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
                        console.log(err);
                    }
        
                })
            }
        })
    })
})