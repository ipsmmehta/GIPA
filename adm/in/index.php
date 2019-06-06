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

 <?php  ob_start(); ?>
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
<!-- <script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script> 	 -->
<script src="//cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script> 	
<body>

 

<div id="regForm"   >

<div class="row">
  <div class="col-sm-6" align="left"> <!-- <a href="index.php" onclick="return confirm('This Button will take you to home page and can cause the loss of data you have entered in the form, It is recommended to complete the form and submit it, then go back, Are you sure you want to go back ?');" title="you may losse all of your data onclick " > <span class="label label-warning">Back</span> </a>  --></div>
  <div class="col-sm-6" align="right"> <a href="../logout.php" onclick="return confirm('Are you sure about Logout ?');" title="  Log-Out" > <span class="label label-danger">Logout</span> </a> </div>
 
</div>

<?php 
   
	$SQL_Sg="SELECT Admin_header FROM survey_data WHERE id ='1' ";
	foreach($dbo->query($SQL_Sg) AS $jhs5){
		echo $jhs5["Admin_header"];
	}
?>

		<div class="panel panel-default">
                <div class="panel-heading">
					<form name="sdf" method="post" >
						<input type="submit" name="Headerdata" value="Header Data " class="btn btn-default" style="width:auto;">
						<input type="submit" name="Annexure1" value="Institutional  Survey Data " class="btn btn-default" style="width:auto;" >
						<input type="submit" name="Annexure2" value=" Researcher Survey Data " class="btn btn-default" style="width:auto;" >
					</form>
				</div>

                <div class="panel-body">
				<?php
						if(isset($_POST["View_dataAnnexure_2"])){ 
						  $data = $_POST["View_dataAnnexure_2"];
							 // include('print_researcher.php');
							//fun_Annexure2($dbo);
							//preview_form_ANZ1_2 ($data,$dbo);
							echo "<h3>Researcher  Survey Data : </h3><hr>";
							 preview_Researcher_ANZ_2 ($data,$dbo);
						}
					?>
				<?php
						if(isset($_POST["View_data"])){ 
						   $data = $_POST["View_data"];
							 //include('print_institutional.php');
							 
							// preview_form_ANZ1 ($data,$dbo);
							echo "<h3>Institutional  Survey Data : </h3><hr>";
							 preview_INSTITUTIONAL_ANZ1 ($data,$dbo);
							 
							 /*
							header("Content-Type: application/vnd.ms-excel");
							header("Expires: 0");
							$date = date('Y-m-d-Hi');
							header("content-disposition: attachment;filename=Institutional_Survey_on$date.xls");
							 */
						}
					?>
					
					<?php 
					if(isset($_POST["consolidated_1"])){ 
						 //  $consolidated_1 = $_POST["consolidated_1"];
							 
							 preview_consolidated_1 ($dbo);
							 
							 /*
							 $SQl_sfj="SELECT user_id FROM survey_questions WHERE Annexure='1' GROUP BY user_id ";
							 foreach($dbo->query($SQl_sfj) AS $dfh5 ){
								 echo $user_id = $dfh5["user_id"]; 
								// echo"<br>";
								preview_consolidated_1_sOLUTIONS ($dbo,$user_id);
							 }
							 */ 
							header("Content-Type: application/vnd.ms-excel");
							header("Expires: 0");
							$date = date('Y-m-d-Hi');
							header("content-disposition: attachment;filename=Institutional_Survey_on$date.xls");
						}
						//if(isset)consolidated_1
				?>
			<?php 
					if(isset($_POST["consolidated_2_researcher"])){ 
						   preview_consolidated_Researcher ($dbo);
							 
							header("Content-Type: application/vnd.ms-excel");
							header("Expires: 0");
							$date = date('Y-m-d-Hi');
							header("content-disposition: attachment;filename=Researcher_Survey_on$date.xls");
						}
						//if(isset)consolidated_1
				?>

				
					 <form class="form-horizontal" method="POST"  >
                    <?php 
						if(empty($_GET)){
						}else{
						}
							if ($_SERVER['REQUEST_METHOD'] == 'POST') {
								// echo"no mr ";
							}	else{
								fun_Headerdata();
							}
							
						if(isset($_POST['Headerdata']))
						{
							fun_Headerdata();
						}
						if(isset($_POST['Annexure1']))
						{	echo "<h3>Institutional  Survey Data : </h3>";
							fun_Annexure1($dbo);
						}
						if(isset($_POST['Annexure2']))
						{
							echo "<h3> Researcher Survey Data : </h3>";
							fun_Annexure2($dbo);
						}
					
					?>					   
                       
                    </form>
					
					<?php 
						if(isset($_POST['Viewheader']))
						{	$data=NULL;
							 $header = $_POST["header"];
							 $SQL_Sg="SELECT $header FROM survey_data WHERE id ='1' ";
									foreach($dbo->query($SQL_Sg) AS $jhs5){
										$data = $jhs5["$header"];
									}
							 ?>
							 
							  <form class="form-horizontal" method="POST"  >
							  <input type="text" name="heade_name"  value="<?php echo $header; ?>"  hidden readonly style="display:none;">
									<h3> 
									<?php // if($header=="Annexure2") {echo "Researcher Header"; }else{ echo "Institutional Header"; }
											switch($header){
												case"Annexure2":
													echo "Researcher Header";
												break;
												case"Annexure1":
													echo "Institutional Header";
												break;
												case"Login_Institutional":
													echo "Institutional Log-in Page Header";
												break;
												case"Login_Researcher":
													echo " Researcher Log-in  Page Header ";
												break;
												case"Admin_header":
													echo "Admin Page Header";
												break;
											}
									?>
									<b style="color:red;">*</b></h3> <br> <div style="margin-left:2%;">
									
								<br><textarea name="task_remarks" required="required" Placeholder="Enter Remarks here " class="form-control" /><?php echo $data; ?></textarea>
										<script>	CKEDITOR.replace( 'task_remarks' );	</script> </div>
								</td>
								<center> <br>
								<input type="submit" style="width:20%;" name="Updateheader" value="Update" class="btn btn-warning" />
								</center>
							  </form>
							 <?php
						}
					?>
				
				
					
				
				</div>
		</div>
 
	
 
 <br>
<?php 
	
?>
 
<hr>
 
					<?php 
						if(isset($_POST['Updateheader']))
						{	//$data=NULL;
							 $heade_name = $_POST["heade_name"];
							 $task_remarks = $_POST["task_remarks"];
							 $SQHJGD_sdhf="UPDATE survey_data SET $heade_name='$task_remarks' WHERE id='1' ";
							 if($dbo->query($SQHJGD_sdhf))
							 {
								 echo"<script> alert(' Data updated Successfully'); </script>";
							 }else{
								  echo"<script> alert(' Error  while updation '); </script>";
							 }
						}
						?>
 
 
 <?php 
	function fun_Headerdata()
	{
		?>
			 <label> Select Header  </label>
			<div style="margin-left:2%;">  
				<select name="header" required="required" class="form-control">
					<option value="" >--Select Header--</option>
					<option value="Annexure2" >Researcher Page Header</option>
					<option value="Annexure1" >Institutional Page Header</option>
					<option value="Login_Institutional" > Institutional  Log-in  Page Header</option>
					<option value="Login_Researcher" > Researcher Log-in Page Header</option>
					<option value="Admin_header" >Admin Page Header</option>
				</select>
			 </div><br>
			 <center>
			 <input type="submit" style="width:20%;" name="Viewheader" value="View" class="btn btn-warning" />
			 </center>
		<?php 
	}
 ?> 
 <?php 
	function fun_Annexure1($dbo)
	{
		?> 
		
		<div align="right"> <input type="submit" name="consolidated_1" value="Consolidated View " style="width:auto;" class="btn btn-default" >  </div><br>
		<table class="table">
			<tr>
				<th> Sr.No. </th>
				<th> User </th>
				<th> Affiliation </th>
				<th> Date </th>
				<th> Action  </th>
			</tr>
			<?php  $Sgf=0;
				$dhg_df=" SELECT distinct user_id FROM survey_questions WHERE Annexure='1' ";
				foreach($dbo->query($dhg_df)AS $sry67){
					
					 $user_id = $sry67["user_id"];
					 $SQL_dsfj="SELECT created_at,updated_at,id,Affiliation,email,name FROM survey_user WHERE id='$user_id' ";
					 foreach($dbo->query($SQL_dsfj)AS $SDH5){
						$name = $SDH5["name"];
						$email = $SDH5["email"];
						$Affiliation = $SDH5["Affiliation"];
						$created_at = $SDH5["created_at"];
						$updated_at = $SDH5["updated_at"];
						$id = $SDH5["id"];
						$Sgf=$Sgf+1;
						?>
						<tr>
							<td> <?php echo $Sgf; ?> </td>
							<td> <?php echo $name; ?> <br><small style="color:lightgray"><?php echo $email; ?> </small></td>
							<td>  <?php echo $Affiliation; ?> </td>
							<td>  Last login on  <?php echo $updated_at; ?> <br><small style="color:lightgray">Registered on  <?php echo $created_at; ?> </small></td>
							<td> <Button type="submit" name="View_data" class="btn btn-warning" value="<?php echo $id; ?>" > View</Button> / <a target="_blank" href="print_institutional.php?print=<?php echo $id; ?>"  name="View_data" class="btn btn-warning"> Print </a>   </td>
							 
						</tr>
						<?php 
					 }
				}
			?>
		</table>
		<?php 
	}
 ?> 
 <?php 
	function fun_Annexure2($dbo)
	{
		?>
		<div align="right"> <input type="submit" name="consolidated_2_researcher" value="Consolidated View " style="width:auto;" class="btn btn-default" >  </div><br>
		<table class="table">
			<tr>
				<th> Sr.No. </th>
				<th> User </th>
				<th> Affiliation </th>
				<th> Date </th>
				<th> Action  </th>
			</tr>
			<?php  $Sgf=0;
				$dhg_df=" SELECT distinct user_id FROM survey_questions WHERE Annexure='2' ";
				foreach($dbo->query($dhg_df)AS $sry67){
					
					 $user_id = $sry67["user_id"];
					 $SQL_dsfj="SELECT created_at,updated_at,id,Affiliation,email,name FROM survey_user WHERE id='$user_id' ";
					 foreach($dbo->query($SQL_dsfj)AS $SDH5){
						$name = $SDH5["name"];
						$email = $SDH5["email"];
						$Affiliation = $SDH5["Affiliation"];
						$created_at = $SDH5["created_at"];
						$updated_at = $SDH5["updated_at"];
						$id = $SDH5["id"];
						$Sgf=$Sgf+1;
						?>
						<tr>
							<td> <?php echo $Sgf; ?> </td>
							<td> <?php echo $name; ?> <br><small style="color:lightgray"><?php echo $email; ?> </small></td>
							<td>  <?php echo $Affiliation; ?> </td>
							<td>  Last login on  <?php echo $updated_at; ?> <br><small style="color:lightgray">Registered on  <?php echo $created_at; ?> </small></td>
							<td> <Button type="submit" name="View_dataAnnexure_2" class="btn btn-warning" value="<?php echo $id; ?>" > View</Button> / <a target="_blank" href="print_researcher.php?print=<?php echo $id; ?>"  name="View_data" class="btn btn-warning"> Print </a>  </td>
							 
						</tr>
						<?php 
					 }
				}
			?>
		</table>
		<?php 
	}
 ?>
  

 
<footer class="container-fluid text-center">
  <p> This  form is Design and Developed by <a href="https://itra.medialabasia.in/" target="_blank" title="For any query contect, Avinash JWD (ITRA) " > ITRA</a> </p>
</footer>

</body>
</html>

<?php 
		function preview_consolidated_Researcher($dbo){
			?>
			
			  <style>
	table, td, th {    
							 border: 1px solid #ddd;
							text-align: center;
						}

						table {
							border-collapse: collapse;
							width: 79%;
						}

						th, td {
							padding: 7px;
						}
						
						.alignleft {
							float: left;
						}
						.alignright {
							float: right;
						}
	</style>  
			<table class="table table-striped"   >
						<tr >
						<th  > Name </th>
						<th > Designation </th>
						<th > Affiliation </th>
						<th > Email </th>
						<th > Telephone </th>
						<th > Place </th>
						<th > Date:   </th>
						
						
						 
						
						
						
						<th >  	
								2.	Area of research 
						<table >
								<tr><th > A.	What is your broad area of research?    </th>
								 
						<th >   Imparting Education / Knowledge </th>
						<th >   Remarks (if any) </th>
						<th >   Undertaking Basic Research  </th>
						<th >   Remarks (if any) </th>
						<th >   Undertaking Applied Research </th>
						<th >   Remarks (if any) </th>
						<th >   Research translation in terms of Publications  </th>
						<th >   Remarks (if any) </th>
						<th >   Research translation in terms of Intellectual Property Rights/Patents  </th>
						<th >   Remarks (if any) </th>
						<th >   Research translation in terms of Products/Services   	</th>
						<th >   Remarks (if any) </th>
						<th >   Others (please specify):   	</th>
						<th >   Remarks (if any) </th>
						</tr>
						</table> 
						</th>
						
						
						<th >  	
								C. Please mention the number of ICT&E R&D projects undertaken: 
							<table > 
								<tr>
									<th >  Internal Resources with focus on basic research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
									<th >  Internal Resources with focus on applied research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
								 
									<th >  Govt Funds/funding Agencies with focus on basic research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
									
								 	<th >  Govt Funds/funding Agencies with focus on applied research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
								 
								 	<th >  Industry funds with focus on basic research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
								 
								 	<th >  Industry funds with focus on applied research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
								 
								 	<th >  International funds with focus on basic research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
								 
								 	<th >  International funds with focus on applied research (Number of Single institution projects ) </th>
									<th >   Number of Joint (multi-institutional) projects </th>
									<th >   Remarks (eg. name of scheme or agency) </th>
								 
								</tr>
							</table> 
						</th>
						
						<th >   D.	Please mention numbers for various R&D output indicators: 	
						<table> 
							<tr>
							<th >   Publication (referred journals) </th>
							<th >   Patent Filed	 </th>
							<th >   Patent Granted	 </th>
							<th >   Copyright Obtained 	 </th>
							<th >   New products developed  </th>
							<th >   New processes developed </th>
							<th >   Transfer of Technologies  </th>
							<th >   Licensing  </th>
							<th >   Others (please specify) </th>
							</tr>
						</table> 
						</th>
						
						 
						<th >  	
								E. Please mention the number of new ICT&E Technology(s)/ Prototype(s)/ Startup(s)/ Service(s) developed which were intended for Indian/ Global markets: 
							<table> <tr>
								<td > Government  ( Indian market) </td>
								<td >  Government( Global market ) </td>
								<td >  Government [Remarks (eg. broad domain of type)] </td>
								<td >  Industry( Indian market) </td>
								<td >  Industry ( Global market) </td>
								<td >  Industry [Remarks (eg. broad domain of type)] </td>
								<th >   Others(pl specify):	 </th>
								<td >   Indian market </td>
								<td >   Global market </td>
								<td >  Remarks (eg. broad domain of type) </td>
								</tr>
							</table> 
						</th>
						
						<th> F. Has output of your past R&D carried out in ICT&E domain been used by Industry?  <th>
						<th>G.	Do you think that the ICT&E Technology(s)/ Prototype(s)/ Product(s)/ Service(s) developed by you have a potential for commercial/social translation? 
						<table> 
							<th >  Your choice </th>
							<th >  If yes, then how many </th>
							<th >  If yes, then their broad application area(s) </th>
						</table> 
						<th>
						
						<th > H.	Please rank the Basis/Need, on which the research problem/ project undertaken by your Institution/ University/ Organisation was ascertained/ proposed:
						<table> 
						
							<th >  Market survey  </th>
							<th >  Literature review </th>
							<th >  Intellectual Property Rights survey </th>
							<th >  Industry interactions</th>
							<th >  Social interactions </th>>
							<th >  Intuition   </th>
						</table> 
						</th>
						
						<th >  I.	How many schemes for translations of research into products/ services from Goverment of India and other souces are known: 
						<table> 
						
							<th >  Known and received funding( Numbers ) </th>
							<th >  Remarks (if any) </th>
							<th >  Known but not received funding( Numbers ) </th>
							<th >  Remarks (if any) </th>
							 
						</table> 
						</th>
						
						<th >  	
								3. Institutional Support: 
								<br>   A.	What in your opion is the major focus of your Institution/ University/ Organization 
						<table   > 
							<th >   Imparting Education / Knowledge </th>
							<th >   Remarks (if any) </th>
							<th >   Undertaking Basic Research  </th>
							<th >   Remarks (if any) </th>
							<th >   Undertaking Applied Research </th>
							<th >   Remarks (if any) </th>
							<th >   Research translation in terms of Publications  </th>
							<th >   Remarks (if any) </th>
							<th >   Research translation in terms of Intellectual Property Rights/Patents  </th>
							<th >   Remarks (if any) </th>
							<th >   Research translation in terms of Products/Services   	</th>
							<th >   Remarks (if any) </th>
							<th >   Others (please specify):   	</th>
							<th >   Remarks (if any) </th>
						</table> 
						</th>
						
						<th >  	B.	Does your institution's rules/policies/schemes support its researchers in undertaking the following activities: 
							<table> 
								<th >   R&D </th>
								<th >   Intellectual Property Rights filing </th>
								<th >   Publication	 </th>
								<th >   Research Translation in products/services/startups	 </th>
							</table> 
						</th>
						
						
							
						<th >  	C.	Are researchers (scientists and inventors) at your Institution/ University/ Organisation given any sort of incentive for successful research or obtaining patent or product development or Transfer of technology 
								<table> 
								<th >   Selection </th>
								<th >  Remarks on how the inventers are incentivized? (profit sharing/ awards/ etc.) OPTIONAL 	 </th>
							</table> 
						</th>
						
						<th >  	 D.	Has industry setup a research facility/laboratory in ICT&E domain at your institution
								<table> 
								<th >   Selection </th>
								<th >  If yes, please give details: 	 </th>
							</table> 
						</th>
						
						<th >  	
							  B.	Does your Institution/ University/ Organisation provide access of the following to its researchers? 
							<table> 
									<th >   Rapid prototyping facility (Hardware and/or Software) [ Is access provided to researchers?  ] </th>
									<th >   Location with reference to your institution (ignore if previous option is No) </th>
							
									<th >   Hardware and/or Software testing facility(s) [ Is access provided to researchers?  ] </th>
										<th >   Location with reference to your institution (ignore if previous option is No) </th>
									<th >   Standardization/ Certification Body(s)	 [ Is access provided to researchers?  ] </th>
										<th >   Location with reference to your institution (ignore if previous option is No) </th>
									<th >   Intellectual Property Rights office  [ Is access provided to researchers?  ] </th>
										<th >   Location with reference to your institution (ignore if previous option is No) </th>
									<th >   Technology Transfer Office [ Is access provided to researchers?  ] </th>
										<th >   Location with reference to your institution (ignore if previous option is No) </th>
									<th >   Platform for Industry Interactions [ Is access provided to researchers?  ] </th>
										<th >   Location with reference to your institution (ignore if previous option is No) </th>
									<th >  Other: </th>
							
							</table> 
						</th>
						
						 <th > 4.	Insight
							<table> 
						 
						
							<th >  A.	Based on some known successful examples of ICT&E R&D translation, what is your opinion/ suggestion that will boost translation of R&D into Technologies / Products/ Solutions /Startups having commercial/societal value:   </th>
							<th >  B.	Views on issues/ problem faced (if any) that hinders in translation of research into Technologies/ Products/ Services/ Start-ups having commercial/societal value:* </th>
							<th >  C.	Do you think there are factors/ barriers which are hampering Industry academia linkages and Transfer of Technologies? If yes, your views on the same:   </th>
						
							</table> 
						</th>
						 
						<th > 5. Would you like to be participate in similar surveys next year? </th>
						 
						</tr>
						
							<?php 		
					 $SQl_sfj="SELECT user_id FROM survey_questions WHERE Annexure='2' GROUP BY user_id ";
							 foreach($dbo->query($SQl_sfj) AS $dfh5 ){
								   $user_id = $dfh5["user_id"]; 
								 // echo"<br>";
								preview_Rsearch_sOLUTIONS ($dbo,$user_id);
							 }
							 
					 ?>
							
						</table>
						
			
			<?php 
		}
?>


<?php 
		function preview_Rsearch_sOLUTIONS ($dbo,$user_id){
			$sess_userid = $user_id ; 
			?>
			 	<tr>
						<td> 	<?php  $clmn="name"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="designation"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="Affiliation"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="email"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="Telephone"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="Place"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="updated_at"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						
						 
						
						 
						
						
						
						<td >  	 
						<table >
								<tr><td > <?php $Q_title="ResearcherA_1"; echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?><br>  
										  <?php $Q_title="ResearcherA_2"; echo $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?><br>
										  Others:<?php $Q_title="ResearcherA_4"; echo $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 										  
								</td>
								 
						<td >   <?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
						<td >  <?php $Q_title="ResearcherB_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  	 </td>
						<td >   <?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
						<td >   <?php $Q_title="ResearcherB_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
						<td >  	<?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </td>
						<td >   <?php $Q_title="ResearcherB_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
						<td >   <?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>   </td>
						<td >   <?php $Q_title="ResearcherB_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
						<td >   <?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>   </td>
						<td >  <?php $Q_title="ResearcherB_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
						<td >   <?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	</td>
						<td >   <?php $Q_title="ResearcherB_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  </td>
						<td >  Others :   <?php $Q_title="ResearcherB_13"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  <br> 
								<?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
								switch($GSBV){ 
								case "Can not say":  echo "Can't say"; break; 
								case "0-No focus": echo "0-No focus"; break;
								case "1": echo "1- Low Priority"; break;
								case "2": echo "2";  break;
								case "3": echo "3"; break;
								case "4": echo "4"; break;
								case "5":  echo "5 - High Priority"; break; }
							 ?> 
						</td>
						<td >   
						  <?php $Q_title="ResearcherB_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>
						 </td>
						</tr>
						</table> 
						</td>
						
						
						<td >  	
								 
							<table > 
								<tr>
		<td> 	 <?php $Q_title="Researcher1C_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
        <td> 	 <?php $Q_title="Researcher1C_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1C_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
		<td> 	 <?php $Q_title="Researcher1C_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
		<td> 	 <?php $Q_title="Researcher1C_7"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_8"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_9"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
		<td> 	<?php $Q_title="Researcher1C_10"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	<?php $Q_title="Researcher1C_11"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	<?php $Q_title="Researcher1C_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
		<td> 	 <?php $Q_title="Researcher1C_13"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1C_14"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1C_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
		<td> 	 <?php $Q_title="Researcher1C_16"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_17"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_18"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
		<td> 	 <?php $Q_title="Researcher1C_19"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_20"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_21"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
		<td> 	 <?php $Q_title="Researcher1C_22"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_23"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_24"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
									 
								</tr>
							</table> 
						</td>
						
						<td >  
						<table> 
							<tr>
							<td >   <?php $Q_title="Researcher1D_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
							<td >   <?php $Q_title="Researcher1D_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	 </td>
							<td >   <?php $Q_title="Researcher1D_3"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	 </td>
							<td >    <?php $Q_title="Researcher1D_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; }?> 	 </td>
							<td >   <?php $Q_title="Researcher1D_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>  </td>
							<td >   <?php $Q_title="Researcher1D_6"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
							<td >   <?php $Q_title="Researcher1D_8"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>  </td>
							<td >   <?php $Q_title="Researcher1D_9"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>  </td>
							<td >   Others : <?php $Q_title="Researcher1D_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> <br> 
										 <b>  <?php $Q_title="Researcher1D_11"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></b>
								</td>
							</tr>
						</table> 
						</td>
						
						 
						<td >  	
								  
							<table> <tr>
				<td> 	 <?php $Q_title="Researcher1E_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
				<td> 	 <?php $Q_title="Researcher1E_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
				<td> 	 <?php $Q_title="Researcher1E_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
				<td> 	 <?php $Q_title="Researcher1E_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
				<td> 	 <?php $Q_title="Researcher1E_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
				<td> 	 <?php $Q_title="Researcher1E_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
				<td>     <?php $Q_title="Researcher1E_7"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	 </td>
				<td> 	 <?php $Q_title="Researcher1E_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
				<td> 	 <?php $Q_title="Researcher1E_9"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
				<td> 	 <?php $Q_title="Researcher1E_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
								</tr>
							</table> 
						</td>
						
						<td>  <?php $Q_title="Researcher1F_1"; echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?>  <td>
						<td> 
						<table> 
							<td > <?php $Q_title="Researcher1G_1";  echo  $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?>  </td>
							<td > <?php $Q_title="Researcher1G_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></td>
							<td > <?php $Q_title="Researcher1G_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  </td>
						</table> 
						<td>
						
						<td >   
						<table> 
						
							<td > <?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
							<td ><?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
							<td >  <?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </td>
							<td >  <?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </td>
							<td > <?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
							<td > <?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>    </td>
						</table> 
						</td>
						
						<td >  
						<table> 
						
							<td >  <?php $Q_title="Researcher1I_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>  </td>
							<td >  <?php $Q_title="Researcher1I_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>   </td>
							<td >  <?php $Q_title="Researcher1I_3"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
							<td >  <?php $Q_title="Researcher1I_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
							 
						</table> 
						</td>
						
						<td >   
						<table   > 
							<td >   <?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
							<td >   <?php $Q_title="Researcher2B_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
							<td >   <?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>   </td>
							<td >  <?php $Q_title="Researcher2B_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></td>
							<td >  <?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
							<td >   <?php $Q_title="Researcher2B_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?></td>
							<td >   <?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>   </td>
							<td >  <?php $Q_title="Researcher2B_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
							<td >   <?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>   </td>
							<td >  <?php $Q_title="Researcher2B_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
							<td >   
					<?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  	</td>
							<td >   <?php $Q_title="Researcher2B_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
							<td >   Others : <?php $Q_title="Researcher2B_13"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> <br><b> <?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </b>   	</td>
							<td >    <?php $Q_title="Researcher2B_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  </td>
						</table> 
						</td>
						
						<td > <table> 
								<td >  <?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
								<td >    <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
								<td >   <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 </td>
								<td >  <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 </td>
							</table> 
						</td>
						
						
							
						<td >  <table> 
								<td >   <?php $Q_title="Researcher2C_1";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?>  </td>
								<td > <?php $Q_title="Researcher2C_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  	 </td>
							</table> 
						</td>
						
						<td >  	 <table> 
								<td >  <?php $Q_title="Researcher2D_1";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
								<td >  <?php $Q_title="Researcher2D_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	 </td>
							</table> 
						</td>
						
						<td >  	
							  
							<table> 
									<td >   <?php $Q_title="Researcher2E_1";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?>  </td>
									<td >   <?php $Q_title="Researcher2E_2";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
							
									<td >  <?php $Q_title="Researcher2E_3";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> </td>
										<td >   <?php $Q_title="Researcher2E_4";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
									<td >   <?php $Q_title="Researcher2E_5";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> </td>
										<td >  <?php $Q_title="Researcher2E_6";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
									<td >    <?php $Q_title="Researcher2E_7";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
										<td >  <?php $Q_title="Researcher2E_8";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> </td>
									<td >  <?php $Q_title="Researcher2E_9";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
										<td >   <?php $Q_title="Researcher2E_10";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
									<td >   <?php $Q_title="Researcher2E_11";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
										<td >  <?php $Q_title="Researcher2E_12";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?>  </td>
									<td >  <?php $Q_title="Researcher2E_other"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
							
							</table> 
						</td>
						
						 <td >  
							<table> 
						 
						
							<td >   <?php $Q_title="Researcher4A"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  </td>
							<td >   <?php $Q_title="Researcher4B"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>   </td>
							<td >   <?php $Q_title="Researcher4C"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>    </td>
						
							</table> 
						</td>
						 
						<td >  <?php $Q_title="Researcher4D";    $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="") { echo"NO";}else{ echo $Ifb; }   ?>  </td>
						 
						</tr>
						
							
						 
						
			
			<?php 
		}
?>

<?php 
		function preview_consolidated_1 ($dbo)
		{
			?>
			 
			  <style>
	table, td, th {    
							 border: 1px solid #ddd;
							text-align: center;
						}

						table {
							border-collapse: collapse;
							width: 79%;
						}

						th, td {
							padding: 7px;
						}
						
						.alignleft {
							float: left;
						}
						.alignright {
							float: right;
						}
	</style>  
			<table class="table table-striped"   >
						<tr >
						<th  > Name </th>
						<th > Designation </th>
						<th > Affiliation </th>
						<th > Email </th>
						<th > Telephone </th>
						<th > Place </th>
						<th > Date:   </th>
						
						<th >  	
								Please rank the major focus of your Institution/ University/ Organisation on the following: 
								<br>    Please rank in order of priority  &  Remarks (if any)
						 
						<table   > 
						 
						
						<th >   Imparting Education / Knowledge </th>
						<th >   Remarks (if any) </th>
						<th >   Undertaking Basic Research  </th>
						<th >   Remarks (if any) </th>
						<th >   Undertaking Applied Research </th>
						<th >   Remarks (if any) </th>
						<th >   Research translation in terms of Publications  </th>
						<th >   Remarks (if any) </th>
						<th >   Research translation in terms of Intellectual Property Rights/Patents  </th>
						<th >   Remarks (if any) </th>
						<th >   Research translation in terms of Products/Services   	</th>
						<th >   Remarks (if any) </th>
						<th >   Others (please specify):   	</th>
						<th >   Remarks (if any) </th>
						
						
						 
						</table> 
						</th>
						
						 
						
						<th >  	3.	Information on R&D Output: <br>
								A.	Please mention the number of ICT&E R&D projects undertaken by your Institution/ University/ Organization: 
								<br>    Please rank in order of priority  &  Remarks (if any)
						 
						<table> 
						 
						<th >   Internal Resources with focus on basic research <br> ( Number of Single institution projects  ) </th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >   Internal Resources with focus on applied research  ( Number of Single institution projects  )</th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >   Govt Funds/funding Agencies with focus on basic research ( Number of Single institution projects  ) </th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >   Govt Funds/funding Agencies with focus on applied research  ( Number of Single institution projects  )</th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >   Industry funds with focus on basic research		 ( Number of Single institution projects  ) </th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >   Industry funds with focus on applied research ( Number of Single institution projects  )</th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >  International funds with focus on basic research   ( Number of Single institution projects  ) </th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						<th >   International funds with focus on applied research  ( Number of Single institution projects  ) </th>
						<th >   Number of Joint (multi-institutional) projects </th>
						<th >   Remarks (eg. name of scheme or agency) </th>
						
						
						</table> 
						</th>
						
						 
						<th >  	
								B. Please mention the number of new ICT&E Technology(s)/ Prototype(s)/ Startup(s)/ Service(s) developed by your 
								<br>    Institution/ University/ Organisation intended for Indian/ Global markets: 
						 
						<table> 
						
						
						 
							<td > Government  ( Indian market) </td>
							<td >  Government( Global market ) </td>
							<td >  Government [Remarks (eg. broad domain of type)] </td>
						      
							<td >  Industry( Indian market) </td>
							<td >  Industry ( Global market) </td>
							<td >  Industry [Remarks (eg. broad domain of type)] </td>
						<th >   Others(pl specify):	 </th>
							<td >   Indian market </td>
							<td >   Global market </td>
							<td >  Remarks (eg. broad domain of type) </td>
						 
						</table> 
						</th>
						
						  
						<th >  	
								C.	Please mention number of various R&D output indicators for your Institution/ University/ Organisation in ICT&E domain: 
								
						<table> 
						
						 
						<th >   Publication (referred journals) </th>
							
						<th >   Patent Filed	 </th>
						<th >   Patent Granted	 </th>
						<th >   Copyright Obtained 	 </th>
						<th >   New products developed  </th>
						<th >   New processes developed </th>
						<th >   Transfer of Technologies  </th>
						<th >   Licensing  </th>
						<th >   Others (please specify) </th>
						</table> 
						</th>
						
						 
						  
						<th >  	
							4.	Institutional Support: 
								<br> A.	Does your institution's rules/ policies/ schemes support its researchers in undertaking the following activities :( please rank them in order of their priority)
						<table> 
						
						
						<th >   R&D </th>
						<th >   Intellectual Property Rights filing </th>
						<th >   Publication	 </th>
						<th >   Research Translation in products/services/startups	 </th>
						
						</table> 
						</th>
						
						   
						<th >  	
							  B.	Does your Institution/ University/ Organisation provide access of the following to its researchers? 
						<table> 
					
						
						<th >   Rapid prototyping facility (Hardware and/or Software) [ Is access provided to researchers?  ] </th>
								<th >   Location with reference to your institution (ignore if previous option is No) </th>
						
						<th >   Hardware and/or Software testing facility(s) [ Is access provided to researchers?  ] </th>
									<th >   Location with reference to your institution (ignore if previous option is No) </th>
						<th >   Standardization/ Certification Body(s)	 [ Is access provided to researchers?  ] </th>
									<th >   Location with reference to your institution (ignore if previous option is No) </th>
						<th >   Intellectual Property Rights office  [ Is access provided to researchers?  ] </th>
									<th >   Location with reference to your institution (ignore if previous option is No) </th>
						<th >   Technology Transfer Office [ Is access provided to researchers?  ] </th>
									<th >   Location with reference to your institution (ignore if previous option is No) </th>
						<th >   Platform for Industry Interactions [ Is access provided to researchers?  ] </th>
									<th >   Location with reference to your institution (ignore if previous option is No) </th>
						<th >  Other: </th>
						
						</table> 
						</th>
						
						 
						 	   
						<th >  	
							 C.	Are researchers (scientists and inventors) given any sort of incentive for successful research or product development? 
						<table> 
						
						
						<th >  Selection </th>
								<th >  Remarks on how the inventers are incentivized? (profit sharing/ awards/ etc.) OPTIONAL  </th>
						</table> 
						</th>
						
						 	 	   
						<th >  	D.	Who is the owner of the IP generated?
						<table> 
						<tr>
						
						<th >  Selection </th>
								<th >  Other please specify Optional ...  </th>
						</table> 
						</th>
						
						 
						  	 	   
						<th >   E.	Do you think that the ICT&E Technology(s)/ Prototype(s)/ Product(s)/ Service(s) developed by your Institution/ University/ Organisation has a potential for commercial/social translation?
						<table> 
						
						
							<th >  Your choice </th>
							<th >  If yes, then how many </th>
							<th >  If yes, then their broad application area(s) </th>
						</table> 
						</th>
						
						 <th >  F.	Has the institution developed any Technology/ Prototype/ Product/ Services jointly with Industry? 
						<table> 
						
						
							<th >  Your choice </th>
							<th >  If yes, then how many </th>
							<th >  If yes, then their broad application area(s) </th>
						</table> 
						</th>
						
						 	
						 <th > G.	Please rank the Basis/Need, on which the research problem/ project undertaken by your Institution/ University/ Organisation was ascertained/ proposed:
						<table> 
						
							<th >  Market survey  </th>
							<th > Literature review </th>
							<th >  Intellectual Property Rights survey </th>
							<th >  Industry interactions</th>
							<th >  Social interactions </th>>
							<th >  Intuition   </th>
						</table> 
						</th>
						
						  	
						 <th > 5.	Insight
							<table> 
						 
						
							<th >  A.	Based on some known successful examples of ICT&E R&D translation, what is your opinion/ suggestion that will boost translation of R&D into Technologies / Products/ Solutions /Startups having commercial/societal value:   </th>
							<th > B.	Views on issues/ problem faced (if any) that hinders in translation of research into Technologies/ Products/ Services/ Start-ups having commercial/societal value: </th>
							<th >  C.	Do you think there are factors/ barriers which are hampering Industry academia linkages and Transfer of Technologies? If yes, your views on the same: </th>
						
							</table> 
						</th>
						 
					 <th > 5. Would you like to be participate in similar surveys next year? </th>
						 
						</tr>
						
					<?php 		
					 $SQl_sfj="SELECT user_id FROM survey_questions WHERE Annexure='1' GROUP BY user_id ";
							 foreach($dbo->query($SQl_sfj) AS $dfh5 ){
								   $user_id = $dfh5["user_id"]; 
								// echo"<br>";
								preview_consolidated_1_sOLUTIONS ($dbo,$user_id);
							 }
							 
					 ?>
							 </table> 
					 <?php 
			
			
		}
?>

<?php 
	function User_details ($dbo,$user_id,$clmn){
		$sess_userid =$user_id;
		$SQL_HGDG="SELECT $clmn FROM survey_user WHERE id='$sess_userid'";
					foreach($dbo->query($SQL_HGDG) AS $HGF5)
					{
					return  $HGF5["$clmn"];
					}
	}
?>

<?php 
		function preview_consolidated_1_sOLUTIONS ($dbo,$user_id)
		{
				  $sess_userid =$user_id;
					
				?>
			 
			 
						<!--
						<tr>
						<th  > Name </th>
						<th > Designation </th>
						<th > Affiliation </th>
						<th > Email </th>
						<th > Telephone </th>
						<th > Place </th>
						<th > Date:   </th>  
			--> 
			<tr>
						<td> 	<?php  $clmn="name"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="designation"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="Affiliation"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="email"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="Telephone"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="Place"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						<td> 	<?php  $clmn="updated_at"; echo User_details ($dbo,$user_id,$clmn) ?>	</td> 
						
						<td >  	
								 
						 
						<table   > 
						 
						
						<td >   <?php $Q_title="Institute2_1";     $GSBV = get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>   </td>
						<td >    <?php $Q_title="Institute2_2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						 
						<td >   <?php $Q_title="Institute2_3";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>    </td>
						<td >   <?php $Q_title="Institute2_4"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						<td>   <?php $Q_title="Institute2_ar1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>   </td>
						<td >   <?php $Q_title="Institute2_ar2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						<td>   <?php $Q_title="Institute2_5";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>   </td>
						<td >   <?php $Q_title="Institute2_6"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						<td >   <?php $Q_title="Institute2_7";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>   </td>
						<td >   <?php $Q_title="Institute2_8"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						<td >  <?php $Q_title="Institute2_9";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>    	</td>
						<td>  <?php $Q_title="Institute2_10"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						<td>  Others (please specify): <?php $Q_title="Institute2_Others"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 
						<br>
						<?php $Q_title="Institute2_11";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>  </td>
						<td>  <?php $Q_title="Institute2_12"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						
						
						 
						</table> 
						</td>
						
						 
						
						<td >  
						 
						<table> 
						 
						
						<td >   <?php $Q_title="Institute3_1"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td >  	<?php $Q_title="Institute3_2"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td >   <?php $Q_title="Institute3_3"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>  </td>
						
						<td>    <?php $Q_title="Institute3_4"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?></td>
						<td >   <?php $Q_title="Institute3_5"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td >   <?php $Q_title="Institute3_6"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						
						<td >   <?php $Q_title="Institute3_7"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td >   <?php $Q_title="Institute3_8"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td >   <?php $Q_title="Institute3_9"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						
						 <td> 	 <?php $Q_title="Institute3_10"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						 <td> 	 <?php $Q_title="Institute3_11"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						 <td> 	 <?php $Q_title="Institute3_12"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						
        <td> 	 <?php $Q_title="Institute3_13"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_14"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_15"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						
        <td> 	 <?php $Q_title="Institute3_16"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Institute3_17"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Institute3_18"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
		
		<td> 	 <?php $Q_title="Institute3_19"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_20"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_21"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						
		<td> 	 <?php $Q_title="Institute3_22"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>  	</td>
        <td>     <?php $Q_title="Institute3_23"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_24"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						 
						</table> 
						</td>
						
						 
						<td >  	
								 
						 
						<table> 
						 
						
						 
						<td> 	<?php $Q_title="Institute3b_1";  $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_2"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_4"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_5"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_6"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_8"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						<th style="width:25%;"> Others(pl specify): <?php $Q_title="Institute3b_7"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </th>
						<td> 	 <?php $Q_title="Institute3b_9"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_10"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						<td> 	 <?php $Q_title="Institute3b_12"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
						 
						</table> 
						</td>
						
						  
						<td >  	
							 
						<table> 
						 
						
						<td> 	 <?php $Q_title="Institute3c_1"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_2"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_3"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_3"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_4"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_5"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_6"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
						<td> 	 <?php $Q_title="Institute3c_8"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td> 	 <?php $Q_title="Institute3c_9"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
						<td style="width:25%;">   <?php $Q_title="Institute3b_11"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						<td> 	 <?php $Q_title="Institute3c_10"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						</table> 
						</td>
						
						 
						  
						<td >  	
							 <table> 
						 
						
						<td >   <?php $Q_title="Institute4a_1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </td>
						<td >  <?php $Q_title="Institute4a_1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
						<td > <?php $Q_title="Institute4a_3";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
						<td >   <?php $Q_title="Institute4a_4";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 </td>
						
						</table> 
						</td>
						
						   
						<td >  	
							   
						<table> 
						 
						
						<td>  <?php $Q_title="Institute4b_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td> 
						<td>  <?php $Q_title="Institute4b_2";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
						
						<td>  <?php $Q_title="Institute4b_3";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>    </td>
						<td>  <?php $Q_title="Institute4b_4";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>   </td>
						
						<td>  <?php $Q_title="Institute4b_5";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>   </td>
						<td>  <?php $Q_title="Institute4b_6";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>   </td>
		 
						  
						<td>  <?php $Q_title="Institute4b_7";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
						<td>  <?php $Q_title="Institute4b_8";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>	
						
						<td>  <?php $Q_title="Institute4b_9";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>   </td>
						<td>  <?php $Q_title="Institute4b_10";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
		 
						<td>  <?php $Q_title="Institute4b_11";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
						<td>  <?php $Q_title="Institute4b_12";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
		 
						<td>   Others: <?php $Q_title="Institute4b_other"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 						
						</table> 
						</td>
						
						 
						 	   
						<td >  	
							 <table>  
						<td >  <?php $Q_title="Institute4C_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
								<td >   <?php $Q_title="Institute4C"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>  </td>
						</table> 
						</td>
						
						 	 	   
						<td >  
						<table>  
						<td >   <?php $Q_title="Institute4D_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>
								 <?php $Q_title="Institute4D_2";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
						</td>
						<td >  	<?php $Q_title="Institute4D"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						</table> 
						</td>
						
						 
						  	 	   
						<td >    
						<table> 
						    <td > <?php $Q_title="Institute4E_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  </td>
							<td >   <?php $Q_title="Institute4E_2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
							<td > <?php $Q_title="Institute4E"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						</table> 
						</td>
						
						 <td >  
						<table> 
						 
						
							<td > <?php $Q_title="Institute4F_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> </td>
							<td > <?php $Q_title="Institute4F_2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>  </td>
							<td > <?php $Q_title="Institute4F"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						</table> 
						</td>
						
						 	
						 <td >
						 <table> 
							<td ><?php $Q_title="Institute4G_1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>   </td>
							<td >  <?php $Q_title="Institute4G_2";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 </td>
							<td > <?php $Q_title="Institute4G_3";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 </td>
							<td >  <?php $Q_title="Institute4G_4";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </td>
							<td >  <?php $Q_title="Institute4G_5";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>  </td>
							<td >  <?php $Q_title="Institute4G_6";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?>    </td>
						</table> 
						</td>
						
						  	
						 <td >  
							<table> 
							<td >    <?php $Q_title="Institute5A"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>   </td>
							<td >    <?php $Q_title="Institute5B"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>  </td>
							<td >    <?php $Q_title="Institute5C"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
						
							</table> 
						</td>
						 
					 <td >  <?php $Q_title="Institute5D"; $dfg = get_exelDATA($dbo,$Q_title,$sess_userid); if($dfg=="") { echo "NO"; } else{ echo $dfg; } ?>  </td>
						</tr>

							<?PHP 
								
							?>
						 
			<?php 			
		}
?>

	 <?php
	function preview_INSTITUTIONAL_ANZ1 ($sess_userid,$dbo){
		?>
		
		<b style="font-size:19px;"> 1.	Basic Information: </b><br><br>
				<?php 
					$SQL_HGDG="SELECT * FROM survey_user WHERE id='$sess_userid'";
					foreach($dbo->query($SQL_HGDG) AS $HGF5)
					{
						$name = $HGF5["name"];
						$designation = $HGF5["designation"];
						$Affiliation = $HGF5["Affiliation"];
						$email = $HGF5["email"];
						$Telephone = $HGF5["Telephone"];
						$Place = $HGF5["Place"];
						$Place = $HGF5["Place"];
						$updated_at = $HGF5["updated_at"];
						?>
						<table class="table table-striped">
						<tr>
						<th style="width:25%;"> Name </th>
						<td> 	<?php   echo $name; ?>	</td> 
					   </tr><tr>
						<th style="width:25%;"> Designation </th>
						<td> 	<?php   echo $designation; ?>	</td> 
					   </tr><tr>
						<th style="width:25%;"> Affiliation </th>
						<td> 	<?php   echo $Affiliation; ?>	</td> 
					   </tr><tr>
						<th style="width:25%;"> Email </th>
						<td> 	<?php   echo $email; ?>	</td> 
					   </tr><tr>
						<th style="width:25%;"> Telephone </th>
						<td> 	<?php   echo $Telephone; ?>	</td> 
					   </tr><tr>
						<th style="width:25%;"> Place </th>
						<td> 	 <?php   echo $Place; ?>	</td> 
					   </tr>
				    </table> 
						<!-- <div align="right"> Date: <?php echo $updated_at; ?> </div> --> 
						<?php 
					}
					
				?>
						   
    <b style="font-size:19px;"> 2.	Please rank the major focus of your Institution/ University/ Organisation on the following:  </b><br><br>
		 
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Please rank in order of priority*	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Imparting Education / Knowledge </th>
        <td> 	  
						 <?php $Q_title="Institute2_1";     $GSBV = get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>  
					 
				<!-- <input type="text" required="required"    oninput="this.className = ''" value="<?php $Q_title="Institute2_1"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>" name="Institute2_1">	--> </td> 
        <td> 	
			  <?php $Q_title="Institute2_2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Undertaking Basic Research </th>
		
        <td> 	
		 <?php $Q_title="Institute2_3";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>  
						   <td> 	 <?php $Q_title="Institute2_4"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr> 
	  <tr>
        <td style="width:25%;"> Undertaking Applied Research</td>
		
        <td> 	
		 <?php $Q_title="Institute2_ar1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?>  
						   <td> 	 <?php $Q_title="Institute2_ar2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
	    <tr>
        <th style="width:25%;"> Research translation in terms of Publications </th>
        <td> 	<?php $Q_title="Institute2_5";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?> 
		  <td> 	<?php $Q_title="Institute2_6"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Intellectual Property Rights/Patents </th>
        <td> 	<?php $Q_title="Institute2_7";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?> 

	  <td> 	 <?php $Q_title="Institute2_8"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Products/Services </th>
        <td> 	<?php $Q_title="Institute2_9";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?> 	 
						 <td> 	<?php $Q_title="Institute2_10"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
	   <tr>
        <th style="width:25%;">   Others (please specify): <?php $Q_title="Institute2_Others"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>   </th>
        <td> 	<?php $Q_title="Institute2_11";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){
							case "Can not say":
								echo "Can't say";
							break;case "0-No focus":
								echo "0-No focus";
							break;case "1":
								echo "1- Low Priority";
							break;case "2":
								echo "2";
							break;case "3":
								echo "3";
							break;case "4":
								echo "4";
							break;case "5":
								echo "5 - High Priority";
							break;
						  }
						 ?> 
			 
		  <td> 	 <?php $Q_title="Institute2_12"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>
  
    </table> 
	<br>
   <b style="font-size:19px;"> 3.	Information on R&D Output:  </b><br> <br> 
	<b style="font-size:19px;"> A.	Please mention the number of ICT&E R&D projects undertaken by your Institution/ University/ Organization: 
 </b><br>
	<br>
  
   <table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Number of Single institution projects	</th>
        <th> 	Number of Joint (multi-institutional) projects  </th>
        <th> 	Remarks (eg. name of scheme or agency) </th>
	  
      <tr>
        <th style="width:25%;"> Internal Resources with focus on basic research </th>
        <td> 	 <?php $Q_title="Institute3_1"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_2"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_3"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Internal Resources with focus on basic research </th>
        <td> 	 <?php $Q_title="Institute3_4"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Institute3_5"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
        <td> 	 <?php $Q_title="Institute3_6"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Govt Funds/funding Agencies with focus on basic research </th>
        <td> 	 <?php $Q_title="Institute3_7"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_8"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_9"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Govt Funds/funding Agencies with focus on applied research  </th>
        <td> 	 <?php $Q_title="Institute3_10"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_11"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_12"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> Industry funds with focus on basic research </th>
        <td> 	 <?php $Q_title="Institute3_13"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_14"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_15"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Industry funds with focus on applied research </th>
        <td> 	 <?php $Q_title="Institute3_16"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Institute3_17"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Institute3_18"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> International funds with focus on basic research </th>
        <td> 	 <?php $Q_title="Institute3_19"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_20"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_21"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> International funds with focus on applied research  </th>
        <td> 	 <?php $Q_title="Institute3_22"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>  	</td>
        <td>     <?php $Q_title="Institute3_23"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3_24"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
 
  
    </table> 
	 
	<br>
	
	  <b style="font-size:19px;">  B. 	Please mention the number of new ICT&E Technology(s)/ Prototype(s)/ Startup(s)/ Service(s) developed by your Institution/ University/ Organisation intended for Indian/ Global markets: </b><br>
	Number of new technologies/prototypes/startups/services :</b><br><br>
 
	   <table class="table table-striped">
	   <tr>
        <th>   	</th>
        <th>  Indian market  	</th>
        <th> 	Global market</th>
        
        <th> 	Remarks (eg. broad domain of type) </th>
	 </tr>
	 
	  <tr>
        <th style="width:25%;"> Government </th>
        <td> 	<?php $Q_title="Institute3b_1";  $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3b_2"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        
        <td> 	 <?php $Q_title="Institute3b_4"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>  <tr>
        <th style="width:25%;"> Industry </th>
        <td> 	 <?php $Q_title="Institute3b_5"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Institute3b_6"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
     
        <td> 	 <?php $Q_title="Institute3b_8"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr><tr>
        <th style="width:25%;"> Others(pl specify): <?php $Q_title="Institute3b_7"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </th>
        <td> 	 <?php $Q_title="Institute3b_9"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
        <td> 	 <?php $Q_title="Institute3b_10"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
     
        <td> 	 <?php $Q_title="Institute3b_12"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	 
	</table> 
	<br>
  <b style="font-size:19px;"> C.	Please mention number of various R&D output indicators for your Institution/ University/ Organisation in ICT&E domain:  </b><br><br>
	   <table class="table table-striped">
	 <tr>
         
        <th> 	Output indicators  	</th>
        <th> 	Number (Remarks National/International) </th>
	  </tr>
      <tr>
        <th style="width:25%;">Publication (referred journals)</th>
        <td> 	 <?php $Q_title="Institute3c_1"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        </tr>
	   <tr>
        <th style="width:25%;"> Patent Filed </th>
        <td> 	 <?php $Q_title="Institute3c_2"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Patent Granted </th>
        <td> 	 <?php $Q_title="Institute3c_3"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr> <tr>
        <th style="width:25%;">Copyright Obtained</th>
        <td> 	 <?php $Q_title="Institute3c_4"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New products developed </th>
        <td> 	 <?php $Q_title="Institute3c_5"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New processes developed </th>
        <td> 	 <?php $Q_title="Institute3c_6"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	  <!--
	   <tr>
        <th style="width:25%;"> Design prototypes developed </th>
        <td> 	 <?php $Q_title="Institute3c_7";   get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
      </tr> -->
	  <tr>
        <th style="width:25%;"> Transfer of Technologies (ToT)</th>
        <td> 	 <?php $Q_title="Institute3c_8"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
      </tr> <tr>
        <th style="width:25%;"> Licensing</th>
        <td> 	 <?php $Q_title="Institute3c_9"; $DGMO = get_exelDATA($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
      </tr><tr>
        <th style="width:25%;"> Others (please specify):  <?php $Q_title="Institute3b_11"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </th>
        <td> 	 <?php $Q_title="Institute3c_10"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>
  
    </table> 
	<br>
			<br> 
	<b style="font-size:19px;"> 4.	Institutional Support: </b><br><br>
			 
		 <b style="font-size:19px;">A.	Does your institution's rules/ policies/ schemes support its researchers in undertaking the following activities (please rank them in order of their priority):</b><br><br>
		
		 <table class="table table-striped">
      <tr>
        <th style="width:25%;"> R&D </th>
        <td> 	
		<?php $Q_title="Institute4a_1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </tr>
	   <tr>
        <th style="width:25%;"> Intellectual Property Rights filing </th>
        <td> 	
		<?php $Q_title="Institute4a_1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </tr>
	   <tr>
        <th style="width:25%;"> Publication </th>
        <td> <?php $Q_title="Institute4a_3";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				 </tr> <tr>
        <th style="width:25%;"> Research Translation in products/services/startups </th>
        <td> 	<?php $Q_title="Institute4a_4";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
			</tr>
	   
    </table>
	  
   <br>
   <b style="font-size:19px;"> B.	Does your Institution/ University/ Organisation provide access of the following to its researchers?  </b> <br>
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Is access provided to researchers?  	</th>
        <th> 	Location with reference to your institution (ignore if previous option is No)</th>
	  
      <tr>
        <th style="width:25%;"> Rapid prototyping facility (Hardware and/or Software) </th>
        <td> 	  <?php $Q_title="Institute4b_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
				 
		</td> 
        <td> 	 <?php $Q_title="Institute4b_2";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Hardware and/or Software testing facility(s)</th>
         <td> 	<?php $Q_title="Institute4b_3";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		  </td>
        <td> 	<?php $Q_title="Institute4b_4";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		 </td></tr>
	   <tr>
        <th style="width:25%;"> Standardization/ Certification Body(s) </th>
          <td> 
			<?php $Q_title="Institute4b_5";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		  </td>
        <td> 		<?php $Q_title="Institute4b_6";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		 </td></tr> <tr>
        <th style="width:25%;"> Intellectual Property Rights office </th>
         <td> 	
		 <?php $Q_title="Institute4b_7";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		 </td>
        <td> 	<?php $Q_title="Institute4b_8";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		 	</td> </tr>
	  <tr>
        <th style="width:25%;"> Technology Transfer Office (TTO) </th>
          <td> 	
			<?php $Q_title="Institute4b_9";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		 </td>
        <td> 	
			<?php $Q_title="Institute4b_10";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
				 </td> </tr>
	  <tr>
        <th style="width:25%;"> Platform for Industry Interactions </th>
         <td> 	
			<?php $Q_title="Institute4b_11";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
		  </td>
        <td> 	
			<?php $Q_title="Institute4b_12";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?> 
				 </td> </tr>
	  
  
    </table> 
		<table class="table table-striped">
	<tr>
	<td  >   Others: <?php $Q_title="Institute4b_other"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 
	</td>
	</tr>
	 </table> 
		<br>
		
	    <b style="font-size:19px;"> C.	Are researchers (scientists and inventors) given any sort of incentive for successful research or product development?   </b><br><br>
	 		<?php $Q_title="Institute4C_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  <br>
			
		 <div style="margin-left:1%;"> <?php $Q_title="Institute4C"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> </div> <br><br>
	     
		 <b style="font-size:19px;">  D.Who is the owner of the IP generated? </b><br><br>
			<?php $Q_title="Institute4D_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  <br>
			<?php $Q_title="Institute4D_2";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  <br>
			
			  <br> <label>Other:</label><div style="margin-left:1%;"> 
			 <?php $Q_title="Institute4D"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> <br><br>
			</div>
		 <b style="font-size:19px;">E. 	Do you think that the ICT&E Technology(s)/ Prototype(s)/ Product(s)/ Service(s) developed by your Institution/ University/ Organisation has a potential for commercial/social translation? </b><br><br>
			<label>(a). Your choice :</label><br> <div style="margin-left:1%;"> 
				<?php $Q_title="Institute4E_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  <br>
			 </div> 
			<br> <label> (b). If yes, then how many: </label><br> <div style="margin-left:1%;"> 
					 <?php $Q_title="Institute4E_2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 
			</div>
			
			<br> <label> (C).  If yes, then their broad application area(s): </label><br> <div style="margin-left:1%;"> 
			
			 <?php $Q_title="Institute4E"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?><br><br>
			</div> 
		 <b style="font-size:19px;"> Has the institution developed any Technology/ Prototype/ Product/ Services jointly with Industry?  </b><br><br>
			<label>(a). Your choice :</label><br> <div style="margin-left:1%;"> 
				<?php $Q_title="Institute4F_1";  echo $Ifb = get_exelDATA($dbo,$Q_title,$sess_userid);  ?>  <br>
			 </div> 
			<br> <label> (b). If yes, then how many: </label><br> <div style="margin-left:1%;"> 
					 <?php $Q_title="Institute4F_2"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> 
			</div>
			
			<br> <label> (C). If yes, then their broad application area(s): </label><br> <div style="margin-left:1%;"> 
			
				 <?php $Q_title="Institute4F"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> <br><br>
			</div> 
		  <br> 
		
		<b style="font-size:19px;"> G.	Please rank the Basis/Need, on which the research problem/ project undertaken by your Institution/ University/ Organisation was ascertained/ proposed:   </b><br><br>
			<table class="table table-striped">
			  
			 <tr>
				<th style="width:25%;">  Market survey </th>
				<td> 	<?php $Q_title="Institute4G_1";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Literature review </th>
				<td> <?php $Q_title="Institute4G_2";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intellectual Property Rights survey </th>
				<td> <?php $Q_title="Institute4G_3";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Industry interactions</th>
				<td> <?php $Q_title="Institute4G_4";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Social interactions </th>
				<td> <?php $Q_title="Institute4G_5";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intuition  </th>
				<td> <?php $Q_title="Institute4G_6";   $GSBV= get_exelDATA($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 	 
				</td>
			 </tr>
			 </table><br>
			 
			 <b style="font-size:19px;">5.	Insight</b><br><br>
				<b style="font-size:19px;"> A.	Based on some known successful examples of ICT&E R&D translation, what is your opinion/ suggestion that will boost translation of R&D into Technologies / Products/ Solutions /Startups having commercial/societal value:  </b><br>
				 <?php $Q_title="Institute5A"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> <br><br>
				<b style="font-size:19px;">	B.	Views on issues/ problem faced (if any) that hinders in translation of research into Technologies/ Products/ Services/ Start-ups having commercial/societal value:</b><br>
				 <?php $Q_title="Institute5B"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> <br><br>
				<b style="font-size:19px;"> C.	Do you think there are factors/ barriers which are hampering Industry academia linkages and Transfer of Technologies? If yes, your views on the same: </b><br><br>
				 <?php $Q_title="Institute5C"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> <br>
				
				<br><b style="font-size:19px;">6. Would you like to be participate in similar surveys next year?   </b><br><br>
				 <?php $Q_title="Institute5D"; echo get_exelDATA($dbo,$Q_title,$sess_userid); ?> <br>
			 
			<br> <br>
		<?php 
	}
 ?>

	<?php 
function get_exelDATA($dbo,$Q_title,$sess_userid)
	{	 
		// echo $sess_userid;
		$SJHDKJ_FD="SELECT Q_details FROM survey_questions WHERE user_id='$sess_userid' AND Q_title='$Q_title' AND Annexure='1'";
			foreach($dbo->query($SJHDKJ_FD) AS $YTFG7)
			{
					return $A2rea1 = $YTFG7["Q_details"];
			}
	}
?>
 
 
	 <?php
	function preview_Researcher_ANZ_2 ($sess_userid,$dbo){
		?>
		
		<b style="font-size:19px;"> 1.	Basic Information: </b><br><br>
				<?php 
					$SQL_HGDG="SELECT * FROM survey_user WHERE id='$sess_userid'";
					foreach($dbo->query($SQL_HGDG) AS $HGF5)
					{
						$name = $HGF5["name"];
						$designation = $HGF5["designation"];
						$Affiliation = $HGF5["Affiliation"];
						$email = $HGF5["email"];
						$Telephone = $HGF5["Telephone"];
						$Place = $HGF5["Place"];
						$Place = $HGF5["Place"];
						$updated_at = $HGF5["updated_at"];
						?>
						<table class="table table-striped">
						<tr>
						<td style="width:25%;"> Name </td>
						<td> 	<?php   echo $name; ?>	</td> 
					   </tr><tr>
						<td style="width:25%;"> Designation </td>
						<td> 	<?php   echo $designation; ?>	</td> 
					   </tr><tr>
						<td style="width:25%;"> Affiliation </td>
						<td> 	<?php   echo $Affiliation; ?>	</td> 
					   </tr><tr>
						<td style="width:25%;"> Email </td>
						<td> 	<?php   echo $email; ?>	</td> 
					   </tr><tr>
						<td style="width:25%;"> Telephone </td>
						<td> 	<?php   echo $Telephone; ?>	</td> 
					   </tr><tr>
						<td style="width:25%;"> Place </td>
						<td> 	 <?php   echo $Place; ?>	</td> 
					   </tr>
				    </table> 
						<!--  <div align="right"> Date: <?php echo $updated_at; ?> </div>--> 
						<?php 
					}
					
				?>
				
				  <b style="font-size:19px;"> 2.	Area of research </b><br><br>
	
		 <b style="font-size:19px;"> A.	What is your broad area of research? </b><br> <br> 
		 
		  
		<div style="margin-left:2%;" class="panel panel-default" id="ResearcherA" > 
			<div class="panel-body">
			 <div class="row"  >
				<div class="col-sm-3">
					<input type="checkbox"  style="width:auto;" id="ResearcherA_1"  name="ResearcherA_1" value ="ICT"  <?php $Q_title="ResearcherA_1"; $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="ICT"){ echo"checked";} ?>> ICT <br> 
					<input type="checkbox"  style="width:auto;" id="ResearcherA_2"  name="ResearcherA_2" value ="Electronics"  <?php $Q_title="ResearcherA_2"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Electronics"){ echo"checked";} ?>> Electronics   &nbsp;  
				
					</div>
				
				<div class="col-sm-9">
				  
					  <input type="checkbox"  style="width:auto;" id="ResearcherA_3"  name="ResearcherA_3" value ="Others" <?php $Q_title="ResearcherA_3"; $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($Ifb=="Others"){ echo"checked";} ?> > Other: 
					 
					  <?php $Q_title="ResearcherA_4"; echo $Ifb =  get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 
					 
				 
					
					</div>
			</div>
		</div>
		</div>
	
	<b style="font-size:19px;">B. Please rank your focus on the following categories:  </b><br> <br> 		
			
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Priority  	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Imparting Education / Knowledge </th>
        <td> 		 
					<?php $Q_title="ResearcherB_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				  </td> 
        <td> 	
			  <?php $Q_title="ResearcherB_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Basic Research </th>
        <td> 	  
					<?php $Q_title="ResearcherB_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
					</td>
        <td> 	 <?php $Q_title="ResearcherB_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Applied Research </th>
        <td> 	 
					<?php $Q_title="ResearcherB_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
					</td>
        <td> 	 <?php $Q_title="ResearcherB_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	    <tr>
        <th style="width:25%;"> Research translation in terms of Publications </th>
        <td> 	 
					<?php $Q_title="ResearcherB_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </td>
        <td> 	 <?php $Q_title="ResearcherB_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Intellectual Property Rights/Patents </th>
        <td> 		 
					<?php $Q_title="ResearcherB_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </td>
        <td> 	 <?php $Q_title="ResearcherB_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Products/Services </th>
        <td> 		 
					<?php $Q_title="ResearcherB_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </td>
        <td> 	 <?php $Q_title="ResearcherB_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	   <tr>
        <td> Others :   <?php $Q_title="ResearcherB_13"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>   </td>
        <td> 
			 
					<?php $Q_title="ResearcherB_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		  </td>
        <td> 	 <?php $Q_title="ResearcherB_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>
  
    </table> 
	 
   <b style="font-size:19px;">C. Please mention the number of ICT&E R&D projects undertaken:   </b><br> <br> 
		
		  <table class="table table-striped">
	 <tr>
        <th style="width:25%;"> Using <span class="caret"></span>  </th>
        <th> 	Number of Single institution projects	 </th>
        <th> 	Number of Joint (multi-institutional) projects  </th>
        <th  style="width:35%;" > 	Remarks (eg. name of scheme or agency) </th>
	  
      <tr>
        <th style="width:25%;"> Internal Resources with focus on basic research </th>
        <td> 	 <?php $Q_title="Researcher1C_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
        <td> 	 <?php $Q_title="Researcher1C_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1C_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Internal Resources with focus on applied research  </th>
        <td> 	 <?php $Q_title="Researcher1C_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;">  Govt Funds/funding Agencies with focus on basic research </th>
        <td> 	 <?php $Q_title="Researcher1C_7"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_8"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_9"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Govt Funds/funding Agencies with focus on applied research </th>
        <td> 	<?php $Q_title="Researcher1C_10"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	<?php $Q_title="Researcher1C_11"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	<?php $Q_title="Researcher1C_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> Industry funds with focus on basic research </th>
        <td> 	 <?php $Q_title="Researcher1C_13"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1C_14"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1C_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> Industry funds with focus on applied research </th>
        <td> 	 <?php $Q_title="Researcher1C_16"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_17"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_18"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
 
	   <tr>
        <th style="width:25%;"> International funds with focus on basic research </th>
        <td> 	 <?php $Q_title="Researcher1C_19"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_20"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_21"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>  
	  <tr>
        <th style="width:25%;"> International funds with focus on applied research  </th>
        <td> 	 <?php $Q_title="Researcher1C_22"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_23"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        <td> 	 <?php $Q_title="Researcher1C_24"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
 
  
    </table> 
	<b style="font-size:19px;">D.	Please mention numbers for various R&D output indicators:  </b><br> <br> 
	
	<table class="table table-striped">
	 <tr>
         
        <th> 	Output indicators	</th>
       <th> 	Number (Remarks National/International)   </th>
	  </tr>
      <tr>
        <th style="width:25%;">Publication (referred journals)  </th>
        <td> 	 <?php $Q_title="Researcher1D_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
        </tr>
	   <tr>
        <th style="width:25%;"> Patent Filed </th>
        <td> 	 <?php $Q_title="Researcher1D_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Patent Granted </th>
        <td> 	 <?php $Q_title="Researcher1D_3"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr> <tr>
        <th style="width:25%;">Copyright Obtained</th>
        <td> 	 <?php $Q_title="Researcher1D_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; }?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New products developed </th>
        <td> 	 <?php $Q_title="Researcher1D_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> New processes developed </th>
        <td> 	 <?php $Q_title="Researcher1D_6"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
      </tr>
	  <!-- 
	   <tr>
        <th style="width:25%;"> Design prototypes developed </th>
        <td> 	 <?php $Q_title="Researcher1D_7"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
      </tr> --> <tr>
        <th style="width:25%;"> Transfer of Technologies  </th>
        <td> 	 <?php $Q_title="Researcher1D_8"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
      </tr> <tr>
        <th style="width:25%;"> Licensing</th>
        <td> 	 <?php $Q_title="Researcher1D_9"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> </td>
      </tr><tr>
		<td style="width:25%;">   Others : <?php $Q_title="Researcher1D_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  </td>
        <td> 	 <?php $Q_title="Researcher1D_11"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>
  
    </table> 
   
   <b style="font-size:19px;">E. Please mention the number of new ICT&E Technology(s)/ Prototype(s)/ Startup(s)/ Service(s) developed which were intended for Indian/ Global markets:  </b><br> <br> 
   
     <table class="table table-striped">
	  <tr>
        <th>   	</th>
        <th>  Indian market    	</th>
        <th>  Global market    </th>
        <th>  Remarks (eg. broad domain of type) </th>
	  </tr>
	 
	  <tr>
        <th style="width:25%;"> Government </th>
        <td> 	 <?php $Q_title="Researcher1E_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1E_2"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
		<td> 	 <?php $Q_title="Researcher1E_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>  <tr>
        <th style="width:25%;"> Industry </th>
        <td> 	 <?php $Q_title="Researcher1E_4"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1E_5"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?>	</td>
        <td> 	 <?php $Q_title="Researcher1E_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr><tr>
	   <td style="width:25%;">  Others :    <?php $Q_title="Researcher1E_7"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>   </td>
       <td> 	 <?php $Q_title="Researcher1E_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
        <td> 	 <?php $Q_title="Researcher1E_9"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
       <td> 	 <?php $Q_title="Researcher1E_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>	</td>
      </tr>
	 
	</table> 
	
	 <b style="font-size:19px;">F. Has  output of your past R&D carried out in ICT&E domain been used by Industry? </b><br> <br> 
		<div class="panel panel-default">
		  <div class="panel-body">
		   
			 <?php $Q_title="Researcher1F_1"; echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 
			 
		  </div>
		</div>
		
		
	 <br> <b style="font-size:19px;">G.	Do you think that the ICT&E Technology(s)/ Prototype(s)/ Product(s)/ Service(s) developed by you have a potential for commercial/social translation?    </b><br> <br> 	
		
		<div class="panel panel-default">
		  <div class="panel-body">
		  
		 
		 
		 
			  <div class="col-sm-2">
				<label>(a). Your choice:</label> <br>
				  <?php $Q_title="Researcher1G_1";  echo  $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 				 
			  </div>
			  <div class="col-sm-3">
			  <label> (b). If yes, then how many: </label> <br>
					 <?php $Q_title="Researcher1G_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 
			 
			  </div>
			<div class="col-sm-7">
				  <label> (c).  If yes, then their broad application area(s): </label>  <br>
			
					<?php $Q_title="Researcher1G_3"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 
			 
			  </div>
		</div> </div>
		
		<br><b style="font-size:19px;"> H.	Please rank the Basis/Need, on which your research problems/ projects were ascertained/ proposed: </b><br><br>
			<table class="table table-striped">
				<tr>
					<th></th>
					<th>Rank the relevant cells   </th>
				</tr>
			  
			 <tr>
				<th style="width:25%;">  Market survey  </th>
				<td> 	 
				<?php $Q_title="Researcher1H_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Literature review  </th>
				<td> 	 
				<?php $Q_title="Researcher1H_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intellectual Property Rights survey   </th>
				<td>  
				<?php $Q_title="Researcher1H_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Industry interactions  </th>
				<td> 	 
				<?php $Q_title="Researcher1H_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Social interactions   </th>
				<td> 	 
				<?php $Q_title="Researcher1H_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				</td>
			 </tr> <tr>
				<th style="width:25%;">  Intuition  </th>
				<td> 	 
				<?php $Q_title="Researcher1H_6";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				</td>
			 </tr>
			 </table>
		<br><b style="font-size:19px;"> I.	How many schemes for translations of research into products/ services from Goverment of India and other souces are known:   </b><br><br>
					
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Numbers  	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Known and received funding: </th>
        <td> 	 <?php $Q_title="Researcher1I_1"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
          </td> 
        <td> 	
			  <?php $Q_title="Researcher1I_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Known but not received funding </th>
        <td>  <?php $Q_title="Researcher1I_3"; $DGMO = get_currentdata_anx2($dbo,$Q_title,$sess_userid); if($DGMO ==""){ echo "0";}else{ echo $DGMO; } ?> 	</td>
         </td>
        <td> 	 <?php $Q_title="Researcher1I_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	  </table>
			<br> 
					
							 
	 	<b style="font-size:19px;"> 3. Institutional Support: </b><br> <br> 
	<b style="font-size:19px;"> A.	What in your opion is the major focus of your Institution/ University/ Organization </b><br>
	<br>
	 		
	<table class="table table-striped">
	 <tr>
        <th style="width:25%;">  </th>
        <th> 	Priority  	</th>
        <th> 	Remarks (if any) </th>
	  
      <tr>
        <th style="width:25%;"> Imparting Education / Knowledge </th>
        <td> 		 
					<?php $Q_title="Researcher2B_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
				  </td> 
        <td> 	
			  <?php $Q_title="Researcher2B_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Basic Research </th>
        <td> 	 
					 
					<?php $Q_title="Researcher2B_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
					</td>
        <td> 	 <?php $Q_title="Researcher2B_4"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	   <tr>
        <th style="width:25%;"> Undertaking Applied Research </th>
        <td> 	 
					 
					<?php $Q_title="Researcher2B_5";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> </td>
        <td> 	 <?php $Q_title="Researcher2B_6"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  
	    <tr>
        <th style="width:25%;"> Research translation in terms of Publications </th>
        <td> 	 
					<?php $Q_title="Researcher2B_7";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </td>
        <td> 	 <?php $Q_title="Researcher2B_8"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Intellectual Property Rights/Patents </th>
        <td> 	 
					<?php $Q_title="Researcher2B_9";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </td>
        <td> 	 <?php $Q_title="Researcher2B_10"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	  <tr>
        <th style="width:25%;"> Research translation in terms of Products/Services </th>
        <td> 		 
					<?php $Q_title="Researcher2B_11";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 </td>
        <td> 	 <?php $Q_title="Researcher2B_12"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 	</td>
      </tr>
	   <tr>
        <td style="width:25%;">   Others : <?php $Q_title="Researcher2B_13"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>  </td>
        <td> 
			 
					<?php $Q_title="Researcher2B_14";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		  </td>
        <td> 	 <?php $Q_title="Researcher2B_15"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> </td>
      </tr>
  
    </table> 
    
	 
	<br>
	
	
	  <b style="font-size:19px;">  B.	Does your institution's rules/policies/schemes support its researchers in undertaking the following activities: </b><br>
		
		 <table class="table table-striped">
		  
		  <tr>
		   <th style="width:25%;">   </th>	
		   <th >  please rank them in order of their priority   </th>	
		  </tr>
		 
      <tr>
        <th style="width:29%;"> R&D   </th>
        <td> 	 
				<?php $Q_title="Researcher2Bb_1";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 	</td>
      </tr>
	   <tr>
        <th  > Intellectual Property Rights filing  </th>
        <td> 	 <?php $Q_title="Researcher2Bb_2";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
	 	</td>
      </tr>
	   <tr>
        <th > Publication  </th>
        <td> 
				 <?php $Q_title="Researcher2Bb_3";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		  </td>
      </tr> <tr>
        <th  > Research Translation in products/services/startups  </th>
        <td> 	 <?php $Q_title="Researcher2Bb_4";   $GSBV= get_currentdata_anx2($dbo,$Q_title,$sess_userid); 
							switch($GSBV){ 
							case "Can not say":  echo "Can't say"; break; 
							case "0-No focus": echo "0-No focus"; break;
							case "1": echo "1- Low Priority"; break;
							case "2": echo "2";  break;
							case "3": echo "3"; break;
							case "4": echo "4"; break;
							case "5":  echo "5 - High Priority"; break; }
						 ?> 
		 	</td>
      </tr>
	   
    </table>
  
	<br>
	
	  <b style="font-size:19px;">  C.	Are researchers (scientists and inventors) at your Institution/ University/ Organisation  given any sort of incentive for successful research or obtaining patent or product development or Transfer of technology </b> <br><br>
	 		<div class="panel panel-default">
			  <div class="panel-body">
			 
			  <div class="col-sm-2">
				 <?php $Q_title="Researcher2C_1";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 
				 
			  </div>
			  <div class="col-sm-10">
				 <?php $Q_title="Researcher2C_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 
	     
			  </div>
				 </div>
			</div>
			 
			<br>
			
	  <b style="font-size:19px;">  D.	Has industry setup a research  facility/laboratory in ICT&E domain at your institution   </b> <br><br>
	 		 <div class="panel panel-default">
  <div class="panel-body">  

			  <div class="col-sm-2">
				 <?php $Q_title="Researcher2D_1";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
				 
			  </div>
			  <div class="col-sm-10"> If yes, please give details:
				 <?php $Q_title="Researcher2D_2"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> 
	     
			  </div>
			  </div>
				
			</div><br>
		<b style="font-size:19px;"> E.	Does your Institution/ University/ Organisation provide access of the following to its researchers? </b> <br>
	<table class="table table-striped">
	 <tr>
        <th style="width:50%;">  </th>
        <th > 	Is access provided to researchers? 	  </th>
        <th style="text-align:center;"> 	Location with reference to your   institution (ignore if previous option is No)</th>
	  
      <tr>
        <th style="width:25%;"> Rapid prototyping facility (Hardware and/or Software) </th>
        <td> 	  <?php $Q_title="Researcher2E_1";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 
				 </td> 
        <td style="text-align:center;" > 	
				  <?php $Q_title="Researcher2E_2";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
		 	</td>
      </tr>
	   <tr>
        <th style="width:25%;"> Hardware and/or Software testing facility(s) </th>
         <td> 	 <?php $Q_title="Researcher2E_3";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> </td>
        <td style="text-align:center;"> 	
			<?php $Q_title="Researcher2E_4";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
		</td></tr>
	   <tr>
        <th style="width:25%;"> Standardization/ Certification Body(s) </th>
          <td>	 <?php $Q_title="Researcher2E_5";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
		  </td>
        <td style="text-align:center;"> 	
			 <?php $Q_title="Researcher2E_6";  echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
		</td></tr> <tr>
        <th style="width:25%;"> Intellectual Property Rights office </th>
         <td> 	 <?php $Q_title="Researcher2E_7";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
			 	</td>
        <td style="text-align:center;"> 
				<?php $Q_title="Researcher2E_8";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 		
		 </td> </tr>
	  <tr>
        <th style="width:25%;"> Technology Transfer Office </th>
          <td> 
				<?php $Q_title="Researcher2E_9";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
				
		 </td>
        <td style="text-align:center;"> 

			<?php $Q_title="Researcher2E_10";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
	 	</td> </tr>
	  <tr>
        <th style="width:25%;"> Platform for Industry Interactions </th>
		
         <td>
			<?php $Q_title="Researcher2E_11";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
		 </td>
        <td style="text-align:center;"> 	
			<?php $Q_title="Researcher2E_12";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);  ?> 
		 	</td> </tr>
	  </table> 	
	  
	  <table class="table table-striped">
		<tr>
		<td  >    Others:  <?php $Q_title="Researcher2E_other"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?>
		</td>
		</tr>
	</table> 
    
	
	<b style="font-size:19px;">5.	Insight</b><br><br>
				<b style="font-size:19px;"> A.	Based on some known successful examples of ICT&E R&D translation, what is your opinion/ suggestion that will boost translation of R&D into Technologies / Products/ Solutions /Startups having commercial/societal value: </b><b class="red">*</b><br>
				   <?php $Q_title="Researcher4A"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> <br><br>
				<b style="font-size:19px;">	B.	Views on issues/ problem faced (if any) that hinders in translation of research into Technologies/ Products/ Services/ Start-ups having commercial/societal value:</b><b class="red">*</b><br>
				 <?php $Q_title="Researcher4B"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> <br><br>
				<b style="font-size:19px;"> C.	Do you think there are factors/ barriers which are hampering Industry academia linkages and Transfer of Technologies? If yes, your views on the same: </b><b class="red">*</b><br><br>
				 <?php $Q_title="Researcher4C"; echo get_currentdata_anx2($dbo,$Q_title,$sess_userid); ?> <br><br>
				
				<br>
				
				<b style="font-size:19px;">5. Would you like to be participate in similar surveys next year?  </b><b class="red">*</b> <br> 
				<div class="panel panel-default">
					<div class="panel-body">
						 <?php $Q_title="Researcher4D";   echo $Ifb = get_currentdata_anx2($dbo,$Q_title,$sess_userid);   ?> 
					 	</div>
				</div>
			 
			<br> <br>
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
	  <?php ob_end_flush(); ?>