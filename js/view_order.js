$(".view-order").click(function () {

    console.log(this.id);

    var order_id = this.id;
    var myWidth = 1200;
    var myHeight = 450;
    var left = (screen.width - myWidth) / 2;
    var top = (screen.height - myHeight) / 4;
    var myURL = "/orders/view_order.php?order_id=" + order_id;
    var title = "Προβολή Παραγγελίας";

    var myWindow = window.open(myURL, title, 'width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
    myWindow.focus();
});