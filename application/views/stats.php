<div class="container">

    <h1>Website statistics</h1>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    <script type="text/javascript">
        $(function () {
            var chart;
            $(document).ready(function() {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container',
                        type: 'line',
                        marginRight: 130,
                        marginBottom: 25
                    },
                    title: {
                        text: 'Overzicht van bezoekers',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Data van Google Analytics',
                        x: -20
                    },
                    xAxis: {
                        categories: [<?php for($i=1; $i <= $date_info['days']; $i++){ echo "'" . $i . "',";} ?>]
                    },
                    yAxis: {
                        title: {
                            text: 'Aantal bezoekers'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>'+ this.series.name +'</b>'+
                                this.x +': '+ this.y +'';
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    series: [{
                        name: 'Unieke Bezoekers',
                        data: [<?php foreach($stats as $d) {
                            echo $d[4] . ', ';
                        }?>]
                    }, {
                        name: 'Pagina Weergaves',

                        data: [<?php foreach($stats as $d) {
                            echo $d[5] . ', ';
                        }?>]
                    }]
                });
            });

        });
    </script>

    <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

</div> <!-- /container -->
