function container1(){
    Highcharts.chart('container1', {

        title: {
            text: 'Solar Employment Growth by Sector, 2010-2016'
        },

        subtitle: {
            text: 'Source: thesolarfoundation.com'
        },

        yAxis: {
            title: {
                text: 'Number of Employees'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                pointStart: 2010
            }
        },

        series: [{
            name: 'Installation',
            data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
    }, {
            name: 'Manufacturing',
            data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
    }, {
            name: 'Sales & Distribution',
            data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
    }, {
            name: 'Project Development',
            data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
    }, {
            name: 'Other',
            data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
    }]

    });
}
function container(){
    Highcharts.mapChart('container', {
        chart: {
            borderWidth: 1
        },

        title: {
            text: 'Nordic countries'
        },
        subtitle: {
            text: 'Demo of drawing all areas in the map, only highlighting partial data'
        },

        legend: {
            enabled: false
        },

        series: [{
            name: 'Country',
            mapData: Highcharts.maps['custom/europe'],
            data: [
            ['is', 1],
            ['no', 1],
            ['se', 1],
            ['dk', 1],
            ['fi', 1]
        ],
            dataLabels: {
                enabled: true,
                color: '#FFFFFF',
                formatter: function () {
                    if (this.point.value) {
                        return this.point.name;
                    }
                }
            },
            tooltip: {
                headerFormat: '',
                pointFormat: '{point.name}'
            }
    }]
    });
}
function pizza(){
    Highcharts.chart('pizza', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares January, 2015 to May, 2015'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Microsoft Internet Explorer',
                y: 56.33
            }, {
                name: 'Chrome',
                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: 'Firefox',
                y: 10.38
            }, {
                name: 'Safari',
                y: 4.77
            }, {
                name: 'Opera',
                y: 0.91
            }, {
                name: 'Proprietary or Undetectable',
                y: 0.2
            }]
        }]
    });
}
function con(){
     Highcharts.chart('con', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Previsão para 2017'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Educação',
                y: 56.33
                                    }, {
                name: 'Saúde',
                y: 24.03,
                sliced: true,
                selected: true
                                    }, {
                name: 'Infraestrutura',
                y: 10.38
                                    }, {
                name: 'Previdência',
                y: 4.77
                                    }]
                            }]
    });

}
function con1(){
    Highcharts.chart('con1', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Previsão para 2017'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Educação',
                y: 56.33
                                    }, {
                name: 'Saúde',
                y: 24.03,
                sliced: true,
                selected: true
                                    }, {
                name: 'Infraestrutura',
                y: 10.38
                                    }, {
                name: 'Previdência',
                y: 4.77
                                    }]
                            }]
    });

}

function testeGrafico() {
    container1();
    con();
    con1();
    pizza();

}
