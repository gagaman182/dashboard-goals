<?php
	 header('Access-Control-Allow-Origin: *');
   

include 'connect.php';
// $opdno = $_GET["opdno"];




$data=array();

$strSQL  = "select * from (SELECT
'1' as years,
ROUND ((  IPDDEATH.IPDDISCHARGE / x.ipddischarge) * 100,2) as dataperson,
oldyear.dataperson as datapersonold,
oldyear2.dataperson as datapersonold2,
oldyear3.dataperson as datapersonold3,
oldyear4.dataperson as datapersonold4,
oldyear5.dataperson as datapersonold5

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
)oldyear on x.year = oldyear.years
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
) ipddeath ON x. YEAR = IPDDEATH. YEAR)oldyear2 on x.year = oldyear2.years
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-2  || '/' || '09/30' ,
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
) ipddeath ON x. YEAR = IPDDEATH. YEAR)oldyear3 on x.year = oldyear3.years
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-3  || '/' || '09/30' ,
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
) ipddeath ON x. YEAR = IPDDEATH. YEAR)oldyear4 on x.year = oldyear4.years
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
			TO_CHAR (CURRENT_DATE, 'yyyy')-5 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 6 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-4  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -5 || '/' ||'09/30' ,
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
			TO_CHAR (CURRENT_DATE, 'yyyy') -5 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') - 6 || '/' || '10/01',
			'yyyy/mm/dd'
		)
	END
	AND IPDTRANS.DATEDISCH <= CASE
	WHEN TO_CHAR (CURRENT_DATE, 'mm') IN ('10', '11', '12') THEN
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy')-4  || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	ELSE
		TO_DATE (
			TO_CHAR (CURRENT_DATE, 'yyyy') -5 || '/' || '09/30' ,
			'yyyy/mm/dd'
		)
	END
and DS_STATUS_ID = '9'
) ipddeath ON x. YEAR = IPDDEATH. YEAR)oldyear5 on x.year = oldyear5.years
)x






	
";
//and DISEASE_WAREHOUSE.HN = '".$hn."'

$objParse = oci_parse ($objConnect, $strSQL);
oci_execute($objParse,OCI_DEFAULT);
while($rs_pmk=oci_fetch_array($objParse,OCI_BOTH)){

	$a['YEAR1']=$rs_pmk[1];
	$a['YEAR2']=$rs_pmk[2];
	$a['YEAR3']=$rs_pmk[3];
	$a['YEAR4']=$rs_pmk[4];
	$a['YEAR5']=$rs_pmk[5];
	


	array_push($data,$a);
}	
	
// $data_array2 = array("data" => $data);

echo json_encode($data);

oci_close($objConnect);





?>
