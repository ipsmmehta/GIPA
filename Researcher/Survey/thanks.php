<?php 
 
session_start();
    
	// START OF SESSION FEILD
    $_SESSION['timeout'] = time();
    
		if(!isset($_SESSION['sess_username'])){
		  header('Location: ../index.php');
        }
        $sess_userid =  $_SESSION['sess_userid'] ;
        $sess_username =  $_SESSION['sess_username'] ;
        $sess_name = $_SESSION['sess_name'];
        $sess_userrole =  $_SESSION['sess_userrole'] ;
        $sess_designation =   $_SESSION['sess_designation'] ;
        //$sess_lastlogin_at =   $_SESSION['sess_lastlogin_at'] ;
        $sess_created_at = $_SESSION['sess_created_at'];
		//$sess_userlogincountt =   $_SESSION['sess_userlogincountt'] ;
        //$sess_useractive =   $_SESSION['sess_useractive'] ;
	$final="NO";
    // END   OF SESSION FEILD
    // session_destroy(); 
?>
<?php  require "../config.php";// connection to database  ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 10px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

.red{
	font-size:19px;
	color:red;
}
</style>
<body>
<div id="regForm"   >

<div class="row">
  <div class="col-sm-6" align="left"><a href="#"> Welcome <?php  echo $sess_name; ?></a> <!-- <a href="index.php" onclick="return confirm('This Button will take you to home page and can cause the loss of data you have entered in the form, It is recommended to complete the form and submit it, then go back, Are you sure you want to go back ?');" title="you may losse all of your data onclick " > <span class="label label-warning">Back</span> </a>  --></div>
  <div class="col-sm-6" align="right"> <a href="../logout.php" onclick="return confirm('Are you sure  about Logout ?');" title="  Log-Out" > <span class="label label-danger">Logout</span> </a> </div>
 
</div>
 <br>
<?php 
	$SQL_Sg="SELECT Annexure2 FROM survey_data WHERE id ='1' ";
	foreach($dbo->query($SQL_Sg) AS $jhs5){
		echo $jhs5["Annexure2"];
	}
?>

<center >
							 
								<h2 style="color:red;"> Thanks for participating in Survey  </h2>
								<h4> your data has been successfully received </h4>
								 
								</center>