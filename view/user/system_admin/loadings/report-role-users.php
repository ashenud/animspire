
<?php
include '../../../../commons/session.php';
include '../../../../model/user_model.php';
$userObj = new User();

$role ="";
if ($_REQUEST['role_id'] != "") {
    $role = "AND ur.role_id ='". $_REQUEST['role_id'] ."'";
}

$userResults = $userObj->getAllUsers();
$roleUsers = $userObj->getUsersForRole($role);

if($_SESSION["user"]["role_id"]==1) {
?>

    <div id="data_section" class="scroll mt-3" style="overflow-y:scroll;">
        <table id="printarea" width="98%" border="1" align="center">
            <tr style="background: #cfb3e9;">
                <th align="center" width="50px">User ID</th>
                <th align="left" width="90px">Name</th>
                <th align="left" width="180px">Email</th>
                <th align="center" width="165px">Phone</th>
                <th align="left" width="80px">Designation</th>
                <th align="left" width="90px">Department</th>
                <th align="center" width="60px">Gender</th>
            </tr>
        <?php
        while($userRow = $roleUsers->fetch_assoc()) {
        ?>
            <tr>
                <td align="center" > <?php echo $userRow["id"]; ?></td>
                <td align="left" > <?php echo $userRow["name"]; ?></td>
                <td align="left" > <?php echo $userRow["email"]; ?></td>
                <td align="center" > <?php echo $userRow["phone"]; ?></td>
                <td align="left" > <?php echo $userRow["designation"]; ?></td>
                <td align="left" > <?php echo $userRow["department"]; ?></td>
                <td align="center" > <?php echo $userRow["gender"]; ?></td>
            </tr>
        <?php
        }
        ?>
        </table>
        <button name="download-btn" class="btn btn-danger float-right" id="download-btn" onclick="generate_pdf()">
            <i class="fas fa-print"></i> Print
        </button>
    </div>

    <script>

        function generate_pdf() {

            $("#printarea").attr("border", "");
            var print_area = $("#printarea")[0].outerHTML;

            var filters =   "<h1 align='center'>Animspire Freelancer Management System</h1>" +
                            "<div style='margin-bottom:45px'>" +
                                "<table width='100%' align='center'>" +
                                    "<tr class='body_text'>" +
                                        "<td align='center'><h2 style=''>Employee Information by Role</h2></td>" +
                                    "</tr>" +
                                "</table>"+
                            "</div>";

            var pdf_name = "employee information by role.pdf";

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