
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$adminObj = new Admin();

$admin_id ="";
if ($_REQUEST['admin_id'] != "") {
    $admin_id = "AND u.user_id ='". $_REQUEST['admin_id'] ."'";
}

$db_backup = $adminObj->getDbBackupData($admin_id);

if($_SESSION["user"]["role_id"]==1) {
?>

   
    <table id="printarea" width="98%" border="1" align="center">
        <tr style="background: #cfb3e9;">
            <th align="center" width="70px">Backup ID</th>
            <th align="center" width="90px">Reference</th>
            <th align="center" width="100px">Date</th>
            <th align="center" width="100px">Time</th>
            <th align="left" width="160px">description</th>
        </tr>
    <?php
    if($db_backup->num_rows >0) {
        while($dataRow = $db_backup->fetch_assoc()) {
        ?>
            <tr>
                <td align="center" > <?php echo $dataRow["backup_id"]; ?></td>
                <td align="center" > <?php echo $dataRow["reference"]; ?></td>
                <td align="center" > <?php echo $dataRow["date"]; ?></td>
                <td align="center" > <?php echo $dataRow["time"]; ?></td>
                <td align="left" > <?php echo $dataRow["description"]; ?></td>
            </tr>
        <?php
        }
    }
    else {
        ?>
        <tr>
            <td align="center" style="text-align:center; color:red" colspan="5">No result found</td>
        </tr>
        <?php
    }
    ?>
    </table>
    <button name="download-btn" class="btn btn-danger float-right" id="download-btn" onclick="generate_pdf()">
        <i class="fas fa-print"></i> Print
    </button>
    

    <script>

        function generate_pdf() {

            $("#printarea").attr("border", "");
            var print_area = $("#printarea")[0].outerHTML;

            var filters =   "<h1 align='center'>Animspire Freelancer Management System</h1>" +
                            "<div style='margin-bottom:45px'>" +
                                "<table width='100%' align='center'>" +
                                    "<tr class='body_text'>" +
                                        "<td align='center'><h2 style=''>Database Backup Details</h2></td>" +
                                    "</tr>" +
                                "</table>"+
                            "</div>";

            var pdf_name = "database backup details.pdf";

            var layout = "A4";


            var mapForm = document.createElement("form");
            mapForm.target = "Map";
            mapForm.method = "POST"; 
            mapForm.action = "./loadings/report_template.php";

            var mapInput = document.createElement("input");
            mapInput.type = "hidden";
            mapInput.name = "x";
            mapInput.value = print_area;
            mapForm.appendChild(mapInput);

            var mapInput2 = document.createElement("input");
            mapInput2.type = "hidden";
            mapInput2.name = "y";
            mapInput2.value = filters;
            mapForm.appendChild(mapInput2);

            var mapInput3 = document.createElement("input");
            mapInput3.type = "hidden";
            mapInput3.name = "z";
            mapInput3.value = pdf_name;
            mapForm.appendChild(mapInput3);

            var mapInput4 = document.createElement("input");
            mapInput4.type = "hidden";
            mapInput4.name = "layout";
            mapInput4.value = layout;
            mapForm.appendChild(mapInput4);

            document.body.appendChild(mapForm);

            map = window.open("", "Map", "status=0,title=0,height=1600,width=1800,scrollbars=1");

            if (map) {
                mapForm.submit();
            } else {
                alert('Please Retry.');
            }


        }

    </script>

<?php
} else {
    echo 'Invalid User';
}
?>