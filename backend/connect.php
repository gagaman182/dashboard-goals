<?php

	// putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
	// $objConnect = oci_connect("admin","admin","192.168.99.250/HY");
	// if($objConnect)
	// {
	// 	echo "";
	// }
	// else
	// {
	// 	echo "Can not connect to Oracle Server";
	// }


    putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
	$username="cc";
	$password="cc";
	$objConnect =oci_connect($username,$password,'(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.99.250)(PORT = 1521))(CONNECT_DATA = (SERVICE_NAME = hy)(SID = hy)))');

	if(!$objConnect){
		echo "Can not connect to Oracle Server";
		exit;
	}



?>