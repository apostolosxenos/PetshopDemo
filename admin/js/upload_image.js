$(document).ready(function () {

    $("#img_upload_btn").click(function () {

        var urlParams = new URLSearchParams(window.location.search);
        var kind = 'dogs';
        var category = urlParams.get('category');

        console.log(kind);
        console.log(category);

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        $.ajax({
            url: 'upload_product_image.php',
            type: 'POST',
            data: [fd, kind, category],
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    console.log(response);
                    $("#img").attr("src", response);
                    $(".preview img").show(); // Display image element
                } else {
                    $(".preview img").hide();
                }
            },
        });
    });
});