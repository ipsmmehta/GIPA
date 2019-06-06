

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
</style>
<body>


<div id="regForm"> 
 	 <br> 
<?php 
 require "config.php";// connection to database 
	$SQL_Sg="SELECT Login_Researcher FROM survey_data WHERE id ='1' ";
	foreach($dbo->query($SQL_Sg) AS $jhs5){
		echo $jhs5["Login_Researcher"];
	}
?>

 
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
	 

           
					
			 
                   
                    <?php 
						if(empty($_GET)){
						}else{
						}
							if ($_SERVER['REQUEST_METHOD'] == 'POST') {
								// echo"no mr ";
							}	else{
								fun_login();
							}
							
						if(isset($_POST['Register']))
						{
							fun_Register();
						}
						if(isset($_POST['Login']))
						{
							fun_login();
						}
					
					?>					   
                       
                    
               
			
			
        </div>
    </div>
 
  
       
    

 


 
<footer class="container-fluid text-center">
  <p> This  form is Design and Developed by <a href="https://itra.medialabasia.in/" target="_blank" title="For any query contect, Avinash JWD (ITRA) " > ITRA</a> </p>
</footer>
</div>
</body>
</html>


<?php 
		function fun_login()
		{
			
			?>
			 <div class="panel panel-default">
                <div class="panel-heading">
					<form name="sdf" method="post" >
						<button type="submit" name="Register"  class="btn btn-default" style="width:auto;">  <span style="color:red;"> Register  </span></button>
						<!-- <input type="submit" name="Login" value="Login" class="btn btn-default" style="width:auto;" > -->
					</form>
				</div>

                <div class="panel-body">
			 <form class="form-horizontal" method="POST" action="authen.php"  >
			 <div class="form-group">
				 
                            <label for="email" class="col-md-4 control-label">E-Mail </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"  >

                                                            </div>
                        </div>

                      
                         

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" name="login_authi7d55" class="btn btn-primary">
                                    Continue
                                </button>
 
                            </div>
                        </div>
				 </form>
				  </div>
            </div>
			<?php 
		}
	?>


<?php 
		function fun_Register()
		{
			?>
			<div class="panel panel-default">
                <div class="panel-heading">
					<form name="sdf" method="post" >
					<button type="submit" name="Login"  class="btn btn-default" style="width:auto;">  <span style="color:red;"> Login  </span></button>
						<!-- <input type="submit" name="Register" value="Register" class="btn btn-default" style="width:auto;"> -->
						 
					</form>
				</div>

                <div class="panel-body">
				
			  <form class="form-horizontal" method="POST" action="authen.php"  >
			 <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">  <input id="name" type="text" class="form-control" name="name" value="" required  autofocus>   </div>
                        </div>
						
						<div class="form-group">
                            <label for="Designation" class="col-md-4 control-label">Designation</label> <div class="col-md-6">
								<input id="name" type="text" class="form-control" name="designation" value="" required  autofocus> </div>
                        </div>

						<div class="form-group">
                            <label for="Designation" class="col-md-4 control-label">Affiliation</label>
							<div class="col-md-6"> <input id="name" type="text" class="form-control" name="Affiliation" value="" required  autofocus> </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail </label>
								<div class="col-md-6"> <input id="email" type="email" class="form-control" name="email" value=""  required  ></div>
                        </div>
                        
                      

                        <div class="form-group">
                            <label for="Designation" class="col-md-4 control-label">Telephone</label>
								<div class="col-md-6"> <input   type="number" class="form-control" name="Telephone" value="" required  autofocus> </div> 
                        </div>
                 
                        <div class="form-group">
                            <label for="Designation" class="col-md-4 control-label">Place</label>
								<div class="col-md-6"> <input id="Place" type="text" class="form-control" name="Place" value="" required  autofocus> </div> 
                        </div>
                 


                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required  >

                                                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="hash_Registernew"  >
                                    Continue
                                </button>
                            </div>
                        </div>
				</form>	
 </div>
            </div>				
			<?php 
		}
?>

