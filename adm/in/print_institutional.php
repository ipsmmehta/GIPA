  
<?php  require "../config.php";// connection to database  ?>
 <?php  ob_start(); ?>
 
 <?php 
	if(isset($_GET["print"])){
	 	$data = $_GET["print"];
		if(!$data==""){
			?> <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				
			<?php 
			echo "<h3>Institutional  Survey Data : </h3><hr>";
			preview_form_ANZ1 ($data,$dbo);
			?>
			<script type="text/javascript">
				  window.onload = function() { window.print(); }
			 </script>
			<?php 
		}
	}
 ?>
 
	<?php 
		if(isset($_POST["get_exelAnex_1_excel"]))
		{
			$User_name = $_POST["User_name"]; 
			preview_form_ANZ1 ($User_name,$dbo);
			// get_exelAnex_1_data($dbo,$User_name);
			header("Content-Type: application/vnd.ms-excel");
			header("Expires: 0");
			$date = date('Y-m-d-Hi');
			header("content-disposition: attachment;filename=Survey_on$date.xls");
		}
	?>
	
	<?php 
		if(isset($_POST["get_exelAnex_1_word"]))
		{
			$User_name = $_POST["User_name"]; 
			preview_form_ANZ1 ($User_name,$dbo);
			header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
			 
		//	header("Content-Type: application/vnd.ms-excel");
			header("Expires: 0");
			$date = date('Y-m-d-Hi');
			header("content-disposition: attachment;filename=Survey_doc$date.doc");
		}
	?>
 <?php 
		if(isset($_POST["get_exelAnex_1_pdf"]))
		{
			$User_name = $_POST["User_name"]; 
			preview_form_ANZ1 ($User_name,$dbo);
			//header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
			header("Content-type:application/pdf");
			// It will be called downloaded.pdf
			header("Content-Disposition:attachment;filename='downloaded.pdf'");
			header("Expires: 0");
			$date = date('Y-m-d-Hi');
			header("content-disposition: attachment;filename=Survey_pdf$date.pdf");
		}
	?>
 
	
	 
	 	 <?php
	function preview_form_ANZ1 ($sess_userid,$dbo){
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
						<!-- <div align="right"> Date: <?php echo $updated_at; ?> </div>-->
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
        <th style="width:25%;"> Research translation in terms of IPR/Patents </th>
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
        <th style="width:25%;"> IPR filing </th>
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
        <th style="width:25%;"> IPR office </th>
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
				<th style="width:25%;">  IPR survey </th>
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
function get_currentdata($dbo,$Q_title,$User_name)
	{	/*
		$avail_count=NULL;
		$Check_avail ="SELECT count(*) FROM  survey_questions WHERE user_id='$User_name' AND Q_title='$Q_title' ";
		foreach($dbo->query($Check_avail) AS $GF5)
			{
				   $avail_count = $GF5["0"];
			}
			*/
		$SJHDKJ_FD="SELECT Q_details FROM survey_questions WHERE user_id='$User_name' AND Q_title='$Q_title' AND Annexure='2'";
			foreach($dbo->query($SJHDKJ_FD) AS $YTFG7)
			{
					return $A2rea1 = $YTFG7["Q_details"];
			}
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
		if(isset($_POST["get_exel_2"]))
		{
			$OutPut .= ' <table  >
				<tr>
					<th> Sr.No. </th>
					<th> Publication ID </th>
					 
					<th> Focusarea  </th>
					<th> Project  Name  </th>
					<th> Project ID   </th>
					<th> Institutions    </th>
					 
				</tr> ';
				$CNT=0;
			$SQL_75="SELECT institute_id,publication_id,project_id FROM publication_institute ORDER by publication_id ";
											foreach($dbo->query($SQL_75)AS $FEF57)
											{	
													//$id = $FEF57["id"];
													 $CNT=$CNT +1;
													$institute_id = $FEF57["institute_id"];
													$publication_id = $FEF57["publication_id"];
													$project_id = $FEF57["project_id"];
													$SQL_GET="SELECT focusareashortname FROM project_inst_data WHERE project_id='$project_id' ";
													foreach($dbo->query($SQL_GET)AS $AVGDCm )
													{
														$focusareashortname = $AVGDCm['focusareashortname'];
													}
													// $focusareashortname = GetFANAME($focus_area_id,$dbo);
													$Projecttname = get_pnm($dbo,$project_id);
													$INIname = get_ini($dbo,$institute_id);
													 
			
													//$institute = get_INII_IDF($dbo,$id);
													// $ININAME = get_ini($dbo,$institute_id);
													
												$OutPut .= "
														<tr>
																<td>    $CNT  </td>
																<td>    $publication_id  </td>
																<td>      $focusareashortname </td>
																<td>    $Projecttname   </td>
																<td>    $project_id   </td>
																<td>    $INIname   </td>
															  	 
														</tr>
														";	
											}
			$OutPut .= ' </table>';			
			
					header("Content-Type: application/vnd.ms-excel");
					header("Expires: 0");
					$date = date('Y-m-d-Hi');
					header("content-disposition: attachment;filename=Publication_BYFA$date.xls");
					echo $OutPut;				
		}
	?>
	</div>
	
	 <?php 
function get_currentdata_1($dbo,$Q_title,$User_name)
	{	 
		$SJHDKJ_FD="SELECT Q_details FROM survey_questions WHERE user_id='$User_name' AND Q_title='$Q_title' AND Annexure='1'";
			foreach($dbo->query($SJHDKJ_FD) AS $YTFG7)
			{
					return $A2rea1 = $YTFG7["Q_details"];
			}
	}
?>
	
    <?php ob_end_flush(); ?>