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
  <div class="col-sm-6" align="left"> <a href="#"> Welcome <?php  echo $sess_name; ?> <!-- <a href="index.php" onclick="return confirm('This Button will take you to home page and can cause the loss of data you have entered in the form, It is recommended to complete the form and submit it, then go back, Are you sure you want to go back ?');" title="you may losse all of your data onclick " > <span class="label label-warning">Back</span> </a>  --></div>
  <div class="col-sm-6" align="right"> <a href="../logout.php" onclick="return confirm('Are you sure  about Logout ?');" title="  Log-Out" > <span class="label label-danger">Logout</span> </a> </div>
 
</div>
 <br>
<?php 
	$SQL_Sg="SELECT Annexure2 FROM survey_data WHERE id ='1' ";
	foreach($dbo->query($SQL_Sg) AS $jhs5){
		echo $jhs5["Annexure2"];
	}
?>
 
<hr>
 
  <?php 
	if (empty($_POST))
		{
			 $final_submission = $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='2' ";
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
					
					
					$Check_avail ="SELECT final_submission FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='2' ";
					foreach($dbo->query($Check_avail) AS $GF5)
						{
							  	$final_submission = $GF5["final_submission"];
						}
						if($final_submission=="YES"){
							?> <!-- <center >
								<h2 style="color:red;"> Thanks for participating in Survey  </h2>
								<h4> your data has been successfully received </h4>
								</center>
								-->
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
								case 77:
									form_step2($sess_userid,$dbo,$final);
								break;
								case 113:
									form_step3($sess_userid,$dbo,$final);
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
		
		 if(empty($_POST["ResearcherA_1"]))	{	$ResearcherA_1  = ""; 	 }else 	{    $ResearcherA_1  = $_POST["ResearcherA_1"];  }  
	 if(empty($_POST["ResearcherA_2"]))	{	$ResearcherA_2  = ""; 	 }else 	{    $ResearcherA_2  = $_POST["ResearcherA_2"];  }  
	 if(empty($_POST["ResearcherA_3"]))	{	$ResearcherA_3  = ""; 	 }else 	{    $ResearcherA_3  = $_POST["ResearcherA_3"];  }  
	 if(empty($_POST["ResearcherA_4"]))	{	$ResearcherA_4  = ""; 	 }else 	{    $ResearcherA_4  = $_POST["ResearcherA_4"];  }  
	 
	 if(empty($_POST["ResearcherB_1"]))	{	$ResearcherB_1  = ""; 	 }else 	{    $ResearcherB_1  = $_POST["ResearcherB_1"];  }  
	 if(empty($_POST["ResearcherB_2"]))	{	$ResearcherB_2  = ""; 	 }else 	{    $ResearcherB_2  = $_POST["ResearcherB_2"];  }  
	 if(empty($_POST["ResearcherB_3"]))	{	$ResearcherB_3  = ""; 	 }else 	{    $ResearcherB_3  = $_POST["ResearcherB_3"];  }  
	 if(empty($_POST["ResearcherB_4"]))	{	$ResearcherB_4  = ""; 	 }else 	{    $ResearcherB_4  = $_POST["ResearcherB_4"];  }  
	 if(empty($_POST["ResearcherB_5"]))	{	$ResearcherB_5  = ""; 	 }else 	{    $ResearcherB_5  = $_POST["ResearcherB_5"];  }  
	 if(empty($_POST["ResearcherB_6"]))	{	$ResearcherB_6  = ""; 	 }else 	{    $ResearcherB_6  = $_POST["ResearcherB_6"];  }  
	 if(empty($_POST["ResearcherB_7"]))	{	$ResearcherB_7  = ""; 	 }else 	{    $ResearcherB_7  = $_POST["ResearcherB_7"];  }  
	 if(empty($_POST["ResearcherB_8"]))	{	$ResearcherB_8 = ""; 	 }else 	{    $ResearcherB_8  = $_POST["ResearcherB_8"];  }  
	 if(empty($_POST["ResearcherB_9"]))	{	$ResearcherB_9  = ""; 	 }else 	{    $ResearcherB_9  = $_POST["ResearcherB_9"];  }  
	 if(empty($_POST["ResearcherB_10"]))    {	$ResearcherB_10  = ""; 	 }else 	{    $ResearcherB_10  = $_POST["ResearcherB_10"];  }  
	 if(empty($_POST["ResearcherB_11"]))	{	$ResearcherB_11  = ""; 	 }else 	{    $ResearcherB_11  = $_POST["ResearcherB_11"];  }  
	 if(empty($_POST["ResearcherB_12"]))	{	$ResearcherB_12  = ""; 	 }else 	{    $ResearcherB_12  = $_POST["ResearcherB_12"];  }  
	 if(empty($_POST["ResearcherB_13"]))	{	$ResearcherB_13  = ""; 	 }else 	{    $ResearcherB_13  = $_POST["ResearcherB_13"];  }  
	 if(empty($_POST["ResearcherB_14"]))	{	$ResearcherB_14 = ""; 	 }else 	{    $ResearcherB_14  = $_POST["ResearcherB_14"];  }  
	 if(empty($_POST["ResearcherB_15"]))	{	$ResearcherB_15  = ""; 	 }else 	{    $ResearcherB_15  = $_POST["ResearcherB_15"];  }  
	 
	 if(empty($_POST["Researcher1C_1"]))	{	$Researcher1C_1  = ""; 	 }else 	{    $Researcher1C_1  = $_POST["Researcher1C_1"];  }  
	 if(empty($_POST["Researcher1C_2"]))	{	$Researcher1C_2  = ""; 	 }else 	{    $Researcher1C_2  = $_POST["Researcher1C_2"];  }  
	 if(empty($_POST["Researcher1C_3"]))	{	$Researcher1C_3  = ""; 	 }else 	{    $Researcher1C_3  = $_POST["Researcher1C_3"];  }  
	 if(empty($_POST["Researcher1C_4"]))	{	$Researcher1C_4  = ""; 	 }else 	{    $Researcher1C_4  = $_POST["Researcher1C_4"];  }  
	 if(empty($_POST["Researcher1C_5"]))	{	$Researcher1C_5  = ""; 	 }else 	{    $Researcher1C_5  = $_POST["Researcher1C_5"];  }  
	 if(empty($_POST["Researcher1C_6"]))	{	$Researcher1C_6  = ""; 	 }else 	{    $Researcher1C_6  = $_POST["Researcher1C_6"];  }  
	 if(empty($_POST["Researcher1C_7"]))	{	$Researcher1C_7  = ""; 	 }else 	{    $Researcher1C_7  = $_POST["Researcher1C_7"];  }  
	 if(empty($_POST["Researcher1C_8"]))	{	$Researcher1C_8  = ""; 	 }else 	{    $Researcher1C_8  = $_POST["Researcher1C_8"];  }  
	 if(empty($_POST["Researcher1C_9"]))	{	$Researcher1C_9  = ""; 	 }else 	{    $Researcher1C_9  = $_POST["Researcher1C_9"];  }  
	 if(empty($_POST["Researcher1C_10"]))	{	$Researcher1C_10  = "";  }else 	{    $Researcher1C_10  = $_POST["Researcher1C_10"];  }  
	 if(empty($_POST["Researcher1C_11"]))	{	$Researcher1C_11  = "";  }else 	{    $Researcher1C_11  = $_POST["Researcher1C_11"];  } 
	 if(empty($_POST["Researcher1C_12"]))	{	$Researcher1C_12  = "";  }else 	{    $Researcher1C_12  = $_POST["Researcher1C_12"];  } 
	 if(empty($_POST["Researcher1C_13"]))	{	$Researcher1C_13  = "";  }else 	{    $Researcher1C_13 = $_POST["Researcher1C_13"];  } 
	 if(empty($_POST["Researcher1C_14"]))	{	$Researcher1C_14  = "";  }else 	{    $Researcher1C_14  = $_POST["Researcher1C_14"];  } 
	 if(empty($_POST["Researcher1C_15"]))	{	$Researcher1C_15  = "";  }else 	{    $Researcher1C_15  = $_POST["Researcher1C_15"];  } 
	 if(empty($_POST["Researcher1C_16"]))	{	$Researcher1C_16  = "";	 }else 	{    $Researcher1C_16  = $_POST["Researcher1C_16"];  } 
	 if(empty($_POST["Researcher1C_17"]))	{	$Researcher1C_17  = "";  }else 	{    $Researcher1C_17  = $_POST["Researcher1C_17"];  } 
	 if(empty($_POST["Researcher1C_18"]))	{	$Researcher1C_18  = "";  }else 	{    $Researcher1C_18  = $_POST["Researcher1C_18"];  } 
	 if(empty($_POST["Researcher1C_19"]))	{	$Researcher1C_19  = "";  }else 	{    $Researcher1C_19  = $_POST["Researcher1C_19"];  } 
	 if(empty($_POST["Researcher1C_20"]))	{	$Researcher1C_20  = "";  }else 	{    $Researcher1C_20  = $_POST["Researcher1C_20"];  } 
	 if(empty($_POST["Researcher1C_21"]))	{	$Researcher1C_21  = "";  }else 	{    $Researcher1C_21  = $_POST["Researcher1C_21"];  } 
	 if(empty($_POST["Researcher1C_22"]))	{	$Researcher1C_22  = "";  }else 	{    $Researcher1C_22  = $_POST["Researcher1C_22"];  } 
	 if(empty($_POST["Researcher1C_23"]))	{	$Researcher1C_23  = "";  }else 	{    $Researcher1C_23  = $_POST["Researcher1C_23"];  } 
	 if(empty($_POST["Researcher1C_24"]))	{	$Researcher1C_24  = "";  }else 	{    $Researcher1C_24  = $_POST["Researcher1C_24"];  } 
	 
	 if(empty($_POST["Researcher1D_1"]))	{	$Researcher1D_1  = "";  }else 	{    $Researcher1D_1  = $_POST["Researcher1D_1"];  } 
	 if(empty($_POST["Researcher1D_2"]))	{	$Researcher1D_2  = "";  }else 	{    $Researcher1D_2  = $_POST["Researcher1D_2"];  } 
	 if(empty($_POST["Researcher1D_3"]))	{	$Researcher1D_3  = "";  }else 	{    $Researcher1D_3  = $_POST["Researcher1D_3"];  } 
	 if(empty($_POST["Researcher1D_4"]))	{	$Researcher1D_4  = "";  }else 	{    $Researcher1D_4  = $_POST["Researcher1D_4"];  } 
	 if(empty($_POST["Researcher1D_5"]))	{	$Researcher1D_5  = "";  }else 	{    $Researcher1D_5  = $_POST["Researcher1D_5"];  } 
	 if(empty($_POST["Researcher1D_6"]))	{	$Researcher1D_6  = "";  }else 	{    $Researcher1D_6  = $_POST["Researcher1D_6"];  } 
	 if(empty($_POST["Researcher2E_other"]))	{	$Researcher2E_other  = "";  }else 	{    $Researcher2E_other  = $_POST["Researcher2E_other"];  } 
	 if(empty($_POST["Researcher1D_8"]))	{	$Researcher1D_8  = "";  }else 	{    $Researcher1D_8  = $_POST["Researcher1D_8"];  } 
	 if(empty($_POST["Researcher1D_9"]))	{	$Researcher1D_9  = "";  }else 	{    $Researcher1D_9  = $_POST["Researcher1D_9"];  } 
	 if(empty($_POST["Researcher1D_10"]))	{	$Researcher1D_10  = "";  }else 	{    $Researcher1D_10  = $_POST["Researcher1D_10"];  } 
	 if(empty($_POST["Researcher1D_11"]))	{	$Researcher1D_11  = "";  }else 	{    $Researcher1D_11  = $_POST["Researcher1D_11"];  } 
	 
	 if(empty($_POST["Researcher1E_1"]))	{	$Researcher1E_1   = "";  }else 	{    $Researcher1E_1   = $_POST["Researcher1E_1"];  } 
	 if(empty($_POST["Researcher1E_2"]))	{	$Researcher1E_2   = "";  }else 	{    $Researcher1E_2   = $_POST["Researcher1E_2"];  } 
	 if(empty($_POST["Researcher1E_3"]))	{	$Researcher1E_3   = "";  }else 	{    $Researcher1E_3   = $_POST["Researcher1E_3"];  } 
	 if(empty($_POST["Researcher1E_4"]))	{	$Researcher1E_4   = "";  }else 	{    $Researcher1E_4   = $_POST["Researcher1E_4"];  } 
	 if(empty($_POST["Researcher1E_5"]))	{	$Researcher1E_5   = "";  }else 	{    $Researcher1E_5   = $_POST["Researcher1E_5"];  } 
	 if(empty($_POST["Researcher1E_6"]))	{	$Researcher1E_6   = "";  }else 	{    $Researcher1E_6   = $_POST["Researcher1E_6"];  } 
	 if(empty($_POST["Researcher1E_7"]))	{	$Researcher1E_7   = "";  }else 	{    $Researcher1E_7   = $_POST["Researcher1E_7"];  } 
	 if(empty($_POST["Researcher1E_8"]))	{	$Researcher1E_8   = "";  }else 	{    $Researcher1E_8   = $_POST["Researcher1E_8"];  } 
	 if(empty($_POST["Researcher1E_9"]))	{	$Researcher1E_9   = "";  }else 	{    $Researcher1E_9   = $_POST["Researcher1E_9"];  } 
	 if(empty($_POST["Researcher1E_10"]))	{	$Researcher1E_10  = "";  }else  {    $Researcher1E_10  = $_POST["Researcher1E_10"];  } 
	 
	 if(empty($_POST["Researcher1F_1"]))	{	$Researcher1F_1  = "";  }else  {    $Researcher1F_1  = $_POST["Researcher1F_1"];  } 
	 if(empty($_POST["Researcher1F_2"]))	{	$Researcher1F_2  = "";  }else  {    $Researcher1F_2  = $_POST["Researcher1F_2"];  } 
	 
	 if(empty($_POST["Researcher1G_1"]))	{	$Researcher1G_1  = "";  }else  {    $Researcher1G_1  = $_POST["Researcher1G_1"];  } 
	 if(empty($_POST["Researcher1G_2"]))	{	$Researcher1G_2  = "";  }else  {    $Researcher1G_2  = $_POST["Researcher1G_2"];  } 
	 if(empty($_POST["Researcher1G_3"]))	{	$Researcher1G_3  = "";  }else  {    $Researcher1G_3  = $_POST["Researcher1G_3"];  } 
	 
	 if(empty($_POST["Researcher1H_1"]))	{	$Researcher1H_1  = "";  }else  {    $Researcher1H_1  = $_POST["Researcher1H_1"];  } 
	 if(empty($_POST["Researcher1H_2"]))	{	$Researcher1H_2  = "";  }else  {    $Researcher1H_2  = $_POST["Researcher1H_2"];  } 
	 if(empty($_POST["Researcher1H_3"]))	{	$Researcher1H_3  = "";  }else  {    $Researcher1H_3  = $_POST["Researcher1H_3"];  } 
	 if(empty($_POST["Researcher1H_4"]))	{	$Researcher1H_4  = "";  }else  {    $Researcher1H_4  = $_POST["Researcher1H_4"];  } 
	 if(empty($_POST["Researcher1H_5"]))	{	$Researcher1H_5  = "";  }else  {    $Researcher1H_5  = $_POST["Researcher1H_5"];  } 
	 if(empty($_POST["Researcher1H_6"]))	{	$Researcher1H_6  = "";   }else {    $Researcher1H_6  = $_POST["Researcher1H_6"];  } 
	 
	 
	 if(empty($_POST["Researcher1I_1"]))	{	$Researcher1I_1  = "";  }else  {    $Researcher1I_1  = $_POST["Researcher1I_1"];  } 
	 if(empty($_POST["Researcher1I_2"]))	{	$Researcher1I_2  = "";  }else  {    $Researcher1I_2  = $_POST["Researcher1I_2"];  } 
	 if(empty($_POST["Researcher1I_3"]))	{	$Researcher1I_3  = "";  }else  {    $Researcher1I_3  = $_POST["Researcher1I_3"];  } 
	 if(empty($_POST["Researcher1I_4"]))	{	$Researcher1I_4  = "";  }else  {    $Researcher1I_4  = $_POST["Researcher1I_4"];  } 
		 if(empty($_POST["Researcher2B_1"]))	{ $Researcher2B_1 = ""; 		 }else 	{  $Researcher2B_1 = $_POST["Researcher2B_1"];  }
	 if(empty($_POST["Researcher2B_2"]))	{ $Researcher2B_2 = ""; 		 }else 	{  $Researcher2B_2 = $_POST["Researcher2B_2"];  }
	 if(empty($_POST["Researcher2B_3"]))	{ $Researcher2B_3 = ""; 		 }else 	{  $Researcher2B_3 = $_POST["Researcher2B_3"];  }
	 if(empty($_POST["Researcher2B_4"]))	{ $Researcher2B_4 = ""; 		 }else 	{  $Researcher2B_4 = $_POST["Researcher2B_4"];  }
	 if(empty($_POST["Researcher2B_5"]))	{ $Researcher2B_5 = ""; 		 }else 	{  $Researcher2B_5 = $_POST["Researcher2B_5"];  }
	 if(empty($_POST["Researcher2B_6"]))	{ $Researcher2B_6 = ""; 		 }else 	{  $Researcher2B_6 = $_POST["Researcher2B_6"];  }
	 if(empty($_POST["Researcher2B_7"]))	{ $Researcher2B_7 = ""; 		 }else 	{  $Researcher2B_7 = $_POST["Researcher2B_7"];  }
	 if(empty($_POST["Researcher2B_8"]))	{ $Researcher2B_8 = ""; 		 }else 	{  $Researcher2B_8 = $_POST["Researcher2B_8"];  }
	 if(empty($_POST["Researcher2B_9"]))	{ $Researcher2B_9 = ""; 		 }else 	{  $Researcher2B_9 = $_POST["Researcher2B_9"];  }
	 if(empty($_POST["Researcher2B_10"]))	{ $Researcher2B_10 = ""; 		 }else 	{  $Researcher2B_10 = $_POST["Researcher2B_10"];  }
	 if(empty($_POST["Researcher2B_11"]))	{ $Researcher2B_11 = ""; 		 }else 	{  $Researcher2B_11 = $_POST["Researcher2B_11"];  }
	 if(empty($_POST["Researcher2B_12"]))	{ $Researcher2B_12 = ""; 		 }else 	{  $Researcher2B_12 = $_POST["Researcher2B_12"];  }
	 if(empty($_POST["Researcher2B_13"]))	{ $Researcher2B_13 = ""; 		 }else 	{  $Researcher2B_13 = $_POST["Researcher2B_13"];  }
	 if(empty($_POST["Researcher2B_14"]))	{ $Researcher2B_14 = ""; 		 }else 	{  $Researcher2B_14 = $_POST["Researcher2B_14"];  }
	 if(empty($_POST["Researcher2B_15"]))	{ $Researcher2B_15 = ""; 		 }else 	{  $Researcher2B_15 = $_POST["Researcher2B_15"];  }
	 
	 if(empty($_POST["Researcher2Bb_1"]))	{ $Researcher2Bb_1 = ""; 		 }else 	{  $Researcher2Bb_1 = $_POST["Researcher2Bb_1"];  }
	 if(empty($_POST["Researcher2Bb_2"]))	{ $Researcher2Bb_2 = ""; 		 }else 	{  $Researcher2Bb_2 = $_POST["Researcher2Bb_2"];  }
	 if(empty($_POST["Researcher2Bb_3"]))	{ $Researcher2Bb_3 = ""; 		 }else 	{  $Researcher2Bb_3 = $_POST["Researcher2Bb_3"];  }
	 if(empty($_POST["Researcher2Bb_4"]))	{ $Researcher2Bb_4 = ""; 		 }else 	{  $Researcher2Bb_4 = $_POST["Researcher2Bb_4"];  }
	 
	 if(empty($_POST["Researcher2C_1"]))	{ $Researcher2C_1 = ""; 		 }else 	{  $Researcher2C_1 = $_POST["Researcher2C_1"];  }
	 if(empty($_POST["Researcher2C_2"]))	{ $Researcher2C_2 = ""; 		 }else 	{  $Researcher2C_2 = $_POST["Researcher2C_2"];  }
	 
	 if(empty($_POST["Researcher2D_1"]))	{ $Researcher2D_1 = ""; 		 }else 	{  $Researcher2D_1 = $_POST["Researcher2D_1"];  }
	 if(empty($_POST["Researcher2D_2"]))	{ $Researcher2D_2 = ""; 		 }else 	{  $Researcher2D_2 = $_POST["Researcher2D_2"];  }
	 
	 if(empty($_POST["Researcher2E_1"]))	{ $Researcher2E_1 = ""; 		 }else 	{  $Researcher2E_1 = $_POST["Researcher2E_1"];  }
	 if(empty($_POST["Researcher2E_2"]))	{ $Researcher2E_2 = ""; 		 }else 	{  $Researcher2E_2 = $_POST["Researcher2E_2"];  }
	 if(empty($_POST["Researcher2E_3"]))	{ $Researcher2E_3 = ""; 		 }else 	{  $Researcher2E_3 = $_POST["Researcher2E_3"];  }
	 if(empty($_POST["Researcher2E_4"]))	{ $Researcher2E_4 = ""; 		 }else 	{  $Researcher2E_4 = $_POST["Researcher2E_4"];  }
	 if(empty($_POST["Researcher2E_5"]))	{ $Researcher2E_5 = ""; 		 }else 	{  $Researcher2E_5 = $_POST["Researcher2E_5"];  }
	 if(empty($_POST["Researcher2E_6"]))	{ $Researcher2E_6 = ""; 		 }else 	{  $Researcher2E_6 = $_POST["Researcher2E_6"];  }
	 if(empty($_POST["Researcher2E_7"]))	{ $Researcher2E_7 = ""; 		 }else 	{  $Researcher2E_7 = $_POST["Researcher2E_7"];  }
	 if(empty($_POST["Researcher2E_8"]))	{ $Researcher2E_8 = ""; 		 }else 	{  $Researcher2E_8 = $_POST["Researcher2E_8"];  }
	 if(empty($_POST["Researcher2E_9"]))	{ $Researcher2E_9 = ""; 		 }else 	{  $Researcher2E_9 = $_POST["Researcher2E_9"];  }
	 if(empty($_POST["Researcher2E_10"]))	{ $Researcher2E_10 = ""; 		 }else 	{  $Researcher2E_10 = $_POST["Researcher2E_10"];  }
	 if(empty($_POST["Researcher2E_11"]))	{ $Researcher2E_11 = ""; 		 }else 	{  $Researcher2E_11 = $_POST["Researcher2E_11"];  }
	 if(empty($_POST["Researcher2E_12"]))	{ $Researcher2E_12 = ""; 		 }else 	{  $Researcher2E_12 = $_POST["Researcher2E_12"];  }
	 
		if(empty($_POST["Researcher4A"])){	$Researcher4A ="";   }else 	{  $Researcher4A = $_POST["Researcher4A"];  }
			if(empty($_POST["Researcher4B"])){	$Researcher4B ="";	 }else 	{  $Researcher4B = $_POST["Researcher4B"];  }
			if(empty($_POST["Researcher4C"])){	$Researcher4C =""; 	 }else 	{  $Researcher4C = $_POST["Researcher4C"];  }
			if(empty($_POST["Researcher4D"])){	$Researcher4D =""; 	 }else 	{  $Researcher4D = $_POST["Researcher4D"];  }
	 
	 $avail_cvh7 ="SELECT Q_title FROM survey_questions WHERE user_id='$sess_userid' AND Annexure='2' ";
					foreach($dbo->query($avail_cvh7) AS $GF5)
						{
							 $Q_title = $GF5["Q_title"]; 
							//echo"<br>";
							 $data_Q = $$Q_title;
							  $Q_dat_variable = "$".$Q_title;
							 // echo $$Q_dat_variable;
							 	echo"<br>";
							$SGDF_ins5=" UPDATE  survey_questions  SET  Q_details='$data_Q',final_submission='YES' WHERE Q_title='$Q_title' AND user_id='$sess_userid' AND Annexure='2' ";
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
			if(empty($_POST["Researcher4A"])){	$Researcher4A ="";   }else 	{  $Researcher4A = $_POST["Researcher4A"];  }
			if(empty($_POST["Researcher4B"])){	$Researcher4B ="";	 }else 	{  $Researcher4B = $_POST["Researcher4B"];  }
			if(empty($_POST["Researcher4C"])){	$Researcher4C =""; 	 }else 	{  $Researcher4C = $_POST["Researcher4C"];  }
			if(empty($_POST["Researcher4D"])){	$Researcher4D =""; 	 }else 	{  $Researcher4D = $_POST["Researcher4D"];  }
			 $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='2' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				    $avail_count = $GF5["0"];
			}
			if($avail_count==113)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('2','Researcher4A','$Researcher4A','$aajki_date','$sess_userid'),
				('2','Researcher4B','$Researcher4B','$aajki_date','$sess_userid'),
				('2','Researcher4C','$Researcher4C','$aajki_date','$sess_userid'), 
				('2','Researcher4D','$Researcher4D','$aajki_date','$sess_userid') ";
				
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
 
		if(isset($_POST["Save_data_step3"])){
			
			/*
			Researcher2B_1 -14
			Researcher2Bb_1 -4
			Researcher2C_1 -2
			Researcher2D_1 -2
			Researcher2E_1 -12
			*/
	 if(empty($_POST["Researcher2B_1"]))	{ $Researcher2B_1 = ""; 		 }else 	{  $Researcher2B_1 = $_POST["Researcher2B_1"];  }
	 if(empty($_POST["Researcher2B_2"]))	{ $Researcher2B_2 = ""; 		 }else 	{  $Researcher2B_2 = $_POST["Researcher2B_2"];  }
	 if(empty($_POST["Researcher2B_3"]))	{ $Researcher2B_3 = ""; 		 }else 	{  $Researcher2B_3 = $_POST["Researcher2B_3"];  }
	 if(empty($_POST["Researcher2B_4"]))	{ $Researcher2B_4 = ""; 		 }else 	{  $Researcher2B_4 = $_POST["Researcher2B_4"];  }
	 if(empty($_POST["Researcher2B_5"]))	{ $Researcher2B_5 = ""; 		 }else 	{  $Researcher2B_5 = $_POST["Researcher2B_5"];  }
	 if(empty($_POST["Researcher2B_6"]))	{ $Researcher2B_6 = ""; 		 }else 	{  $Researcher2B_6 = $_POST["Researcher2B_6"];  }
	 if(empty($_POST["Researcher2B_7"]))	{ $Researcher2B_7 = ""; 		 }else 	{  $Researcher2B_7 = $_POST["Researcher2B_7"];  }
	 if(empty($_POST["Researcher2B_8"]))	{ $Researcher2B_8 = ""; 		 }else 	{  $Researcher2B_8 = $_POST["Researcher2B_8"];  }
	 if(empty($_POST["Researcher2B_9"]))	{ $Researcher2B_9 = ""; 		 }else 	{  $Researcher2B_9 = $_POST["Researcher2B_9"];  }
	 if(empty($_POST["Researcher2B_10"]))	{ $Researcher2B_10 = ""; 		 }else 	{  $Researcher2B_10 = $_POST["Researcher2B_10"];  }
	 if(empty($_POST["Researcher2B_11"]))	{ $Researcher2B_11 = ""; 		 }else 	{  $Researcher2B_11 = $_POST["Researcher2B_11"];  }
	 if(empty($_POST["Researcher2B_12"]))	{ $Researcher2B_12 = ""; 		 }else 	{  $Researcher2B_12 = $_POST["Researcher2B_12"];  }
	 if(empty($_POST["Researcher2B_13"]))	{ $Researcher2B_13 = ""; 		 }else 	{  $Researcher2B_13 = $_POST["Researcher2B_13"];  }
	 if(empty($_POST["Researcher2B_14"]))	{ $Researcher2B_14 = ""; 		 }else 	{  $Researcher2B_14 = $_POST["Researcher2B_14"];  }
	 if(empty($_POST["Researcher2B_15"]))	{ $Researcher2B_15 = ""; 		 }else 	{  $Researcher2B_15 = $_POST["Researcher2B_15"];  }
	 
	 if(empty($_POST["Researcher2Bb_1"]))	{ $Researcher2Bb_1 = ""; 		 }else 	{  $Researcher2Bb_1 = $_POST["Researcher2Bb_1"];  }
	 if(empty($_POST["Researcher2Bb_2"]))	{ $Researcher2Bb_2 = ""; 		 }else 	{  $Researcher2Bb_2 = $_POST["Researcher2Bb_2"];  }
	 if(empty($_POST["Researcher2Bb_3"]))	{ $Researcher2Bb_3 = ""; 		 }else 	{  $Researcher2Bb_3 = $_POST["Researcher2Bb_3"];  }
	 if(empty($_POST["Researcher2Bb_4"]))	{ $Researcher2Bb_4 = ""; 		 }else 	{  $Researcher2Bb_4 = $_POST["Researcher2Bb_4"];  }
	 
	 if(empty($_POST["Researcher2C_1"]))	{ $Researcher2C_1 = ""; 		 }else 	{  $Researcher2C_1 = $_POST["Researcher2C_1"];  }
	 if(empty($_POST["Researcher2C_2"]))	{ $Researcher2C_2 = ""; 		 }else 	{  $Researcher2C_2 = $_POST["Researcher2C_2"];  }
	 
	 if(empty($_POST["Researcher2D_1"]))	{ $Researcher2D_1 = ""; 		 }else 	{  $Researcher2D_1 = $_POST["Researcher2D_1"];  }
	 if(empty($_POST["Researcher2D_2"]))	{ $Researcher2D_2 = ""; 		 }else 	{  $Researcher2D_2 = $_POST["Researcher2D_2"];  }
	 
	 if(empty($_POST["Researcher2E_1"]))	{ $Researcher2E_1 = ""; 		 }else 	{  $Researcher2E_1 = $_POST["Researcher2E_1"];  }
	 if(empty($_POST["Researcher2E_2"]))	{ $Researcher2E_2 = ""; 		 }else 	{  $Researcher2E_2 = $_POST["Researcher2E_2"];  }
	 if(empty($_POST["Researcher2E_3"]))	{ $Researcher2E_3 = ""; 		 }else 	{  $Researcher2E_3 = $_POST["Researcher2E_3"];  }
	 if(empty($_POST["Researcher2E_4"]))	{ $Researcher2E_4 = ""; 		 }else 	{  $Researcher2E_4 = $_POST["Researcher2E_4"];  }
	 if(empty($_POST["Researcher2E_5"]))	{ $Researcher2E_5 = ""; 		 }else 	{  $Researcher2E_5 = $_POST["Researcher2E_5"];  }
	 if(empty($_POST["Researcher2E_6"]))	{ $Researcher2E_6 = ""; 		 }else 	{  $Researcher2E_6 = $_POST["Researcher2E_6"];  }
	 if(empty($_POST["Researcher2E_7"]))	{ $Researcher2E_7 = ""; 		 }else 	{  $Researcher2E_7 = $_POST["Researcher2E_7"];  }
	 if(empty($_POST["Researcher2E_8"]))	{ $Researcher2E_8 = ""; 		 }else 	{  $Researcher2E_8 = $_POST["Researcher2E_8"];  }
	 if(empty($_POST["Researcher2E_9"]))	{ $Researcher2E_9 = ""; 		 }else 	{  $Researcher2E_9 = $_POST["Researcher2E_9"];  }
	 if(empty($_POST["Researcher2E_10"]))	{ $Researcher2E_10 = ""; 		 }else 	{  $Researcher2E_10 = $_POST["Researcher2E_10"];  }
	 if(empty($_POST["Researcher2E_11"]))	{ $Researcher2E_11 = ""; 		 }else 	{  $Researcher2E_11 = $_POST["Researcher2E_11"];  }
	 if(empty($_POST["Researcher2E_12"]))	{ $Researcher2E_12 = ""; 		 }else 	{  $Researcher2E_12 = $_POST["Researcher2E_12"];  }
	 if(empty($_POST["Researcher2E_other"]))	{	$Researcher2E_other  = "";  }else 	{    $Researcher2E_other  = $_POST["Researcher2E_other"];  } 
	  
	  $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='2' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				  $avail_count = $GF5["0"];
			}
			
			 
				
			if($avail_count==77)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('2','Researcher2B_1','$Researcher2B_1','$aajki_date','$sess_userid'),
				('2','Researcher2B_2','$Researcher2B_2','$aajki_date','$sess_userid'),
				('2','Researcher2B_3','$Researcher2B_3','$aajki_date','$sess_userid'),
				('2','Researcher2B_4','$Researcher2B_4','$aajki_date','$sess_userid'),
				('2','Researcher2B_5','$Researcher2B_5','$aajki_date','$sess_userid'),
				('2','Researcher2B_6','$Researcher2B_6','$aajki_date','$sess_userid'),
				('2','Researcher2B_7','$Researcher2B_7','$aajki_date','$sess_userid'),
				('2','Researcher2B_8','$Researcher2B_8','$aajki_date','$sess_userid'),
				('2','Researcher2B_9','$Researcher2B_9','$aajki_date','$sess_userid'),
				('2','Researcher2B_10','$Researcher2B_10','$aajki_date','$sess_userid'),
				('2','Researcher2B_11','$Researcher2B_11','$aajki_date','$sess_userid'),
				('2','Researcher2B_12','$Researcher2B_12','$aajki_date','$sess_userid'),
				('2','Researcher2B_13','$Researcher2B_13','$aajki_date','$sess_userid'),
				('2','Researcher2B_14','$Researcher2B_14','$aajki_date','$sess_userid'),
				('2','Researcher2B_15','$Researcher2B_15','$aajki_date','$sess_userid'),
				('2','Researcher2Bb_1','$Researcher2Bb_1','$aajki_date','$sess_userid'),
				('2','Researcher2Bb_2','$Researcher2Bb_2','$aajki_date','$sess_userid'),
				('2','Researcher2Bb_3','$Researcher2Bb_3','$aajki_date','$sess_userid'),
				('2','Researcher2Bb_4','$Researcher2Bb_4','$aajki_date','$sess_userid'),
				('2','Researcher2C_1','$Researcher2C_1','$aajki_date','$sess_userid'),
				('2','Researcher2C_2','$Researcher2C_2','$aajki_date','$sess_userid'),
				('2','Researcher2D_1','$Researcher2D_1','$aajki_date','$sess_userid'),
				('2','Researcher2D_2','$Researcher2D_2','$aajki_date','$sess_userid'),
				('2','Researcher2E_1','$Researcher2E_1','$aajki_date','$sess_userid'),
				('2','Researcher2E_2','$Researcher2E_2','$aajki_date','$sess_userid'),
				('2','Researcher2E_3','$Researcher2E_3','$aajki_date','$sess_userid'),
				('2','Researcher2E_4','$Researcher2E_4','$aajki_date','$sess_userid'),
				('2','Researcher2E_5','$Researcher2E_5','$aajki_date','$sess_userid'),
				('2','Researcher2E_6','$Researcher2E_6','$aajki_date','$sess_userid'),
				('2','Researcher2E_7','$Researcher2E_7','$aajki_date','$sess_userid'),
				('2','Researcher2E_8','$Researcher2E_8','$aajki_date','$sess_userid'),
				('2','Researcher2E_9','$Researcher2E_9','$aajki_date','$sess_userid'),
				('2','Researcher2E_10','$Researcher2E_10','$aajki_date','$sess_userid'),
				('2','Researcher2E_11','$Researcher2E_11','$aajki_date','$sess_userid'),
				('2','Researcher2E_other','$Researcher2E_other','$aajki_date','$sess_userid'),
				('2','Researcher2E_12','$Researcher2E_12','$aajki_date','$sess_userid')";
			
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
			
	 if(empty($_POST["ResearcherA_1"]))	{	$ResearcherA_1  = ""; 	 }else 	{    $ResearcherA_1  = $_POST["ResearcherA_1"];  }  
	 if(empty($_POST["ResearcherA_2"]))	{	$ResearcherA_2  = ""; 	 }else 	{    $ResearcherA_2  = $_POST["ResearcherA_2"];  }  
	 if(empty($_POST["ResearcherA_3"]))	{	$ResearcherA_3  = ""; 	 }else 	{    $ResearcherA_3  = $_POST["ResearcherA_3"];  }  
	 if(empty($_POST["ResearcherA_4"]))	{	$ResearcherA_4  = ""; 	 }else 	{    $ResearcherA_4  = $_POST["ResearcherA_4"];  }  
	 
	 if(empty($_POST["ResearcherB_1"]))	{	$ResearcherB_1  = ""; 	 }else 	{    $ResearcherB_1  = $_POST["ResearcherB_1"];  }  
	 if(empty($_POST["ResearcherB_2"]))	{	$ResearcherB_2  = ""; 	 }else 	{    $ResearcherB_2  = $_POST["ResearcherB_2"];  }  
	 if(empty($_POST["ResearcherB_3"]))	{	$ResearcherB_3  = ""; 	 }else 	{    $ResearcherB_3  = $_POST["ResearcherB_3"];  }  
	 if(empty($_POST["ResearcherB_4"]))	{	$ResearcherB_4  = ""; 	 }else 	{    $ResearcherB_4  = $_POST["ResearcherB_4"];  }  
	 if(empty($_POST["ResearcherB_5"]))	{	$ResearcherB_5  = ""; 	 }else 	{    $ResearcherB_5  = $_POST["ResearcherB_5"];  }  
	 if(empty($_POST["ResearcherB_6"]))	{	$ResearcherB_6  = ""; 	 }else 	{    $ResearcherB_6  = $_POST["ResearcherB_6"];  }  
	 if(empty($_POST["ResearcherB_7"]))	{	$ResearcherB_7  = ""; 	 }else 	{    $ResearcherB_7  = $_POST["ResearcherB_7"];  }  
	 if(empty($_POST["ResearcherB_8"]))	{	$ResearcherB_8 = ""; 	 }else 	{    $ResearcherB_8  = $_POST["ResearcherB_8"];  }  
	 if(empty($_POST["ResearcherB_9"]))	{	$ResearcherB_9  = ""; 	 }else 	{    $ResearcherB_9  = $_POST["ResearcherB_9"];  }  
	 if(empty($_POST["ResearcherB_10"]))    {	$ResearcherB_10  = ""; 	 }else 	{    $ResearcherB_10  = $_POST["ResearcherB_10"];  }  
	 if(empty($_POST["ResearcherB_11"]))	{	$ResearcherB_11  = ""; 	 }else 	{    $ResearcherB_11  = $_POST["ResearcherB_11"];  }  
	 if(empty($_POST["ResearcherB_12"]))	{	$ResearcherB_12  = ""; 	 }else 	{    $ResearcherB_12  = $_POST["ResearcherB_12"];  }  
	 if(empty($_POST["ResearcherB_13"]))	{	$ResearcherB_13  = ""; 	 }else 	{    $ResearcherB_13  = $_POST["ResearcherB_13"];  }  
	 if(empty($_POST["ResearcherB_14"]))	{	$ResearcherB_14 = ""; 	 }else 	{    $ResearcherB_14  = $_POST["ResearcherB_14"];  }  
	 if(empty($_POST["ResearcherB_15"]))	{	$ResearcherB_15  = ""; 	 }else 	{    $ResearcherB_15  = $_POST["ResearcherB_15"];  }  
	 
	 if(empty($_POST["Researcher1C_1"]))	{	$Researcher1C_1  = ""; 	 }else 	{    $Researcher1C_1  = $_POST["Researcher1C_1"];  }  
	 if(empty($_POST["Researcher1C_2"]))	{	$Researcher1C_2  = ""; 	 }else 	{    $Researcher1C_2  = $_POST["Researcher1C_2"];  }  
	 if(empty($_POST["Researcher1C_3"]))	{	$Researcher1C_3  = ""; 	 }else 	{    $Researcher1C_3  = $_POST["Researcher1C_3"];  }  
	 if(empty($_POST["Researcher1C_4"]))	{	$Researcher1C_4  = ""; 	 }else 	{    $Researcher1C_4  = $_POST["Researcher1C_4"];  }  
	 if(empty($_POST["Researcher1C_5"]))	{	$Researcher1C_5  = ""; 	 }else 	{    $Researcher1C_5  = $_POST["Researcher1C_5"];  }  
	 if(empty($_POST["Researcher1C_6"]))	{	$Researcher1C_6  = ""; 	 }else 	{    $Researcher1C_6  = $_POST["Researcher1C_6"];  }  
	 if(empty($_POST["Researcher1C_7"]))	{	$Researcher1C_7  = ""; 	 }else 	{    $Researcher1C_7  = $_POST["Researcher1C_7"];  }  
	 if(empty($_POST["Researcher1C_8"]))	{	$Researcher1C_8  = ""; 	 }else 	{    $Researcher1C_8  = $_POST["Researcher1C_8"];  }  
	 if(empty($_POST["Researcher1C_9"]))	{	$Researcher1C_9  = ""; 	 }else 	{    $Researcher1C_9  = $_POST["Researcher1C_9"];  }  
	 if(empty($_POST["Researcher1C_10"]))	{	$Researcher1C_10  = "";  }else 	{    $Researcher1C_10  = $_POST["Researcher1C_10"];  }  
	 if(empty($_POST["Researcher1C_11"]))	{	$Researcher1C_11  = "";  }else 	{    $Researcher1C_11  = $_POST["Researcher1C_11"];  } 
	 if(empty($_POST["Researcher1C_12"]))	{	$Researcher1C_12  = "";  }else 	{    $Researcher1C_12  = $_POST["Researcher1C_12"];  } 
	 if(empty($_POST["Researcher1C_13"]))	{	$Researcher1C_13  = "";  }else 	{    $Researcher1C_13 = $_POST["Researcher1C_13"];  } 
	 if(empty($_POST["Researcher1C_14"]))	{	$Researcher1C_14  = "";  }else 	{    $Researcher1C_14  = $_POST["Researcher1C_14"];  } 
	 if(empty($_POST["Researcher1C_15"]))	{	$Researcher1C_15  = "";  }else 	{    $Researcher1C_15  = $_POST["Researcher1C_15"];  } 
	 if(empty($_POST["Researcher1C_16"]))	{	$Researcher1C_16  = "";	 }else 	{    $Researcher1C_16  = $_POST["Researcher1C_16"];  } 
	 if(empty($_POST["Researcher1C_17"]))	{	$Researcher1C_17  = "";  }else 	{    $Researcher1C_17  = $_POST["Researcher1C_17"];  } 
	 if(empty($_POST["Researcher1C_18"]))	{	$Researcher1C_18  = "";  }else 	{    $Researcher1C_18  = $_POST["Researcher1C_18"];  } 
	 if(empty($_POST["Researcher1C_19"]))	{	$Researcher1C_19  = "";  }else 	{    $Researcher1C_19  = $_POST["Researcher1C_19"];  } 
	 if(empty($_POST["Researcher1C_20"]))	{	$Researcher1C_20  = "";  }else 	{    $Researcher1C_20  = $_POST["Researcher1C_20"];  } 
	 if(empty($_POST["Researcher1C_21"]))	{	$Researcher1C_21  = "";  }else 	{    $Researcher1C_21  = $_POST["Researcher1C_21"];  } 
	 if(empty($_POST["Researcher1C_22"]))	{	$Researcher1C_22  = "";  }else 	{    $Researcher1C_22  = $_POST["Researcher1C_22"];  } 
	 if(empty($_POST["Researcher1C_23"]))	{	$Researcher1C_23  = "";  }else 	{    $Researcher1C_23  = $_POST["Researcher1C_23"];  } 
	 if(empty($_POST["Researcher1C_24"]))	{	$Researcher1C_24  = "";  }else 	{    $Researcher1C_24  = $_POST["Researcher1C_24"];  } 
	 
	 if(empty($_POST["Researcher1D_1"]))	{	$Researcher1D_1  = "";  }else 	{    $Researcher1D_1  = $_POST["Researcher1D_1"];  } 
	 if(empty($_POST["Researcher1D_2"]))	{	$Researcher1D_2  = "";  }else 	{    $Researcher1D_2  = $_POST["Researcher1D_2"];  } 
	 if(empty($_POST["Researcher1D_3"]))	{	$Researcher1D_3  = "";  }else 	{    $Researcher1D_3  = $_POST["Researcher1D_3"];  } 
	 if(empty($_POST["Researcher1D_4"]))	{	$Researcher1D_4  = "";  }else 	{    $Researcher1D_4  = $_POST["Researcher1D_4"];  } 
	 if(empty($_POST["Researcher1D_5"]))	{	$Researcher1D_5  = "";  }else 	{    $Researcher1D_5  = $_POST["Researcher1D_5"];  } 
	 if(empty($_POST["Researcher1D_6"]))	{	$Researcher1D_6  = "";  }else 	{    $Researcher1D_6  = $_POST["Researcher1D_6"];  } 
	
	 if(empty($_POST["Researcher1D_8"]))	{	$Researcher1D_8  = "";  }else 	{    $Researcher1D_8  = $_POST["Researcher1D_8"];  } 
	 if(empty($_POST["Researcher1D_9"]))	{	$Researcher1D_9  = "";  }else 	{    $Researcher1D_9  = $_POST["Researcher1D_9"];  } 
	 if(empty($_POST["Researcher1D_10"]))	{	$Researcher1D_10  = "";  }else 	{    $Researcher1D_10  = $_POST["Researcher1D_10"];  } 
	 if(empty($_POST["Researcher1D_11"]))	{	$Researcher1D_11  = "";  }else 	{    $Researcher1D_11  = $_POST["Researcher1D_11"];  } 
	 
	 if(empty($_POST["Researcher1E_1"]))	{	$Researcher1E_1   = "";  }else 	{    $Researcher1E_1   = $_POST["Researcher1E_1"];  } 
	 if(empty($_POST["Researcher1E_2"]))	{	$Researcher1E_2   = "";  }else 	{    $Researcher1E_2   = $_POST["Researcher1E_2"];  } 
	 if(empty($_POST["Researcher1E_3"]))	{	$Researcher1E_3   = "";  }else 	{    $Researcher1E_3   = $_POST["Researcher1E_3"];  } 
	 if(empty($_POST["Researcher1E_4"]))	{	$Researcher1E_4   = "";  }else 	{    $Researcher1E_4   = $_POST["Researcher1E_4"];  } 
	 if(empty($_POST["Researcher1E_5"]))	{	$Researcher1E_5   = "";  }else 	{    $Researcher1E_5   = $_POST["Researcher1E_5"];  } 
	 if(empty($_POST["Researcher1E_6"]))	{	$Researcher1E_6   = "";  }else 	{    $Researcher1E_6   = $_POST["Researcher1E_6"];  } 
	 if(empty($_POST["Researcher1E_7"]))	{	$Researcher1E_7   = "";  }else 	{    $Researcher1E_7   = $_POST["Researcher1E_7"];  } 
	 if(empty($_POST["Researcher1E_8"]))	{	$Researcher1E_8   = "";  }else 	{    $Researcher1E_8   = $_POST["Researcher1E_8"];  } 
	 if(empty($_POST["Researcher1E_9"]))	{	$Researcher1E_9   = "";  }else 	{    $Researcher1E_9   = $_POST["Researcher1E_9"];  } 
	 if(empty($_POST["Researcher1E_10"]))	{	$Researcher1E_10  = "";  }else  {    $Researcher1E_10  = $_POST["Researcher1E_10"];  } 
	 
	 if(empty($_POST["Researcher1F_1"]))	{	$Researcher1F_1  = "";  }else  {    $Researcher1F_1  = $_POST["Researcher1F_1"];  } 
	 if(empty($_POST["Researcher1F_2"]))	{	$Researcher1F_2  = "";  }else  {    $Researcher1F_2  = $_POST["Researcher1F_2"];  } 
	 
	 if(empty($_POST["Researcher1G_1"]))	{	$Researcher1G_1  = "";  }else  {    $Researcher1G_1  = $_POST["Researcher1G_1"];  } 
	 if(empty($_POST["Researcher1G_2"]))	{	$Researcher1G_2  = "";  }else  {    $Researcher1G_2  = $_POST["Researcher1G_2"];  } 
	 if(empty($_POST["Researcher1G_3"]))	{	$Researcher1G_3  = "";  }else  {    $Researcher1G_3  = $_POST["Researcher1G_3"];  } 
	 
	 if(empty($_POST["Researcher1H_1"]))	{	$Researcher1H_1  = "";  }else  {    $Researcher1H_1  = $_POST["Researcher1H_1"];  } 
	 if(empty($_POST["Researcher1H_2"]))	{	$Researcher1H_2  = "";  }else  {    $Researcher1H_2  = $_POST["Researcher1H_2"];  } 
	 if(empty($_POST["Researcher1H_3"]))	{	$Researcher1H_3  = "";  }else  {    $Researcher1H_3  = $_POST["Researcher1H_3"];  } 
	 if(empty($_POST["Researcher1H_4"]))	{	$Researcher1H_4  = "";  }else  {    $Researcher1H_4  = $_POST["Researcher1H_4"];  } 
	 if(empty($_POST["Researcher1H_5"]))	{	$Researcher1H_5  = "";  }else  {    $Researcher1H_5  = $_POST["Researcher1H_5"];  } 
	 if(empty($_POST["Researcher1H_6"]))	{	$Researcher1H_6  = "";   }else {    $Researcher1H_6  = $_POST["Researcher1H_6"];  } 
	 
	 if(empty($_POST["Researcher1I_1"]))	{	$Researcher1I_1  = "";  }else  {    $Researcher1I_1  = $_POST["Researcher1I_1"];  } 
	 if(empty($_POST["Researcher1I_2"]))	{	$Researcher1I_2  = "";  }else  {    $Researcher1I_2  = $_POST["Researcher1I_2"];  } 
	 if(empty($_POST["Researcher1I_3"]))	{	$Researcher1I_3  = "";  }else  {    $Researcher1I_3  = $_POST["Researcher1I_3"];  } 
	 if(empty($_POST["Researcher1I_4"]))	{	$Researcher1I_4  = "";  }else  {    $Researcher1I_4  = $_POST["Researcher1I_4"];  } 
 
	 
	 $avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$sess_userid' AND Annexure='2' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				      $avail_count = $GF5["0"];
			}
			if($avail_count==0)
			{
				$SGDF_ins="INSERT INTO survey_questions (Annexure,Q_title,Q_details,on_date,user_id) VALUES 
				('2','ResearcherA_1','$ResearcherA_1','$aajki_date','$sess_userid'),
				('2','ResearcherA_2','$ResearcherA_2','$aajki_date','$sess_userid'),
				('2','ResearcherA_3','$ResearcherA_3','$aajki_date','$sess_userid'),
				('2','ResearcherA_4','$ResearcherA_4','$aajki_date','$sess_userid'),
				('2','ResearcherB_1','$ResearcherB_1','$aajki_date','$sess_userid'),
				('2','ResearcherB_2','$ResearcherB_2','$aajki_date','$sess_userid'),
				('2','ResearcherB_3','$ResearcherB_3','$aajki_date','$sess_userid'),
				('2','ResearcherB_4','$ResearcherB_4','$aajki_date','$sess_userid'),
				('2','ResearcherB_5','$ResearcherB_5','$aajki_date','$sess_userid'),
				('2','ResearcherB_6','$ResearcherB_6','$aajki_date','$sess_userid'),
				('2','ResearcherB_7','$ResearcherB_7','$aajki_date','$sess_userid'),
				('2','ResearcherB_8','$ResearcherB_8','$aajki_date','$sess_userid'),
				('2','ResearcherB_9','$ResearcherB_9','$aajki_date','$sess_userid'),
				('2','ResearcherB_10','$ResearcherB_10','$aajki_date','$sess_userid'),
				('2','ResearcherB_11','$ResearcherB_11','$aajki_date','$sess_userid'),
				('2','ResearcherB_12','$ResearcherB_12','$aajki_date','$sess_userid'),
				('2','ResearcherB_13','$ResearcherB_13','$aajki_date','$sess_userid'),
				('2','ResearcherB_14','$ResearcherB_14','$aajki_date','$sess_userid'),
				('2','ResearcherB_15','$ResearcherB_15','$aajki_date','$sess_userid'),
				('2','Researcher1C_1','$Researcher1C_1','$aajki_date','$sess_userid'),
				('2','Researcher1C_2','$Researcher1C_2','$aajki_date','$sess_userid'),
				('2','Researcher1C_3','$Researcher1C_3','$aajki_date','$sess_userid'),
				('2','Researcher1C_4','$Researcher1C_4','$aajki_date','$sess_userid'),
				('2','Researcher1C_5','$Researcher1C_5','$aajki_date','$sess_userid'),
				('2','Researcher1C_6','$Researcher1C_6','$aajki_date','$sess_userid'),
				('2','Researcher1C_7','$Researcher1C_7','$aajki_date','$sess_userid'),
				('2','Researcher1C_8','$Researcher1C_8','$aajki_date','$sess_userid'),
				('2','Researcher1C_9','$Researcher1C_9','$aajki_date','$sess_userid'),
				('2','Researcher1C_10','$Researcher1C_10','$aajki_date','$sess_userid'),
				('2','Researcher1C_11','$Researcher1C_11','$aajki_date','$sess_userid'),
				('2','Researcher1C_12','$Researcher1C_12','$aajki_date','$sess_userid'),
				('2','Researcher1C_13','$Researcher1C_13','$aajki_date','$sess_userid'),
				('2','Researcher1C_14','$Researcher1C_14','$aajki_date','$sess_userid'),
				('2','Researcher1C_15','$Researcher1C_15','$aajki_date','$sess_userid'),
				('2','Researcher1C_16','$Researcher1C_16','$aajki_date','$sess_userid'),
				('2','Researcher1C_17','$Researcher1C_17','$aajki_date','$sess_userid'),
				('2','Researcher1C_18','$Researcher1C_18','$aajki_date','$sess_userid'),
				('2','Researcher1C_19','$Researcher1C_19','$aajki_date','$sess_userid'),
				('2','Researcher1C_20','$Researcher1C_20','$aajki_date','$sess_userid'),
				('2','Researcher1C_21','$Researcher1C_21','$aajki_date','$sess_userid'),
				('2','Researcher1C_22','$Researcher1C_22','$aajki_date','$sess_userid'),
				('2','Researcher1C_23','$Researcher1C_23','$aajki_date','$sess_userid'),
				('2','Researcher1C_24','$Researcher1C_24','$aajki_date','$sess_userid'),
				('2','Researcher1D_1','$Researcher1D_1','$aajki_date','$sess_userid'),
				('2','Researcher1D_2','$Researcher1D_2','$aajki_date','$sess_userid'),
				('2','Researcher1D_3','$Researcher1D_3','$aajki_date','$sess_userid'),
				('2','Researcher1D_4','$Researcher1D_4','$aajki_date','$sess_userid'),
				('2','Researcher1D_5','$Researcher1D_5','$aajki_date','$sess_userid'),
				('2','Researcher1D_6','$Researcher1D_6','$aajki_date','$sess_userid'),
				('2','Researcher1D_8','$Researcher1D_8','$aajki_date','$sess_userid'),
				('2','Researcher1D_9','$Researcher1D_9','$aajki_date','$sess_userid'),
				('2','Researcher1D_10','$Researcher1D_10','$aajki_date','$sess_userid'),
				('2','Researcher1D_11','$Researcher1D_11','$aajki_date','$sess_userid'),
				('2','Researcher1E_1','$Researcher1E_1','$aajki_date','$sess_userid'),
				('2','Researcher1E_2','$Researcher1E_2','$aajki_date','$sess_userid'),
				('2','Researcher1E_3','$Researcher1E_3','$aajki_date','$sess_userid'),
				('2','Researcher1E_4','$Researcher1E_4','$aajki_date','$sess_userid'),
				('2','Researcher1E_5','$Researcher1E_5','$aajki_date','$sess_userid'),
				('2','Researcher1E_6','$Researcher1E_6','$aajki_date','$sess_userid'),
				('2','Researcher1E_7','$Researcher1E_7','$aajki_date','$sess_userid'),
				('2','Researcher1E_8','$Researcher1E_8','$aajki_date','$sess_userid'),
				('2','Researcher1E_9','$Researcher1E_9','$aajki_date','$sess_userid'),
				('2','Researcher1E_10','$Researcher1E_10','$aajki_date','$sess_userid'), 
				('2','Researcher1F_1','$Researcher1F_1','$aajki_date','$sess_userid'), 
				('2','Researcher1G_1','$Researcher1G_1','$aajki_date','$sess_userid'), 
				('2','Researcher1G_2','$Researcher1G_2','$aajki_date','$sess_userid'), 
				('2','Researcher1G_3','$Researcher1G_3','$aajki_date','$sess_userid'), 
				('2','Researcher1H_1','$Researcher1H_1','$aajki_date','$sess_userid'), 
				('2','Researcher1H_2','$Researcher1H_2','$aajki_date','$sess_userid'), 
				('2','Researcher1H_3','$Researcher1H_3','$aajki_date','$sess_userid'), 
				('2','Researcher1H_4','$Researcher1H_4','$aajki_date','$sess_userid'), 
				('2','Researcher1H_5','$Researcher1H_5','$aajki_date','$sess_userid'), 
				('2','Researcher1H_6','$Researcher1H_6','$aajki_date','$sess_userid'), 
				('2','Researcher1I_1','$Researcher1I_1','$aajki_date','$sess_userid'), 
				('2','Researcher1I_2','$Researcher1I_2','$aajki_date','$sess_userid'), 
				('2','Researcher1I_3','$Researcher1I_3','$aajki_date','$sess_userid'), 
				('2','Researcher1I_4','$Researcher1I_4','$aajki_date','$sess_userid')	";
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
  <p> This  form is Design and Developed by <a href="https://itra.medialabasia.in/" target="_blank" title="For any query contect, Avinash JWD (ITRA) " > ITRA</a> </p>
</footer>

</body>
</html>
 

  <?php 
	function form_step3($sess_userid,$dbo,$final){
		?>
		
		
		
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?> 
				<form   method="post" style="//margin-top:-1%;"    >
				 
			<?php 
		}
		?> 
			<b style="font-size:19px;">4.	Insight</b><br><br>
				<b style="font-size:19px;"> A.	Based on some known successful examples of ICT&E R&D translation, what is your opinion/ suggestion that will boost translation of R&D into Technologies / Products/ Solutions /Startups having commercial/societal value: </b><b class="red">*</b><br>
				<textarea  required="required" class="form-control" placeholder="Remarks (i.e. Govt. Policy/Institutional policy/ Knowledge Access/Funds Access)"   name="Researcher4A" id="Researcher4A" ><?php $Q_title="Researcher4A"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></textarea><br><br>
				<b style="font-size:19px;">	B.	Views on issues/ problem faced (if any) that hinders in translation of research into Technologies/ Products/ Services/ Start-ups having commercial/societal value:</b><b class="red">*</b><br>
				<textarea  required="required" class="form-control"    name="Researcher4B" id="Researcher4B" ><?php $Q_title="Researcher4B"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></textarea><br><br>
				<b style="font-size:19px;"> C.	Do you think there are factors/ barriers which are hampering Industry academia linkages and Transfer of Technologies? If yes, your views on the same: </b><b class="red">*</b><br><br>
				<textarea  required="required" class="form-control"   name="Researcher4C" id="Researcher4C" ><?php $Q_title="Researcher4C"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></textarea><br>
				
				 <br>
	 
			
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?><div style="float:right;">
					<!--	<button type="submit"  style="background-color:lightgray;"  name="Save_data_step2"  >Previous</button> -->
						<button type="submit"   name="Save_data_step_last_submit"  >Preview & Submit</button>
					</div>
				   </form>
				   
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
			?> <form   method="post"    > <?php 
		}
		?>
		 
					 
	 	<b style="font-size:19px;"> 2. Institutional Support: </b><br> <br> 
	<b style="font-size:19px;"> A.	What in your opion is the major focus of your Institution/ University/ Organization </b><br>
	<br>
	 		
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Priority <b class="red">*</b>	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Imparting Education / Knowledge </th>
        <td> 		<select name="Researcher2B_1"  required="required"  class="form-control"  id="Researcher2B_1"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
				  </td> 
        <td> 	
			 <input type="text"    id="Researcher2B_2"  name="Researcher2B_2" value="<?php $Q_title="Researcher2B_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>"> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Basic Research </th>
        <td> 	<select name="Researcher2B_3"  required="required"  class="form-control" id="Researcher2B_3"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say"> Can't say </option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus" > 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>   </td>
        <td> 	<input type="text"     id="Researcher2B_4"    name="Researcher2B_4" value="<?php $Q_title="Researcher2B_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Applied Research </th>
        <td> 	<select name="Researcher2B_5"  required="required"  class="form-control" id="Researcher2B_5"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say"> Can't say </option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus" > 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select> </td>
        <td> 	<input type="text"     id="Researcher2B_6"    name="Researcher2B_6" value="<?php $Q_title="Researcher2B_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	    <tr>
        <th style="width:25%;"> Research translation in terms of Publications </th>
        <td> 	<select name="Researcher2B_7"  required="required"  class="form-control" id="Researcher2B_7"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		 </td>
        <td> 	<input type="text"      id="Researcher2B_8"  name="Researcher2B_8" value="<?php $Q_title="Researcher2B_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Intellectual Property Rights/Patents </th>
        <td> 		<select name="Researcher2B_9"  required="required"  class="form-control" id="Researcher2B_9"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		 </td>
        <td> 	<input type="text"     id="Researcher2B_10"   name="Researcher2B_10" value="<?php $Q_title="Researcher2B_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Products/Services </th>
        <td> 		<select name="Researcher2B_11"  required="required"  class="form-control" id="Researcher2B_11"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say</option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		 </td>
        <td> 	<input type="text"      id="Researcher2B_12"   name="Researcher2B_12" value="<?php $Q_title="Researcher2B_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;">  <input type="text"   class="form-control" placeholder="Others (please specify)"  name="Researcher2B_13" value="<?php $Q_title="Researcher2B_13"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >  </th>
        <td> 
			<select name="Researcher2B_14"    class="form-control"    > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?>  value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		  </td>
        <td> 	<input type="text"  name="Researcher2B_15" value="<?php $Q_title="Researcher2B_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" ></td>
      </tr>
  
    </table> 
    
	 
	<br>
	
	
	  <b style="font-size:19px;">  B.	Does your institution's rules/policies/schemes support its researchers in undertaking the following activities: </b><br>
		
		 <table class="table table-striped">
		  
		  <tr>
		   <th style="width:25%;">   </th>	
		   <th >  please rank them in order of their priority <b class="red">*</b> </th>	
		  </tr>
		 
      <tr>
        <th style="width:29%;"> R&D   </th>
        <td> 	<select name="Researcher2Bb_1" required="required"  class="form-control"  id="Researcher2Bb_1"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		 	</td>
      </tr>
	   <tr>
        <th  > Intellectual Property Rights filing  </th>
        <td> 	<select name="Researcher2Bb_2"  required="required"  class="form-control"  id="Researcher2Bb_2"  > 
						<option value="">--Select Priority--</option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say </option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
	 	</td>
      </tr>
	   <tr>
        <th > Publication  </th>
        <td> 
				<select name="Researcher2Bb_3"  required="required"  class="form-control"  id="Researcher2Bb_3"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		  </td>
      </tr> <tr>
        <th  > Research Translation in products/services/startups  </th>
        <td> 	<select name="Researcher2Bb_4"  required="required"  class="form-control"  id="Researcher2Bb_4"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say  </option>
						<option <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
		 	</td>
      </tr>
	   
    </table>
  
	<br>
	
	  <b style="font-size:19px;">  C.	Are researchers (scientists and inventors) at your Institution/ University/ Organisation  given any sort of incentive for successful research or obtaining patent or product development or Transfer of technology </b><b class="red">*</b><br><br>
	 		<div class="panel panel-default">
			  <div class="panel-body">
			 
			  <div class="col-sm-2" id="chk3">
				<input type="radio" style="width:auto;"  required="required"  id="Researcher2C_1" name="Researcher2C_1" value ="YES"  <?php $Q_title="Researcher2C_1";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<br><input type="radio"  style="width:auto;"  id="Researcher2C_1_1" name="Researcher2C_1" value ="NO"   <?php $Q_title="Researcher2C_1"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		
			  </div>
			  <div class="col-sm-10">
				<textarea   placeholder="Remarks on how the inventers are incentivized? (profit sharing/ awards/ etc.) OPTIONAL " class="form-control" name="Researcher2C_2"><?php $Q_title="Researcher2C_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></textarea>
	     
			  </div>
				 </div>
			</div>
			 
			<br>
			
	  <b style="font-size:19px;">  D.	Has industry setup a research  facility/laboratory in ICT&E domain at your institution   </b><b class="red">*</b><br><br>
	 		 <div class="panel panel-default">
  <div class="panel-body">  

			  <div class="col-sm-2" id="chk4">
				<input type="radio" style="width:auto;"  required="required"  id="Researcher2D_1" name="Researcher2D_1" value ="YES"  <?php $Q_title="Researcher2D_1";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<br><input type="radio"  style="width:auto;"  id="Researcher2D_1_1" name="Researcher2D_1" value ="NO"   <?php $Q_title="Researcher2D_1"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		
			  </div>
			  <div class="col-sm-10"> If yes, please give details:
				<textarea   placeholder="industry-Lab/facility name " class="form-control" name="Researcher2D_2"><?php $Q_title="Researcher2D_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></textarea> 
	     
			  </div>
			  </div>
				
			</div><br>
		<b style="font-size:19px;"> E.	Does your Institution/ University/ Organisation provide access of the following to its researchers? </b> <br>
	<table class="table table-striped">
	 <tr>
        <th style="width:50%;">  </th>
        <th > 	Is access provided to researchers? 	<b class="red">*</b> </th>
        <th style="text-align:center;"> 	Location with reference to your   institution (ignore if previous option is No)</th>
	  
      <tr>
        <th style="width:25%;"  > Rapid prototyping facility (Hardware and/or Software) </th>
        <td  id="chk5" > 	<input type="radio" style="width:auto;"    required="required"   id="Researcher2E_1" name="Researcher2E_1" value ="YES"  <?php $Q_title="Researcher2E_1";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;"    required="required"  name="Researcher2E_1"  id="Researcher2E_1_1" value ="NO"   <?php $Q_title="Researcher2E_1"; $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td> 
        <td style="text-align:center;" > 	
				<input type="radio" style="width:auto;"   checked  name="Researcher2E_2" value ="Inside"  <?php $Q_title="Researcher2E_2";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Researcher2E_2" value ="Outside"   <?php $Q_title="Researcher2E_2"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Hardware and/or Software testing facility(s) </th>
         <td id="chk6"> 	<input type="radio" style="width:auto;"  required="required"  name="Researcher2E_3" id="Researcher2E_3" value ="YES"  <?php $Q_title="Researcher2E_3";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Researcher2E_3" id="Researcher2E_3_3" value ="NO"   <?php $Q_title="Researcher2E_3"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Researcher2E_4" value ="Inside"  <?php $Q_title="Researcher2E_4";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Researcher2E_4" value ="Outside"   <?php $Q_title="Researcher2E_4"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td></tr>
	   <tr>
        <th style="width:25%;"> Standardization/ Certification Body(s) </th>
          <td  id="chk7"> 	<input type="radio" style="width:auto;"  required="required"  name="Researcher2E_5" id="Researcher2E_5"  value ="YES"  <?php $Q_title="Researcher2E_5";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Researcher2E_5" id="Researcher2E_5_5" value ="NO"   <?php $Q_title="Researcher2E_5"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"   checked  name="Researcher2E_6" value ="Inside"  <?php $Q_title="Researcher2E_6";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Researcher2E_6" value ="Outside"   <?php $Q_title="Researcher2E_6"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td></tr> <tr>
        <th style="width:25%;"> Intellectual Property Rights office </th>
         <td  id="chk8"> 	<input type="radio" style="width:auto;"  required="required"  name="Researcher2E_7"  id="Researcher2E_7" value ="YES"  <?php $Q_title="Researcher2E_7";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Researcher2E_7"  id="Researcher2E_7_7" value ="NO"   <?php $Q_title="Researcher2E_7"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Researcher2E_8" value ="Inside"  <?php $Q_title="Researcher2E_8";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Researcher2E_8" value ="Outside"   <?php $Q_title="Researcher2E_8"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td> </tr>
	  <tr>
        <th style="width:25%;"> Technology Transfer Office </th>
          <td  id="chk9"> 	<input type="radio" style="width:auto;"  required="required"  name="Researcher2E_9" id="Researcher2E_9" value ="YES"  <?php $Q_title="Researcher2E_9";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Researcher2E_9" id="Researcher2E_9_9" value ="NO"   <?php $Q_title="Researcher2E_9"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Researcher2E_10" value ="Inside"  <?php $Q_title="Researcher2E_10";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"    name="Researcher2E_10" value ="Outside"   <?php $Q_title="Researcher2E_10"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td> </tr>
	  <tr>
        <th style="width:25%;"> Platform for Industry Interactions </th>
         <td  id="chk10"> 	<input type="radio" style="width:auto;"  required="required"   name="Researcher2E_11"  id="Researcher2E_11"  value ="YES"  <?php $Q_title="Researcher2E_11";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
				<input type="radio"  style="width:auto;" required="required"  name="Researcher2E_11"   id="Researcher2E_11_11"  value ="NO"   <?php $Q_title="Researcher2E_11"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		</td>
        <td style="text-align:center;"> 	
				<input type="radio" style="width:auto;"  checked  name="Researcher2E_12" value ="Inside"  <?php $Q_title="Researcher2E_12";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Inside"){ echo"checked";} ?>> Inside  &nbsp;
				<input type="radio"  style="width:auto;"   name="Researcher2E_12" value ="Outside"   <?php $Q_title="Researcher2E_12"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Outside"){ echo"checked";} ?>> Outside	
		</td> </tr>
	  </table> 	
	<table class="table table-striped">
		<tr>
		<td  >  <input type="text"     placeholder="Others (please specify)" class="form-control" name="Researcher2E_other" value="<?php $Q_title="Researcher2E_other"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >
		</td>
		</tr>
	</table> 
		
	<!-- 		 
Researcher2B_1 -14
Researcher2Bb_1 -4
Researcher2C_1 -2
Researcher2D_1 -2
Researcher2E_1 -12
	-->
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?>
			
					<div style="float:right;">
						<!-- <button type="submit" style="background-color:lightgray;"  name="Save_data_step1"  >Previous</button> -->
						<button type="submit"   name="Save_data_step3"  >Save & Next</button>
					</div>
				   </form>
				   
				   <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:lightgreen;' ></span>
										<span class="step"   ></span>
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
			?> <form   method="post"    >
			<?php 
		}
		?>			
					   
    <b style="font-size:19px;"> 1.	Area of research </b><br><br>
	
		 <b style="font-size:19px;"> A.	What is your broad area of research? </b><br> <br> 
		 
		  
		<div style="margin-left:2%;" class="panel panel-default" id="ResearcherA" > 
			<div class="panel-body">
			 <div class="row"  >
				<div class="col-sm-3">
					<input type="checkbox"  style="width:auto;" id="ResearcherA_1"  name="ResearcherA_1" value ="ICT"  <?php $Q_title="ResearcherA_1"; $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="ICT"){ echo"checked";} ?>> ICT <br>
					<input type="checkbox"  style="width:auto;" id="ResearcherA_2"  name="ResearcherA_2" value ="Electronics"  <?php $Q_title="ResearcherA_2"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Electronics"){ echo"checked";} ?>>Electronics   &nbsp;  
				
					</div>
				
				<div class="col-sm-9">
				 <div class="row"  >
					<div class="col-sm-1"> <input type="checkbox"  style="width:auto;" id="ResearcherA_3"  name="ResearcherA_3" value ="Others"  <?php $Q_title="ResearcherA_3"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Others"){ echo"checked";} ?>> 
					 </div>
					<div class="col-sm-11"> <input type="text"  class="form-control" id="ResearcherA_4" style="width:100%;"  placeholder="Other"  name="ResearcherA_4" value ="<?php $Q_title="ResearcherA_4"; echo $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>"> 
					</div>
				</div>
					
					</div>
			</div>
		</div>
		</div>
	
	<b style="font-size:19px;">B. Please rank your focus on the following categories:  </b><br> <br> 		
			
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Priority <b class="red">*</b>	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Imparting Education / Knowledge </th>
        <td> 		<select name="ResearcherB_1"  required="required"  class="form-control"  id="ResearcherB_1"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
				  </td> 
        <td> 	
			 <input type="text"    id="ResearcherB_2"  name="ResearcherB_2" value="<?php $Q_title="ResearcherB_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>"> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Basic Research </th>
        <td> 	<select name="ResearcherB_3"  required="required"  class="form-control" id="ResearcherB_3"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say"> Can't say </option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus" > 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>   </td>
        <td> 	<input type="text"     id="ResearcherB_4"    name="ResearcherB_4" value="<?php $Q_title="ResearcherB_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Applied Research </th>
        <td> 	<select name="ResearcherB_5"  required="required"  class="form-control" id="ResearcherB_5"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say"> Can't say </option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus" > 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select> </td>
        <td> 	<input type="text"     id="ResearcherB_6"    name="ResearcherB_6" value="<?php $Q_title="ResearcherB_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	    <tr>
        <th style="width:25%;"> Research translation in terms of Publications </th>
        <td> 	<select name="ResearcherB_7"  required="required"  class="form-control" id="ResearcherB_7"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		 </td>
        <td> 	<input type="text"      id="ResearcherB_8"  name="ResearcherB_8" value="<?php $Q_title="ResearcherB_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Intellectual Property Rights/Patents </th>
        <td> 		<select name="ResearcherB_9"  required="required"  class="form-control" id="ResearcherB_9"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		 </td>
        <td> 	<input type="text"     id="ResearcherB_10"   name="ResearcherB_10" value="<?php $Q_title="ResearcherB_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Products/Services </th>
        <td> 		<select name="ResearcherB_11"  required="required"  class="form-control" id="ResearcherB_11"   > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say</option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		 </td>
        <td> 	<input type="text"      id="ResearcherB_12"   name="ResearcherB_12" value="<?php $Q_title="ResearcherB_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;">  <input type="text"   class="form-control" placeholder="Others (please specify)"  name="ResearcherB_13" value="<?php $Q_title="ResearcherB_13"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >  </th>
        <td> 
			<select name="ResearcherB_14"    class="form-control"    > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">  Can't say </option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==1) { echo "selected"; }?>  value="1"> 1- Low Priority </option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==2) { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==3) { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==4) { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV==5) { echo "selected"; }?> value="5"> 5 - High Priority </option>
					<select>
		  </td>
        <td> 	<input type="text"  name="ResearcherB_15" value="<?php $Q_title="ResearcherB_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" ></td>
      </tr>
  
    </table> 
	 
   <b style="font-size:19px;">C. Please mention the number of ICT&E R&D projects undertaken:  </b><br> <br> 
		
		  <table class="table table-striped">
	 <tr>
        <th style="width:25%;"> Using <span class="caret"></span>  </th>
        <th> 	Number of Single institution projects	<b class="red">*</b></th>
        <th> 	Number of Joint (multi-institutional) projects <b class="red">*</b></th>
        <th  style="width:35%;" > 	Remarks (eg. name of scheme or agency) </th>
	  
      <tr>
        <th style="width:25%;"> Internal Resources with focus on basic research </th>
        <td> 	<input type="number" required="required" min="0" max="999" id="Researcher1C_1"   oninput="this.className = ''" name="Researcher1C_1" value="<?php $Q_title="Researcher1C_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999" id="Researcher1C_2"   oninput="this.className = ''" name="Researcher1C_2" value="<?php $Q_title="Researcher1C_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"  id="Researcher1C_3"  oninput="this.className = ''" name="Researcher1C_3" value="<?php $Q_title="Researcher1C_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Internal Resources with focus on applied research  </th>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_4"  oninput="this.className = ''" name="Researcher1C_4" value="<?php $Q_title="Researcher1C_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_5" oninput="this.className = ''" name="Researcher1C_5" value="<?php $Q_title="Researcher1C_5";  $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"   id="Researcher1C_6"  oninput="this.className = ''" name="Researcher1C_6" value="<?php $Q_title="Researcher1C_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;">  Govt Funds/funding Agencies with focus on basic research </th>
        <td> 	<input type="number" required="required" min="0" max="999" id="Researcher1C_7"  oninput="this.className = ''" name="Researcher1C_7" value="<?php $Q_title="Researcher1C_7";  $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; }?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_8"  oninput="this.className = ''" name="Researcher1C_8" value="<?php $Q_title="Researcher1C_8"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"       id="Researcher1C_9" oninput="this.className = ''" name="Researcher1C_9" value="<?php $Q_title="Researcher1C_9"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Govt Funds/funding Agencies with focus on applied research </th>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_10"  oninput="this.className = ''" name="Researcher1C_10" value="<?php $Q_title="Researcher1C_10"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_11"  oninput="this.className = ''" name="Researcher1C_11" value="<?php $Q_title="Researcher1C_11"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"      id="Researcher1C_12" oninput="this.className = ''" name="Researcher1C_12" value="<?php $Q_title="Researcher1C_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> Industry funds with focus on basic research </th>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Researcher1C_13"  oninput="this.className = ''" name="Researcher1C_13" value="<?php $Q_title="Researcher1C_13"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Researcher1C_14" oninput="this.className = ''" name="Researcher1C_14" value="<?php $Q_title="Researcher1C_14";  $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"     id="Researcher1C_15"  oninput="this.className = ''" name="Researcher1C_15" value="<?php $Q_title="Researcher1C_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Industry funds with focus on applied research </th>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Researcher1C_16"  oninput="this.className = ''" name="Researcher1C_16" value="<?php $Q_title="Researcher1C_16"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Researcher1C_17" oninput="this.className = ''" name="Researcher1C_17" value="<?php $Q_title="Researcher1C_17";  $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"       id="Researcher1C_18" oninput="this.className = ''" name="Researcher1C_18" value="<?php $Q_title="Researcher1C_18"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> International funds with focus on basic research </th>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Researcher1C_19"  oninput="this.className = ''" name="Researcher1C_19" value="<?php $Q_title="Researcher1C_19"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" id="Researcher1C_20"  oninput="this.className = ''" name="Researcher1C_20" value="<?php $Q_title="Researcher1C_20"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"       id="Researcher1C_21"  oninput="this.className = ''" name="Researcher1C_21" value="<?php $Q_title="Researcher1C_21"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> International funds with focus on applied research  </th>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_22"  oninput="this.className = ''" name="Researcher1C_22" value="<?php $Q_title="Researcher1C_22"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999"  id="Researcher1C_23"  oninput="this.className = ''" name="Researcher1C_23" value="<?php $Q_title="Researcher1C_23"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"      id="Researcher1C_24"  oninput="this.className = ''" name="Researcher1C_24" value="<?php $Q_title="Researcher1C_24"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
 
  
    </table> 
	<b style="font-size:19px;">D.	Please mention numbers for various R&D output indicators:  </b><br> <br> 
	
	<table class="table table-striped">
	 <tr>
         
        <th> 	Output indicators	</th>
       <th> 	Number (Remarks National/International) <b class="red">*</b> </th>
	  </tr>
      <tr>
        <th style="width:25%;">Publication (referred journals)  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_1" name="Researcher1D_1" value="<?php $Q_title="Researcher1D_1";  $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        </tr>
	   <tr>
        <th style="width:25%;"> Patent Filed </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_2" name="Researcher1D_2" value="<?php $Q_title="Researcher1D_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Patent Granted </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_3" name="Researcher1D_3" value="<?php $Q_title="Researcher1D_3"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
      </tr> <tr>
        <th style="width:25%;">Copyright Obtained</th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_4" name="Researcher1D_4" value="<?php $Q_title="Researcher1D_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New products developed </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_5" name="Researcher1D_5" value="<?php $Q_title="Researcher1D_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New processes developed </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_6" name="Researcher1D_6" value="<?php $Q_title="Researcher1D_6"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
      </tr>
	  <!--
	   <tr>
        <th style="width:25%;"> Design prototypes developed </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_7" name="Researcher1D_7" value="<?php $Q_title="Researcher1D_7"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" ></td>
      </tr>--> <tr>
        <th style="width:25%;"> Transfer of Technologies  </th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_8" name="Researcher1D_8" value="<?php $Q_title="Researcher1D_8"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" ></td>
      </tr> <tr>
        <th style="width:25%;"> Licensing</th>
        <td> 	<input type="number" min="0" max="999"  required="required"   oninput="this.className = ''" id="Researcher1D_9" name="Researcher1D_9" value="<?php $Q_title="Researcher1D_9"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" ></td>
      </tr><tr>
		<td style="width:25%;">  <input type="text"     placeholder="Others (please specify)" oninput="this.className = ''" name="Researcher1D_10" value="<?php $Q_title="Researcher1D_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >  </td>
        <td> 	<input type="number" min="0" max="999"   oninput="this.className = ''" id="Researcher1D_11" name="Researcher1D_11" value="<?php $Q_title="Researcher1D_11"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>"  ></td>
      </tr>
  
    </table> 
   
   <b style="font-size:19px;">E. Please mention the number of new ICT&E Technology(s)/ Prototype(s)/ Startup(s)/ Service(s) developed  which were intended for Indian/ Global markets:  </b><br> <br> 
   
     <table class="table table-striped">
	  <tr>
        <th>   	</th>
        <th>  Indian market  <b class="red">*</b> 	</th>
        <th>  Global market <b class="red">*</b>  </th>
        <th>  Remarks (eg. broad domain of type) </th>
	  </tr>
	 
	  <tr>
        <th style="width:25%;"> Government </th>
        <td> 	<input type="number" required="required"  min="0" max="999"  class="form-control" name="Researcher1E_1"   id="Researcher1E_1" value="<?php $Q_title="Researcher1E_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required"  min="0" max="999" class="form-control" name="Researcher1E_2"   id="Researcher1E_2"value="<?php $Q_title="Researcher1E_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
		<td> 	<input type="text"    class="form-control" id="Institute3b_4" name="Researcher1E_3" value="<?php $Q_title="Researcher1E_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>  <tr>
        <th style="width:25%;"> Industry </th>
        <td> 	<input type="number" required="required" min="0" max="999" id="Researcher1E_4"  class="form-control" class="form-control" name="Researcher1E_4" value="<?php $Q_title="Researcher1E_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="number" required="required" min="0" max="999" id="Researcher1E_5" class="form-control"  class="form-control" name="Researcher1E_5" value="<?php $Q_title="Researcher1E_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
        <td> 	<input type="text"    class="form-control"   id="Researcher1E_6" name="Researcher1E_6" value="<?php $Q_title="Researcher1E_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr><tr>
	   <th style="width:25%;"> <input type="text"   class="form-control" placeholder="Others (please specify)"   name="Researcher1E_7" value="<?php $Q_title="Researcher1E_7"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >  </th>
       <td> 	<input type="number"   min="0" max="999"   class="form-control"  name="Researcher1E_8" value="<?php $Q_title="Researcher1E_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
        <td> 	<input type="number"   min="0" max="999"   class="form-control"   name="Researcher1E_9" value="<?php $Q_title="Researcher1E_9"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
       <td> 	<input type="text"  class="form-control"   name="Researcher1E_10" value="<?php $Q_title="Researcher1E_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	 
	</table> 
	
	 <b style="font-size:19px;">F. Has  output of your past R&D carried out in ICT&E domain been used by Industry? </b><br> <br> 
		<div class="panel panel-default">
		  <div class="panel-body"  id="chk1" >
		   
			<input type="radio" style="width:auto;"  required="required" id="Researcher1F_1"  name="Researcher1F_1" value ="YES" <?php $Q_title="Researcher1F_1"; $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
			<input type="radio" style="width:auto;"    name="Researcher1F_1" id="Researcher1F_1_1" value ="NO"  <?php $Q_title="Researcher1F_1"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
		 
		  </div>
		</div>
		
		
	 <br> <b style="font-size:19px;">G.	Do you think that the ICT&E Technology(s)/ Prototype(s)/ Product(s)/ Service(s) developed have a potential for commercial/social translation?    </b><br> <br> 	
		
		<div class="panel panel-default">
		  <div class="panel-body">
		  
		 
		 
		 
			  <div class="col-sm-2" id="chk2" >
				<label>(a). Your choice:</label><b class="red">*</b><br>
				<input type="radio" style="width:auto;"  required="required" id="Researcher1G_1" name="Researcher1G_1" value ="YES"  <?php $Q_title="Researcher1G_1";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;<br>
				<input type="radio"  style="width:auto;"   name="Researcher1G_1" id="Researcher1G_1_1" value ="NO"   <?php $Q_title="Researcher1G_1"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
			
			  </div>
			  <div class="col-sm-3">
			  <label> (b). If yes, then how many: </label> 
					<input type="number"  min="0" max="999" placeholder=" OPTIONAL... " id="Researcher1G_2"  class="form-control" name="Researcher1G_2" value="<?php $Q_title="Researcher1G_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >
			 
			  </div>
			<div class="col-sm-7">
				  <label> (c).  If yes, then their broad application area(s): </label>   
			
			<textarea    id="Researcher1G_3" class="form-control" placeholder=" OPTIONAL... " name="Researcher1G_3" ><?php $Q_title="Researcher1G_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></textarea><br><br>
			 
			  </div>
		</div> </div>
		
		<br><b style="font-size:19px;"> H.	Please rank the Basis/Need, on which your research problems/ projects were ascertained/ proposed: </b><br><br>
			<table class="table table-striped">
				<tr>
					<th></th>
					<th>Rank the relevant cells <b class="red">*</b> </th>
				</tr>
			  
			 <tr>
				<th style="width:25%;">  Market survey <b class="red">*</b></th>
				<td> 	<select name="Researcher1H_1"  required="required"  class="form-control"  id="Researcher1H_1"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say </option>
						<option <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?>  value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Literature review  </th>
				<td> 	<select name="Researcher1H_2"  required="required"  class="form-control"  id="Researcher1H_2"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option <?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intellectual Property Rights survey   </th>
				<td> 	<select name="Researcher1H_3"  required="required"  class="form-control"  id="Researcher1H_3"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Industry interactions  </th>
				<td> 	<select name="Researcher1H_4"  required="required"  class="form-control"  id="Researcher1H_4"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Social interactions   </th>
				<td> 	<select name="Researcher1H_5"  required="required"  class="form-control"  id="Researcher1H_5"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say  </option>
						<option <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intuition  </th>
				<td> 	<select name="Researcher1H_6"  required="required"  class="form-control"  id="Researcher1H_6"  > 
						<option value="">--Select Priority--</option>
						<option <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="Can not say") { echo "selected"; }?> value="Can not say">   Can't say </option>
						<option <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="0-No focus") { echo "selected"; }?> value="0-No focus"> 0- No focus  </option>
						<option  <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="1") { echo "selected"; }?> value="1"> 1- Low Priority </option>
						<option  <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="2") { echo "selected"; }?> value="2"> 2 </option>
						<option  <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="3") { echo "selected"; }?> value="3"> 3 </option>
						<option  <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="4") { echo "selected"; }?> value="4"> 4 </option>
						<option  <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($GSBV=="5") { echo "selected"; }?> value="5"> 5 - High Priority </option>
				<select>
				</td>
			 </tr>
			 </table>
		<br><b style="font-size:19px;"> I.	How many schemes for translations of research into products/ services from Goverment of India and other souces are known:   </b><br><br>
					
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Numbers <b class="red">*</b>	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Known and received funding: </th>
        <td> 	<input type="number" required="required"  min="0" max="999"  class="form-control" name="Researcher1I_1"   id="Researcher1I_1" value="<?php $Q_title="Researcher1I_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
          </td> 
        <td> 	
			 <input type="text"  name="Researcher1I_2" value="<?php $Q_title="Researcher1I_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>"> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Known but not received funding </th>
        <td> <input type="number" required="required"  min="0" max="999"  class="form-control" name="Researcher1I_3"   id="Researcher1I_3" value="<?php $Q_title="Researcher1I_3"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>" >	</td>
         </td>
        <td> 	<input type="text"         name="Researcher1I_4" value="<?php $Q_title="Researcher1I_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>" >	</td>
      </tr>
	  
	  </table>
			<br> 
			<!-- 
ResearcherA_1 - 4
ResearcherB_1 - 15
Researcher1C_1 - 24
Researcher1D_1 - 11
Researcher1E_1 - 10
Researcher1F_1 - 1
Researcher1G_1 -3
Researcher1I_1 -4
  -->
	 <?php 
		if($final=="yes"){
			
		}else{ 
			?> <div style="float:right;">
       
				  <button type="submit"   name="Save_data_step2"  >Save & Next</button>
				</div>
			   </form>
			   
			    <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:lightgreen;' ></span>
										<span class="step"  ></span>
										<span class="step"   ></span>
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
			// ResearcherA_2
			var check1 = check2 =check3=check4="ffff" ;
			check1 = document.getElementById('ResearcherA_1').checked; //document.getElementById('checkbox').checked
			check2 = document.getElementById('ResearcherA_2').checked;
			check3 = document.getElementById('ResearcherA_3').checked;
			check4 = document.getElementById('ResearcherA_4').checked;
		//	alert(check1);
		//	alert(check2);
		//	alert(check3);
		//	alert(check4);
			if(check1 == false && check2 == false && check3 == false && check4 ==false ){
				alert("Please select at least one value for the feild ! ");
				document.getElementById('ResearcherA').style.backgroundColor = '#ffdddd';
				return false;	
			}
			
			 
			 if(document.getElementById('ResearcherB_1').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('ResearcherB_1').style.backgroundColor = '#ffdddd';
				return false;	 
			 }
			  
			 if(document.getElementById('ResearcherB_3').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('ResearcherB_3').style.backgroundColor = '#ffdddd';
				return false;	 
			 }
			  
			 if(document.getElementById('ResearcherB_5').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('ResearcherB_5').style.backgroundColor = '#ffdddd';
				return false;	 
			 }
			  
			 if(document.getElementById('ResearcherB_7').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('ResearcherB_7').style.backgroundColor = '#ffdddd';
				return false;	 
			 }
			  
			 if(document.getElementById('ResearcherB_9').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('ResearcherB_9').style.backgroundColor = '#ffdddd';
				return false;	 
			 }
			  
			 
			 var	x = document.getElementById("Researcher1C_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_1').style.backgroundColor = '#ffdddd';
								return false;
							}
			var	x = document.getElementById("Researcher1C_2").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_2').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_4").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_4').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_5").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_5').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_7").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_7').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_8").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_8').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_10").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_10').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_11").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_11').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_13").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_13').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_14").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_14').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_16").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_16').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_17").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_17').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_19").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_19').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_20").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_20').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_22").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_22').style.backgroundColor = '#ffdddd';
								return false;
							} 
			var	x = document.getElementById("Researcher1C_23").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1C_23').style.backgroundColor = '#ffdddd';
								return false;
							} 
			 
			var	x = document.getElementById("Researcher1D_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_1').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1D_2").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_2').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1D_3").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_3').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1D_4").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_4').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1D_5").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_5').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1D_6").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_6').style.backgroundColor = '#ffdddd';
								return false;
							} 
							/* var	x = document.getElementById("Researcher1D_7").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_7').style.backgroundColor = '#ffdddd';
								return false;
							}  */
							 var	x = document.getElementById("Researcher1D_8").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_8').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1D_9").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1D_9').style.backgroundColor = '#ffdddd';
								return false;
							} 
						 var	x = document.getElementById("Researcher1E_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1E_1').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1E_2").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1E_2').style.backgroundColor = '#ffdddd';
								return false;
							} 
							 var	x = document.getElementById("Researcher1E_4").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1E_4').style.backgroundColor = '#ffdddd';
								return false;
							} 
						 var	x = document.getElementById("Researcher1E_5").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1E_5').style.backgroundColor = '#ffdddd';
								return false;
							} 
					 		
				
				
				if(document.getElementById('Researcher1H_1').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher1H_1').style.backgroundColor = '#ffdddd';
				return false;	 }
			 			
				if(document.getElementById('Researcher1H_2').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher1H_2').style.backgroundColor = '#ffdddd';
				return false;	 }
			 	 		
				if(document.getElementById('Researcher1H_3').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher1H_3').style.backgroundColor = '#ffdddd';
				return false;	 }
			 			
				if(document.getElementById('Researcher1H_4').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher1H_4').style.backgroundColor = '#ffdddd';
				return false;	 }
			 		
				if(document.getElementById('Researcher1H_5').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher1H_5').style.backgroundColor = '#ffdddd';
				return false;	 }
			 			
				if(document.getElementById('Researcher1H_6').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher1H_6').style.backgroundColor = '#ffdddd';
				return false;	 }
			
			 
			  var	x = document.getElementById("Researcher1I_1").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1I_1').style.backgroundColor = '#ffdddd';
								return false;
							} 
			  var	x = document.getElementById("Researcher1I_3").value;
						  if (isNaN(x) || x < 0 || x > 999|| x=="" ) {
								alert("Please Provide valid input first  ! ");
								document.getElementById('Researcher1I_3').style.backgroundColor = '#ffdddd';
								return false;
							} 
							
				if(document.getElementById('Researcher2B_1').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2B_1').style.backgroundColor = '#ffdddd';
				return false;	 }	
				if(document.getElementById('Researcher2B_3').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2B_3').style.backgroundColor = '#ffdddd';
				return false;	 }			
								
				if(document.getElementById('Researcher2B_5').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2B_5').style.backgroundColor = '#ffdddd';
				return false;	 }			
								
				if(document.getElementById('Researcher2B_7').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2B_7').style.backgroundColor = '#ffdddd';
				return false;	 }			
								
				if(document.getElementById('Researcher2B_9').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2B_9').style.backgroundColor = '#ffdddd';
				return false;	 }			
								
				if(document.getElementById('Researcher2B_11').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2B_11').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 		 		
				if(document.getElementById('Researcher2Bb_1').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2Bb_1').style.backgroundColor = '#ffdddd';
				return false;	 }			
				  				
				if(document.getElementById('Researcher2Bb_2').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2Bb_2').style.backgroundColor = '#ffdddd';
				return false;	 }			
				  				
				if(document.getElementById('Researcher2Bb_3').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2Bb_3').style.backgroundColor = '#ffdddd';
				return false;	 }			
				  				
				if(document.getElementById('Researcher2Bb_4').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher2Bb_4').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 
				 /*
				 check4 = document.getElementById('ResearcherA_4').checked;
		
					if(check1 == false && check2 == false && check3 == false && check4 ==false ){
						alert("Please select at least one value for the feild ! ");
						document.getElementById('ResearcherA').style.backgroundColor = '#ffdddd';
						return false;	
					}
				*/
			
				if( document.getElementById('Researcher1F_1').checked==false && document.getElementById('Researcher1F_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk1').style.backgroundColor = '#ffdddd';
				return false;	 }
				
 				
				if(document.getElementById('Researcher1G_1').checked==false && document.getElementById('Researcher1G_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk2').style.backgroundColor = '#ffdddd';
				return false;	 }
				
				if(document.getElementById('Researcher2C_1').checked==false && document.getElementById('Researcher2C_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk3').style.backgroundColor = '#ffdddd';
				return false;	 }			
				   				
				if(document.getElementById('Researcher2D_1').checked==false && document.getElementById('Researcher2D_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk4').style.backgroundColor = '#ffdddd';
				return false;	 }			
				    				
				if(document.getElementById('Researcher2E_1').checked==false && document.getElementById('Researcher2E_1_1').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk5').style.backgroundColor = '#ffdddd';
				return false;	
				
				 }
				
				 if(document.getElementById('Researcher2E_3').checked==false && document.getElementById('Researcher2E_3_3').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk6').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 if(document.getElementById('Researcher2E_5').checked==false && document.getElementById('Researcher2E_5_5').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk7').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 if(document.getElementById('Researcher2E_7').checked==false && document.getElementById('Researcher2E_7_7').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk8').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 if(document.getElementById('Researcher2E_9').checked==false && document.getElementById('Researcher2E_9_9').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk9').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 if(document.getElementById('Researcher2E_11').checked==false && document.getElementById('Researcher2E_11_11').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk10').style.backgroundColor = '#ffdddd';
				return false;	 }
				
				 
				
				 if(document.getElementById('Researcher4A').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher4A').style.backgroundColor = '#ffdddd';
				return false;	 }			
				  if(document.getElementById('Researcher4B').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher4B').style.backgroundColor = '#ffdddd';
				return false;	 }			
				  if(document.getElementById('Researcher4C').value==""){
				alert("Please select value for the feild ! ");
				document.getElementById('Researcher4C').style.backgroundColor = '#ffdddd';
				return false;	 }	
				
				if(document.getElementById('Researcher4D').checked==false  && document.getElementById('Researcher4D_2').checked==false ){
				alert("Please select value for the feild ! ");
				document.getElementById('chk12').style.backgroundColor = '#ffdddd';
				return false;	 }			
				 
				 
			 
		}
		</script>
		
			<form   method="post" style="//margin-top:-1%;" onsubmit="return validate_Submit(); "  >
					 
					 
	
		<?php 
		form_step1($sess_userid,$dbo,$final);
		form_step2($sess_userid,$dbo,$final);
		form_step3($sess_userid,$dbo,$final);
		 
		?>
		
		 
				
				<b style="font-size:19px;">5. Would you like to be participate in similar surveys next year?  </b><b class="red">*</b> <br> 
				<div class="panel panel-default">
					<div class="panel-body" id="chk12">
						<input type="radio" style="width:auto;"   required="required"   id="Researcher4D" name="Researcher4D" value ="YES"  checked <?php $Q_title="Researcher4D";   $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="YES"){ echo"checked";} ?>> YES  &nbsp;
						<input type="radio"  style="width:auto;" required="required"  name="Researcher4D"  id="Researcher4D_2"  value ="NO"   <?php $Q_title="Researcher4D"; $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="NO"){ echo"checked";} ?>> NO 
					</div>
				</div>
			 
			<br>
  
					<div style="float:right;">
						<!-- <button type="submit" style="background-color:lightgray;"  name="Save_data_step1"  >Previous</button> -->
						<button type="submit"   name="final_Submit"  > Save the Update </button>
					</div>
			</form>
			
			 
				    <div style="text-align:center;margin-top:40px;">
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;' ></span>
										<span class="step" style='background-color:green;'  ></span>
										<span class="step" style='background-color:lightgreen;'  ></span>
										 
					</div> 
					
		<?php 
		 
	}
  ?>

  
<?php 
function get_currentdata_anx2($dbo,$Q_title,$sess_userid)
	{	 
		$SJHDKJ_FD="SELECT Q_details FROM survey_questions WHERE user_id='$sess_userid' AND Q_title='$Q_title' AND Annexure='2'";
			foreach($dbo->query($SJHDKJ_FD) AS $YTFG7)
			{
					return $A2rea1 = $YTFG7["Q_details"];
			}
	}
?>


 