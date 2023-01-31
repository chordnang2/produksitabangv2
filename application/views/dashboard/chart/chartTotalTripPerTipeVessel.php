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
            var valueRaw = h.chartTotalTripRawCoalPerTipeVessel;
            var valueCrush = h.chartTotalTripCrushCoalPerTipeVessel;
            var label = h.chartTipeVesselList;
            var options = {
                chart: {
                    type: "line",
                    fontFamily: 'inherit',
                    height: 200,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false,
                    },
                    animations: {
                        enabled: true
                    },
                    stacked: false,
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
                colors: ['#99C2A2', '#C5EDAC'],
                series: [{
                        name: "Total Trip Raw Coal",
                        type: 'line',
                        data: valueRaw
                    },
                    {
                        name: "Total Trip Crush Coal",
                        type: 'line',
                        data: valueCrush
                    },
                ],
                stroke: {
                    width: [4, 4]
                },
                plotOptions: {
                    bar: {
                        columnWidth: "100%"
                    }
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
                    seriesName: 'Total Trip Raw Coal',
                    show: true
                }, ],
                legend: {
                    horizontalAlign: "left",
                    offsetX: 0,
                }
            };
            var chart = new ApexCharts(document.querySelector("#chartTotalTripPerTipeVessel"), options);
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
                        var valueRaw = h.chartTotalTripRawCoalPerTipeVessel;
                        var valueCrush = h.chartTotalTripCrushCoalPerTipeVessel;
                        var label = h.chartTipeVesselList;
                        chart.updateSeries([{
                                name: "Total Trip Raw Coal",
                                type: 'line',
                                data: valueRaw
                            },
                            {
                                name: "Total Trip Crush Coal",
                                type: 'line',
                                data: valueCrush
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