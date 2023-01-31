<script>
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('dashboard/ajaxChartData') ?>",
        method: "GET",
        async: true,
        cache: false,
        success: function(data) {
            // console.log(data);
            h = JSON.parse(data);
            var value = h.chartMonitoringProduksiValue;
            var valuetotal = h.chartMonitoringProduksiValueTotal;
            var label = h.chartMonitoringProduksiHour;
            var chart = new ApexCharts(document.querySelector("#chartMonitoringProduksi"), options = {
                chart: {
                    type: "bar",
                    fontFamily: 'inherit',
                    height: <?= $height ?>,
                    <?= $width ?>
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: true
                    },
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%',
                    }
                },
                responsive: [{
                    breakpoint: 1000,
                    options: {
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        legend: {
                            position: "bottom"
                        }
                    }
                }],
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: undefined,
                    formatter: function(val, opts) {
                        return val
                    },
                    textAnchor: 'bottom',
                    distributed: false,
                    offsetX: -10,
                    offsetY: 20,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        fontWeight: 'bold',
                        colors: undefined
                    },
                    background: {
                        enabled: true,
                        foreColor: '#fff',
                        padding: 4,
                        borderRadius: 2,
                        borderWidth: 1,
                        borderColor: '#fff',
                        opacity: 0.9,
                        dropShadow: {
                            enabled: false,
                            top: 1,
                            left: 1,
                            blur: 1,
                            color: '#000',
                            opacity: 0.45
                        }
                    },
                    dropShadow: {
                        enabled: false,
                        top: 1,
                        left: 1,
                        blur: 1,
                        color: '#000',
                        opacity: 0.45
                    }
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                        name: "Produksi per jam",
                        data: value
                    },
                    {
                        name: "Produksi per jam total",
                        data: valuetotal
                    }
                ],
                tooltip: {
                    theme: 'dark'
                },
                grid: {
                    padding: {
                        top: -20,
                        right: 0,
                        left: -4,
                        bottom: -4
                    },
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
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
                    min: 0,
                    max: 55000,
                },
                labels: label,
                colors: ['#206bc4', '#2fb344'],
                legend: {
                    horizontalAlign: "left",
                    offsetX: 40
                }
            });
            chart.render();
            function updateChartSeries() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('dashboard/ajaxChartData') ?>",
                    method: "GET",
                    async: true,
                    cache: false,
                    success: function(data) {
                        // console.log(data);
                        h = JSON.parse(data);
                        var value2 = h.chartMonitoringProduksiValue;
                        var valuetotal2 = h.chartMonitoringProduksiValueTotal;
                        var label2 = h.chartMonitoringProduksiHour;
                        chart.updateSeries([{
                                name: "Produksi per jam",
                                data: value2
                            },
                            {
                                name: "Produksi per jam total",
                                data: valuetotal2
                            }
                        ]);
                    }
                })
                // Replace data to existing Chart
            }
            setInterval(function() {
                updateChartSeries();
            }, 5000);

        },
    });
</script>