<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+542 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +543 END as  YEARS,
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
) x
INNER JOIN (
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
		TO_CHAR (CURRENT_DATE, 'yyyy') + 1 || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' || TO_CHAR (CURRENT_DATE, 'dd') ,
			'yyyy/mm/dd'
		)
ELSE
	TO_DATE (
		TO_CHAR (CURRENT_DATE, 'yyyy') || '/' || TO_CHAR (CURRENT_DATE, 'mm') || '/' || TO_CHAR (CURRENT_DATE, 'dd') ,
			'yyyy/mm/dd'
		)
END
and DS_STATUS_ID = '9'
) ipddeath ON x. YEAR = IPDDEATH. YEAR

UNION 
SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+541 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +542 END as  YEARS,
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-1 || '/' || '10/01',
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
			TO_CHAR (CURRENT_DATE, 'yyyy')  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -1 || '/' ||'09/30' ,
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
			TO_CHAR (CURRENT_DATE, 'yyyy')  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -1 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	END
and DS_STATUS_ID = '9'
) ipddeath ON x. YEAR = IPDDEATH. YEAR

union 
SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+540 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +541 END as  YEARS,
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-2 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 3 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-1  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -2 || '/' ||'09/30' ,
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

	WHERE
		IPDTRANS.DATEDISCH >= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -2 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 3 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
	AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-1  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -2 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	END
and DS_STATUS_ID = '9'
) ipddeath ON x. YEAR = IPDDEATH. YEAR

UNION 

SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+539 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +540 END as  YEARS,
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-3 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 4 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-2 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -3 || '/' ||'09/30' ,
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

	WHERE
		IPDTRANS.DATEDISCH >= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -3 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 4 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
	AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-2  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -3 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	END
and DS_STATUS_ID = '9'
) ipddeath ON x. YEAR = IPDDEATH. YEAR
UNION
SELECT
CASE WHEN TO_CHAR(CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN TO_CHAR(CURRENT_DATE, 'yyyy')+538 ELSE TO_CHAR(CURRENT_DATE, 'yyyy') +539 END as  YEARS,
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-4 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 5 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-3 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -4 || '/' ||'09/30' ,
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

	WHERE
		IPDTRANS.DATEDISCH >= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -4 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 5 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
	AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-3  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -4 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	END
and DS_STATUS_ID = '9'
) ipddeath ON x. YEAR = IPDDEATH. YEAR






	
";
//and DISEASE_WAREHOUSE.HN = '".$hn."'

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){

	$a['YEARS']=$rs_pmk[0];
	$a['DATA']=$rs_pmk[1];

	


	array_push($data,$a);
}	
	
// $data_array2 = array("data" => $data);

echo json_encode($data);

oci_close($objConnect);





?>
