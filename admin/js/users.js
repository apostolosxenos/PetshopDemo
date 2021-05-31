$(document).ready(function () {
    
    $(".edit-user").click(function () {

        var user_id = this.id;
        var myWidth = 800;
        var myHeight = 475;
        var left = (screen.width - myWidth) / 2;
        var top = (screen.height - myHeight) / 4;
        var myURL = "edit_user.php?user_id=" + user_id;
        var title = "Επεξεργασία Χρήστη";

        var myWindow = window.open(myURL, title, 'width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
        myWindow.focus();
    });

    $(".delete-user").click(function () {

        var user_id_value = this.id;
        var confirmation = confirm("Θέλετε σίγουρα να διαγράψετε τον χρήστη με ID=" + user_id_value + ";");
        if (confirmation == true) {

            $.ajax({
                type: 'POST',
                url: 'user_check.php',
                data: {
                    user_id: user_id_value,
                    action: 'delete'
                },
                success: function (response) {

                    $("#user_id-" + user_id_value).remove();
                    alert('Επιτυχής διαγραφή!');

                }
            });
        }
    });
});