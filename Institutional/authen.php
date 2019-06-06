<?php  require "config.php";// connection to database  ?>
<?php 
	if(isset($_POST["hash_Registernew"]))
	{
		// $form_key = $_POST['form_key'];
		 $name = $_POST["name"];
		 $designation = $_POST["designation"];
		 $Affiliation = $_POST["Affiliation"];
		 $email = $_POST["email"];
		 $Telephone = $_POST["Telephone"];
		 $Place = $_POST["Place"];
		 $password = $_POST["password"];
		 $password_confirmation = $_POST["password_confirmation"];
		 
		  $availability = NULL;
            $Check_availability ="SELECT count(*) FROM survey_user WHERE email='$email' ";
            foreach($dbo->query($Check_availability) AS $DG5 )
            { $availability = $DG5['0']; }
             if($availability==0)
             {
               //  echo $availability;
               $var_cmp2=strcmp($password,$password_confirmation); 
               if($var_cmp2==0){
                   $hash_password = password_hash( $password, PASSWORD_BCRYPT);
                   try
                   {
                    $SQL_REGs="INSERT INTO survey_user ( name,email,designation,Affiliation,password,Telephone,created_at,updated_at,Place,status,role) 
                        VALUES ('$name','$email','$designation','$Affiliation','$hash_password','$Telephone','$aajki_date','$aajki_date','$Place','enable','Annexure1') ";
                         if($dbo->query($SQL_REGs))
                         {
                            echo "<script type= 'text/javascript'> alert(' Your registration is Successful ! '); </script>";
                            ?>
							<!--	<h1 style='color:red;'> Your registration is Successful ! <a href="index.php?login" class="btn btn-warning"> Click here to Login   </a> </h1>
								-->
							<?php 
							 /*
                            $SQL_access5=" SELECT * FROM survey_user WHERE email='$email' AND status = 'enable' ";
                            foreach($dbo->query($SQL_access5) AS $GE_T5){
                                session_regenerate_id();
								$_SESSION['sess_useractive'] = $GE_T5['id'];
									// $_SESSION["USERID"] = $GE_T5["id"];
									$_SESSION['USER_ID'] = $GE_T5['id'];
									$_SESSION['s_username'] = $GE_T['email'];
									$_SESSION['s_userrole'] = $GE_T['role'];
									$_SESSION['s_designation'] = $GE_T['designation'];
									$_SESSION['s_lastlogin_at'] = $GE_T['updated_at'];
                                session_write_close();
								header('location: form/index.php');
								
                            }
							 
							*/
							 
							  echo"<script> window.location.assign('index.php')</script>";
																				 
							// header('location: index.php?login');
							
                        }else{  echo "<script type= 'text/javascript'> alert(' Error while registration  ! ');		</script>";}
                         // $stmt = $dbo->prepare($SQL_REGs);
                         //  $stmt->execute();

                          
                   }
                       catch(PDOException $e)
                           {
                           echo $SQL_REGs . "<br>" . $e->getMessage();
                           }
               }else{
                   echo"<h3 align='center' style='color:red;'> new password and confirm new password must be same ! </h3>";
				    echo"<script> window.location.assign('index.php')</script>";
									 			
               }
              
             }else{
				 echo"<script> alert(' Given E-mail adress already exists, Please choose another one ! '); </script> ";
				   echo"<script> window.location.assign('index.php')</script>";
									 
				 }
          
		  
	}
?>


<?php 
	$username =  $password = $user_hash_passwd = NULL;
		if(isset($_POST["login_authi7d55"])) 
		{
			session_start();
			  // $form_key = $_POST['form_key'];
			
			if(isset($_POST['email'])){
				   $username = $_POST['email'];
			}
			if (isset($_POST['password'])) {
				   $password = $_POST['password'];

			}
			//echo"<br>";
			$Counter_val = $cnt = $Available =0;
			
			$SQL_access_check_avail=" SELECT count(*) FROM survey_user WHERE email='$username' AND status = 'enable' ";
				foreach($dbo->query($SQL_access_check_avail)AS $GH5)
				{
					$Available = $GH5["0"];
				}
				if($Available==0)
				{
                   // echo "I am here";
				     echo"<script> alert(' Invalid combination of username and password ');</script>";
				   	 echo"<script> window.location.assign('index.php?form=1579')</script>";
															 
				   // echo"<script> window.location.assign('index.php')</script>";
					// header('location: index.php?err=1');
				}else{
			
				$SQL_access=" SELECT * FROM survey_user WHERE email='$username' AND status = 'enable' ";
				foreach($dbo->query($SQL_access) AS $GE_T)
					{
						   $user_hash_passwd = $GE_T["password"];
					
					//echo"<br>";
						if(password_verify($password,$user_hash_passwd))
							{
								// $cnt=$cnt+1;
								// echo "TRUE ";
								session_regenerate_id();
								$_SESSION['sess_userid'] = $GE_T['id'];
								$_SESSION['sess_name'] = $GE_T['name'];
								$_SESSION['sess_username'] = $GE_T['email'];
							 	$_SESSION['sess_userrole'] = $GE_T['role'];
							    $_SESSION['sess_designation'] = $GE_T['designation'];
								//$_SESSION['sess_lastlogin_at'] = $GE_T['lastlogin_at'];
								$_SESSION['sess_created_at'] = $GE_T['created_at'];
							//	$_SESSION['sess_form_key'] = $form_key;
                               // $_SESSION['sess_userlogincountt'] = $GE_T['log_count'];
                                	
                                session_write_close();
								$role_x = $GE_T['role'];
								$username_x =  $GE_T['email'];
								$id_x =  $GE_T['id'];
								//$Counter_val =  $GE_T['log_count'];
								//$Counter_val = $Counter_val+1;
                               
                                $sql=" UPDATE survey_user set
												updated_at ='$aajki_date'
												WHERE id ='$id_x' ";
											if($dbo->query($sql))
												{
                                                     // header('location: index_doc.php?my_post=f');
                                                   //  echo"updated  data ";						
												}
												else{
												//	echo"Errr while data updation";
                                                }
												 
												 
														 	 header('location: Survey/');	
															 
												 
                                               //  header('location: form/');	  
                              
							}
							else
								{
                                   //  header('location:../?err=2');
								    echo"<script> alert(' Please Login to Access this Area! ');</script>";
									echo"<script> window.location.assign('index.php')</script>";
																			 
								}
					}	
				}					
	
		}
 ?>
 
  <?php 
 	if(empty($_POST)){
				header('location: index.php');	
			}
 ?>