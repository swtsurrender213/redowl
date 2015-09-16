<?php
//add admin settings



//hook to add menu to setting in dashboard
add_action("admin_menu", "custom_registration_admin");

function custom_registration_admin() {
/**Paraeters**/
//basic title
// name the appears in the settings menu
// capability-manage options means the user can change options
// get the locations of the current page __FILE__
// function to proceed the option page actions

add_menu_page('CustomRegistration', 'Custom Registration', 'manage_options', __FILE__, 'custom_registration_process' );

}

//function to proceed out from when submitted
function custom_registration_process() {?>

<?php

if(isset($_POST['submit'])) {
	$select=$_POST["Framework"];
	echo "The Framework you have selected is ".$_POST['Framework']; 
	update_option("framework",$select);
//insert users selection into the option table
}

else{
	//default
	
	
	//check to see if option exists
	$exist=get_option("framework");

	if(empty($exist)){
	
	//insert users selection into the option table
	add_option("framework",$select);
}
else {$select=$exist;	}

}

?>


	<form name="custom_registration_option" action="" method="post">
	<h2>Choose Your Options of Framework</h2>
<input type="radio" name="Framework" value="html" <?php if($select=="html"){echo 'checked="checked"';}?>>HTML<br>
<input type="radio" name="Framework" value="bootstrap" <?php if($select=="bootstrap"){echo 'checked="checked"';}?>>BootStrap<br>
<input type="radio" name="Framework" value="foundation" <?php if($select=="foundation"){echo 'checked="checked"';}?>>Foundation<br>
<input type="submit" name="submit">
</form>
	
<?php }

//form for user to select options for framework

