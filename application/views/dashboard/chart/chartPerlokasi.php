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
            var valueTrip = h.chartTripPerLoadingPoint;
            var valueUndeload = h.chartUnderloadPerLoadingPoint;
            var valueTonKm = h.chartTotalTonKmPerLoadingPoint;
            var label = h.chartLoadingPoint;

            var options = {
                series: [{
                    name: 'Trip',
                    type: 'column',
                    data: valueTrip
                }, {
                    name: 'Undeload',
                    type: 'column',
                    data: valueUndeload
                }, {
                    name: 'Ton Km',
                    type: 'line',
                    data: valueTonKm
                }],
                chart: {
                    height: 200,
                    type: 'line',
                    stacked: false,
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: undefined,
                    formatter: function(val, opts) {
                        return val
                    },
                    textAnchor: 'bottom',
                    distributed: false,
                    offsetX: -3,
                    offsetY: -3,
                    style: {
                        fontSize: '10px',
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
                stroke: {
                    width: [1, 1, 4]
                },
                xaxis: {
                    categories: label,
                    labels: {
                        style: {
                            fontSize: '8px',
                            fontWeight: 500,
                        },
                    }
                },
                yaxis: [{
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                            color: '#008FFB'
                        },
                        labels: {
                            style: {
                                colors: '#008FFB',
                            }
                        },
                        tooltip: {
                            enabled: true
                        },
                        max: 120
                    },
                    {
                        opposite: false,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#00E396'
                        },
                        labels: {
                            style: {
                                colors: '#00E396',
                            }
                        },
                        max: 120
                    },
                    {
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#FEB019'
                        },
                        labels: {
                            style: {
                                colors: '#FEB019',
                            },
                        },
                    },
                ],
                tooltip: {
                    fixed: {
                        enabled: true,
                        position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                        offsetY: 30,
                        offsetX: 60
                    },
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 0
                }
            };
            var chart = new ApexCharts(document.querySelector("#chartPerlokasi"), options);
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
                        var valueTrip = h.chartTripPerLoadingPoint;
                        var valueUndeload = h.chartUnderloadPerLoadingPoint;
                        var valueTonKm = h.chartTotalTonKmPerLoadingPoint;
                        var label = h.chartLoadingPoint;
                        chart.updateSeries([{
                            name: 'Trip',
                            type: 'column',
                            data: valueTrip
                        }, {
                            name: 'Undeload',
                            type: 'column',
                            data: valueUndeload
                        }, {
                            name: 'Ton Km',
                            type: 'line',
                            data: valueTonKm
                        }]);
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