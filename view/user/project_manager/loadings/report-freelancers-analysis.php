<script type="text/javascript">
    
    $(document).ready(function () {
        var freelancer1_id = '<?php echo $_REQUEST['freelancer1_id']; ?>';
        var freelancer2_id = '<?php echo $_REQUEST['freelancer2_id']; ?>';
        var freelancer1_name = '<?php echo $_REQUEST['freelancer1_name']; ?>';
        var freelancer2_name = '<?php echo $_REQUEST['freelancer2_name']; ?>';
        $.ajax({
            type: 'POST',
            url: 'loadings/freelancer-analysis.php',
            data: {
                'freelancer1_id': freelancer1_id,
                'freelancer2_id': freelancer2_id,
                'freelancer1_name': freelancer1_name,
                'freelancer2_name': freelancer2_name
            },
            success: function (data) {

                var freelancers = JSON.parse(data);
                // console.log(freelancers);
                drowChart(freelancers.series,freelancer1_name,freelancer2_name);
            }

        });

    });


    function drowChart(series,freelancer1_name,freelancer2_name) {
        var size=0;

        $('#chart_div').highcharts({

            chart: {
                type: 'bar'
            },
            title: {
                text: 'Freelancer Comparison of Task',
                x: -20, 
                align: 'left',
                x: -10,
            },
            subtitle: {
                text: `Task Comparison of ${freelancer1_name} Vs. ${freelancer2_name}`,
                align: 'left',
                x: -10,

            },
            xAxis: {
                categories: [ freelancer1_name,freelancer2_name ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Value()'
                }
            },
            colors: ['#0661af','#00c851','#ffc107'],
            tooltip: {
                headerFormat:   '<span style="font-size:15px; text-transform:uppercase">{point.key}</span><table style="width:200px">',
                pointFormat:    '<tr><td style="color:{series.color};padding:0"><b style="font-size:12px"> {series.name} : </b></td>' +
                                '<td style="padding:0"><b style="font-size:14px">{point.y} </b></td></tr>',
                footerFormat:   '</table>',
                shared: true,
                useHTML: true
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            credits: {
                enabled: false
            },

            series:series

        });

    }

</script>