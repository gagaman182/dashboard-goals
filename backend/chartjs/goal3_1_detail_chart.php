<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "select * from (SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+542 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +543 END as  YEARS,
IPDTRANS.PLA_PLACECODE,
PLACES.HALFPLACE,
sum(ROUND(IPDTRANS.DATEDISCH - IPDTRANS.DATEADMIT)) AS ipddead
	FROM
		IPDTRANS
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
			TO_CHAR (CURRENT_DATE, 'yyyy') + 1 || '/' || '09/30',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') || '/' || '09/30',
			'yyyy/mm/dd'
		)
	END
	and IPDTRANS.DATEDISCH is not null
GROUP BY IPDTRANS.PLA_PLACECODE,
PLACES.HALFPLACE
ORDER BY 	sum(ROUND(IPDTRANS.DATEDISCH - IPDTRANS.DATEADMIT)) DESC)x
		


	
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
