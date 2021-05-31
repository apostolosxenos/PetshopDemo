$(document).ready(function () {
    $(".view-order").click(function () {

        var order_id = this.id;
        var myWidth = 800;
        var myHeight = 450;
        var left = (screen.width - myWidth) / 2;
        var top = (screen.height - myHeight) / 4;
        var myURL = "/orders/view_order.php?order_id=" + order_id;
        var title = "Προβολή Παραγγελίας";

        var myWindow = window.open(myURL, title, 'width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
        myWindow.focus();
    });

    $(".status-option").change(function () {
        var selectedStatus = $(this).children("option:selected").val();
        var selectedId = this.id;

        console.log(selectedStatus);
        console.log(selectedId);

        $.post('update_order_status.php', {
            status: selectedStatus,
            order_id: selectedId,
            action: 'update'
        })
            .done(function () {

                alert("Αλλαγή κατάστασης παραγγελίας με ID:" + order_id + " σε --> " + selectedStatus);

            });
    });
});