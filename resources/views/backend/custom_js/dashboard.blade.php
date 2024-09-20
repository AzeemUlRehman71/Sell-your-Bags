<script>
    $(function () {
            'use strict';

        var flatPicker = $('.flat-picker'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            chartColors = {
                column: {
                    series1: '#826af9',
                    series2: '#d2b0ff',
                    bg: '#f8d3ff'
                },
                success: {
                    shade_100: '#7eefc7',
                    shade_200: '#06774f'
                },
                donut: {
                    series1: '#ffe700',
                    series2: '#00d4bd',
                    series3: '#826bf8',
                    series4: '#2b9bf4',
                    series5: '#FFA1A1'
                },
                area: {
                    series3: '#a4f8cd',
                    series2: '#60f2ca',
                    series1: '#2bdac7'
                }
            };

        // heat chart data generator
        function generateDataHeat(count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = 'w' + (i + 1).toString();
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                series.push({
                    x: x,
                    y: y
                });
                i++;
            }
            return series;
        }

        // Init flatpicker
        if (flatPicker.length) {
            var date = new Date();
            flatPicker.each(function () {
                $(this).flatpickr({
                    mode: 'range',
                    defaultDate: ['2019-05-01', '2019-05-10']
                });
            });
        }

        // Area Chart
        // --------------------------------------------------------------------
        var areaChartEl = document.querySelector('#line-area-chart'),
            areaChartConfig = {
                chart: {
                    height: 400,
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: false,
                    curve: 'straight'
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'start'
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
                series: [
                    {
                        name: 'Sales',
                        data: [{{ $data['saleTen'] }}, {{ $data['saleNine'] }}, {{ $data['saleEight'] }}, {{ $data['saleSeven'] }}, {{ $data['saleSix'] }}, {{ $data['saleFive'] }}, {{ $data['saleFour'] }}, {{ $data['saleThree'] }}, {{ $data['saleTwo'] }}, {{ $data['saleOne'] }}]
                    },
                    {
                        name: 'Profit',
                        data: [{{ $data['profit10'] }}, {{ $data['profit9'] }}, {{ $data['profit8'] }}, {{ $data['profit7'] }}, {{ $data['profit6'] }}, {{ $data['profit5'] }}, {{ $data['profit4'] }}, {{ $data['profit3'] }}, {{ $data['profit2'] }}, {{ $data['profit1'] }}]
                    }
                ],
                xaxis: {
                    categories: [
                        '{{ $data['ten'] }}',
                        '{{ $data['nine'] }}',
                        '{{ $data['eight'] }}',
                        '{{ $data['seven'] }}',
                        '{{ $data['six'] }}',
                        '{{ $data['five'] }}',
                        '{{ $data['four'] }}',
                        '{{ $data['three'] }}',
                        '{{ $data['two'] }}',
                        '{{ $data['one'] }}'
                    ]
                },
                fill: {
                    opacity: 1,
                    type: 'solid'
                },
                tooltip: {
                    shared: false
                },
                yaxis: {
                    opposite: isRtl
                }
            };
        if (typeof areaChartEl !== undefined && areaChartEl !== null) {
            var areaChart = new ApexCharts(areaChartEl, areaChartConfig);
            areaChart.render();
        }

        var $barColor = '#f3f3f3';
        var $trackBgColor = '#EBEBEB';
        var $textMutedColor = '#b9b9c3';
        var $budgetStrokeColor2 = '#dcdae3';
        var $goalStrokeColor2 = '#51e5a8';
        var $strokeColor = '#ebe9f1';
        var $textHeadingColor = '#5e5873';
        var $earningsStrokeColor2 = '#28c76f66';
        var $earningsStrokeColor3 = '#28c76f33';

        var $avgSessionStrokeColor2 = '#ebf0f7';
        var $textHeadingColor = '#5e5873';
        var $white = '#fff';
        var $strokeColor = '#ebe9f1';

        var $gainedChart = document.querySelector('#gained-chart');
        var $orderChart = document.querySelector('#order-chart');
        var $avgSessionsChart = document.querySelector('#avg-sessions-chart');
        var $supportTrackerChart = document.querySelector('#support-trackers-chart');
        var $salesVisitChart = document.querySelector('#sales-visit-chart');
        var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');

        var gainedChartOptions;
        var orderChartOptions;
        var avgSessionsChartOptions;
        var supportTrackerChartOptions;
        var salesVisitChartOptions;
        var goalOverviewChartOptions;

        var gainedChart;
        var orderChart;
        var avgSessionsChart;
        var supportTrackerChart;
        var salesVisitChart;
        var goalOverviewChart;
        var isRtl = $('html').attr('data-textdirection') === 'rtl';

        // Sales Chart
        // -----------------------------
        salesVisitChartOptions = {
            chart: {
                height: 300,
                type: 'radar',
                dropShadow: {
                    enabled: true,
                    blur: 8,
                    left: 1,
                    top: 1,
                    opacity: 0.2
                },
                toolbar: {
                    show: true
                },
                offsetY: 5
            },
            series: [
                {
                    name: 'Sales',
                    data: [{{ $data['mon_sale'] }}, {{ $data['tue_sale'] }}, {{ $data['wed_sale'] }}, {{ $data['thu_sale'] }}, {{ $data['fri_sale'] }}, {{ $data['sat_sale'] }}, {{ $data['sun_sale'] }}]
                },
                {
                    name: 'Purchase',
                    data: [{{ $data['mon_purchase'] }}, {{ $data['tue_purchase'] }}, {{ $data['wed_purchase'] }}, {{ $data['thu_purchase'] }}, {{ $data['fri_purchase'] }}, {{ $data['sat_purchase'] }}, {{ $data['sun_purchase'] }}]
                }
            ],
            stroke: {
                width: 0
            },
            colors: [window.colors.solid.primary, window.colors.solid.info],
            plotOptions: {
                radar: {
                    polygons: {
                        strokeColors: [$strokeColor, 'transparent', 'transparent', 'transparent', 'transparent', 'transparent'],
                        connectorColors: 'transparent'
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    gradientToColors: [window.colors.solid.primary, window.colors.solid.info],
                    shadeIntensity: 1,
                    type: 'horizontal',
                    opacityFrom: 0.5,
                    opacityTo: 1,
                    stops: [0, 100, 100, 100]
                }
            },
            markers: {
                size: 3
            },
            legend: {
                show: true
            },
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            dataLabels: {
                background: {
                    foreColor: [$strokeColor, $strokeColor, $strokeColor, $strokeColor, $strokeColor, $strokeColor]
                }
            },
            yaxis: {
                show: false
            },
            grid: {
                show: false,
                padding: {
                    bottom: -27
                }
            }
        };
        salesVisitChart = new ApexCharts($salesVisitChart, salesVisitChartOptions);
        salesVisitChart.render();


        goalOverviewChartOptions = {
            chart: {
                height: 310,
                type: 'radialBar',
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    blur: 3,
                    left: 1,
                    top: 1,
                    opacity: 0.1
                }
            },
            colors: [$goalStrokeColor2],
            plotOptions: {
                radialBar: {
                    offsetY: -10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '77%'
                    },
                    track: {
                        background: $strokeColor,
                        strokeWidth: '50%'
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            color: $textHeadingColor,
                            fontSize: '2.86rem',
                            fontWeight: '600'
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: [window.colors.solid.success],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            series: [{{ $data['percentage'] }}],
            stroke: {
                lineCap: 'round'
            },
            grid: {
                padding: {
                    bottom: 30
                }
            }
        };
        goalOverviewChart = new ApexCharts($goalOverviewChart, goalOverviewChartOptions);
        goalOverviewChart.render();
    });



</script>
