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
            var valueAverageRitasi = h.chartAverageRitasi;
            var valueTotalUnit = h.chartTotalUnit;
            var valueTotalRitasi = h.chartTotalRitasi;
            var label = h.chartMonitoringProduksiHour;
            console.log(label);
            var options = {
                chart: {
                    height: <?= $heightRitasi ?>,
                    <?= $width ?>
                    type: "line",
                    stacked: false,
                    toolbar: {
                        show: false,
                    },
                },
                zoom: {
                    enabled: true,
                    type: 'x',
                    resetIcon: {
                        offsetX: -10,
                        offsetY: 0,
                        fillColor: '#fff',
                        strokeColor: '#37474F'
                    },
                    selection: {
                        background: '#90CAF9',
                        border: '#0D47A1'
                    }
                },
                responsive: [{
                    breakpoint: 1000,
                    options: {
                        plotOptions: {
                            bar: {
                                horizontal: true
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
                    offsetX: 1,
                    offsetY: 2,
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
                colors: ["#FF1654", "#247BA0", '#2fb344'],
                series: [{
                        name: "Average Ritasi",
                        data: valueAverageRitasi
                    },
                    {
                        name: "Total Unit",
                        data: valueTotalUnit
                    },
                    {
                        name: "Total Ritase",
                        data: valueTotalRitasi
                    },
                ],
                stroke: {
                    width: [4, 4, 4]
                },
                plotOptions: {
                    bar: {
                        columnWidth: "20%"
                    }
                },
                xaxis: {
                    categories: label
                },
                yaxis: [{
                        axisTicks: {
                            show: true
                        },
                        axisBorder: {
                            show: true,
                            color: "#FF1654"
                        },
                        labels: {
                            style: {
                                colors: "#FF1654"
                            }
                        },
                        title: {
                            text: "Average Ritasi",
                            style: {
                                color: "#FF1654"
                            }
                        }
                    },
                    {
                        opposite: true,
                        axisTicks: {
                            show: true
                        },
                        axisBorder: {
                            show: true,
                            color: "#247BA0"
                        },
                        labels: {
                            style: {
                                colors: "#247BA0"
                            }
                        },
                        title: {
                            text: "Total Unit",
                            style: {
                                color: "#247BA0"
                            }
                        },
                        max: 200,
                    },
                    {
                        opposite: true,
                        axisTicks: {
                            show: true
                        },
                        axisBorder: {
                            show: true,
                            color: '#2fb344'
                        },
                        labels: {
                            style: {
                                colors: '#2fb344'
                            }
                        },
                        title: {
                            text: "Total Ritasi",
                            style: {
                                color: '#2fb344'
                            }
                        },
                        max: 200,
                    }
                ],
                tooltip: {
                    theme: 'dark',
                },
                legend: {
                    horizontalAlign: "left",
                    offsetX: 40
                }
            };
            var chart = new ApexCharts(document.querySelector("#chartRitasi"), options);
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
                        var valueAverageRitasi = h.chartAverageRitasi;
                        var valueTotalUnit = h.chartTotalUnit;
                        var valueTotalRitasi = h.chartTotalRitasi;
                        var label = h.chartMonitoringProduksiHour;
                        chart.updateSeries([{
                                name: "Average Ritasi",
                                data: valueAverageRitasi
                            },
                            {
                                name: "Total Unit",
                                data: valueTotalUnit
                            },
                            {
                                name: "Total Ritase",
                                data: valueTotalRitasi
                            },
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