<?php
	include("functions.inc.php");

	echo "Prepping table";	

	mysqlconnect();
	//renametable();
	//removeapostrophe();
	//addcolumns();
	//changetime();
	//mobile();
	//callednumber();
	//validateukmobile();
	validatecountry();
	//validateband();
	//validateduration(); Incomplete
	//calculations(); Incomplete
	mysqlclose();
	
?>
