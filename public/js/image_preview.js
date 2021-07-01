$('.multi-image-input').on('change', function (e) {
    let that = $(this);
    const  parent = $(this).parent('.upload-block');
    const input = e.target;
    if (input.files) {
        var filesAmount = input.files.length;
        parent.find('.gallery').html('');
        for (let i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function (event) {
                let imagePvr = `<div class="col-4">
                                    <div class="image-block">
                                        <img src="${event.target.result}"
                                             alt="..." class="img-thumbnail">
                                    </div>
                                </div>`;

                parent.find('.gallery').append(imagePvr);
            }
            reader.readAsDataURL(input.files[i]);
        }
        parent.find('.upload-info').css('display', 'none');
    }
});


$('.single-image-input').on('change', function (e) {
    let that = $(this);
    const  parent = $(this).parent('.upload-block');
    const input = e.target;
    if (input.files) {
        var filesAmount = input.files.length;
        parent.find('.gallery').html('');
        for (let i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function (event) {
                let imagePvr = `<div class="image-block">
                                    <img src="${event.target.result}"
                                         alt="..." class="img-thumbnail">
                                </div>`;

                parent.find('.gallery').append(imagePvr);
            }
            reader.readAsDataURL(input.files[i]);
        }
        parent.find('.upload-info').css('display', 'none');
    }
});
