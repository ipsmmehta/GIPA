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
  <div class="col-sm-6" align="left"> <a href="#"> Welcome <?php  echo $sess_name; ?></a> <!-- <a href="index.php" onclick="return confirm('This Button will take you to home page and can cause the loss of data you have entered in the form, It is recommended to complete the form and submit it, then go back, Are you sure you want to go back ?');" title="you may losse all of your data onclick " > <span class="label label-warning">Back</span> </a>  --></div>
  <div class="col-sm-6" align="right"> <a href="../logout.php" onclick="return confirm('Are you sure about Logout ?');" title="  Log-Out" > <span class="label label-danger">Logout</span> </a> </div>
 
</div>
 <br>
<?php 
	$SQL_Sg="SELECT Annexure1 FROM survey_data WHERE id ='1' ";
	foreach($dbo->query($SQL_Sg) AS $jhs5){
		echo $jhs5["Annexure1"];
	}
?>
  
<hr>
 
  <?php 
	if (empty($_POST))
		{
			 $final_submission = $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				     $avail_count = $GF5["0"];
			}
			if($avail_count==0)
			{
				?>
				<form name="sdffsd" method="post" >
					<input type="submit" name="Save_data_step1" value=" Please click here to start the survey " class="btn btn-success" > 
				</form>
				<?php 
				}else { 
					
					
					$Check_avail ="SELECT final_submission FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
					foreach($dbo->query($Check_avail) AS $GF5)
						{
							  	$final_submission = $GF5["final_submission"];
						}
						if($final_submission=="YES"){
							?> <center >
								<!--
								<h2 style="color:red;"> Thanks for participating in Survey  </h2>
								<h4> your data has been successfully received </h4>
								-->
								</center>
								
								  <script type="text/javascript">
									  var POP;
									  function pop() {
										var userid = <?php echo $sess_userid ?> ;
										POP = window.open('print.php?print='+userid, 'thePopup', 'width=750,height=750');
									  }
								 </script>
								<div align="right">	
								  <button type="submit"  onclick="pop();" class="btn btn-default" style="width:auto; text-align:left;"  > &nbsp;  <a href="#"><span class="glyphicon glyphicon-envelope"></span></a>    Print file   <span class="caret"></span> </button>
								
								<!-- 								
								<div class="dropdown">
								 <form name="dfsd" method="post" action="print.php" >
									<input type="text" name="User_name" value="<?php echo $sess_userid; ?>" hidden readonly style="display:none;" />
									<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"> <span class="glyphicon glyphicon-download-alt"></span> Action
									<span class="caret"></span></button>

									<ul class="dropdown-menu dropdown-menu-right"   role="menu" aria-labelledby="menu1">
									 
									  <li role="presentation"> <button type="submit" name="get_exelAnex_1_excel" class="btn btn-default" style="width:100%; text-align:left;"  > &nbsp;    <span class="glyphicon glyphicon-cloud-download"></span>   &nbsp; Excel file &nbsp;  </button> </li>
									   <li role="presentation"> <button type="submit" name="get_exelAnex_1_word" class="btn btn-default" style="width:100%; text-align:left;"  > &nbsp;   <span class="glyphicon glyphicon-cloud-download"></span>    &nbsp;  Word file &nbsp;  </button> </li>
									 
									  <li role="presentation"> <button type="submit" name="get_exelAnex_1_pdf" class="btn btn-default" style="width:100%; text-align:left;"  > &nbsp;   <span class="glyphicon glyphicon-cloud-download"></span>    &nbsp;  Pdf file &nbsp;  </button> </li>
									   </ul>
									
								</form>  </div>
								--> 
								</div>
								 
							<?php 
						}else{
						}							
							// preview_form($sess_userid,$dbo);
							
							switch($avail_count){
								case 0:
									form_step1($sess_userid,$dbo,$final);
								break;
								case 15:
									form_step2($sess_userid,$dbo,$final);
								break;
								case 60:
									form_step3($sess_userid,$dbo,$final);
								break;
								case 94:
									form_step4($sess_userid,$dbo,$final);
								break;
								 default:
								   preview_form($sess_userid,$dbo);
								break;
							}
							
							//form_step1($sess_userid,$dbo,$final);
							//form_step2($sess_userid,$dbo,$final);
							//form_step3($sess_userid,$dbo,$final);
							//form_step4($sess_userid,$dbo,$final);
						 
						 
				
				?>
				 
				<?php 
			}
		 ?> 	

		 <?php 
		} 
  ?>
  <!-- One "tab" for each step in the form: -->
  
<?php 
	if(isset($_POST["final_Submit"]))
	{
		if(empty($_POST["Institute5A"])){	$Institute5A ="";    }else 	{  $Institute5A = $_POST["Institute5A"];  }
			if(empty($_POST["Institute5B"])){	$Institute5B ="";	 }else 	{  $Institute5B = $_POST["Institute5B"];  }
			if(empty($_POST["Institute5C"])){	$Institute5C =""; 	 }else 	{  $Institute5C = $_POST["Institute5C"];  }
			if(empty($_POST["Institute5D"])){	$Institute5D =""; 	 }else 	{  $Institute5D = $_POST["Institute5D"];  }
			 if(empty($_POST["Institute4a_1"])){	$Institute4a_1 ="";  	 }else 	{  $Institute4a_1 = $_POST["Institute4a_1"];  }
	 if(empty($_POST["Institute4a_2"])){	$Institute4a_2 ="";  	 }else 	{  $Institute4a_2 = $_POST["Institute4a_2"];  }
	 if(empty($_POST["Institute4a_3"])){	$Institute4a_3 ="";  	 }else 	{  $Institute4a_3 = $_POST["Institute4a_3"];  }
	 if(empty($_POST["Institute4a_4"])){	$Institute4a_4 ="";  	 }else 	{  $Institute4a_4 = $_POST["Institute4a_4"];  }
	 
	 if(empty($_POST["Institute4b_1"])){	$Institute4b_1 ="";  	 }else 	{  $Institute4b_1 = $_POST["Institute4b_1"];  }
	 if(empty($_POST["Institute4b_2"])){	$Institute4b_2 ="";  	 }else 	{  $Institute4b_2 = $_POST["Institute4b_2"];  }
	 if(empty($_POST["Institute4b_3"])){	$Institute4b_3 ="";  	 }else 	{  $Institute4b_3 = $_POST["Institute4b_3"];  }
	 if(empty($_POST["Institute4b_4"])){	$Institute4b_4 ="";  	 }else 	{  $Institute4b_4 = $_POST["Institute4b_4"];  }
	 if(empty($_POST["Institute4b_5"])){	$Institute4b_5 ="";  	 }else 	{  $Institute4b_5 = $_POST["Institute4b_5"];  }
	 if(empty($_POST["Institute4b_6"])){	$Institute4b_6 ="";  	 }else 	{  $Institute4b_6 = $_POST["Institute4b_6"];  }
	 if(empty($_POST["Institute4b_7"])){	$Institute4b_7 ="";  	 }else 	{  $Institute4b_7 = $_POST["Institute4b_7"];  }
	 if(empty($_POST["Institute4b_8"])){	$Institute4b_8 ="";  	 }else 	{  $Institute4b_8 = $_POST["Institute4b_8"];  }
	 if(empty($_POST["Institute4b_9"])){	$Institute4b_9 ="";  	 }else 	{  $Institute4b_9 = $_POST["Institute4b_9"];  }
	 if(empty($_POST["Institute4b_10"])){	$Institute4b_10 ="";  	 }else 	{  $Institute4b_10 = $_POST["Institute4b_10"];  }
	 if(empty($_POST["Institute4b_11"])){	$Institute4b_11 ="";  	 }else 	{  $Institute4b_11 = $_POST["Institute4b_11"];  }
	 if(empty($_POST["Institute4b_12"])){	$Institute4b_12 ="";  	 }else 	{  $Institute4b_12 = $_POST["Institute4b_12"];  }
	 
	 if(empty($_POST["Institute4C"])){	 $Institute4C ="";   }else 	{  $Institute4C = $_POST["Institute4C"];  }
	 if(empty($_POST["Institute4C_1"])){	 $Institute4C_1 ="";   }else 	{  $Institute4C_1 = $_POST["Institute4C_1"];  }
	 if(empty($_POST["Institute4D"])){	 $Institute4D =""; 	 }else 	{  $Institute4D = $_POST["Institute4D"];  }
	 if(empty($_POST["Institute4D_1"])){	 $Institute4D_1 =""; 	 }else 	{  $Institute4D_1 = $_POST["Institute4D_1"];  }
	 if(empty($_POST["Institute4D_2"])){	 $Institute4D_2 =""; 	 }else 	{  $Institute4D_2 = $_POST["Institute4D_2"];  }
	 if(empty($_POST["Institute4E"])){	 $Institute4E =""; 	 }else 	{  $Institute4E = $_POST["Institute4E"];  }
	 if(empty($_POST["Institute4E_1"])){	 $Institute4E_1 =""; 	 }else 	{  $Institute4E_1 = $_POST["Institute4E_1"];  }
	 if(empty($_POST["Institute4E_2"])){	 $Institute4E_2 =""; 	 }else 	{  $Institute4E_2 = $_POST["Institute4E_2"];  }
	 if(empty($_POST["Institute4F"])){	 $Institute4F =""; 	 }else 	{  $Institute4F = $_POST["Institute4F"];  }
	 if(empty($_POST["Institute4F_1"])){	 $Institute4F_1 =""; 	 }else 	{  $Institute4F_1 = $_POST["Institute4F_1"];  }
	 if(empty($_POST["Institute4F_2"])){	 $Institute4F_2 =""; 	 }else 	{  $Institute4F_2 = $_POST["Institute4F_2"];  }
	 
	 if(empty($_POST["Institute4G_1"])){ $Institute4G_1 ="";  	 }else 	{  $Institute4G_1 = $_POST["Institute4G_1"];  }
	 if(empty($_POST["Institute4G_2"])){ $Institute4G_2 ="";	 }else 	{  $Institute4G_2 = $_POST["Institute4G_2"];  }
	 if(empty($_POST["Institute4G_3"])){ $Institute4G_3 =""; 	 }else 	{  $Institute4G_3 = $_POST["Institute4G_3"];  }
	 if(empty($_POST["Institute4G_4"])){ $Institute4G_4 ="";	 }else 	{  $Institute4G_4 = $_POST["Institute4G_4"];  }
	 if(empty($_POST["Institute4G_5"])){ $Institute4G_5 =""; 	 }else 	{  $Institute4G_5 = $_POST["Institute4G_5"];  }
	 if(empty($_POST["Institute4G_6"])){ $Institute4G_6 =""; 	 }else 	{  $Institute4G_6 = $_POST["Institute4G_6"];  }
	  if(empty($_POST["Institute3_1"]))	{ $Institute3_1 = ""; 		 }else 	{  $Institute3_1 = $_POST["Institute3_1"];  }
	 if(empty($_POST["Institute3_2"]))	{ $Institute3_2 = ""; 	 	 }else 	{  $Institute3_2 = $_POST["Institute3_2"];  }
	 if(empty($_POST["Institute3_3"]))	{ $Institute3_3 = ""; 	 	 }else 	{  $Institute3_3 = $_POST["Institute3_3"];  }
	 if(empty($_POST["Institute3_4"]))	{ $Institute3_4 = ""; 	 	 }else 	{  $Institute3_4 = $_POST["Institute3_4"];  }
	 if(empty($_POST["Institute3_5"]))	{ $Institute3_5 = ""; 	 	 }else 	{  $Institute3_5 = $_POST["Institute3_5"];  }
	 if(empty($_POST["Institute3_6"]))	{ $Institute3_6 = ""; 	 	 }else 	{  $Institute3_6 = $_POST["Institute3_6"];  }
	 if(empty($_POST["Institute3_7"]))	{ $Institute3_7 = ""; 	 	 }else 	{  $Institute3_7 = $_POST["Institute3_7"];  }
	 if(empty($_POST["Institute3_8"]))	{ $Institute3_8 = ""; 	 	 }else 	{  $Institute3_8 = $_POST["Institute3_8"];  }
	 if(empty($_POST["Institute3_9"]))	{ $Institute3_9 = ""; 	 	 }else 	{  $Institute3_9 = $_POST["Institute3_9"];  }
	 if(empty($_POST["Institute3_10"]))	{ $Institute3_10 = ""; 	 	 }else 	{  $Institute3_10 = $_POST["Institute3_10"];  }
	 if(empty($_POST["Institute3_11"]))	{ $Institute3_11 = ""; 	 	 }else 	{  $Institute3_11 = $_POST["Institute3_11"];  }
	 if(empty($_POST["Institute3_12"]))	{ $Institute3_12 = ""; 	 	 }else 	{  $Institute3_12 = $_POST["Institute3_12"];  }
	 if(empty($_POST["Institute3_13"]))	{ $Institute3_13 = ""; 	 	 }else 	{  $Institute3_13 = $_POST["Institute3_13"];  }
	 if(empty($_POST["Institute3_14"]))	{ $Institute3_14 = ""; 	 	 }else 	{  $Institute3_14 = $_POST["Institute3_14"];  }
	 if(empty($_POST["Institute3_15"]))	{ $Institute3_15 = ""; 	 	 }else 	{  $Institute3_15 = $_POST["Institute3_15"];  }
	 if(empty($_POST["Institute3_16"]))	{ $Institute3_16 = ""; 	 	 }else 	{  $Institute3_16 = $_POST["Institute3_16"];  }
	 if(empty($_POST["Institute3_17"]))	{ $Institute3_17 = ""; 	 	 }else 	{  $Institute3_17 = $_POST["Institute3_17"];  }
	 if(empty($_POST["Institute3_18"]))	{ $Institute3_18 = ""; 	 	 }else 	{  $Institute3_18 = $_POST["Institute3_18"];  }
	 if(empty($_POST["Institute3_19"]))	{ $Institute3_19 = ""; 	 	 }else 	{  $Institute3_19 = $_POST["Institute3_19"];  }
	 if(empty($_POST["Institute3_20"]))	{ $Institute3_20 = ""; 	 	 }else 	{  $Institute3_20 = $_POST["Institute3_20"];  }
	 if(empty($_POST["Institute3_21"]))	{ $Institute3_21 = ""; 	 	 }else 	{  $Institute3_21 = $_POST["Institute3_21"];  }
	 if(empty($_POST["Institute3_22"]))	{ $Institute3_22 = ""; 	 	 }else 	{  $Institute3_22 = $_POST["Institute3_22"];  }
	 if(empty($_POST["Institute3_23"]))	{ $Institute3_23 = ""; 	 	 }else 	{  $Institute3_23 = $_POST["Institute3_23"];  }
	 if(empty($_POST["Institute3_24"]))	{ $Institute3_24 = ""; 	 	 }else 	{  $Institute3_24 = $_POST["Institute3_24"];  }
	 if(empty($_POST["Institute3b_1"]))	{	$Institute3b_1 =""; 	 }else 	{  $Institute3b_1 = $_POST["Institute3b_1"];  }
	 if(empty($_POST["Institute3b_2"]))	{	$Institute3b_2 =""; 	 }else 	{  $Institute3b_2 = $_POST["Institute3b_2"];  }
	 if(empty($_POST["Institute3b_3"]))	{	$Institute3b_3 ="";  	 }else 	{  $Institute3b_3 = $_POST["Institute3b_3"];  }
	 if(empty($_POST["Institute3b_4"]))	{	$Institute3b_4 ="";  	 }else 	{  $Institute3b_4 = $_POST["Institute3b_4"];  }
	 if(empty($_POST["Institute3b_5"]))	{	$Institute3b_5 ="";  	 }else 	{  $Institute3b_5 = $_POST["Institute3b_5"];  }
	 if(empty($_POST["Institute3b_6"]))	{	$Institute3b_6 ="";  	 }else 	{  $Institute3b_6 = $_POST["Institute3b_6"];  }
	 if(empty($_POST["Institute3b_7"]))	{	$Institute3b_7 ="";  	 }else 	{  $Institute3b_7 = $_POST["Institute3b_7"];  }
	 if(empty($_POST["Institute3b_8"]))	{	$Institute3b_8 ="";  	 }else 	{  $Institute3b_8 = $_POST["Institute3b_8"];  }
	 if(empty($_POST["Institute3b_9"]))	{	$Institute3b_9 ="";  	 }else 	{  $Institute3b_9 = $_POST["Institute3b_9"];  }
	 if(empty($_POST["Institute3b_10"])){	$Institute3b_10 ="";  	 }else 	{  $Institute3b_10 = $_POST["Institute3b_10"];  }
	 if(empty($_POST["Institute3b_11"])){	$Institute3b_11 ="";  	 }else 	{  $Institute3b_11 = $_POST["Institute3b_11"];  }
	 if(empty($_POST["Institute3b_12"])){	$Institute3b_12 ="";  	 }else 	{  $Institute3b_12 = $_POST["Institute3b_12"];  }
	 
	 if(empty($_POST["Institute3c_1"])){	$Institute3c_1 =""; 	 }else 	{  $Institute3c_1 = $_POST["Institute3c_1"];  }
	 if(empty($_POST["Institute3c_2"])){	$Institute3c_2 =""; 	 }else 	{  $Institute3c_2 = $_POST["Institute3c_2"];  }
	 if(empty($_POST["Institute3c_3"])){	$Institute3c_3 ="";  	 }else 	{  $Institute3c_3 = $_POST["Institute3c_3"];  }
	 if(empty($_POST["Institute3c_4"])){	$Institute3c_4 =""; 	 }else 	{  $Institute3c_4 = $_POST["Institute3c_4"];  }
	 if(empty($_POST["Institute3c_5"])){	$Institute3c_5 ="";  	 }else 	{  $Institute3c_5 = $_POST["Institute3c_5"];  }
	 if(empty($_POST["Institute3c_6"])){	$Institute3c_6 ="";  	 }else 	{  $Institute3c_6 = $_POST["Institute3c_6"];  }
	 if(empty($_POST["Institute4b_other"])){	$Institute4b_other =""; 	 }else 	{  $Institute4b_other = $_POST["Institute4b_other"];  }
	 if(empty($_POST["Institute3c_8"])){	$Institute3c_8 ="";  	 }else 	{  $Institute3c_8 = $_POST["Institute3c_8"];  }
	 if(empty($_POST["Institute3c_9"])){	$Institute3c_9 ="";  	 }else 	{  $Institute3c_9 = $_POST["Institute3c_9"];  }
	 if(empty($_POST["Institute3c_10"])){	$Institute3c_10 ="";  	 }else 	{  $Institute3c_10 = $_POST["Institute3c_10"];  }
	  if(empty($_POST["Institute2_1"]))	{	$Institute2_1 = ""; 	 }else 	{  $Institute2_1 = $_POST["Institute2_1"];  }
	 if(empty($_POST["Institute2_2"]))	{	$Institute2_2 = ""; 	 }else 	{  $Institute2_2 = $_POST["Institute2_2"];  }
	 if(empty($_POST["Institute2_3"]))	{	$Institute2_3 = "";  	 }else 	{  $Institute2_3 = $_POST["Institute2_3"];  }
	 if(empty($_POST["Institute2_4"]))	{	$Institute2_4 = "";  	 }else 	{  $Institute2_4 = $_POST["Institute2_4"];  }
	 if(empty($_POST["Institute2_5"]))	{	$Institute2_5 = "";  	 }else 	{  $Institute2_5 = $_POST["Institute2_5"];  }
	 if(empty($_POST["Institute2_6"]))	{	$Institute2_6 = "";  	 }else 	{  $Institute2_6 = $_POST["Institute2_6"];  }
	 if(empty($_POST["Institute2_7"]))	{	$Institute2_7 = "";  	 }else 	{  $Institute2_7 = $_POST["Institute2_7"];  }
	 if(empty($_POST["Institute2_8"]))	{	$Institute2_8 = ""; 	 }else 	{  $Institute2_8 = $_POST["Institute2_8"];  }
	 if(empty($_POST["Institute2_9"]))	{	$Institute2_9 = "";  	 }else 	{  $Institute2_9 = $_POST["Institute2_9"];  }
	 if(empty($_POST["Institute2_10"]))	{	$Institute2_10 = "";  	 }else 	{  $Institute2_10 = $_POST["Institute2_10"];  }
	 if(empty($_POST["Institute2_11"]))	{	$Institute2_11 = "";  	 }else 	{  $Institute2_11 = $_POST["Institute2_11"];  }
	 if(empty($_POST["Institute2_12"]))	{	$Institute2_12 = "";  	 }else 	{  $Institute2_12 = $_POST["Institute2_12"];  }
	 if(empty($_POST["Institute2_Others"]))	{	$Institute2_Others = "";  	 }else 	{  $Institute2_Others = $_POST["Institute2_Others"];  }
	 if(empty($_POST["Institute2_ar1"]))	{	$Institute2_ar1 = "";  	 }else 	{    $Institute2_ar1 = $_POST["Institute2_ar1"];  }
	 if(empty($_POST["Institute2_ar2"]))	{	$Institute2_ar2 = "";  	 }else 	{    $Institute2_ar2 = $_POST["Institute2_ar2"];  }
	 
	 $avail_cvh7 ="SELECT Q_title FROM survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
					foreach($dbo->query($avail_cvh7) AS $GF5)
						{
							 $Q_title = $GF5["Q_title"]; 
							//echo"<br>";
							 $data_Q = $$Q_title;
							  $Q_dat_variable = "$".$Q_title;
							 // echo $$Q_dat_variable;
							 	echo"<br>";
							$SGDF_ins5=" UPDATE  survey_questions  SET  Q_details='$data_Q',final_submission='YES' WHERE Q_title='$Q_title' AND user_id='$sess_userid' AND Annexure='1' ";
							if($dbo->query($SGDF_ins5))
								 {   
									//  header('location: index.php?msg');
								 }else{
									 
									//  header('location: index.php?err');
								 }
						}
						echo"<script> alert('  Thanks! your data has been successfully received ');</script>";
						echo"<script> window.location.assign('thanks.php')</script>";
	 
	}
?>
 
	<?php
 
		if(isset($_POST["Save_data_step_last_submit"])){
			if(empty($_POST["Institute5A"])){	$Institute5A ="";    }else 	{  $Institute5A = $_POST["Institute5A"];  }
			if(empty($_POST["Institute5B"])){	$Institute5B ="";	 }else 	{  $Institute5B = $_POST["Institute5B"];  }
			if(empty($_POST["Institute5C"])){	$Institute5C =""; 	 }else 	{  $Institute5C = $_POST["Institute5C"];  }
			if(empty($_POST["Institute5D"])){	$Institute5D =""; 	 }else 	{  $Institute5D = $_POST["Institute5D"];  }
			 $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				    $avail_count = $GF5["0"];
			}
			if($avail_count==94)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('1','Institute5A','$Institute5A','$aajki_date','$sess_userid'),
				('1','Institute5B','$Institute5B','$aajki_date','$sess_userid'),
				('1','Institute5C','$Institute5C','$aajki_date','$sess_userid'), 
				('1','Institute5D','$Institute5D','$aajki_date','$sess_userid') ";
				
				if($dbo->query($SGDF_ins))
								 {   
									//echo"<script> alert('  Thanks! your data has been successfully received ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }else{
									 
									//echo"<script> alert(' Error While data updation! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }
								 
				}else { //Do Nothing
			}
			
			   preview_form($sess_userid,$dbo);		 
			?>
				
				 
			<?php 
		}
	?>
 
	<?php
 
		if(isset($_POST["Save_data_step4"])){
			
	 if(empty($_POST["Institute4a_1"])){	$Institute4a_1 ="";  	 }else 	{  $Institute4a_1 = $_POST["Institute4a_1"];  }
	 if(empty($_POST["Institute4a_2"])){	$Institute4a_2 ="";  	 }else 	{  $Institute4a_2 = $_POST["Institute4a_2"];  }
	 if(empty($_POST["Institute4a_3"])){	$Institute4a_3 ="";  	 }else 	{  $Institute4a_3 = $_POST["Institute4a_3"];  }
	 if(empty($_POST["Institute4a_4"])){	$Institute4a_4 ="";  	 }else 	{  $Institute4a_4 = $_POST["Institute4a_4"];  }
	 
	 if(empty($_POST["Institute4b_1"])){	$Institute4b_1 ="";  	 }else 	{  $Institute4b_1 = $_POST["Institute4b_1"];  }
	 if(empty($_POST["Institute4b_2"])){	$Institute4b_2 ="";  	 }else 	{  $Institute4b_2 = $_POST["Institute4b_2"];  }
	 if(empty($_POST["Institute4b_3"])){	$Institute4b_3 ="";  	 }else 	{  $Institute4b_3 = $_POST["Institute4b_3"];  }
	 if(empty($_POST["Institute4b_4"])){	$Institute4b_4 ="";  	 }else 	{  $Institute4b_4 = $_POST["Institute4b_4"];  }
	 if(empty($_POST["Institute4b_5"])){	$Institute4b_5 ="";  	 }else 	{  $Institute4b_5 = $_POST["Institute4b_5"];  }
	 if(empty($_POST["Institute4b_6"])){	$Institute4b_6 ="";  	 }else 	{  $Institute4b_6 = $_POST["Institute4b_6"];  }
	 if(empty($_POST["Institute4b_7"])){	$Institute4b_7 ="";  	 }else 	{  $Institute4b_7 = $_POST["Institute4b_7"];  }
	 if(empty($_POST["Institute4b_8"])){	$Institute4b_8 ="";  	 }else 	{  $Institute4b_8 = $_POST["Institute4b_8"];  }
	 if(empty($_POST["Institute4b_9"])){	$Institute4b_9 ="";  	 }else 	{  $Institute4b_9 = $_POST["Institute4b_9"];  }
	 if(empty($_POST["Institute4b_10"])){	$Institute4b_10 ="";  	 }else 	{  $Institute4b_10 = $_POST["Institute4b_10"];  }
	 if(empty($_POST["Institute4b_11"])){	$Institute4b_11 ="";  	 }else 	{  $Institute4b_11 = $_POST["Institute4b_11"];  }
	 if(empty($_POST["Institute4b_12"])){	$Institute4b_12 ="";  	 }else 	{  $Institute4b_12 = $_POST["Institute4b_12"];  }
	 
	 
	 if(empty($_POST["Institute4C"])){	 $Institute4C ="";   }else 	{  $Institute4C = $_POST["Institute4C"];  }
	 if(empty($_POST["Institute4C_1"])){	 $Institute4C_1 ="";   }else 	{  $Institute4C_1 = $_POST["Institute4C_1"];  }
	 if(empty($_POST["Institute4D"])){	 $Institute4D =""; 	 }else 	{  $Institute4D = $_POST["Institute4D"];  }
	 if(empty($_POST["Institute4D_1"])){	 $Institute4D_1 =""; 	 }else 	{  $Institute4D_1 = $_POST["Institute4D_1"];  }
	 if(empty($_POST["Institute4D_2"])){	 $Institute4D_2 =""; 	 }else 	{  $Institute4D_2 = $_POST["Institute4D_2"];  }
	 if(empty($_POST["Institute4E"])){	 $Institute4E =""; 	 }else 	{  $Institute4E = $_POST["Institute4E"];  }
	 if(empty($_POST["Institute4E_1"])){	 $Institute4E_1 =""; 	 }else 	{  $Institute4E_1 = $_POST["Institute4E_1"];  }
	 if(empty($_POST["Institute4E_2"])){	 $Institute4E_2 =""; 	 }else 	{  $Institute4E_2 = $_POST["Institute4E_2"];  }
	 if(empty($_POST["Institute4F"])){	 $Institute4F =""; 	 }else 	{  $Institute4F = $_POST["Institute4F"];  }
	 if(empty($_POST["Institute4F_1"])){	 $Institute4F_1 =""; 	 }else 	{  $Institute4F_1 = $_POST["Institute4F_1"];  }
	 if(empty($_POST["Institute4F_2"])){	 $Institute4F_2 =""; 	 }else 	{  $Institute4F_2 = $_POST["Institute4F_2"];  }
	 
	 if(empty($_POST["Institute4G_1"])){ $Institute4G_1 ="";  	 }else 	{  $Institute4G_1 = $_POST["Institute4G_1"];  }
	 if(empty($_POST["Institute4G_2"])){ $Institute4G_2 ="";	 }else 	{  $Institute4G_2 = $_POST["Institute4G_2"];  }
	 if(empty($_POST["Institute4G_3"])){ $Institute4G_3 =""; 	 }else 	{  $Institute4G_3 = $_POST["Institute4G_3"];  }
	 if(empty($_POST["Institute4G_4"])){ $Institute4G_4 ="";	 }else 	{  $Institute4G_4 = $_POST["Institute4G_4"];  }
	 if(empty($_POST["Institute4G_5"])){ $Institute4G_5 =""; 	 }else 	{  $Institute4G_5 = $_POST["Institute4G_5"];  }
	 if(empty($_POST["Institute4G_6"])){ $Institute4G_6 =""; 	 }else 	{  $Institute4G_6 = $_POST["Institute4G_6"];  }
	 if(empty($_POST["Institute4b_other"])){ $Institute4b_other =""; 	 }else 	{  $Institute4b_other = $_POST["Institute4b_other"];  }
	 
	 $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				    $avail_count = $GF5["0"];
			}
			if($avail_count==60)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('1','Institute4a_1','$Institute4a_1','$aajki_date','$sess_userid'),
				('1','Institute4a_2','$Institute4a_2','$aajki_date','$sess_userid'),
				('1','Institute4a_3','$Institute4a_3','$aajki_date','$sess_userid'),
				('1','Institute4a_4','$Institute4a_4','$aajki_date','$sess_userid'),
				('1','Institute4b_1','$Institute4b_1','$aajki_date','$sess_userid'),
				('1','Institute4b_2','$Institute4b_2','$aajki_date','$sess_userid'),
				('1','Institute4b_3','$Institute4b_3','$aajki_date','$sess_userid'),
				('1','Institute4b_4','$Institute4b_4','$aajki_date','$sess_userid'),
				('1','Institute4b_5','$Institute4b_5','$aajki_date','$sess_userid'),
				('1','Institute4b_6','$Institute4b_6','$aajki_date','$sess_userid'),
				('1','Institute4b_7','$Institute4b_7','$aajki_date','$sess_userid'),
				('1','Institute4b_8','$Institute4b_8','$aajki_date','$sess_userid'),
				('1','Institute4b_9','$Institute4b_9','$aajki_date','$sess_userid'),
				('1','Institute4b_10','$Institute4b_10','$aajki_date','$sess_userid'),
				('1','Institute4b_11','$Institute4b_11','$aajki_date','$sess_userid'),
				('1','Institute4b_12','$Institute4b_12','$aajki_date','$sess_userid'),
				('1','Institute4C','$Institute4C','$aajki_date','$sess_userid'),
				('1','Institute4C_1','$Institute4C_1','$aajki_date','$sess_userid'),
				('1','Institute4D','$Institute4D','$aajki_date','$sess_userid'),
				('1','Institute4D_1','$Institute4D_1','$aajki_date','$sess_userid'),
				('1','Institute4D_2','$Institute4D_2','$aajki_date','$sess_userid'),
				('1','Institute4E','$Institute4E','$aajki_date','$sess_userid'),
				('1','Institute4E_1','$Institute4E_1','$aajki_date','$sess_userid'),
				('1','Institute4E_2','$Institute4E_2','$aajki_date','$sess_userid'),
				('1','Institute4F','$Institute4F','$aajki_date','$sess_userid'),
				('1','Institute4F_1','$Institute4F_1','$aajki_date','$sess_userid'),
				('1','Institute4F_2','$Institute4F_2','$aajki_date','$sess_userid'),
				('1','Institute4G_1','$Institute4G_1','$aajki_date','$sess_userid'),
				('1','Institute4G_2','$Institute4G_2','$aajki_date','$sess_userid'),
				('1','Institute4G_3','$Institute4G_3','$aajki_date','$sess_userid'),
				('1','Institute4G_4','$Institute4G_4','$aajki_date','$sess_userid'),
				('1','Institute4G_5','$Institute4G_5','$aajki_date','$sess_userid'),
				('1','Institute4b_other','$Institute4b_other','$aajki_date','$sess_userid'),
				('1','Institute4G_6','$Institute4G_6','$aajki_date','$sess_userid')";
	 
			if($dbo->query($SGDF_ins))
								 {   
									//echo"<script> alert('  Thanks for submitting the Survey Questionnaire for  Annexure-I ! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }else{
									 
									//echo"<script> alert(' Error While data updation! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }
				}else{
				// Do Nothing 
			}	
	 
					
			?>
			
			
			<?php form_step4($sess_userid,$dbo,$final); ?>
				
			<?php 
		}
	?>
 
	<?php
 
		if(isset($_POST["Save_data_step3"])){
			//	echo "<h1> We are here !</h1>";	
			
			
	 if(empty($_POST["Institute3_1"]))	{ $Institute3_1 = ""; 		 }else 	{  $Institute3_1 = $_POST["Institute3_1"];  }
	 if(empty($_POST["Institute3_2"]))	{ $Institute3_2 = ""; 	 	 }else 	{  $Institute3_2 = $_POST["Institute3_2"];  }
	 if(empty($_POST["Institute3_3"]))	{ $Institute3_3 = ""; 	 	 }else 	{  $Institute3_3 = $_POST["Institute3_3"];  }
	 if(empty($_POST["Institute3_4"]))	{ $Institute3_4 = ""; 	 	 }else 	{  $Institute3_4 = $_POST["Institute3_4"];  }
	 if(empty($_POST["Institute3_5"]))	{ $Institute3_5 = ""; 	 	 }else 	{  $Institute3_5 = $_POST["Institute3_5"];  }
	 if(empty($_POST["Institute3_6"]))	{ $Institute3_6 = ""; 	 	 }else 	{  $Institute3_6 = $_POST["Institute3_6"];  }
	 if(empty($_POST["Institute3_7"]))	{ $Institute3_7 = ""; 	 	 }else 	{  $Institute3_7 = $_POST["Institute3_7"];  }
	 if(empty($_POST["Institute3_8"]))	{ $Institute3_8 = ""; 	 	 }else 	{  $Institute3_8 = $_POST["Institute3_8"];  }
	 if(empty($_POST["Institute3_9"]))	{ $Institute3_9 = ""; 	 	 }else 	{  $Institute3_9 = $_POST["Institute3_9"];  }
	 if(empty($_POST["Institute3_10"]))	{ $Institute3_10 = ""; 	 	 }else 	{  $Institute3_10 = $_POST["Institute3_10"];  }
	 if(empty($_POST["Institute3_11"]))	{ $Institute3_11 = ""; 	 	 }else 	{  $Institute3_11 = $_POST["Institute3_11"];  }
	 if(empty($_POST["Institute3_12"]))	{ $Institute3_12 = ""; 	 	 }else 	{  $Institute3_12 = $_POST["Institute3_12"];  }
	 if(empty($_POST["Institute3_13"]))	{ $Institute3_13 = ""; 	 	 }else 	{  $Institute3_13 = $_POST["Institute3_13"];  }
	 if(empty($_POST["Institute3_14"]))	{ $Institute3_14 = ""; 	 	 }else 	{  $Institute3_14 = $_POST["Institute3_14"];  }
	 if(empty($_POST["Institute3_15"]))	{ $Institute3_15 = ""; 	 	 }else 	{  $Institute3_15 = $_POST["Institute3_15"];  }
	 if(empty($_POST["Institute3_16"]))	{ $Institute3_16 = ""; 	 	 }else 	{  $Institute3_16 = $_POST["Institute3_16"];  }
	 if(empty($_POST["Institute3_17"]))	{ $Institute3_17 = ""; 	 	 }else 	{  $Institute3_17 = $_POST["Institute3_17"];  }
	 if(empty($_POST["Institute3_18"]))	{ $Institute3_18 = ""; 	 	 }else 	{  $Institute3_18 = $_POST["Institute3_18"];  }
	 if(empty($_POST["Institute3_19"]))	{ $Institute3_19 = ""; 	 	 }else 	{  $Institute3_19 = $_POST["Institute3_19"];  }
	 if(empty($_POST["Institute3_20"]))	{ $Institute3_20 = ""; 	 	 }else 	{  $Institute3_20 = $_POST["Institute3_20"];  }
	 if(empty($_POST["Institute3_21"]))	{ $Institute3_21 = ""; 	 	 }else 	{  $Institute3_21 = $_POST["Institute3_21"];  }
	 if(empty($_POST["Institute3_22"]))	{ $Institute3_22 = ""; 	 	 }else 	{  $Institute3_22 = $_POST["Institute3_22"];  }
	 if(empty($_POST["Institute3_23"]))	{ $Institute3_23 = ""; 	 	 }else 	{  $Institute3_23 = $_POST["Institute3_23"];  }
	 if(empty($_POST["Institute3_24"]))	{ $Institute3_24 = ""; 	 	 }else 	{  $Institute3_24 = $_POST["Institute3_24"];  }
	 if(empty($_POST["Institute3b_1"]))	{	$Institute3b_1 =""; 	 }else 	{  $Institute3b_1 = $_POST["Institute3b_1"];  }
	 if(empty($_POST["Institute3b_2"]))	{	$Institute3b_2 =""; 	 }else 	{  $Institute3b_2 = $_POST["Institute3b_2"];  }
	 if(empty($_POST["Institute3b_3"]))	{	$Institute3b_3 ="";  	 }else 	{  $Institute3b_3 = $_POST["Institute3b_3"];  }
	 if(empty($_POST["Institute3b_4"]))	{	$Institute3b_4 ="";  	 }else 	{  $Institute3b_4 = $_POST["Institute3b_4"];  }
	 if(empty($_POST["Institute3b_5"]))	{	$Institute3b_5 ="";  	 }else 	{  $Institute3b_5 = $_POST["Institute3b_5"];  }
	 if(empty($_POST["Institute3b_6"]))	{	$Institute3b_6 ="";  	 }else 	{  $Institute3b_6 = $_POST["Institute3b_6"];  }
	 if(empty($_POST["Institute3b_7"]))	{	$Institute3b_7 ="";  	 }else 	{  $Institute3b_7 = $_POST["Institute3b_7"];  }
	 if(empty($_POST["Institute3b_8"]))	{	$Institute3b_8 ="";  	 }else 	{  $Institute3b_8 = $_POST["Institute3b_8"];  }
	 if(empty($_POST["Institute3b_9"]))	{	$Institute3b_9 ="";  	 }else 	{  $Institute3b_9 = $_POST["Institute3b_9"];  }
	 if(empty($_POST["Institute3b_10"])){	$Institute3b_10 ="";  	 }else 	{  $Institute3b_10 = $_POST["Institute3b_10"];  }
	 if(empty($_POST["Institute3b_11"])){	$Institute3b_11 ="";  	 }else 	{  $Institute3b_11 = $_POST["Institute3b_11"];  }
	 if(empty($_POST["Institute3b_12"])){	$Institute3b_12 ="";  	 }else 	{  $Institute3b_12 = $_POST["Institute3b_12"];  }
	 
	 if(empty($_POST["Institute3c_1"])){	$Institute3c_1 =""; 	 }else 	{  $Institute3c_1 = $_POST["Institute3c_1"];  }
	 if(empty($_POST["Institute3c_2"])){	$Institute3c_2 =""; 	 }else 	{  $Institute3c_2 = $_POST["Institute3c_2"];  }
	 if(empty($_POST["Institute3c_3"])){	$Institute3c_3 ="";  	 }else 	{  $Institute3c_3 = $_POST["Institute3c_3"];  }
	 if(empty($_POST["Institute3c_4"])){	$Institute3c_4 =""; 	 }else 	{  $Institute3c_4 = $_POST["Institute3c_4"];  }
	 if(empty($_POST["Institute3c_5"])){	$Institute3c_5 ="";  	 }else 	{  $Institute3c_5 = $_POST["Institute3c_5"];  }
	 if(empty($_POST["Institute3c_6"])){	$Institute3c_6 ="";  	 }else 	{  $Institute3c_6 = $_POST["Institute3c_6"];  }
	// if(empty($_POST["Institute3c_7"])){	$Institute3c_7 =""; 	 }else 	{  $Institute3c_7 = $_POST["Institute3c_7"];  }
	 if(empty($_POST["Institute3c_8"])){	$Institute3c_8 ="";  	 }else 	{  $Institute3c_8 = $_POST["Institute3c_8"];  }
	 if(empty($_POST["Institute3c_9"])){	$Institute3c_9 ="";  	 }else 	{  $Institute3c_9 = $_POST["Institute3c_9"];  }
	 if(empty($_POST["Institute3c_10"])){	$Institute3c_10 ="";  	 }else 	{  $Institute3c_10 = $_POST["Institute3c_10"];  }
	  
	  $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				  $avail_count = $GF5["0"];
			}
			
			 
				
			if($avail_count==15)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('1','Institute3_1','$Institute3_1','$aajki_date','$sess_userid'),
				('1','Institute3_2','$Institute3_2','$aajki_date','$sess_userid'),
				('1','Institute3_3','$Institute3_3','$aajki_date','$sess_userid'),
				('1','Institute3_4','$Institute3_4','$aajki_date','$sess_userid'),
				('1','Institute3_5','$Institute3_5','$aajki_date','$sess_userid'),
				('1','Institute3_6','$Institute3_6','$aajki_date','$sess_userid'),
				('1','Institute3_7','$Institute3_7','$aajki_date','$sess_userid'),
				('1','Institute3_8','$Institute3_8','$aajki_date','$sess_userid'),
				('1','Institute3_9','$Institute3_9','$aajki_date','$sess_userid'),
				('1','Institute3_10','$Institute3_10','$aajki_date','$sess_userid'),
				('1','Institute3_11','$Institute3_11','$aajki_date','$sess_userid'),
				('1','Institute3_12','$Institute3_12','$aajki_date','$sess_userid'),
				('1','Institute3_13','$Institute3_13','$aajki_date','$sess_userid'),
				('1','Institute3_14','$Institute3_14','$aajki_date','$sess_userid'),
				('1','Institute3_15','$Institute3_15','$aajki_date','$sess_userid'),
				('1','Institute3_16','$Institute3_16','$aajki_date','$sess_userid'),
				('1','Institute3_17','$Institute3_17','$aajki_date','$sess_userid'),
				('1','Institute3_18','$Institute3_18','$aajki_date','$sess_userid'),
				('1','Institute3_19','$Institute3_19','$aajki_date','$sess_userid'),
				('1','Institute3_20','$Institute3_20','$aajki_date','$sess_userid'),
				('1','Institute3_21','$Institute3_21','$aajki_date','$sess_userid'),
				('1','Institute3_22','$Institute3_22','$aajki_date','$sess_userid'),
				('1','Institute3_23','$Institute3_23','$aajki_date','$sess_userid'),
				('1','Institute3_24','$Institute3_24','$aajki_date','$sess_userid'),
				('1','Institute3b_1','$Institute3b_1','$aajki_date','$sess_userid'),
				('1','Institute3b_2','$Institute3b_2','$aajki_date','$sess_userid'),
				('1','Institute3b_3','$Institute3b_3','$aajki_date','$sess_userid'),
				('1','Institute3b_4','$Institute3b_4','$aajki_date','$sess_userid'),
				('1','Institute3b_5','$Institute3b_5','$aajki_date','$sess_userid'),
				('1','Institute3b_6','$Institute3b_6','$aajki_date','$sess_userid'),
				('1','Institute3b_7','$Institute3b_7','$aajki_date','$sess_userid'),
				('1','Institute3b_8','$Institute3b_8','$aajki_date','$sess_userid'),
				('1','Institute3b_9','$Institute3b_9','$aajki_date','$sess_userid'),
				('1','Institute3b_10','$Institute3b_10','$aajki_date','$sess_userid'),
				('1','Institute3b_11','$Institute3b_11','$aajki_date','$sess_userid'),
				('1','Institute3b_12','$Institute3b_12','$aajki_date','$sess_userid'),
				('1','Institute3c_1','$Institute3c_1','$aajki_date','$sess_userid'),
				('1','Institute3c_2','$Institute3c_2','$aajki_date','$sess_userid'),
				('1','Institute3c_3','$Institute3c_3','$aajki_date','$sess_userid'),
				('1','Institute3c_4','$Institute3c_4','$aajki_date','$sess_userid'),
				('1','Institute3c_5','$Institute3c_5','$aajki_date','$sess_userid'),
				('1','Institute3c_6','$Institute3c_6','$aajki_date','$sess_userid'),
				('1','Institute3c_8','$Institute3c_8','$aajki_date','$sess_userid'),
				('1','Institute3c_9','$Institute3c_9','$aajki_date','$sess_userid'),
				('1','Institute3c_10','$Institute3c_10','$aajki_date','$sess_userid')";
			
			if($dbo->query($SGDF_ins))
								 {   
									//echo"<script> alert('  Thanks for submitting the Survey Questionnaire for  Annexure-I ! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }else{
									 
									//echo"<script> alert(' Error While data updation! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }
			}else{
				
					 
				
			}		
			 
	 
							 
								 
								 
			?>
			
			
	
			 
				<?php form_step3($sess_userid,$dbo,$final); ?>
				
			<?php 
		}
	?>
 
    <?php
 
		if(isset($_POST["Save_data_step2"])){
			
	 if(empty($_POST["Institute2_1"]))	{	$Institute2_1 = ""; 	 }else 	{    $Institute2_1 = $_POST["Institute2_1"];  } // echo"<br>";
	 if(empty($_POST["Institute2_2"]))	{	$Institute2_2 = ""; 	 }else 	{    $Institute2_2 = $_POST["Institute2_2"];  } //echo"<br>";
	 if(empty($_POST["Institute2_3"]))	{	$Institute2_3 = "";  	 }else 	{    $Institute2_3 = $_POST["Institute2_3"];  } // echo"hh <br>";
	 if(empty($_POST["Institute2_4"]))	{	$Institute2_4 = "";  	 }else 	{    $Institute2_4 = $_POST["Institute2_4"];  } //echo"<br>";
	 if(empty($_POST["Institute2_5"]))	{	$Institute2_5 = "";  	 }else 	{    $Institute2_5 = $_POST["Institute2_5"];  } //echo"<br>";
	 if(empty($_POST["Institute2_6"]))	{	$Institute2_6 = "";  	 }else 	{    $Institute2_6 = $_POST["Institute2_6"];  } //echo"<br>";
	 if(empty($_POST["Institute2_7"]))	{	$Institute2_7 = "";  	 }else 	{    $Institute2_7 = $_POST["Institute2_7"];  } //echo"<br>";
	 if(empty($_POST["Institute2_8"]))	{	$Institute2_8 = ""; 	 }else 	{    $Institute2_8 = $_POST["Institute2_8"];  } //echo"<br>";
	 if(empty($_POST["Institute2_9"]))	{	$Institute2_9 = "";  	 }else 	{    $Institute2_9 = $_POST["Institute2_9"];  } //echo"<br>";
	 if(empty($_POST["Institute2_10"]))	{	$Institute2_10 = "";  	 }else 	{    $Institute2_10 = $_POST["Institute2_10"];  } //echo"<br>";
	 if(empty($_POST["Institute2_11"]))	{	$Institute2_11 = "";  	 }else 	{    $Institute2_11 = $_POST["Institute2_11"];  } //echo"<br>";
	 if(empty($_POST["Institute2_12"]))	{	$Institute2_12 = "";  	 }else 	{    $Institute2_12 = $_POST["Institute2_12"];  } //echo"<br>";
	 if(empty($_POST["Institute2_Others"]))	{	$Institute2_Others = "";  	 }else 	{    $Institute2_Others = $_POST["Institute2_Others"];  }
	 if(empty($_POST["Institute2_ar1"]))	{	$Institute2_ar1 = "";  	 }else 	{    $Institute2_ar1 = $_POST["Institute2_ar1"];  }
	 if(empty($_POST["Institute2_ar2"]))	{	$Institute2_ar2 = "";  	 }else 	{    $Institute2_ar2 = $_POST["Institute2_ar2"];  }
	 
	 $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='1' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				      $avail_count = $GF5["0"];
			}
			if($avail_count==0)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('1','Institute2_1','$Institute2_1','$aajki_date','$sess_userid'),
				('1','Institute2_2','$Institute2_2','$aajki_date','$sess_userid'),
				('1','Institute2_3','$Institute2_3','$aajki_date','$sess_userid'),
				('1','Institute2_4','$Institute2_4','$aajki_date','$sess_userid'),
				('1','Institute2_5','$Institute2_5','$aajki_date','$sess_userid'),
				('1','Institute2_6','$Institute2_6','$aajki_date','$sess_userid'),
				('1','Institute2_7','$Institute2_7','$aajki_date','$sess_userid'),
				('1','Institute2_8','$Institute2_8','$aajki_date','$sess_userid'),
				('1','Institute2_9','$Institute2_9','$aajki_date','$sess_userid'),
				('1','Institute2_10','$Institute2_10','$aajki_date','$sess_userid'),
				('1','Institute2_11','$Institute2_11','$aajki_date','$sess_userid'),
				('1','Institute2_12','$Institute2_12','$aajki_date','$sess_userid'),
				('1','Institute2_ar1','$Institute2_ar1','$aajki_date','$sess_userid'),
				('1','Institute2_ar2','$Institute2_ar2','$aajki_date','$sess_userid'),
				('1','Institute2_Others','$Institute2_Others','$aajki_date','$sess_userid')";
				if($dbo->query($SGDF_ins))
								 {   
									//echo"<script> alert('  Thanks for submitting the Survey Questionnaire for  Annexure-I ! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }else{
									 
									//echo"<script> alert(' Error While data updation! ');</script>";
									//echo"<script> window.location.assign('index.php')</script>";
								 }
			}else{
				 
			}
			// echo $Institute2_Others;
				
			 
	 
			
								 
			?>
			
					 
	
				<?php form_step2($sess_userid,$dbo,$final); ?>
  
			<?php 
		}
	 ?>
 
 <?php
 
		if(isset($_POST["Save_data_step1"])){
			
			?>
				
					<?php form_step1($sess_userid,$dbo,$final); ?>
				
			<?php 
		}
	 ?>
 
  <!-- Circles which indicates the steps of the form: -->
  
  </div>


 


 
<footer class="container-fluid text-center">
  <p> This form is Design and Developed by <a href="https://itra.medialabasia.in/" target="_blank" title="For any query contect, Avinash JWD (ITRA) " > ITRA</a> </p>
</footer>

</body>
</html>
 
	
<?php 
	function form_step4($sess_userid,$dbo,$final){
		?>
		
		
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?> 
			<form   method="post"    >
			<?php 
		}
		?>
			<b style="font-size:19px;">4.	Insight</b><br><br>
				<b style="font-size:19px;"> A.	Based on some known successful examples of ICT&E R&D translation, what is your opinion/ suggestion that will boost translation of R&D into Technologies / Products/ Solutions /Startups having commercial/societal value: </b><b class="red">*</b><br>
				<textarea  required="required" class="form-control" placeholder="Remarks (i.e. Govt. Policy/Institutional policy/ Knowledge Access/Funds Access)"   name="Institute5A" id="Institute5A" ><?php $Q_title="Institute5A"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea><br><br>
				<b style="font-size:19px;">	B.	Views on issues/ problem faced (if any) that hinders in translation of research into Technologies/ Products/ Services/ Start-ups having commercial/societal value:</b><b class="red">*</b><br>
				<textarea  required="required" class="form-control"    name="Institute5B" id="Institute5B" ><?php $Q_title="Institute5B"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea><br><br>
				<b style="font-size:19px;"> C.	Do you think there are factors/ barriers which are hampering Industry academia linkages and Transfer of Technologies? If yes, your views on the same: </b><b class="red">*</b><br><br>
				<textarea  required="required" class="form-control"   name="Institute5C" id="Institute5C" ><?php $Q_title="Institute5C"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea><br>
				
				
				
			<br>
			
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?><div style="float:right;">
					<!--	<button type="submit"  style="background-color:lightgray;"   name="Save_data_step3"  >Previous</button> -->
						<button type="submit"   name="Save_data_step_last_submit"  > Preview & Submit </button>
					</div>
			</form>
			
			    <br>
				   <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:lightgreen;'  ></span>
										 
										 
				</div> 

			<?php 
		}
		?>
			
		<?php 
		}
	?>


  <?php 
	function form_step3($sess_userid,$dbo,$final){
		?>
		
		
		
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?> 
				<form   method="post"   >
				
				
			<?php 
		}
		?> 
			<br> 
	<b style="font-size:19px;"> 3.	Institutional Support: </b><br><br>
			 
		 <b style="font-size:19px;">A.	Does your institution's rules/ policies/ schemes support its researchers in undertaking the following activities :</b><br><br>
		
		 <table class="table table-striped">
		  
		  <tr>
		   <th style="width:29%;">   </th>	
		   <th >  please rank them in order of their priority <b class="red">*</b> </th>	
		  </tr>
		 
      <tr>
        <th style="width:29%;"> R&D   </th>
        <td> 	<select name="Institute4a_1" required="required"  class="form-control"  id="Institute4a_1"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4a_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		<!-- <input type="nember" required="required"   oninput="this.className = ''" name="Institute4a_1" value="<?php $Q_title="Institute4a_1"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>">-->	</td>
      </tr>
	   <tr>
        <th  > Intellectual Property Rights filing  </th>
        <td> 	<select name="Institute4a_2"  required="required"  class="form-control"  id="Institute4a_2"  > 
						<option value="">--Select Priority--</option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say </option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4a_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		<!--
		<input type="nember" required="required"  oninput="this.className = ''" name="Institute4a_2" value="<?php $Q_title="Institute4a_2"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>"> -->	</td>
      </tr>
	   <tr>
        <th > Publication  </th>
        <td> 
				<select name="Institute4a_3"  required="required"  class="form-control"  id="Institute4a_3"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4a_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		<!--		<input type="nember" required="required"   oninput="this.className = ''" name="Institute4a_3" value="<?php $Q_title="Institute4a_3"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>">	--> </td>
      </tr> <tr>
        <th  > Research Translation in products/services/startups  </th>
        <td> 	<select name="Institute4a_4"  required="required"  class="form-control"  id="Institute4a_4"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say  </option>
						<option <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4a_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		<!-- <input type="nember" required="required"   oninput="this.className = ''" name="Institute4a_4" value="<?php $Q_title="Institute4a_4"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>"> -->	</td>
      </tr>
	   
    </table>
	  
   <br>
   <b style="font-size:19px;"> B.	Does your Institution/ University/ Organisation provide access of the following to its researchers? </b> <br>
	<table class="table table-striped">
	 <tr>
        <th style="width:50%;">  </th>
        <th > 	Is access provided to researchers? 	<b class="red">*</b> </th>
        <th style="text-align:center;"> 	Location with reference to your   institution (ignore if previous option is No)</th>
	  
      <tr>
        <th style="width:25%;"> Rapid prototyping facility (Hardware and/or Software) </th>
        <td id="chk1"> 	<input type="radio" style="width:auto;"   required="required"   id="Institute4b_1" name="Institute4b_1" value ="YES"  <?php $Q_title="Institute4b_1";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"    name="Institute4b_1"  id="Institute4b_1_1" value ="NO"   <?php $Q_title="Institute4b_1"; $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td> 
        <td style="text-align:center;" > 	
				<input type="radio" style="width:auto;"   checked  name="Institute4b_2" value ="Inside"  <?php $Q_title="Institute4b_2";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Institute4b_2" value ="Outside"   <?php $Q_title="Institute4b_2"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Hardware and/or Software testing facility(s) </th>
         <td id="chk2"> 	<input type="radio" style="width:auto;"  required="required"  id="Institute4b_3"  name="Institute4b_3" value ="YES"  <?php $Q_title="Institute4b_3";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Institute4b_3" id="Institute4b_3_3"  value ="NO"   <?php $Q_title="Institute4b_3"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Institute4b_4" value ="Inside"  <?php $Q_title="Institute4b_4";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Institute4b_4" value ="Outside"   <?php $Q_title="Institute4b_4"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td></tr>
	   <tr>
        <th style="width:25%;"> Standardization/ Certification Body(s) </th>
          <td id="chk3"> 	<input type="radio" style="width:auto;"  required="required"   id="Institute4b_5"  name="Institute4b_5" value ="YES"  <?php $Q_title="Institute4b_5";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Institute4b_5"   id="Institute4b_5_5"  value ="NO"   <?php $Q_title="Institute4b_5"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"   checked  name="Institute4b_6" value ="Inside"  <?php $Q_title="Institute4b_6";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Institute4b_6" value ="Outside"   <?php $Q_title="Institute4b_6"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td></tr> <tr>
        <th style="width:25%;"> Intellectual Property Rights office </th>
         <td id="chk4"> 	<input type="radio" style="width:auto;"  required="required" id="Institute4b_7" name="Institute4b_7" value ="YES"  <?php $Q_title="Institute4b_7";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Institute4b_7" id="Institute4b_7_7"  value ="NO"   <?php $Q_title="Institute4b_7"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Institute4b_8" value ="Inside"  <?php $Q_title="Institute4b_8";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Institute4b_8" value ="Outside"   <?php $Q_title="Institute4b_8"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td> </tr>
	  <tr>
        <th style="width:25%;"> Technology Transfer Office </th>
          <td id="chk5"> 	<input type="radio" style="width:auto;"  required="required" id="Institute4b_9"  name="Institute4b_9" value ="YES"  <?php $Q_title="Institute4b_9";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Institute4b_9" id="Institute4b_9_9" value ="NO"   <?php $Q_title="Institute4b_9"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Institute4b_10" value ="Inside"  <?php $Q_title="Institute4b_10";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Institute4b_10" value ="Outside"   <?php $Q_title="Institute4b_10"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td> </tr>
	  <tr>
        <th style="width:25%;"> Platform for Industry Interactions </th>
         <td id="chk6"> 	<input type="radio" style="width:auto;"  required="required"  id="Institute4b_11" name="Institute4b_11" value ="YES"  <?php $Q_title="Institute4b_11";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Institute4b_11"  id="Institute4b_11_11" value ="NO"   <?php $Q_title="Institute4b_11"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Institute4b_12" value ="Inside"  <?php $Q_title="Institute4b_12";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"   name="Institute4b_12" value ="Outside"   <?php $Q_title="Institute4b_12"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td> </tr>
	  
		
    </table> 
	<table class="table table-striped">
	<tr>
	<td  >  <input type="text"     placeholder="Others (please specify)" class="form-control" name="Institute4b_other" value="<?php $Q_title="Institute4b_other"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >
	</td>
	</tr>
	 </table> 
		
	    <b style="font-size:19px;">  C.	Are researchers (scientists and inventors) given any sort of incentive for successful research or product development? </b><b class="red">*</b><br><br>
	 		<div class="panel panel-default">
				  <div class="panel-body"> 
			  <div class="col-sm-2" id="chk7">
				<input type="radio" style="width:auto;"  required="required"  id="Institute4C_1" name="Institute4C_1" value ="YES"  <?php $Q_title="Institute4C_1";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<br><input type="radio"  style="width:auto;" required="required"   id="Institute4C_1_1"  name="Institute4C_1" value ="NO"   <?php $Q_title="Institute4C_1"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		
			  </div>
			  <div class="col-sm-10">
				<textarea id="Institute4C" placeholder="Remarks on how the inventers are incentivized? (profit sharing/ awards/ etc.) OPTIONAL " class="form-control" name="Institute4C"><?php $Q_title="Institute4C"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea>
	     
			  </div>
				
			</div>
			</div>
			
			
		 <b style="font-size:19px;">  D.	Who is the owner of the IP generated? </b><b class="red">*</b><br><br>
			 <div class="panel panel-default">
			<div class="panel-body"> 
			  <div class="col-sm-2" id="chk8">
				<input type="checkbox" style="width:auto;"   id="Institute4D_1"  name="Institute4D_1" value ="Inventor"  <?php $Q_title="Institute4D_1"; $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Inventor"){ echo"checked";} ?>> Inventor  &nbsp;
				<br><input type="checkbox"  style="width:auto;"    id="Institute4D_2" name="Institute4D_2" value ="Institution"  <?php $Q_title="Institute4D_2"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="Institution"){ echo"checked";} ?>>Institution 
			 
			 </div> 
			 <div class="col-sm-10">
			 
			<textarea placeholder="Other please specify Optional ... "   id="Institute4D"  class="form-control" name="Institute4D" ><?php $Q_title="Institute4D"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea> 
			
			  
			 </div> 
			  </div>
			  </div>
		 <b style="font-size:19px;"> E.	Do you think that the ICT&E Technology(s)/ Prototype(s)/ Product(s)/ Service(s) developed by your Institution/ University/ Organisation has a potential for commercial/social translation?   </b><br><br>
				 <div class="panel panel-default">
			<div class="panel-body"> 
			
				<div class="row" style="margin-left:2%;">
			  <div class="col-sm-2" id="chk9" >
				<label>(a). Your choice:</label><b class="red">*</b><br>
				<input type="radio" style="width:auto;"  required="required" id="Institute4E_1"  name="Institute4E_1" value ="YES"  <?php $Q_title="Institute4E_1";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;<br>
				<input type="radio"  style="width:auto;" required="required" id="Institute4E_1_1" name="Institute4E_1" value ="NO"   <?php $Q_title="Institute4E_1"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
			
			  </div>
			  <div class="col-sm-3">
			  <label> (b). If yes, then how many: </label> 
					<input type="number"  min="0" max="999" placeholder=" OPTIONAL... " id="Institute4E_2"  class="form-control" name="Institute4E_2" value="<?php $Q_title="Institute4E_2"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >
			 
			  </div>
			<div class="col-sm-7">
				  <label> (c).  If yes, then their broad application area(s): </label>   
			
			<textarea    id="Institute4E" class="form-control" placeholder=" OPTIONAL... " name="Institute4E" ><?php $Q_title="Institute4E"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea> 
			 
			  </div>
			  </div>
			  </div>
			  </div>
			
		 
		 <b style="font-size:19px;"> F.	Has the institution developed any Technology/ Prototype/ Product/ Services jointly with Industry?   </b><br><br>
		  <div class="panel panel-default">
			<div class="panel-body"> 
			
			<div class="row" style="margin-left:2%;">
			  <div class="col-sm-2" id="chk10"  >
				  <label>(a). Your choice:</label><b class="red">*</b> <br>  
				<input type="radio" style="width:auto;"  required="required"   id="Institute4F_1" name="Institute4F_1" value ="YES"  <?php $Q_title="Institute4F_1";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<br><input type="radio"  style="width:auto;" required="required"  id="Institute4F_1_1" name="Institute4F_1" value ="NO"   <?php $Q_title="Institute4F_1"; $Ifb =  get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
				 
			  </div> 
			  <div class="col-sm-3">
				<label> (b). If yes, then how many: </label><br>  
					<input type="number"   min="0" max="999" id="Institute4F_2" placeholder=" OPTIONAL... " class="form-control" name="Institute4F_2" value="<?php $Q_title="Institute4F_2"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >
			 
			  </div> 
			  <div class="col-sm-7">
				 <label> (c). If yes, then their broad application area(s): </label><br>  
					<textarea  id="Institute4F" class="form-control"  placeholder=" OPTIONAL... " name="Institute4F" ><?php $Q_title="Institute4F"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?></textarea> 
			  </div>
			</div>
			</div>
			</div>
			  
			
			
			
			
		  <br> 
		
		<b style="font-size:19px;"> G.	Please rank the Basis/Need, on which the research problem/ project undertaken by your  Institution/ University/ Organisation was ascertained/ proposed: </b><br><br>
			<table class="table table-striped">
			  
			 <tr>
				<th style="width:29%;">  Market survey <b class="red">*</b></th>
				<td> 	<select name="Institute4G_1"  required="required"  class="form-control"  id="Institute4G_1"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say </option>
						<option <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?>  value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4G_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Literature review <b class="red">*</b></th>
				<td> 	<select name="Institute4G_2"  required="required"  class="form-control"  id="Institute4G_2"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4G_2";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intellectual Property Rights survey <b class="red">*</b> </th>
				<td> 	<select name="Institute4G_3"  required="required"  class="form-control"  id="Institute4G_3"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4G_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Industry interactions <b class="red">*</b></th>
				<td> 	<select name="Institute4G_4"  required="required"  class="form-control"  id="Institute4G_4"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4G_4";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Social interactions <b class="red">*</b> </th>
				<td> 	<select name="Institute4G_5"  required="required"  class="form-control"  id="Institute4G_5"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4G_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intuition <b class="red">*</b></th>
				<td> 	<select name="Institute4G_6"  required="required"  class="form-control"  id="Institute4G_6"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say </option>
						<option <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Institute4G_6";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr>
			 </table>
			 
			
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?><div style="float:right;">
					<!--	<button type="submit"  style="background-color:lightgray;"  name="Save_data_step2"  >Previous</button> -->
						<button type="submit"   name="Save_data_step4"  >Save & Next</button>
					</div>
				   </form>
				   				   <br>
				   <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:lightgreen;'  ></span>
										<span class="step"  ></span>
										 
				</div> 
			<?php 
		}
		?> 
			 
		<?php 
	}
  ?>
  
  <?php 
	function form_step2($sess_userid,$dbo,$final){
		?>
		
		<?php 
		if($final=="yes"){
			
		}else{ 
			?> 
				 
					<form   method="post"    >
			<?php 
		}
		?>
		
		
		 
		
			
					 
			<b style="font-size:19px;"> 2.	Information on R&D Output: </b><br> <br> 
	<b style="font-size:19px;"> A.	Please mention the number of ICT&E R&D projects undertaken by your Institution/ University/ Organization:   </b><br>
	<br>
  
   <table class="table table-striped">
	 <tr>
        <th style="width:29%;"> Using <span class="caret"></span>  </th>
        <th> 	Number of Single institution projects	<b class="red">*</b></th>
        <th> 	Number of Joint (multi-institutional) projects <b class="red">*</b></th>
        <th  style="width:35%;" > 	Remarks (eg. name of scheme or agency) </th>
	  
      <tr>
        <th style="width:25%;"> Internal Resources with focus on   basic research </th>
        <td> 	<input type="number" required="required" min="0" max="999" id="Institute3_1"   oninput="this.className = ''" name="Institute3_1" value="<?php $Q_title="Institute3_1"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999" id="Institute3_2"   oninput="this.className = ''" name="Institute3_2" value="<?php $Q_title="Institute3_2"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"      id="Institute3_3"  oninput="this.className = ''" name="Institute3_3" value="<?php $Q_title="Institute3_3"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Internal Resources with focus on         applied research  </th>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_4"  oninput="this.className = ''" name="Institute3_4" value="<?php $Q_title="Institute3_4"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_5" oninput="this.className = ''" name="Institute3_5" value="<?php $Q_title="Institute3_5"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"       id="Institute3_6"  oninput="this.className = ''" name="Institute3_6" value="<?php $Q_title="Institute3_6"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Govt Funds/funding Agencies  with focus on         basic research </th>
        <td> 	<input type="number" required="required" min="0" max="999" id="Institute3_7"  oninput="this.className = ''" name="Institute3_7" value="<?php $Q_title="Institute3_7"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_8"  oninput="this.className = ''" name="Institute3_8" value="<?php $Q_title="Institute3_8"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"       id="Institute3_9" oninput="this.className = ''" name="Institute3_9" value="<?php $Q_title="Institute3_9"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Govt Funds/funding Agencies  with focus on      applied research  </th>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_10"  oninput="this.className = ''" name="Institute3_10" value="<?php $Q_title="Institute3_10"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_11"  oninput="this.className = ''" name="Institute3_11" value="<?php $Q_title="Institute3_11"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"      id="Institute3_12" oninput="this.className = ''" name="Institute3_12" value="<?php $Q_title="Institute3_12"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> Industry funds   with focus on         basic research </th>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Institute3_13"  oninput="this.className = ''" name="Institute3_13" value="<?php $Q_title="Institute3_13"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Institute3_14" oninput="this.className = ''" name="Institute3_14" value="<?php $Q_title="Institute3_14";  $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"     id="Institute3_15"  oninput="this.className = ''" name="Institute3_15" value="<?php $Q_title="Institute3_15"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Industry funds  with focus on      applied research  </th>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Institute3_16"  oninput="this.className = ''" name="Institute3_16" value="<?php $Q_title="Institute3_16"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; }?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Institute3_17" oninput="this.className = ''" name="Institute3_17" value="<?php $Q_title="Institute3_17";  $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; }?>" >	</td>
        <td> 	<input type="text"       id="Institute3_18" oninput="this.className = ''" name="Institute3_18" value="<?php $Q_title="Institute3_18"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> International funds  with focus on         basic research </th>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Institute3_19"  oninput="this.className = ''" name="Institute3_19" value="<?php $Q_title="Institute3_19"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Institute3_20"  oninput="this.className = ''" name="Institute3_20" value="<?php $Q_title="Institute3_20"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"       id="Institute3_21"  oninput="this.className = ''" name="Institute3_21" value="<?php $Q_title="Institute3_21"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> International funds  with focus on      applied research  </th>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_22"  oninput="this.className = ''" name="Institute3_22" value="<?php $Q_title="Institute3_22"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Institute3_23"  oninput="this.className = ''" name="Institute3_23" value="<?php $Q_title="Institute3_23"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"      id="Institute3_24"  oninput="this.className = ''" name="Institute3_24" value="<?php $Q_title="Institute3_24"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
 
  
    </table> 
	 
	<br>
	
	  <b style="font-size:19px;">   B.	Please mention the number of new ICT&E Technology(s)/ Prototype(s)/ Startup(s)/ Service(s) developed by your Institution/ University/ Organisation intended for Indian/ Global markets:</b><br>
	 <br>
 
	   <table class="table table-striped">
	   <tr >
        <th style="width:29%;">  	</th>
        <th>  Indian market  	<b class="red">*</b></th>
        <th> 	Global market <b class="red">*</b> </th>
        <!-- <th> 	Type   </th> -->
        <th> 	Remarks (eg. broad domain of type) </th>
	 </tr>
	 
	  <tr>
        <th style="width:25%;"> Government </th>
        <td> 	<input type="number" required="required"  min="0" max="999"  class="form-control" name="Institute3b_1"   id="Institute3b_1" value="<?php $Q_title="Institute3b_1"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" class="form-control" name="Institute3b_2"   id="Institute3b_2"value="<?php $Q_title="Institute3b_2";   $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
       <!--  <td> 	<select name="Institute3b_3"  required="required"  class="form-control"  id="Institute3b_3"    > 
						<option value="">--Select Type--</option>
						<option <?php $Q_title="Institute3b_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Technology") { echo "selected"; }?>  value="Technology"> Technology </option>
						<option <?php $Q_title="Institute3b_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Prototype") { echo "selected"; }?> value="Prototype"> Prototype </option>
						<option <?php $Q_title="Institute3b_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Startup") { echo "selected"; }?> value="Startup"> Startup </option>
						<option <?php $Q_title="Institute3b_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Service") { echo "selected"; }?> value="Service"> Service </option>
			 
				<select>
		 <input type="text" required="required"  oninput="this.className = ''"  name="Institute3b_3" value="<?php $Q_title="Institute3b_3"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	 </td>--> 
        <td> 	<input type="text"    class="form-control" id="Institute3b_4" name="Institute3b_4" value="<?php $Q_title="Institute3b_4"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  <tr>
        <th style="width:25%;"> Industry </th>
        <td> 	<input type="number" required="required" min="0" max="999" id="Institute3b_5"  class="form-control" class="form-control" name="Institute3b_5" value="<?php $Q_title="Institute3b_5"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999" id="Institute3b_6" class="form-control"  class="form-control" name="Institute3b_6" value="<?php $Q_title="Institute3b_6"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
       <!-- <td>	<select name="Institute3b_7"  required="required"  class="form-control"  id="Institute3b_7"  > 
						<option value="">--Select Type--</option>
						<option <?php $Q_title="Institute3b_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Technology") { echo "selected"; }?> value="Technology"> Technology </option>
						<option <?php $Q_title="Institute3b_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Prototype") { echo "selected"; }?> value="Prototype"> Prototype </option>
						<option <?php $Q_title="Institute3b_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Startup") { echo "selected"; }?> value="Startup"> Startup </option>
						<option <?php $Q_title="Institute3b_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Service") { echo "selected"; }?> value="Service"> Service </option>
			 
				<select>
			<input type="text" required="required"  oninput="this.className = ''"  name="Institute3b_7" value="<?php $Q_title="Institute3b_7"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td> -->
        <td> 	<input type="text"    class="form-control"   id="Institute3b_8" name="Institute3b_8" value="<?php $Q_title="Institute3b_8"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <td style="width:25%;"> <input type="text"   class="form-control" placeholder="Others (please specify)"   name="Institute3b_7" value="<?php $Q_title="Institute3b_7"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >  </td>
        <td> 	<input type="number"   min="0" max="999" id="Institute3b_9" class="form-control"  name="Institute3b_9" value="<?php $Q_title="Institute3b_9"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
        <td> 	<input type="number"   min="0" max="999" id="Institute3b_10" class="form-control"   name="Institute3b_10" value="<?php $Q_title="Institute3b_10"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
       <!-- <td> <select name="Institute3b_11" class="form-control"  id="Institute3b_11" > 
						<option value="">--Select Type--</option>
						<option <?php $Q_title="Institute3b_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Technology") { echo "selected"; }?> value="Technology"> Technology </option>
						<option <?php $Q_title="Institute3b_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Prototype") { echo "selected"; }?> value="Prototype"> Prototype </option>
						<option <?php $Q_title="Institute3b_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Startup") { echo "selected"; }?> value="Startup"> Startup </option>
						<option <?php $Q_title="Institute3b_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Service") { echo "selected"; }?> value="Service"> Service </option>
			 
			<select>
		 </td> -->
        <td> 	<input type="text"  class="form-control"  id="Institute3b_12" name="Institute3b_12" value="<?php $Q_title="Institute3b_12"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	 
	</table> 
	<br>
  <b style="font-size:19px;"> C.	Please mention number of various R&D output indicators for your Institution/ University/ Organisation in ICT&E domain: </b><br><br>
	   <table class="table table-striped">
	 <tr>
         
        <th style="width:29%;"> 	Output indicators  	</th>
        <th> 	Number (Remarks National/International) <b class="red">*</b> </th>
	  </tr>
      <tr>
        <th style="width:25%;">Publication (referred journals)  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"    oninput="this.className = ''" id="Institute3c_1" name="Institute3c_1" value="<?php $Q_title="Institute3c_1"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
        </tr>
	   <tr>
        <th style="width:25%;"> Patent Filed   </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_2" name="Institute3c_2" value="<?php $Q_title="Institute3c_2";  $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Patent Granted  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_3" name="Institute3c_3" value="<?php $Q_title="Institute3c_3";   $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
      </tr> <tr>
        <th style="width:25%;">Copyright Obtained  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_4" name="Institute3c_4" value="<?php $Q_title="Institute3c_4";  $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; }?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New products developed  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_5" name="Institute3c_5" value="<?php $Q_title="Institute3c_5";  $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; }?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New processes developed  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_6" name="Institute3c_6" value="<?php $Q_title="Institute3c_6"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" >	</td>
      </tr>
	  <!--
	   <tr>
        <th style="width:25%;"> Design prototypes developed  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_7" name="Institute3c_7" value="<?php $Q_title="Institute3c_7"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" ></td>
      </tr> 
	  -->
	  <tr>
        <th style="width:25%;"> Transfer of Technologies   </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_8" name="Institute3c_8" value="<?php $Q_title="Institute3c_8"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" ></td>
      </tr> <tr>
        <th style="width:25%;"> Licensing  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Institute3c_9" name="Institute3c_9" value="<?php $Q_title="Institute3c_9"; $DGMO = get_currentdata($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";} else{ echo $DGMO; } ?>" ></td>
      </tr><tr>
        <td style="width:25%;">  <input type="text"     placeholder="Others (please specify)" oninput="this.className = ''" name="Institute3b_11" value="<?php $Q_title="Institute3b_11"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >  </td>
        <td> 	<input type="number" min="0" max="999"   oninput="this.className = ''" id="Institute3c_10" name="Institute3c_10" value="<?php $Q_title="Institute3c_10"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>"  ></td>
      </tr>
  
    </table> 
	
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?>
			
					<div style="float:right;">
						<!-- <button type="submit" style="background-color:lightgray;"  name="Save_data_step1"  >Previous</button> -->
						<button type="submit"   name="Save_data_step3"  >Save & Next</button>
					</div>
				   </form>
				   <br>
				   <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:lightgreen;' ></span>
										<span class="step"  ></span>
										<span class="step"  ></span>
										 
				</div> 
			<?php 
		}
		?>
	
		<?php 
	}
  ?>
    
  <?php 
	function form_step1($sess_userid,$dbo,$final){
		?>
			

	 <?php 
		if($final=="yes"){
			
		}else{ 
			?> <form   method="post"  name="dsds"  >
			<?php 
		}
		?>			
					   
    <b style="font-size:19px;"> 1.	Please rank the major focus of your Institution/ University/ Organisation on the following: </b><br><br>
		 
	<table class="table table-striped">
	 <tr>
        <th style="width:27%;">  </th>
        <th> 	Priority <b class="red" >*</b>	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <td style="width:25%;"> <label> Imparting Education / Knowledge  </label></td>
        <td> 		<select name="Institute2_1"  required="required"  class="form-control"  id="Institute2_1"  > 
						<option value="">--Select Priority--  </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select> 
				<!-- <input type="text" required="required"    oninput="this.className = ''" value="<?php $Q_title="Institute2_1"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" name="Institute2_1">	--> </td> 
        <td> 	
			 <input type="text"    id="Institute2_2"  name="Institute2_2" value="<?php $Q_title="Institute2_2"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>"> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Basic Research </th>
        <td> 	<select name="Institute2_3"  required="required"  class="form-control" id="Institute2_3"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say"> Can't say </option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus" > 0- No focus  </option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_3";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select> <!-- <input type="text" required="required"   oninput="this.className = ''" name="Institute2_3" value="<?php $Q_title="Institute2_3"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	--> </td>
        <td> 	<input type="text"     id="Institute2_4"    name="Institute2_4" value="<?php $Q_title="Institute2_4"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Applied Research </th>
        <td> 	<select name="Institute2_ar1"  required="required"  class="form-control" id="Institute2_ar1"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say"> Can't say </option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus" > 0- No focus  </option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_ar1";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select> <!-- <input type="text" required="required"   oninput="this.className = ''" name="Institute2_3" value="<?php $Q_title="Institute2_3"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	--> </td>
        <td> 	<input type="text"     id="Institute2_ar2"    name="Institute2_ar2" value="<?php $Q_title="Institute2_ar2"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	    <tr>
        <th style="width:25%;"> Research translation in terms of Publications </th>
        <td> 	<select name="Institute2_5"  required="required"  class="form-control" id="Institute2_5"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_5";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		<!-- <input type="text" required="required"   oninput="this.className = ''" name="Institute2_5" value="<?php $Q_title="Institute2_5"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	--> </td>
        <td> 	<input type="text"      id="Institute2_6"  name="Institute2_6" value="<?php $Q_title="Institute2_6"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Intellectual Property Rights/Patents </th>
        <td> 		<select name="Institute2_7"  required="required"  class="form-control" id="Institute2_7"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_7";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		<!-- <input type="text" required="required"   oninput="this.className = ''" name="Institute2_7" value="<?php $Q_title="Institute2_7"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	--></td>
        <td> 	<input type="text"     id="Institute2_8"   name="Institute2_8" value="<?php $Q_title="Institute2_8"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Products/Services </th>
        <td> 		<select name="Institute2_9"  required="required"  class="form-control" id="Institute2_9"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say</option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_9";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		<!-- <input type="text" required="required"   oninput="this.className = ''" name="Institute2_9" value="<?php $Q_title="Institute2_9"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	--> </td>
        <td> 	<input type="text"      id="Institute2_10"   name="Institute2_10" value="<?php $Q_title="Institute2_10"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;">  <input type="text"   class="form-control" placeholder="Others (please specify)"   name="Institute2_Others" value="<?php $Q_title="Institute2_Others"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >  </th>
        <td> 
			<select name="Institute2_11"    class="form-control"    > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?>  value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Institute2_11";   $GSBV= get_currentdata($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		<!-- <input type="text" required="required"   oninput="this.className = ''" name="Institute2_11" value="<?php $Q_title="Institute2_11"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" >--> </td>
        <td> 	<input type="text"       name="Institute2_12" value="<?php $Q_title="Institute2_12"; echo get_currentdata($dbo,$Q_title,$sess_userid); ?>" ></td>
      </tr>
  
    </table> 
	<br>
   
  
   
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?> <div style="float:right;">
       
				  <button type="submit"   name="Save_data_step2"  >Save & Next</button>
				</div>
			   </form>
			   <br>
			    <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:lightgreen;' ></span>
										<span class="step"  ></span>
										<span class="step"  ></span>
										<span class="step"  ></span>
										 
				</div> 
					
			<?php 
		}
		?>
  
   
   
		<?php 
	}
  ?>
  
  <?php 
	function preview_form($sess_userid,$dbo){
		$final="yes";
		
		?>
		<script>
		function validate_Submit()
		{
			 if(document.getElementById('Institute2_1').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Institute2_1').style.backgroundColor = '#ffdddd';
				return false;	 
			 } if(document.getElementById('Institute2_3').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Institute2_3').style.backgroundColor = '#ffdddd';
				return false;	 
			 }if(document.getElementById('Institute2_5').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Institute2_5').style.backgroundColor = '#ffdddd';
				return false;	 
			 }if(document.getElementById('Institute2_7').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Institute2_7').style.backgroundColor = '#ffdddd';
				return false;	 
			 }if(document.getElementById('Institute2_9').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Institute2_9').style.backgroundColor = '#ffdddd';
				return false;	 
			 } if(document.getElementById('Institute2_ar1').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Institute2_ar1').style.backgroundColor = '#ffdddd';
				return false;	 
			 } 
			 
			 
						var	x = document.getElementById("Institute3_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_1').style.backgroundColor = '#ffdddd';
								return false;
							} 
						var	x = document.getElementById("Institute3_2").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_2').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_4").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_4').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_5").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_5').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_7").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_7').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_8").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_8').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_10").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_10').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_11").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_11').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_13").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_13').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_14").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_14').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_16").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_16').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_17").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_17').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_19").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_19').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_20").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_20').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_22").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_22').style.backgroundColor = '#ffdddd';
								return false;
							}  
						var	x = document.getElementById("Institute3_23").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3_23').style.backgroundColor = '#ffdddd';
								return false;
							}  
							
							
						var	x = document.getElementById("Institute3b_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3b_1').style.backgroundColor = '#ffdddd';
								return false;
							} 
						 
						var	x = document.getElementById("Institute3b_2").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3b_2').style.backgroundColor = '#ffdddd';
								return false;
							} 
						 
						 
						 
						var	x = document.getElementById("Institute3b_5").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3b_5').style.backgroundColor = '#ffdddd';
								return false;
							} 
						 
						var	x = document.getElementById("Institute3b_6").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3b_6').style.backgroundColor = '#ffdddd';
								return false;
							} 
						 
						 
						 
						 
					 
							
						 
						 	 
						var	x = document.getElementById("Institute3c_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_1').style.backgroundColor = '#ffdddd';
								return false;
							} var	x = document.getElementById("Institute3c_2").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_2').style.backgroundColor = '#ffdddd';
								return false;
							} var	x = document.getElementById("Institute3c_3").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_3').style.backgroundColor = '#ffdddd';
								return false;
							} var	x = document.getElementById("Institute3c_4").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_4').style.backgroundColor = '#ffdddd';
								return false;
							} var	x = document.getElementById("Institute3c_5").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_5').style.backgroundColor = '#ffdddd';
								return false;
							} var	x = document.getElementById("Institute3c_6").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_6').style.backgroundColor = '#ffdddd';
								return false;
							}
							/*  var	x = document.getElementById("Institute3c_7").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_7').style.backgroundColor = '#ffdddd';
								return false;
							} */
							var	x = document.getElementById("Institute3c_8").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_8').style.backgroundColor = '#ffdddd';
								return false;
							} var	x = document.getElementById("Institute3c_9").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide input first  ! ");
								document.getElementById('Institute3c_9').style.backgroundColor = '#ffdddd';
								return false;
							} 
							if(document.getElementById('Institute4a_1').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4a_1').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4a_2').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4a_2').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4a_3').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4a_3').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4a_4').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4a_4').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } 
						 
				if( document.getElementById('Institute4b_1').checked==false && document.getElementById('Institute4b_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk1').style.backgroundColor = '#ffdddd';
				return false;	 }
				
 				
				if(document.getElementById('Institute4b_3').checked==false && document.getElementById('Institute4b_3_3').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk2').style.backgroundColor = '#ffdddd';
				return false;	 }
				
				if(document.getElementById('Institute4b_5').checked==false && document.getElementById('Institute4b_5_5').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk3').style.backgroundColor = '#ffdddd';
				return false;	 }			
				   				
				if(document.getElementById('Institute4b_7').checked==false && document.getElementById('Institute4b_7_7').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk4').style.backgroundColor = '#ffdddd';
				return false;	 }			
				    				
				if(document.getElementById('Institute4b_9').checked==false && document.getElementById('Institute4b_9_9').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk5').style.backgroundColor = '#ffdddd';
				return false;   }
				if(document.getElementById('Institute4b_11').checked==false && document.getElementById('Institute4b_11_11').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk6').style.backgroundColor = '#ffdddd';
				return false;   }
				
				
				if(document.getElementById('Institute4C_1').checked==false && document.getElementById('Institute4C_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk7').style.backgroundColor = '#ffdddd';
				return false;   }
				if(document.getElementById('Institute4D_1').checked==false && document.getElementById('Institute4D_2').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk8').style.backgroundColor = '#ffdddd';
				return false;   }
				if(document.getElementById('Institute4E_1').checked==false && document.getElementById('Institute4E_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk9').style.backgroundColor = '#ffdddd';
				return false;   }
				if(document.getElementById('Institute4F_1').checked==false && document.getElementById('Institute4F_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk10').style.backgroundColor = '#ffdddd';
				return false;   }
				
				 
						 
						 

					if(document.getElementById('Institute4G_1').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4G_1').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4G_2').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4G_2').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4G_3').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4G_3').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4G_4').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4G_4').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4G_5').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4G_5').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute4G_6').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute4G_6').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } 
						 
						  if(document.getElementById('Institute5A').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute5A').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute5B').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute5B').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } if(document.getElementById('Institute5C').value==""){
							alert("Please Provide input first  ! ");
							document.getElementById('Institute5C').style.backgroundColor = '#ffdddd';
							 return false;	 
						 } 
						 
						if(document.getElementById('Institute5D').checked==false && document.getElementById('Institute5D_1').checked==false ){
								alert("Please select value for the feild ! ");
								document.getElementById('chk11').style.backgroundColor = '#ffdddd';
								return false;   }
								
						 
						 
		}
		</script>
		
			<form   method="post" style="//margin-top:-1%;" onsubmit="return validate_Submit(); "  >
					 
					 
	
		<?php 
		form_step1($sess_userid,$dbo,$final);
		form_step2($sess_userid,$dbo,$final);
		form_step3($sess_userid,$dbo,$final);
		form_step4($sess_userid,$dbo,$final);
		?>
		
				 
				
				<b style="font-size:19px;">5. Would you like to be participate in similar surveys next year?  </b><b class="red">*</b> <br> 
				<!-- 	<input type="radio" style="width:auto;"   required="required"   id="Institute5D" name="Institute5D" value ="YES"  <?php $Q_title="Institute5D";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
					<input type="radio" style="width:auto;"      id="Institute5D" name="Institute5D" value ="No"  <?php $Q_title="Institute5D";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO  &nbsp;
				-->
				<div class="panel panel-default">
				<div class="panel-body" id="chk11"> 
					<input type="radio" style="width:auto;"   required="required"   id="Institute5D" name="Institute5D" value ="YES"  checked <?php $Q_title="Institute5D";   $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
					<input type="radio"  style="width:auto;" required="required"  name="Institute5D" id="Institute5D_1"  value ="NO"   <?php $Q_title="Institute5D"; $Ifb = get_currentdata($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		
				</div> 
				</div>
					<br>
					<div style="float:right;">
						<!-- <button type="submit" style="background-color:lightgray;"  name="Save_data_step1"  >Previous</button> -->
						<button type="submit"   name="final_Submit"  > Save the Update </button>
					</div>
					
			</form>
			
			 <br>
				   <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;'  ></span>
										 
										 
				</div> 
		<?php 
		 
	}
  ?>

  
<?php 
function get_currentdata($dbo,$Q_title,$sess_userid)
	{	/*
		$avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Q_title='$Q_title' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				   $avail_count = $GF5["0"];
			}
			*/
		$SJHDKJ_FD="SELECT Q_details FROM survey_questions WHERE user_id='$sess_userid' AND Q_title='$Q_title' AND Annexure='1'";
			foreach($dbo->query($SJHDKJ_FD) AS $YTFG7)
			{
					return $A2rea1 = $YTFG7["Q_details"];
			}
	}
?>


 