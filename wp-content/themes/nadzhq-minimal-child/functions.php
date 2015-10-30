<?php 


//USING FILTERS
// filter to remove bad content from content
function redowl_remove($content){
//create a list of bad words and put them in a array
$BadWords=array('shit','fuck');

//loop through array
foreach($BadWords as $BadWord){
// replace bad content with a neutral content
//3 parameters where to find what to replace and content to be reach
$content=str_ireplace($BadWord,"sorry try again",$content);	
	
}
return $content;
}

add_filter('the_content','redowl_remove');




//APPLYING FILTER
// filter to remove bad content from content
function redowl_remove_message($message){
//create a list of bad words and put them in a array
$BadWords=array('shit','fuck');

//loop through array
foreach($BadWords as $BadWord){
// replace bad content with a neutral content
//3 parameters where to find what to replace and content to be reach
$message=str_ireplace($BadWord,"sorry try again",$message);	
	
}
return $message;
}

add_filter('clean_message','redowl_remove_message');





//LOGOUT
/*
// logout redirect to new login 
function redowl_logout(){
	
	$new_login_page=get_home_url()."/login/";
	wp_redirect($new_login_page."?login=out");
	exit;
	
	
}

add_action('wp_logout','redowl_logout');


function redowl_verify_auth($user,$username,$password){
    
	if($username=="" or $password==""){
	$new_login_page=get_home_url()."/login/";
	wp_redirect($new_login_page."?login=empty");
	exit;		
	}
}

add_filter('authenticate','redowl_verify_auth',1,3);



function redowl_login_fail(){
	
$new_login_page=get_home_url()."/login/";
wp_redirect($new_login_page."?login=fail");
//exit;	

}

add_action('wp_login_failed','redowl_login_fail');

function login_redirect(){

//old login page
$visitpage=basename($_SERVER["REQUEST_URI"],".php");


//if the user is on the old login page redirect them to the new login 
// test id the user is on the old login 
if($visitpage=='wp-login' and $_SERVER['REQUEST_METHOD'] == 'GET'){
	wp_redirect($new_login_page);	
	exit;
}

}

*/

function redowl_member_pay(){
//check if we are at members page 
if(is_page("member-pay-roll")){
//get the path of wordpress login to redirect

	// redirect users to the login page
	 $url=get_home_url();
	 if(!current_user_can("administrator")){
	 wp_redirect($url);
	 exit;
} //end of is_admin

}//end of is page	

}//end of function

add_action("get_header","redowl_member_pay");





//function to protect members page from them that not are logged on

/*
function redowl_protect_member_page(){
//check if we are at members page 
if(is_page("Members")){
//get the path of wordpress login to redirect
$login=get_home_url()."/wp-login.php";


if (!is_user_logged_in()) {
	// redirect users to the login page
	 wp_redirect($login);
} //end of is_logged

}//end of is page	

}//end of function

add_action("get_header","redowl_protect_member_page");

*/



//contact the administrator when someone contacts
//the website

add_action('redowl_contact_submit','contact_admin');

function contact_admin(){

$admin_email=get_option( 'admin_email' );

//email,subject,message
//wp_mail( $admin_email, 'New Contact', 'website had been contacted');

}

//insert contact information into the database
function insert_contact_info(){

//get the five variables 
//prepare variables
//wp_strip_all_tags will remove spaces and illegal characters

 $fname =  wp_strip_all_tags($_POST['fname']);
 $lname =  wp_strip_all_tags($_POST['lname']);
 $email=   wp_strip_all_tags($_POST['email']);
 $phone=trim($_POST['phone']);
 // two parameters of any name of the filter and what you want to filter
 //define the filter
 
 $message= wp_strip_all_tags($_POST['message']);
 
 
 $fullname= $lname.' '.$fname;
 
 
 // Create post object
$contact_post = array(
  'post_title'    => $fullname,
  'post_status'   => 'publish',
  'post_type'     => 'contact',
);

// Insert the post into the wp_post table and get the id
$post_id=wp_insert_post($contact_post);


//Insert into the postmeta table
add_post_meta($post_id, 'first_name', $fname);
add_post_meta($post_id, 'last_name', $lname);
add_post_meta($post_id, 'email', $email);
add_post_meta($post_id, 'telephone',$phone);

$message=apply_filters('clean_message',$message);
add_post_meta($post_id, 'message', $message);

}

//hooking into the do_action on submit
add_action('redowl_contact_submit','insert_contact_info');








//REQUEST FORM
add_action('redowl_request_submit','contact_admin');

//insert contact information into the database
function insert_request_info(){

//get the five variables 
//prepare variables
//wp_strip_all_tags will remove spaces and illegal characters

 $fullname =  wp_strip_all_tags($_POST['fullname']);
 $phone=trim($_POST['phone']);
 $member= wp_strip_all_tags($_POST['member']);
 $experience= wp_strip_all_tags($_POST['experience']);
 $recentemployees= wp_strip_all_tags($_POST['recentemployees']);
 
 
 
 // Create post object
$request_post = array(
  'post_title'    => $fullname,
  'post_status'   => 'publish',
  'post_type'     => 'request',
);

// Insert the post into the wp_post table and get the id
$post_id=wp_insert_post($request_post);


//Insert into the postmeta table
add_post_meta($post_id, 'fullname', $fullname);
add_post_meta($post_id, 'phone',$phone);
add_post_meta($post_id, 'member', $member);
add_post_meta($post_id, 'experience', $experience);
add_post_meta($post_id, 'recentemployees', $recentemployees);

}

//hooking into the do_action on submit
add_action('redowl_request_submit','insert_request_info');




//to hook into the page with your own code
// just before the head tag finishes loading </head>

//first parameter is the name of the hook
//second parameter is the name of the function that 
//will execute (your code to be added just before the /head tag)

add_action('wp_head', 'add_fav_icon');
 
function add_fav_icon() {
//Check meta description is set or not
echo '<link rel="icon" type="image/x-icon" 
href="'.get_stylesheet_directory_uri().'/images/.ico" />';
}










function show_contact_form($error="")
{ 

if($error!=""){
echo '<div class="alert alert-danger centered">'.$error.'</div>';
} ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" method="post" action="">
                    <fieldset>
                        <legend class="text-center header">Contact us</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
								<?php 
								if(isset($_POST['fname'])) 
								echo '<input id="fname" name="fname" type="text" value="'.$_POST['fname'].'" class="form-control">'; 
								else
								echo '<input id="fname" name="fname" type="text" placeholder="First Name" class="form-control">';
								?>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <?php 
								if(isset($_POST['lname'])) 
								echo '<input id="lname" name="lname" type="text" value="'.$_POST['lname'].'" class="form-control">'; 
								else
								echo '<input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control">';
								?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
								  <?php 
								if(isset($_POST['email'])) 
								echo '<input id="email" name="email" type="text" value="'.$_POST['email'].'" class="form-control">'; 
								else
								echo ' <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">';
								?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
								 <?php 
								if(isset($_POST['phone'])) 
								echo '<input id="phone" name="phone" type="text" value="'.$_POST['phone'].'" class="form-control">'; 
								else
								echo '  <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">';
								?>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
								 <?php 
								if(isset($_POST['message'])) 
								echo '<textarea class="form-control" id="message" name="message" rows="7">'.$_POST['message'].'</textarea>'; 
								else
								echo '<textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>';
								?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button name="contact-submit" type="submit" class="btn btn-primary btn-lg">
								Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
}




function show_request_form($error="")
{ 

if($error!=""){
echo '<div class="alert alert-danger centered">'.$error.'</div>';
} ?>


		
		<?php get_sidebar();?>
		
		
    </div>
</div>


<?php
}





function check_show_contact_form_error(){

//no errors to start
 $error="";
    
	//trim first name to remove spaces
	$fname=trim($_POST['fname']);
	
	if ($fname!= "") {
	    //santize to remove any illegal characters
        $fname = filter_var($fname, FILTER_SANITIZE_STRING);
	    //after the first name has been sanitized make sure 
		//it is not blank
		if ($fname == "") {
			$error .= 'Please enter a valid first name.<br/><br/>';
		}
	} else {
    $error .= 'Please enter your first name.<br/>';
	}
	
	
	//trim last name
	$lname=trim($_POST['lname']);
	
	if ($lname!= "") {
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
	//after the last name has been sanitized make sure it is not blank
		if ($lname == "") {
			$error .= 'Please enter a valid first name.<br/><br/>';
		}
	} else {
    $error .= 'Please enter your last name.<br/>';
	}
	
	
	//trim email
	$email=trim($_POST['email']);
	//if not equal to a blank
	if ($email != "") {
	//remove any illegal characters
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
	//check if the email address is valid
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error .= "$email is <strong>NOT</strong> a valid 
			email address.<br/><br/>";
		}
    } else {
    $error .= 'Please enter your email address.<br/>';
    }
	
	
	//phone number
	$phone=trim($_POST['phone']);
	//regular expression
	$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";	
	
	if($phone != ''){
	  //validate the phone number
		if(!preg_match($regex, $phone)){
		$error .= 'Please enter a valid phone number.<br>';
		}
	} else {
		
	$error .= 'Please enter your phone number.<br/>';}
    
	
	
	//message
	$message=trim($_POST['message']);
	
	if ($message!= "") {
    $message = filter_var($message, FILTER_SANITIZE_STRING);
	//after the message has been sanitized make sure it is not blank
		if ($message == "") {
			$error .= 'Please enter a valid message.<br/><br/>';
		}
	} else {
    $error .= 'Please enter a message.<br/>';
	}
	
	
return $error;	

}


//request form
function check_show_request_form_error(){

//no errors to start
 $error="";
    
	//trim first name to remove spaces
	$fullname=trim($_POST['fullname']);
	
	if ($fullname!= "") {
	    //santize to remove any illegal characters
        $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);
	    //after the first name has been sanitized make sure 
		//it is not blank
		if ($fullname == "") {
			$error .= 'Please enter a valid full name.<br/><br/>';
		}
	} else {
    $error .= 'Please enter your full name.<br/>';
	}
		
	//phone number
	$phone=trim($_POST['phone']);
	//regular expression
	$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";	
	
	if($phone != ''){
	  //validate the phone number
		if(!preg_match($regex, $phone)){
		$error .= 'Please enter a valid phone number.<br>';
		}
	} else {
		
	$error .= 'Please enter your phone number.<br/>';}
    
	
	
	//message
	$member=trim($_POST['member']);
	
	if ($member!= "") {
    $member = filter_var($member, FILTER_SANITIZE_STRING);
	//after the message has been sanitized make sure it is not blank
		if ($member == "") {
			$error .= 'Please enter a valid member.<br/><br/>';
		}
	} else {
    $error .= 'Please enter a your member user .<br/>';
	}
	
	
	//message
	$experience=trim($_POST['experience']);
	
	if ($experience!= "") {
    $experience = filter_var($experience, FILTER_SANITIZE_STRING);
	//after the message has been sanitized make sure it is not blank
		if ($experience == "") {
			$error .= 'Please enter a valid experiences.<br/><br/>';
		}
	} else {
    $error .= 'Please enter a your experiences .<br/>';
	}
	
	
	//message
	$recentemployees=trim($_POST['recentemployees']);
	
	if ($recentemployees!= "") {
    $recentemployees = filter_var($recentemployees, FILTER_SANITIZE_STRING);
	//after the message has been sanitized make sure it is not blank
		if ($recentemployees == "") {
			$error .= 'Please enter a valid recent employee skills.<br/><br/>';
		}
	} else {
    $error .= 'Please enter a your recent employment.<br/>';
	}
	
	
return $error;	

}

// Posts The Excerpt Read More.
function nadzhq_minimal_child_new_excerpt_more( $more ) {
  return '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">'.__('   &nbsp;Read More', 'nadzhq-minimal') .'</a>';
}
add_filter( 'excerpt_more', 'nadzhq_minimal_child_new_excerpt_more' );