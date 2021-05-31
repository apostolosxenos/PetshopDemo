<?php

require('../config.php');
require('admin_functions.php');

if (isset($_POST['view']) && $_POST['view'] === 'turnover') {

    $dataset1 = array(
        'today' => get_current_day_turnover($db),
        'week' => get_current_week_turnover($db),
        'month' => get_current_month_turnover($db)
    );

    $dataset2 = array(
        'january' => get_monthly_turnover($db, 'January'),
        'february' => get_monthly_turnover($db, 'February'),
        'march' => get_monthly_turnover($db, 'March'),
        'april' => get_monthly_turnover($db, 'April'),
        'may' => get_monthly_turnover($db, 'May'),
        'june' => get_monthly_turnover($db, 'June'),
        'july' => get_monthly_turnover($db, 'July'),
        'august' => get_monthly_turnover($db, 'August'),
        'september' => get_monthly_turnover($db, 'September'),
        'october' => get_monthly_turnover($db, 'October'),
        'november' => get_monthly_turnover($db, 'November'),
        'december' => get_monthly_turnover($db, 'December'),
    );


    $dataset = array();
    array_push($dataset, $dataset1, $dataset2);

    header('Content-Type: application/json');
    echo json_encode($dataset);
}
