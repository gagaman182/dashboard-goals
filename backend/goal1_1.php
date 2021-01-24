<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "
SELECT
'1' as years,
ROUND ((  IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) as dataperson,
case WHEN  ROUND((IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) < 2.5 then 'text-success' else ' text-danger '  end as textcolor,
case WHEN  ROUND ((IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) < 2.5 then 'border-success' else 'border-danger '  end as bordercolor,
oldyear.dataperson as datapersonold,
case when ROUND ((  IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) < oldyear.dataperson then  'text-success' else ' text-danger '  end as updowncolor,
case when ROUND ((  IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) < oldyear.dataperson then  'arrow-down' else 'arrow-up'  end as updownicon

FROM
(
	SELECT
		'1' AS YEAR,
		COUNT (IPDTRANS.AN) AS ipddischarge
	FROM
		IPDTRANS
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
) x
INNER JOIN (
SELECT
	'1' AS YEAR,
	COUNT (IPDTRANS.AN) AS ipddischarge
FROM
	IPDTRANS
INNER JOIN CAUSE_OF_DEATH ON IPDTRANS.AN = CAUSE_OF_DEATH.AN
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
) ipddeath ON x. YEAR = IPDDEATH. YEAR
INNER JOIN(SELECT
'1' as years,
ROUND ((  IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) as dataperson



FROM
(
	
	SELECT
		'1' AS YEAR,
		COUNT (IPDTRANS.AN) AS ipddischarge
	FROM
		IPDTRANS
	WHERE
		IPDTRANS.DATEDISCH >= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -1 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 2 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
	AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')  || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' ||  '30',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -1 || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' || '30',
			'yyyy/mm/dd'
		)
	END
) x
INNER JOIN (
SELECT
	'1' AS YEAR,
	COUNT (IPDTRANS.AN) AS ipddischarge
FROM
	IPDTRANS
INNER JOIN CAUSE_OF_DEATH ON IPDTRANS.AN = CAUSE_OF_DEATH.AN
	WHERE
		IPDTRANS.DATEDISCH >= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -1 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 2 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
	AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')  || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' ||  '30',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -1 || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' || '30',
			'yyyy/mm/dd'
		)
	END
) ipddeath ON x. YEAR = IPDDEATH. YEAR
)oldyear on x.year = oldyear.years




	

	
";
//and DISEASE_WAREHOUSE.HN = '".$hn."'

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){


	$a['dataperson']=$rs_pmk[1];
	$a['textcolor']=$rs_pmk[2];
	$a['bordercolor']=$rs_pmk[3];
	$a['datapersonold']=$rs_pmk[4];
	$a['updowncolor']=$rs_pmk[5];
	$a['updownicon']=$rs_pmk[6];
	
	
	
	


	
	array_push($data,$a);
}	
	
// $data_array2 = array("data" => $data);

echo json_encode($data);

oci_close($objConnect);





?>
