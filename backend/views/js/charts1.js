$(function () {
    var chartype = {
        type: 'solidgauge'
    }
    var chartitle = null
    var chartpane = {
        center: ['50%', '85%'],
        size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    }
    var chartooltip = {
        enabled: false
    }
    var chartyaxis = {
        stops: [
            [0.1, '#55BF3B'], // green
            [0.5, '#DDDF0D'], // yellow
            [0.9, 'green'] // red
        ],
        lineWidth: 0,
        minorTickInterval: null,
        tickPixelInterval: 400,
        tickWidth: 0,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    }
    var chartplotoptions = {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
    var gaugeOptions = {
        chart:chartype,
        title: chartitle,
        pane: chartpane,
        tooltip:chartooltip,
        yAxis: chartyaxis,
        plotOptions: chartplotoptions
    };
    // The speed gauge
    $('#container-speed1').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: 'Độ ẩm'
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Speed',
            data: [80],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:12px;color:black">%</span></div>'
            },
        }]
    }));
});