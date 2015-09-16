<?php
	/*
	Plugin Name: custom registration
	Plugin URI: http://jts.name
	Description: Plugin for a custom page
	Author: Tommy
	Version:1.0
	Author URI: http://jts.name
	*/

function red_owl_load_con(){

// get framework
$framework=get_option("framework");


// if the framework is bootstrap load bootstrap
if($framework=="bootstrap"){
wp_enqueue_style( 'bootform', plugins_url('/css/bootform.css', __FILE__));
}
// if the framework is foundation load foundation
else{
	if($framework=="foundation"){
	wp_enqueue_style( 'foundaform', plugins_url('/css/foundaform.css', __FILE__));	

	}
	
}

}	
	
add_action("wp_enqueue_scripts", "red_owl_load_con");	
//directory
require_once(dirname( __FILE__ ) . "/admin/admin-add-option.php");
require_once(dirname( __FILE__ ) . "/admin/admin-bio.php");
/**function needed**/
// show the form
// validate the form
function validate_registration_form(){

$username=$_POST["username"];
$password=$_POST["password"];
$password2=$_POST["password2"];
$email=$_POST["email"];	
$website=$_POST["website"];
$firstname=$_POST["fname"];
$lastname=$_POST["lname"];
$nickname=$_POST["nickname"];
$bio=$_POST["bio"];

//check for empty fields on requires
$error="";
if(empty($username)){
$error.="Please put <strong>username</strong> in.<br>";	
}
else {
	// if its valid
	if (!validate_username( $username )){
	$error.="Sorry that is username invalid";
	  }
	  else{
		  //already exists
	if(username_exists( $username ))
	$error.="Sorry try another username, that username already exist.<br>";	  
	  }//end of username exist
}// end of else of username 
if(empty($password or ($password2))){
$error.="Please put a <strong>password</strong> in one of the fields.<br>";	
}
else if($password !==($password2)){
		$error.="Sorry both fields not match please try again<br>";
		
	}
else if(strlen($password) < 6){
		$error.="The <strong>Password</string> needs to be greater than six letters<br>";
}
else if(!preg_match("#[0-9]+#", $password)){
		$error.="The <strong>Password</strong> needs at least one number, please try again<br>";
}
if(empty($email)){
$error.="Please put <strong>email</strong> in.<br>";	
}
else if(!is_email($email)){
		$error.="The <strong>Email</string> is invalid<br>";
}

else if(email_exists( $email )){
	$error.="Sorry try another email, that email already exist.<br>";	  
}

if(empty($website)){
		if(!filter_var($url, FILTER_VALIDATE_URL ) === true) {
			$error.="Sorry please put a website <br>";
		}
}
return $error;
}

// registaration on success

function register(){
//sanitize the data
$username=sanitize_text_field( $_POST['username']); 
$password=esc_attr( $_POST['password']); 
$email=sanitize_email( $_POST['email']);
$website=esc_url( $_POST['website']); 
$fname=sanitize_text_field( $_POST['fname']); 
$lname=sanitize_text_field( $_POST['lname']); 
$nickname=sanitize_text_field( $_POST['nickname']); 
$bio=sanitize_text_field( $_POST['bio']);



$userdata = array(
		"user_login"		=>		$username,
		"user_email"		=>		$email,
		"user_pass"			=>		$password,
		"user_url"			=>		$website,
		"first_name"		=>		$fname,
		"last_name"			=>		$lname,
		"nickname"			=>		$nickname,
		"description"		=>		$bio,
		);
		
$userId=wp_insert_user($userdata);

//print_r($userdata);exit;

if ( is_wp_error($userId) ) :
    echo $userId->get_error_message();
else :
    echo $userId;
endif;

//add admin settings



}
function show_registration_form_html($error=""){?>
<?php
	if(!empty($error)){?>
	<div class="alert alert-danger">
  <strong>WARNING!</strong> <?php echo $error;?>
</div>
	<?php }?>

    <div class="panel panel-primary">
		<div style=" background-color: black; color:white;" class="panel-heading">Registration</div>
            <div class="well well-sm">
    <form class="form-horizontal" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	<fieldset>
	 <div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="username">Username <strong>*</strong></label>
							<input type="text" name="username" value="<?php if( isset( $_POST['username'])) echo $_POST['username'];?>">
					</div>
	 </div>
    <div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                 <div class="col-md-8">
					<label for="password">Password <strong>*</strong></label>
						<input type="password" name="password" value="<?php if( isset( $_POST['password'])) echo $_POST['password'];?>">
				 </div>
    </div>
	
	<div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                 <div class="col-md-8">
					<label for="password2">Password <strong>*</strong></label>
						<input type="password" name="password2" value="<?php if( isset( $_POST['password2'])) echo $_POST['password2'];?>">
				 </div>
    </div>
    <div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                 <div class="col-md-8">
					<label for="email">Email <strong>*</strong></label>
						<input type="text" name="email" value="<?php if( isset( $_POST['email'])) echo $_POST['email'];?>">
				 </div>
    </div>
    <div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                 <div class="col-md-8">
					<label for="website">Website</label>
					<input type="text" name="website" value="<?php if( isset( $_POST['website'])) echo $_POST['website'];?>">
				 </div> 
    </div>
     
    <div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="firstname">First Name</label>
						<input type="text" name="fname" value="<?php if( isset( $_POST['fname'])) echo $_POST['first_name'];?>">
					</div>
    </div>
     
    <div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="website">Last Name</label>
						<input type="text" name="lname" value="<?php if( isset( $_POST['lname'])) echo $_POST['last_name'];?>">
					 </div>
    </div>
     
    <div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="nickname">Nickname</label>
						<input type="text" name="nickname" value="<?php if( isset( $_POST['nickname'])) echo $_POST['nickname'];?>">
					</div>
    </div>
     
   <div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
					<div class="col-md-8">
						<label for="bio">About / Bio</label>
						<textarea name="bio"><?php if(isset( $_POST['bio'])) echo $_POST['bio'];?></textarea>
						</div>
	</div>
	 <div class="form-group">
            <div class="col-md-10 col-md-offset-2 text-center">
    <input type="submit" name="submit" value="Register"/>
	</div>
	</div>
	</fieldset>
	</form>
</div>
</div>



<?php }// end of show custom html registaration	


function show_registration_form_foundation($error=""){?>
<?php
	if(!empty($error)){?>
	<div data-alert class="alert-box warning radius">
  <strong>WARNING!</strong> <?php echo $error;?>
</div>

	<?php }?>

    <div class="row">
	<div class="panel">
		<div style=" background-color: black; color:white;" class="panel-heading">Registration</div>
		 <div class="large-12 columns">
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	 <div class="row">
			<span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
					<div class="medium-8 columns">
						<label for="username">Username <strong>*</strong></label>
							<input type="text" name="username" value="<?php if( isset( $_POST['username'])) echo $_POST['username'];?>">
					</div>
	 </div>
    <div class="row">
            <span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
                 <div class="medium-8 columns">
					<label for="password">Password <strong>*</strong></label>
						<input type="password" name="password" value="<?php if( isset( $_POST['password'])) echo $_POST['password'];?>">
				 </div>
    </div>
	
	<div class="row">
            <span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
                 <div class="medium-8 columns">
					<label for="password2">Password <strong>*</strong></label>
						<input type="password" name="password2" value="<?php if( isset( $_POST['password2'])) echo $_POST['password2'];?>">
				 </div>
    </div>
    <div class="row">
            <span class="large-1 columns medium-2 columns"><i class="fa fa-envelope-o bigicon"></i></span>
                 <div class="medium-8 columns">
					<label for="email">Email <strong>*</strong></label>
						<input type="text" name="email" value="<?php if( isset( $_POST['email'])) echo $_POST['email'];?>">
				 </div>
    </div>
    <div class="row">
            <span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
                 <div class="medium-8 columns">
					<label for="website">Website</label>
					<input type="text" name="website" value="<?php if( isset( $_POST['website'])) echo $_POST['website'];?>">
				 </div> 
    </div>
     
    <div class="row">
			<span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
					<div class="medium-8 columns">
						<label for="firstname">First Name</label>
						<input type="text" name="fname" value="<?php if( isset( $_POST['fname'])) echo $_POST['first_name'];?>">
					</div>
    </div>
     
    <div class="row">
			<span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
					<div class="medium-8 columns">
						<label for="website">Last Name</label>
						<input type="text" name="lname" value="<?php if( isset( $_POST['lname'])) echo $_POST['last_name'];?>">
					 </div>
    </div>
     
    <div class="row">
			<span class="large-1 columns medium-2 columns"><i class="fa fa-user bigicon"></i></span>
					<div class="medium-8 columns">
						<label for="nickname">Nickname</label>
						<input type="text" name="nickname" value="<?php if( isset( $_POST['nickname'])) echo $_POST['nickname'];?>">
					</div>
    </div>
     
   <div class="row">
			<span class="large-1 columns medium-2 columns"><i class="fa fa-pencil-square-o bigicon"></i></span>
					<div class="medium-8 columns">
						<label for="bio">About / Bio</label>
						<textarea name="bio"><?php if(isset( $_POST['bio'])) echo $_POST['bio'];?></textarea>
						</div>
	</div>
	 <div class="row">
            <div class="large-10 columns medium-2 columns">
    <input type="submit" name="submit" value="Register"/>
	</div>
	</div>
	</form>
</div>
</div>
</div>



<?php }// end of show custom foundation registaration	


function show_registration_form_bootstrap($error=""){?>
<?php
	if(!empty($error)){?>
	<div class="alert alert-danger">
  <strong>WARNING!</strong> <?php echo $error;?>
</div>
	<?php }?>

    <div class="panel panel-primary">
		<div style=" background-color: black; color:white;" class="panel-heading">Registration</div>
            <div class="well well-sm">
    <form class="form-horizontal" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
	<fieldset>
	 <div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="username">Username <strong>*</strong></label>
							<input type="text" name="username" value="<?php if( isset( $_POST['username'])) echo $_POST['username'];?>">
					</div>
	 </div>
    <div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                 <div class="col-md-8">
					<label for="password">Password <strong>*</strong></label>
						<input type="password" name="password" value="<?php if( isset( $_POST['password'])) echo $_POST['password'];?>">
				 </div>
    </div>
	
	<div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                 <div class="col-md-8">
					<label for="password2">Password <strong>*</strong></label>
						<input type="password" name="password2" value="<?php if( isset( $_POST['password2'])) echo $_POST['password2'];?>">
				 </div>
    </div>
    <div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                 <div class="col-md-8">
					<label for="email">Email <strong>*</strong></label>
						<input type="text" name="email" value="<?php if( isset( $_POST['email'])) echo $_POST['email'];?>">
				 </div>
    </div>
	<?php
	$website=get_option("website");
	
	if($website=="with"){
   echo '<div class="form-group">
            <span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                 <div class="col-md-8">
					<label for="website">Website</label>
					<input type="text" name="website" value=">';
					
					if( isset( $_POST["website"])) echo $_POST["website"];
					echo '">
				 </div> 
    </div>';
	}
	?>
     <?php
	 $fname=get_option("fname");
	
	if($fname=="with"){
    echo '<div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="firstname">First Name</label>
						<input type="text" name="fname" value=">';
						
						if( isset( $_POST["fname"])) echo $_POST["first_name"];
						echo '">
					</div>
    </div>';
	} // end of first name
	?>
	<?php
	 $lname=get_option("lname");
	
	if($lname=="with"){
    echo '<div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="lastname">Last Name</label>
						<input type="text" name="lname" value=">';
						
						if( isset( $_POST["lname"])) echo $_POST["last_name"];
						echo '">
					 </div>
    </div>';
}// end of lastname
?>
<?php
	 $nickname=get_option("nickname");
	
	if($nickname=="with"){
    echo '<div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
					<div class="col-md-8">
						<label for="nickname">Nickname</label>
						<input type="text" name="nickname" value=">';
						
						 if( isset( $_POST["nickname"])) echo $_POST["nickname"];
						 echo '">
					</div>
		 </div>';
	}// end of nickname
	?>
	<?php
    //echo value if bio is set in options  getoption
  
	$bio=get_option("bio");
	
	if($bio=="with"){
	echo '<div class="form-group">
			<span class="col-lg-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
					<div class="col-md-8">
						<label for="bio">About / Bio</label>
						<textarea name="bio">';
						
						
						if(isset( $_POST["bio"])) echo $_POST["bio"];
						
				echo '</textarea>
				</div>
	     </div>';
	}
	?>
	 <div class="form-group">
            <div class="col-md-10 col-md-offset-2 text-center">
    <input type="submit" name="submit" value="Register"/>
	</div>
	</div>
	</fieldset>
	</form>
</div>
</div>



<?php }// end of show custom registaration	

//main function
function custom_registration(){
//if the form has submitted
if(isset($_POST["submit"])){
	//check for errors
	$error=validate_registration_form();
	if($error==""){
		//success
		register();
	}// end of error
	else{
		$framework=get_option("framework","foundation");
		
		if($framework=="foundation"){
	show_registration_form_foundation($error);
	}
	else if($framework=="bootstrap"){	
	show_registration_form_bootstrap($error);
}
	}
} // end of submit

//first time to see the form
else{
$framework=get_option("framework","foundation");

if($framework=="foundation"){	
show_registration_form_foundation();
}
else if($framework=="bootstrap"){	
show_registration_form_bootstrap();
}
}
}//end post submit

/** Register/Create a new short code: [cr] **/
// first parameter: shortcode tag you put in your post or page
// second parameter: function to excute with shortcode

add_shortcode( 'cr', 'custom_registration_shortcode');

function custom_registration_shortcode(){
		// prevents the sending of any data to the page until the function below
		// has excute
	ob_start();
	// name of our main plugin function
	custom_registration();
	return ob_get_clean();
	
}	
?>