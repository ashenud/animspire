<script type="text/javascript">
    
    $(document).ready(function () {
        var project1_id = '<?php echo $_REQUEST['project1_id']; ?>';
        var project2_id = '<?php echo $_REQUEST['project2_id']; ?>';
        var project1_name = '<?php echo $_REQUEST['project1_name']; ?>';
        var project2_name = '<?php echo $_REQUEST['project2_name']; ?>';
        $.ajax({
            type: 'POST',
            url: 'loadings/project-analysis.php',
            data: {
                'project1_id': project1_id,
                'project2_id': project2_id,
                'project1_name': project1_name,
                'project2_name': project2_name
            },
            success: function (data) {

                var projects = JSON.parse(data);

                //if(customer.quote_count > 0) {
                    // console.log(projects);
                    drowChart(projects.series,project1_name,project2_name);
                //}
               // else {
                   // swal("Someting went wrong!", `No data for customer ${customer_name} !`, "error");
                //}
            }

        });

    });


    function drowChart(series,project1_name,project2_name) {
        var size=0;

        $('#chart_div').highcharts({

            chart: {
                type: 'column'
            },
            title: {
                text: 'Project Comparison',
                x: -20, 
                align: 'left',
                x: -10,
            },
            subtitle: {
                text: `Task Comparison of ${project1_name} Vs. ${project2_name}`,
                align: 'left',
                x: -10,

            },
            xAxis: {
                categories: [ project1_name,project2_name ],
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