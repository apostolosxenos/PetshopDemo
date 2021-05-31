<?php

include('admin_header.php');
include('navbar.php');
include('sidebar.php');

$date_from = date('Y-m-01'); //αρχή του μήνα
$date_to = date('Y-m-d');

?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-6 mt-5">
                            <div class="card">
                                <div class="card-header" style="background-color:rebeccapurple; color:whitesmoke">
                                    <h6>Επιλογή Ημερομηνιών</h6>
                                </div>
                                <div class="card-body mx-auto">
                                    <div>
                                        <form>
                                            Από: <input type="date" name="date_from" id="date_from" class="mr-2" value="<?php echo $date_from; ?>" required>
                                            Εώς: <input type="date" name="date_to" id="date_to" value="<?php echo $date_to; ?>" required>
                                            <button type="submit" id="submit_btn" class="ml-2">Προβολή</button>
                                            <a href="view_sales.php" class="ml-2">Καθαρισμός</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div id="sales-results">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('admin_footer.php') ?>
    <script>
        $(document).ready(function() {

            $('#submit_btn').on('click', function(event) {

                event.preventDefault();

                var date_from = $('#date_from').val();
                var date_to = $('#date_to').val();
                var datesArray = [date_from, date_to];

                $.post('view_sales_ajax.php', {
                        dates: datesArray
                    })
                    .done(function(data) {

                        $('#sales-results').html(data);

                    })
            });
        });
    </script>