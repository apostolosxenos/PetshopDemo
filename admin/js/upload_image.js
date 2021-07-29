$(document).ready(function () {

    $("#img_upload_btn").click(function () {

        var urlParams = new URLSearchParams(window.location.search);
        var kind = 'dogs';

        var formData = new FormData();
        var files = $('#file')[0].files;

        if (files.length > 0) {

            formData.append('file', files[0]);
            formData.append('product_id',urlParams.get('product_id'));
            formData.append('category', urlParams.get('category'));
            formData.append('kind', kind);

            $.ajax({
                url: 'upload_product_image.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        $("#img").attr("src", response);
                        $(".preview img").show(); // Display image element
                    } else {
                        alert('File not uploaded');
                    }
                },
            });
        }
        else alert('Παρακαλώ επιλέξτε φωτογραφία.');
    });
});