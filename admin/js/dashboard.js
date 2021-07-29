$(document).ready(function () {

    $.post('turnover_ajax.php', {
        view: 'turnover'
    })
        .done(function (data) {

            console.log(data);

            var currentChartData = {
                labels: ['Σήμερα', 'Εβδομάδας', 'Μήνα'],
                datasets: [{
                    backgroundColor: ['rgba(0, 102, 204, 0.5)', 'rgba(0, 76, 153, 0.5)', 'rgba(0, 51, 152, 0.5)'],
                    borderColor: ['rgba(0, 102, 204, 1)', 'rgba(0, 76, 153, 1)', 'rgba(0, 51, 152, 1)'],
                    borderWidth: 1,
                    data: [data[0].today, data[0].week, data[0].month]
                }]
            };

            var monthsChartData = {
                labels: ['Ιανουάριος',
                    'Φεβρουάριος',
                    'Μάρτιος',
                    'Απρίλιος',
                    'Μάιος',
                    'Ιούνιος',
                    'Ιούλιος',
                    'Αύγουστος',
                    'Σεπτέμβριος',
                    'Οκτώμβριος',
                    'Νοέμβριος',
                    'Δεκέμβριος'
                ],
                datasets: [{
                    backgroundColor: ['rgba(131, 123, 142, 0.5)',
                        'rgba(124, 152, 141, 0.5)',
                        'rgba(253, 174, 21, 0.5)',
                        'rgba(187, 85, 186, 0.5)',
                        'rgba(207, 166, 74, 0.5)',
                        'rgba(162, 203, 24, 0.5)',
                        'rgba(141, 247, 83, 0.5)',
                        'rgba(154, 106, 180, 0.5)',
                        'rgba(129, 69, 37, 0.5)',
                        'rgba(255, 47, 4, 0.5)',
                        'rgba(233, 166, 42, 0.5)',
                        'rgba(154, 181, 117, 0.5)'
                    ],
                    borderColor: ['rgba(131, 123, 142, 1)',
                        'rgba(124, 152, 141, 1)',
                        'rgba(253, 174, 21, 1)',
                        'rgba(187, 85, 186, 1)',
                        'rgba(207, 166, 74, 1)',
                        'rgba(162, 203, 24, 1)',
                        'rgba(141, 247, 83, 1)',
                        'rgba(154, 106, 180, 1)',
                        'rgba(129, 69, 37, 1)',
                        'rgba(255, 47, 4, 1)',
                        'rgba(233, 166, 42, 1)',
                        'rgba(154, 181, 117, 1)'
                    ],
                    borderWidth: 1,
                    data: [
                        data[1].january,
                        data[1].february,
                        data[1].march,
                        data[1].april,
                        data[1].may,
                        data[1].june,
                        data[1].july,
                        data[1].august,
                        data[1].september,
                        data[1].october,
                        data[1].november,
                        data[1].december
                    ]
                }]
            };

            var ctx = document.getElementById('turnover-current').getContext('2d');
            var currentChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: currentChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Τζίρος €'
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var year = new Date().getFullYear();

            var ctx2 = document.getElementById('turnover-months').getContext('2d');
            var monthsChart = new Chart(ctx2, {
                type: 'bar',
                data: monthsChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Τζίρος € (Μηνιαία Κλίμακα ' + year + ')'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                }
            });

        })
        .fail(function (xhr, status, error) {
            console.log(error);
        });

    $.post('popular_products_ajax.php', {
        view: 'popular-products'
    })
        .done(function (data) {

            console.log(data);

            var random_colors = [];

            data.forEach(element => {
                random_colors.push(random_rgba(0.8));
            });

            var popularProductsChartData = {
                labels: ["id_" + data[0].product_id,
                "id_" + data[1].product_id,
                "id_" + data[2].product_id,
                ],
                datasets: [{
                    backgroundColor: random_colors,
                    borderWidth: 1,
                    data: [data[0].total_sold,
                    data[1].total_sold,
                    data[2].total_sold,
                    ]
                }]
            };

            var ctx3 = document.getElementById('popular-products').getContext('2d');
            var popularProductsChart = new Chart(ctx3, {
                type: 'bar',
                data: popularProductsChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Δημοφιλή Προϊόντα (Ποσότητα Πωλήσεων / Προϊόν)'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                }
            });

        });

    $.post('best_customers_ajax.php', {
        view: 'best-customers',
    })
        .done(function (data) {

            console.log(data);

            var emails = [];
            var total_purchases = [];

            data.forEach(element => {
                emails.push(element.email);
                total_purchases.push(element.total_purchases);
            });

            var bestCustomersChartData = {
                labels: emails,
                datasets: [{
                    backgroundColor: ['rgba(255,215,0,0.5)', 'rgba(192,192,192,0.5)', 'rgb(205,127,50,0.5)'],
                    borderColor: ['rgba(255,215,0,1)', 'rgba(192,192,192,1)', 'rgb(205,127,50,1)'],
                    borderWidth: 1,
                    data: total_purchases
                }]
            };

            var ctx4 = document.getElementById('best-customers').getContext('2d');
            var popularProductsChart = new Chart(ctx4, {
                type: 'pie',
                data: bestCustomersChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Καλύτεροι Πελάτες (Αξία Αγορών / Πελάτη)'
                    },
                }
            });

        });
});

function random_rgba(opacity) {
    var o = Math.round,
        r = Math.random,
        s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + opacity + ')';
}