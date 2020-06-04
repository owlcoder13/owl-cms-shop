var container = el.find('.container');
container.css({
    display: 'flex',
    flexWrap: 'wrap',
})

var addItem = function (data) {
    console.log(data)

    var deleteButton = $('<button type="button">Удалить</button>');

    deleteButton.css({
        position: 'absolute',
        zIndex: 10,
        left: '5px',
        bottom: '5px',
    })


    var div = $('<div/>');

    div.css({
        height: '150px',
        width: '150px',
        margin: '5px',
        position: 'relative',
    })

    var img = $('<img/>');
    img.attr('src', data.image.path);
    img.css({
        width: '100%',
        height: '100%',
        objectFit: 'cover',
    })

    div.append(img);
    div.append(deleteButton)

    deleteButton.on('click', function () {
        $.get('/admin/shop/product/' + id + '/upload-photos/' + data.image.id, function (data) {
            if (data.success) {
                div.remove();
            }
        })
    })
    container.append(div);
}

let data = el.data('data');

for (var i in data) {
    addItem(data[i]);
}

el.find('.files').on('change', function () {
    const fileList = this.files;
    const id = $(el).data('id');

    var formData = new FormData();
    formData.append('_token', $('[name="_token"]').val())

    console.log(fileList)
    for (var i = 0; i < fileList.length; i++) {
        (function () {
            if (Number.isInteger(i)) {
                formData.append('file[]', fileList[i]);
            }

        })()
    }

    $.ajax({
        url: '/admin/shop/product/' + id + '/upload-photos',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success) {
                for (var i in data.data) {
                    addItem(data.data[i]);
                }
            }

        }
    });
});
