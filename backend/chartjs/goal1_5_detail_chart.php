<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "select * from (
	SELECT
		CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+542 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +543 END as years,
			IPDTRANS.PLA_PLACECODE,
			PLACES.HALFPLACE,
			COUNT (IPDTRANS.AN) AS ipddead
	FROM
		IPDTRANS

	INNER JOIN DISEASE_WAREHOUSE on IPDTRANS.RUN_AN = DISEASE_WAREHOUSE.IPD_RUN_AN AND IPDTRANS.YEAR_AN = DISEASE_WAREHOUSE.IPD_YEAR_AN
	INNER JOIN PLACES on IPDTRANS.PLA_PLACECODE = PLACES.PLACECODE
	
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
	AND ((DISEASE_WAREHOUSE.ICD_CODE BETWEEN 'A400' AND 'A409') OR (DISEASE_WAREHOUSE.ICD_CODE BETWEEN 'A410' AND 'A419') OR 
	(DISEASE_WAREHOUSE.ICD_CODE LIKE 'R572') OR (DISEASE_WAREHOUSE.ICD_CODE LIKE 'R651'))
	
	
			GROUP BY IPDTRANS.PLA_PLACECODE,
			PLACES.HALFPLACE
			ORDER BY 	COUNT (IPDTRANS.AN) DESC)x
		
		
	



	
";
//and DISEASE_WAREHOUSE.HN = '".$hn."'

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){

	$a['YEARS']=$rs_pmk[0];
	$a['PLA_PLACECODE']=$rs_pmk[1];
	$a['HALFPLACE']=$rs_pmk[2];
	$a['IPDDEADCOUNT']=$rs_pmk[3];

	array_push($data,$a);
}	
	
// $data_array2 = array("data" => $data);

echo json_encode($data);

oci_close($objConnect);





?>
