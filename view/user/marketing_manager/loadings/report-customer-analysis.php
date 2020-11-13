<script type="text/javascript">
    
    $(document).ready(function () {
        var customer_name = '<?php echo $_REQUEST['customer_name']; ?>';
        var customer_id = '<?php echo $_REQUEST['customer_id']; ?>';
        $.ajax({
            type: 'POST',
            url: 'loadings/customer-analysis.php',
            data: {
                'customer_id': customer_id
            },
            success: function (data) {

                var customer = JSON.parse(data);
                // console.log(customer);
                var series = customer['series'];

                drowChart(series);
            }

        });

    });


    function drowChart(series) {
        var size=0;

        $('#chart_div').highcharts({

            chart: {
                type: 'column'
            },
            title: {
                text: 'CUSTOMER ANALYSIS',
                x: -20, 
            },
            xAxis: {
                categories: [ 'Analysis' ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Value()'
                }
            },
            colors: ['#0661af','#a569bd','#ff3547','#ffc107','#00c851'],
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

            series:series

        });

    }

</script>