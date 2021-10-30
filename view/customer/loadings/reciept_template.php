
<?php
session_start();
date_default_timezone_set('Asia/Colombo');

$print_div= $_REQUEST['y'];

$report_genarator = $_SESSION["user"]["firstname"].' '.$_SESSION["user"]["lastname"];

include("../../../libraries/mpdf/mpdf.php");

$mpdf=new mPDF('c',$_REQUEST['layout'],9,10,15,10,15,15); 

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

$mpdf->SetFooter('Report genarated by '.$report_genarator. ' {DATE  j-m-Y  g:i a} || {PAGENO} of {nb}');

// LOAD a stylesheet
$stylesheet = file_get_contents('../../../css/pdf-style.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($print_div,2);


$mpdf->Output($_REQUEST['z'],'I');
exit;