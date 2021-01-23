<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "SELECT
count(*) dataperson,
case WHEN count(*) < 100 then 'h1 font-weight-bold mb-0 text-success' else 'h1 font-weight-bold mb-0 text-danger '  end as textcolor,
case WHEN count(*) < 100 then 'border-success' else 'border-danger '  end as bordercolor,
case WHEN count(*) < 100 then 'card card-stats border-success' else 'card card-stats border-danger '  end as cardcolor,
case WHEN count(*) < 100 then ' color: green' else ' color: red '  end as iconcolor
FROM
IPDTRANS
WHERE
TO_CHAR(IPDTRANS.DATEADMIT, 'yyyy/mm/dd') = TO_CHAR(CURRENT_DATE, 'yyyy/mm/dd')
and IPDTRANS.DATEDISCH is null







	

	
";
//and DISEASE_WAREHOUSE.HN = '".$hn."'

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){


	$a['dataperson']=$rs_pmk[0];
	$a['textcolor']=$rs_pmk[1];
	$a['bordercolor']=$rs_pmk[2];
	$a['cardcolor']=$rs_pmk[3];
	$a['iconcolor']=$rs_pmk[4];

	
	


	
	array_push($data,$a);
}	
	
// $data_array2 = array("data" => $data);

echo json_encode($data);

oci_close($objConnect);





?>
