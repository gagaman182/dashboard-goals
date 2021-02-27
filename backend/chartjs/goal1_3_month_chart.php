<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'YYYY')+542 ELSE TO_CHAR(CURRENT_DATE, 'YYYY') +543 END as  YEARS,
TO_CHAR (IPDTRANS.DATEDISCH, 'YYYY-MM') as yearmonth  ,
CONCAT(CONCAT (TO_CHAR (IPDTRANS.DATEDISCH , 'MM'),'-'),  TO_CHAR (IPDTRANS.DATEDISCH , 'YYYY')+543) as months ,
count(IPDTRANS.AN) as datas 
FROM
IPDTRANS

	INNER JOIN DISEASE_WAREHOUSE on IPDTRANS.RUN_AN = DISEASE_WAREHOUSE.IPD_RUN_AN AND IPDTRANS.YEAR_AN = DISEASE_WAREHOUSE.IPD_YEAR_AN
WHERE
IPDTRANS.DATEDISCH >= CASE
WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
TO_DATE (
	TO_CHAR (CURRENT_DATE, 'yyyy') || '/' || '10/01',
	'yyyy/mm/dd'
)
ELSE
TO_DATE (
	TO_CHAR (CURRENT_DATE, 'yyyy') - 1 || '/' || '10/01',
	'yyyy/mm/dd'
)
END
AND IPDTRANS.DATEDISCH <= CASE
WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
TO_DATE (
	TO_CHAR (CURRENT_DATE, 'yyyy') + 1 || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' || TO_CHAR (CURRENT_DATE, 'dd') ,
	'yyyy/mm/dd'
)
ELSE
TO_DATE (
	TO_CHAR (CURRENT_DATE, 'yyyy') || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' || TO_CHAR (CURRENT_DATE, 'dd') ,
	'yyyy/mm/dd'
)
END
and IPDTRANS.DS_STATUS_ID = '9'
		and DISEASE_WAREHOUSE.OPDIPD = 'I'
	AND (DISEASE_WAREHOUSE.ICD_CODE LIKE 'Z380' OR DISEASE_WAREHOUSE.ICD_CODE LIKE 'Z383' OR DISEASE_WAREHOUSE.ICD_CODE LIKE 'Z386' )
GROUP BY 	TO_CHAR (IPDTRANS.DATEDISCH , 'YYYY') , TO_CHAR (IPDTRANS.DATEDISCH , 'MM'),TO_CHAR (IPDTRANS.DATEDISCH, 'YYYY-MM')
ORDER BY  TO_CHAR (IPDTRANS.DATEDISCH, 'YYYY-MM') 




	

	
";
//and DISEASE_WAREHOUSE.HN = '".$hn."'

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){

	$a['years']=$rs_pmk[0];
	$a['yearmonth']=$rs_pmk[1];
	$a['months']=$rs_pmk[2];
	$a['datas']=$rs_pmk[3];

	


	array_push($data,$a);
}	
	
// $data_array2 = array("data" => $data);

echo json_encode($data);

oci_close($objConnect);





?>
