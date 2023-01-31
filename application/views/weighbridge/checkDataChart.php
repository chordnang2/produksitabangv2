<script>
    // @formatter:off
    window.onload = function() {
        update(); //call your function to update chart
    };
    //onchange of select
    $("select[name=select]").on("change", function() {
        var select = $(this).val(); //get value of select
        update(select); //call to update
    });

    function update(select) {
        var value;
        //if null
        if (select == null) {
            value = 0; //send some dummy data
        } else {
            value = select; //send actual select
        }
        // console.log(value);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('weighbridge/ajaxData') ?>",
            data: {
                select: value, //send value to backend
            },
            datatype: "json",
            success: function(data) {
                // console.log(data);
                h = JSON.parse(data);
                var label = h.ChartBulananBulan;
                var value = h.ChartBulananTon;

                var chart = new ApexCharts(document.querySelector("#chart-tasks-overview"), options = {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 150,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: true,
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    responsive: [{
                        breakpoint: undefined,
                        options: {},
                    }],

                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '8px',
                            fontWeight: 'bold',
                        },
                        dropShadow: {
                            enabled: false,
                            opacity: 0.5
                        }
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: false,
                        data: value
                    }],
                    tooltip: {
                        theme: 'light'
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        categories: label,
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    colors: ['#206bc4'],
                    legend: {
                        show: false,
                    },
                });

                chart.render();
            },
        });
    }
</script>
<!-- <script>
    Chart.plugins.register(ChartDataLabels);

    window.onload = function() {
        update(); //call your function to update chart
    };
    //onchange of select
    $("select[name=select]").on("change", function() {
        var select = $(this).val(); //get value of select
        update(select); //call to update
    });

    function update(select) {
        var value;
        //if null
        if (select == null) {
            value = 0; //send some dummy data
        } else {
            value = select; //send actual select
        }
        console.log(value);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('weighbridge/ajaxData') ?>",
            data: {
                select: value, //send value to backend
            },
            datatype: "json",
            success: function(data) {
                console.log(data);
                h = JSON.parse(data);
                var label = h.ChartBulananBulan;
                var value = h.ChartBulananTon;

                const ctx = document.getElementById('myChart');

                var myChart = new Chart(ctx, {
                    responsive: true,
                    maintainAspectRatio: false,
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: '# Produksi Bulanan',
                            data: value,
                            backgroundColor: 'rgba(0, 79, 198, 0.8)',
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                borderWidth: 1
                            },
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            },
        });
    }
</script> -->