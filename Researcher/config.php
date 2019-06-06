<?Php
/////// Update your database login details here /////
$dbhost_name = "localhost"; // Your host name 
$database = "itra_mis";       // Your database name
$username = "gaurav";            // Your login userid 
$password = "5PaF6wWsw6YAnzEw";            // Your password 
//////// End of database details of your server //////

// START OF AAJ Ki DATA 
    date_default_timezone_set("Asia/Kolkata");
    $aajki_date = date("Y-m-d H:i:s");
// END OF AAJ Ki DATA 
//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 

<?php

	function get_ini($dbo,$ini_id)
	{
		$SQl_h7="SELECT Instituteshortname FROM institutedata WHERE institute_id='$ini_id' ";
			foreach($dbo->query($SQl_h7)AS $GFH79)
			{
				return $val_ininm = $GFH79["Instituteshortname"];
			}
			
		
	}
?>
<?php

	function get_pnm($dbo,$pnm_id)
	{
		$SQl_h72="SELECT Projectshorttitle FROM projectdata WHERE project_id='$pnm_id' ";
			foreach($dbo->query($SQl_h72)AS $GFH792)
			{
				return $val_pnm = $GFH792["Projectshorttitle"];
			}
			
		
	}
?>
<?php

	function get_fanm($dbo,$pnm_id)
	{
		$SQl_h75="SELECT focusareashortname FROM projectdata WHERE project_id='$pnm_id' ";
			foreach($dbo->query($SQl_h75)AS $GFH795)
			{
				return $val_pnm5 = $GFH795["focusareashortname"];
			}
			
		
	}
?>