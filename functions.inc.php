<?php

	function mysqlconnect() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		echo "Connected to MySQL<br />";
		mysql_select_db("test") or die(mysql_error());
		echo "Connected to Database";
	 
	} 
	
	//function renametable() {
	
	//	$sql = "RENAME TABLE `test`.`table 1` TO `test`.`testdata`";

	//}

	 function removeapostrophe() {
	 
		// Make a MySQL Connection
		$query = "SELECT * FROM testdata"; 
			 
		// Print out the contents of the entry 
		$result = mysql_query($query) or die(mysql_error());
		//echo "test";
		while($row = mysql_fetch_array($result)){
			$id = $row['UID'];
			//echo $id;
			$or_no = $row['Originating_No'];
			$new_or_no = str_replace("'","","$or_no");
			//echo $new_or_no;

			$sql="UPDATE testdata SET Originating_No=$new_or_no WHERE UID=$id";
			
			//'UPDATE tutorials_tbl SET tutorial_title="Learning JAVA" WHERE tutorial_id=3'
			
			$tt=mysql_query($sql);

				if($tt){
				//echo "<BR>";
				//echo "<a href='insert.php'>Back to main page</a>";
				//echo "Successful";
				}

				else {
					die('Could not update data: ' . mysql_error());

				}
		}

		// close connection 

	}

	function addcolumns() {
	
		$query = "SELECT * FROM testdata"; 
			 
		// Print out the contents of the entry 
		$result = mysql_query($query) or die(mysql_error());
		
		$query="ALTER TABLE testdata ADD validcountrycalled VARCHAR(60)";
		$result = mysql_query($query); 
		$query="ALTER TABLE testdata ADD validatedband VARCHAR(60)";
		$result = mysql_query($query);
		$query="ALTER TABLE testdata ADD validatemobile VARCHAR(60)";
		$result = mysql_query($query);
		$query="ALTER TABLE testdata ADD validatedcost VARCHAR(60)";
		$result = mysql_query($query);
		$query="ALTER TABLE testdata ADD duration60 VARCHAR(60)";
		$result = mysql_query($query);
		$query="ALTER TABLE testdata ADD validateukmobile VARCHAR(60)";
		$result = mysql_query($query);

		echo "adding columns complete";
	}
	
	function changetime() {
	
		$query = "SELECT * FROM testdata"; 
		$result = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_array($result)){
			$id = $row['UID'];
			$time = $row['Duration'];
			$arr = explode(":", $time);  
			$validtime = $arr[0] * 60 + $arr[1] + 1; 
						
			$sql="UPDATE testdata SET duration60=$validtime WHERE UID=$id";
			$tt=mysql_query($sql);

				if($tt){
				//echo "<BR>";
				//echo "<a href='insert.php'>Back to main page</a>";
				//echo "Successful";
				}

				else {
					die('Could not update data: ' . mysql_error());

				}
		}
	}
	
	function mobile() {
	
		$query = "SELECT * FROM testdata"; 
		$result = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_array($result)){
			$id = $row['UID'];
			$group = $row['ChargeGroup'];
						
			$pos = strpos($group,'mbl');

			if($pos === false) {
			 // string needle NOT found in haystack
			 //echo "not found";
				$sql="UPDATE testdata SET validatemobile='0' WHERE UID=$id";
				$tt=mysql_query($sql);

				if($tt){
				//echo "<BR>";
				//echo "<a href='insert.php'>Back to main page</a>";
				//echo "Successful";
				}

				else {
				die('Could not update data: ' . mysql_error());

				}
			}
			else {
			 // string needle found in haystack
			 //echo "found";
				$sql="UPDATE testdata SET validatemobile='1' WHERE UID=$id";
				$tt=mysql_query($sql);

				if($tt){
				//echo "<BR>";
				//echo "<a href='insert.php'>Back to main page</a>";
				//echo "Successful";
				}

				else {
					die('Could not update data: ' . mysql_error());

				}
			}

		}
	
	}
	
	function callednumber() {
	
		// Make a MySQL Connection
		$query = "SELECT * FROM testdata"; 
			 
		// Print out the contents of the entry 
		$result = mysql_query($query) or die(mysql_error());
		//echo "test";
		while($row = mysql_fetch_array($result)){
			$id = $row['UID'];
			//echo $id;
			$or_no = $row['CalledNo'];
			$new_or_no = str_replace("'","","$or_no");
			//echo $new_or_no;

			$sql="UPDATE testdata SET CalledNo=$new_or_no WHERE UID=$id";
			
			//'UPDATE tutorials_tbl SET tutorial_title="Learning JAVA" WHERE tutorial_id=3'
			
			$tt=mysql_query($sql);

				if($tt){
				//echo "<BR>";
				//echo "<a href='insert.php'>Back to main page</a>";
				//echo "Successful";
				}

				else {
					die('Could not update data: ' . mysql_error());

				}
		}
	
	}
	
	function validateukmobile() {
	
	//Is the called number uk if mobile == 1?
	
	
	
	}
	
	function validatecountry() {
	
		//what country are you calling?
		//how many digits at the start of the string?
		//get amount of chars
		
		$query = "SELECT * FROM testdata";
		$result = mysql_query($query) or die(mysql_error());
		while ($row = mysql_fetch_array($result)){
		
			$id = $row['UID'];
			$number = $row['CalledNo'];
			
				$sql = "SELECT * FROM countrycodes";
				$sqlret = mysql_query($sql) or die(mysql_error());
				
				while ($row = mysql_fetch_array($sqlret)){
				
					$cty = $row['Country'];
					$amt = $row['Amount'];
					$dialcode = $row['CountryDialCode'];
					
					$correct = substr($number, 0, $amt);
					
					//echo $correct;
					echo "<br />";
					echo $number;
					echo "<br />";
					echo $correct;
					echo "<br />";
					if ($dialcode == $correct) { 

						echo $cty;

					}
					else {

						echo "Boo!";

					}
				
				break;
				}
			
		}
		
	}
	
	/*
	function parsenumber($number) {
	
		$query = "SELECT * FROM countrycodes"; 
		$result = mysql_query($query) or die(mysql_error());
		while($row = mysql_fetch_array($result)){
			$cty = $row['Country'];
			$amt = $row['Amount'];
			$dialcode = $row['CountryDialCode'];
			$correct = substr($number, 0, $amt);
			//echo $correct;
			echo $number;
			echo "<br />";
			if ($dialcode == $correct) { 
			
				echo $cty;
			
			}
			else {
			
				echo "Boo!";
			
			}
			//echo substr($cty, 0, $amt);
		
		}
	
	
	}
	*/
	
	function calculations() {
	
	$sql = "SELECT * FROM testdata";
	$sqlret = mysql_query($sql) or die(mysql_error());
	
		while($row = mysql_fetch_array($sqlret)){
		
		$time = $row['duration60'];
		$band = $row['validateband'];
		
			if ($time >60) {
			
				echo $time;
				echo "More";
				
				//Lookup band
				//select * from bands where chargebands = $band;
				//return cost ppm
				//$total = $cost * $time;
				//echo $total;
				//update table testdata with calculated cost (valdatedcost)
				
			
			}
			
			else if ($time <60) {
			
				echo $time;
				echo "Less";
				
				//Lookup band and place cost in database
			
			}
					
			else {
			
				break;
			
			}
		
		}
	
	}
	
	function mysqlclose() {
	
		mysql_close();
		
	}
	
?>
