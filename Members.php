<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up | Sign In</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/checkbox_style.css">
<link rel="stylesheet" type="text/css" href="include/Captcha/stylesheet.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/checkbox_style.css">

<script src="jquery/jquery-1.8.3.min.js"></script>
<script src="js/tooltip.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(e) {
	$('.Left').hide();
	$('.Right').hide();
});
</script>

<script>
function showPass() {
	document.getElementById('pwd').setAttribute('type','text');
	document.getElementById('pwd1').setAttribute('type','text');
}

</script>
</head>
<body class="main-body">
<div class="col-lg-12 col-md-12">
  <div class="col-lg-12 col-md-12 Forms"> 
    
    <!-- Start AskButtonsArea --> 
    <br/>
    <br/>
    <div class="AskButtonsArea">
      <div class="Welcome"> Welcome , <br/>
        <img src="images/CC.png"/>
        <div class="WelcomeCap"> Share Code, Get Code. </div>
      </div>
      <div class="col-lg-6 col-md-6">
        <button type="button" class="btn btn-success AskButtons btn-go" id="SignIn"> Sign In </button>
      </div>	
      <div class="col-lg-6 col-md-6">
        <button type="button" class="btn btn-success AskButtons btn-go" id="SignUp"> Sign Up </button>
      </div>
      <div class="row">
     <?php 
			if(isset($_GET['status'])) {
			?>
        <div class="alert alert-success" role="alert"><strong>Great ! &nbsp; </strong> You're Sucessfully Registerd With Us.</div>
        <?php
			}
		?> 
        </div>
    </div>
    <!-- End AskButtonsArea --> 
    <!-- Left Form Start -->
    <div class="col-lg-3 col-md-1"> &nbsp; </div>
    <div class="col-lg-6 col-md-6 Left">
      <div class="page-header"> <img src="images/CC.png"/> <br/>
        Sign In </div>
      <?php
	  	if(isset($_REQUEST['login'])) {
			if(isset($_POST['CC_userName']) and strlen($_POST['CC_userName']) > 1) {
				if(isset($_POST['CC_userPassword']) and strlen($_POST['CC_userPassword']) >= 4) {
					$name = hash('md5',normalizeString($_POST['CC_userName']));
					$name1 = normalizeString($_POST['CC_userName']);					
					$pwd = hash('md5',normalizeString($_POST['CC_userPassword']));
					if(!$conn->connect_errno) {
						$query = "select count(*) 'users' from user_login_information where (user_reg='$name1' or user_name='$name' or user_mail='$name') and user_password='$pwd'";
						//echo $query;
						$res = $conn->query($query);
						$result = $res->fetch_assoc();
						if($res->num_rows === 1 and $result['users'] == 1) {
							$token = md5(uniqid(rand(), TRUE));
							$query = "insert into tokens (user_id,session_start,token) values((select user_reg from user_login_information where user_name='".$name."' or user_reg='".$name1."' or user_mail='".$name."'),now(),'".$token."')";						
							if($conn->query($query)) {	
								if(setcookie("tokenID",$token,time()+(60*60),"/")) {
								$query = "select user_id from tokens where token='".$token."'";	
								$res = $conn->query($query);
								$result=$res->fetch_assoc();
								if($res->num_rows === 1 and isset($result['user_id'])) {
									$user = $result['user_id'];
									$query = "select u_name,u_profile from user_personal_information where user_id='".$user."'";
									if($res = $conn->query($query)) {
										$result = $res->fetch_assoc();
										setcookie("userName",$result['u_name'],time()+60*60,"/");
										setcookie("userProfile",$result['u_profile'],time()+60*60,"/");
										setcookie("user",$user,time()+60*60,"/");
									}
								}
			
									
									header("location: dashboard.php");
									exit();
									die();
								}else {
									header("location: ".$url."Members.php?p=old&error=invalidSession");
									exit();
									die();
								}
							} else {
								header("location: ".$url."Members.php?p=old&error=invalidSession");
								exit();
								die();
							}
						} else {
							header("location: ".$url."Members.php?p=old&error=invalid");
							exit();
							die(); 
							
						}
					} else {
						header("location: ".$url."Members.php?p=old&error=noConnection");
						exit(); 
						die();
					}
				} else {
					header("location: ".$url."Members.php?p=old&error=noPassword");
					exit();
					die(); 
				}
			} else {
				header("location: ".$url."Members.php?p=old&error=noUsername");
				die(); 
				exit();
			}
		}
		
		$msg = null ;
		if(isset($_GET['p']) and $_GET['p']=='old' and isset($_GET['error'])) {
			?>
    <script>
	$(document).ready(function(e) {
	$('.Left').hide();
	$('.Right').hide();
	$('.AskButtonsArea').show('fast');
	$('button#SignIn').click();
	});
	</script>
      <?php
			$type = normalizeString($_GET['error']);
			if($type=="invalid") {
				$msg = " Enterd wrong ID Password.";
			}
			else if($type=="noConnection"){
				$msg = " Sorry for inconveniens our Database is Undermantain.";
			}
			else if($type=="noPassword") {
				$msg = " Wrong Password Entered or Passowrd Field left empty.";
			}
			else if($type=="noUsername") {
				$msg = " No UserID Provied.";
			}
			else if($type=="invalidSession") {
				$msg = " Sorry, System is Unable to create uniqe Token for you.";
			}
			else {
				$msg = " Error Recored ! we will fix it soon";	
			}
		}
	  ?>
      <form method="post">
        <div class="row">
          <div class="col-lg-3 col-md-3 text-left">
            <label class="lables" for="userID"> User ID </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" name="CC_userName" class="form-control input" id="userID" />
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3 text-left">
            <label class="lables" for="userPWD"> Password </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="password" name="CC_userPassword" class="form-control input" id="userPWD"/>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3"> </div>
          <div class="col-lg-7 col-md-7 free text-left">
            <a href="forget.php" style="cursor:alias"> <label>Forget Password </label> </a>
          </div>
        </div>
        <?php 
			if(isset($msg)) {
			?>
        <div class="row">
          <div class="alert alert-danger" role="alert"><strong>Error!</strong><?php echo $msg;?></div>
        </div>
        <?php
			}
		?>
        <div class="row">
          <div class="col-lg-3 col-md-3"> &nbsp; </div>
          <div class="col-lg-7 col-md-7">
            <input type="submit" class="btn btn-success form-control input btn-go" name="login" value="Proceed"/>
      
          </div>
        </div>
      </form>
      <a class="LinkR"> Don't have account , Click here to Register </a> </div>
    <!-- Right Form Start -->
    <div class="col-lg-6 col-md-6 Right">
      <div class="page-header"> <img src="images/CC.png"/> <br/>
        Sign Up </div>
      <?php
		$userName = isset($_POST['CC_userName']) ? normalizeString($_POST['CC_userName']) : null ;
		$userID = isset($_POST['CC_userID']) ? normalizeString($_POST['CC_userID']) : '';
		$userNameIden = isset($_POST['CC_userNameIden']) ? normalizeString($_POST['CC_userNameIden']) : null ;
		$userPassword = isset($_POST['CC_userPassword']) ? normalizeString($_POST['CC_userPassword']) : null ;
		$userPassword2 = isset($_POST['CC_userPassword2']) ? normalizeString($_POST['CC_userPassword2']) : null ;
		$userEmail = isset($_POST['CC_userEmail']) ? normalizeString($_POST['CC_userEmail']) : null ;
		$userTel = isset($_POST['CC_userTel']) ? normalizeString($_POST['CC_userTel']) : null ;
		$hashCap = isset($_POST['Sec']) ? normalizeString($_POST['Sec']) : null ;
		$captcha = isset($_POST['captcha']) ? normalizeString($_POST['captcha']) : null ;
		
		if(isset($_POST['newUser'])) {
			if($userName and $userID and $userNameIden and $userPassword and $userPassword2 and $userEmail and $userTel and $hashCap and $captcha) {
				$errors = 0;
				//user Name Check 
				$query = "select count(*) 'users' from user_login_information where user_name='$userName'";
				$res = $conn->query($query);
				$result = $res->fetch_assoc();
				if($res->num_rows === 1 and $result['users'] === 1) {
					header("location: ".$url."?p=new&error=alreadyExist");
					exit();
					$errors = 1;
				}
				 
				//userRegID Name Check
				$query = "select count(*) 'users' from user_login_information where user_reg='$userID'";
				$res = $conn->query($query);
				if($res->num_rows === 1 and $result['users'] == 1 ) {
					header("location: ".$url."Members.php?p=new&error=alreadyExist");
					exit();
					$errors = 1;
				}	
				
				//password check
				if($userPassword != $userPassword2) {
					header("location: ".$url."Members.php?p=new&error=password");
					exit();	
					$errors = 1;
				}
				
				//Captcha
				if($hashCap != hash('md5',$captcha)) {
					//echo $hashCap."<br>";
					//echo hash('md5',$captcha)."<br>";
					header("location: ".$url."Members.php?p=new&error=captcha");
					exit();
					$errors = 1;
				}
				
				if($errors == 0) {
					$h_userName = hash('md5',$userName);
					$h_userPassword = hash('md5',$userPassword);
					$h_userEmail = hash('md5',$userEmail);
					
					$query = "insert into user_login_information (user_reg,user_name,user_password,user_type,user_mail) values('$userID','$h_userName','$h_userPassword','l','$h_userEmail')";
					if($conn->query($query)){
					$query = "insert into user_personal_information (user_id,u_name,u_nameID,u_tel,u_mail) values('$userID','$userNameIden','$userName','$userTel','$userEmail')";
					$conn->query($query);
					header("location: ".$url."Members.php?status=regeistered");
					exit(); 
					} else {
					header("location: ".$url."Members.php?p=new&error=unavailable");
					exit();
					}
				}
			} else {
				echo "Require Fields are empty";
			}
		}
		
		$msg1 = null ;
		if(isset($_GET['p']) and $_GET['p']=='new' and isset($_GET['error'])) {
			?>
      <script> 
	$(document).ready(function(e) {
	$('.Left').hide();
	$('.Right').hide();
	$('.AskButtonsArea').show('fast');
	$('button#SignUp').click();
	});
	</script>

      <?php
			$type = normalizeString($_GET['error']);
			if($type=="alreadyExist") {
				$msg1 = " Already Exist.";
			}
			else if($type=="password"){
				$msg1 = " Password and Re-enter Password Should Match.";
			}
			else if($type=="captcha") {
				$msg1 = " Enterd Captcha is not valid.";
			}
			else if($type=="unavailable") {
				$msg1 = " Sorry, Database is down.";	
			}
			else {
				$msg1 = " Recored ! we will fix it soon";	
			}
		}
		
		?>
      <form method="post" action="Members.php">
        <div class="row col-lg-12" >
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="fullName"> Name </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" name="CC_userNameIden" class="form-control input" id="fullName" onKeyPress="return lettersOnly(event);" value="<?php echo isset($userNameIden) ? $userNameIden : '' ; ?>" />
          </div>
          <div id="Wreg_nameFull">
          </div>
        </div>
        <div class="row col-lg-12" >
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="fullName "> Registration ID </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" name="CC_userID" class="form-control input" id="reg_userID" value="<?php echo isset($userID) ? $userID : '' ; ?>"/>
          </div>
          <div id="Wreg_userID">
          </div>
        </div>
        <div class="row col-lg-12" >
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="fullName"> Username </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="text" name="CC_userName" id="reg_userName" class="form-control input" value="<?php echo isset($userName) ? $userName : '' ; ?>"/>
          </div>
          <div id="Wreg_userName">
          </div>
        </div>
        <div class="row col-lg-12" id="Wpwd">
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="pwd"> Password </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="password" name="CC_userPassword" class="form-control input" id="pwd" value="<?php echo isset($userPassword) ? $userPassword : '' ; ?>"/>
          </div>
        </div>
        <div class="row col-lg-12" id="Wpwd1">
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="pwd1"> Re-enter Password </label>
          </div>
          <div class="col-lg-7 col-md-7 text-right">
            <input type="password" name="CC_userPassword2" class="form-control input" id="pwd1" value="<?php echo isset($userPassword2) ? $userPassword2 : '' ; ?>"/>
          <label id="showPassword" onClick="showPass();"> Show Password </label>
          </div>
        </div>
        <div class="row col-lg-12">
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="Email"> Email </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="email" name="CC_userEmail" class="form-control input" id="Email" value="<?php echo isset($userEmail) ? $userEmail : '' ; ?>" />
          </div>
          <div id="WEmail">
          </div>
        </div>
        <div class="row col-lg-12">
          <div class="col-lg-4 col-md-4 text-left">
            <label class="lables" for="Mobile"> Mobile </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="tel" name="CC_userTel" class="form-control input" id="Mobile" onkeypress='return isNumberKey(event)' value="<?php echo isset($userTel) ? $userTel : '' ; ?>" maxlength="13"/>
          </div>
        </div>
        <div class="row col-lg-12">
          <div class="col-lg-5 col-md-5"> &nbsp; </div>
          <div class="col-lg-7 col-md-7">
            <div class="col-lg-7 col-md-7 captcha thumbnail noselect">
              <?php $xHash=generateRandomString(); 
				$temp = $xHash;
			$xHash = hashString($xHash);
			?>
              <input type="hidden" name="Sec" value="<?php echo $xHash; ?>"/>
              <?php echo setFont($temp); ?>
              <input type="text" name="captcha" class="form-control"/>
            </div>
          </div>
        </div>
        <?php 
			if(isset($msg1) and isset($_GET['error'])) {
			?>
        <div class="alert alert-danger" role="alert"><strong>Error! &nbsp; </strong><?php echo $msg1;?></div>
        <?php
			}
		?>
        <div class="row col-lg-12">
          <div class="col-lg-4 col-md-4">
            <label class="lables"> &nbsp; </label>
          </div>
          <div class="col-lg-7 col-md-7">
            <input type="submit" class="form-control btn btn-success btn-go" id="submit" value="Register" name="newUser" />
          </div>
        </div>
      </form>
      <a class="LinkL col-xs-offset-2"> Already have account , Click Here to Sing In </a> </div>
  </div>
</div>
<script>
$('#SignIn').click(function() {
	$('.AskButtonsArea').hide("slow");
	$('.Left').show("Fast");
});

$('#SignUp').click(function() {
	$('.AskButtonsArea').hide("slow");
	$('.Left').hide("slow");
	$('.Right').show("Fast");
});

$('.LinkL').click(function() {
	$('.AskButtonsArea').hide("slow");
	$('.Right').hide("fast");
	$('.Left').show("slow");
});

$('.LinkR').click(function() {
	$('.AskButtonsArea').hide("slow");
	$('.Left').hide("fast");
	$('.Right').show("slow");
});
</script>
<script src="js/valid.js"></script>
</body>
<script src="js/bootstrap.js"></script>
<?php 
	function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	
	function hashString($data) {
		$data = hash('md5',$data);
		return $data;
	}
	
	function setFont($data) {
		$fonts = array("'figgins_sansitalic'","'lancastershireregular'","'libertaditalic'","'saginaw_bold'");
		$font = $fonts[rand(0,4-1)];
    	return "<div style=\"font-size:22px;font-family:$font;position:relative;\">".$data."</div>";
	}
?>
</html>