<?php
//add admin settings



//hook to add menu to setting in dashboard
add_action("admin_menu", "custom_form_admin");

function custom_form_admin() {
/**Paraeters**/
//basic title
// name the appears in the settings menu
// capability-manage options means the user can change options
// get the locations of the current page __FILE__
// function to proceed the option page actions

add_menu_page('CustomForm', 'Custom Form', 'manage_options', __FILE__, 'custom_form_process' );

}

//function to proceed out from when submitted
function custom_form_process() {?>

<?php

if(isset($_POST['submit'])) {
	$select=$_POST["bio"];
	$select1=$_POST["website"];
	$select2=$_POST["fname"];
	$select3=$_POST["lname"];
	$select4=$_POST["nickname"];
	echo "The form you have selected is ".$_POST['bio'] .$_POST['nickname'].$_POST['lname'].$_POST['fname'].$_POST['website'];
	update_option("bio",$select);
	update_option("nickname",$select1);	
	update_option("fname",$select2);
	update_option("lname",$select3);
	update_option("website",$select4);

//insert users selection into the option table
}

else{
	//default
	
	
	//check to see if option exists
	$exist=get_option("bio");
	$exist=get_option("fname");
	$exist=get_option("lname");
	$exist=get_option("nickname");
	$exist=get_option("website");

	if(empty($exist)){
	
	//insert users selection into the option table
	add_option("bio",$select);
	add_action("nickname",$select1);
	add_action("fname",$select2);
	add_action("lname",$select3);
	add_action("website",$select4);
}
else {$select=$exist;	}

}

?>


	<form name="custom_registration_option" action="" method="post">
	<h2>Choose Your Options of Form Input</h2>

<label>for bootstrap without bio</label><br><input type="radio" name="bio" value="without" <?php if($select=="without"){echo 'checked="checked"';}?>>Without<br>
<label>for bootstrap with bio</label><br><input type="radio" name="bio" value="with" <?php if($select=="with"){echo 'checked="checked"';}?>>With<br>
<br>
<label>for bootstrap without nickname</label><br><input type="radio" name="nickname" value="without" <?php if($select=="without"){echo 'checked="checked"';}?>>Without<br>
<label>for bootstrap with nickname</label><br><input type="radio" name="nickname" value="with" <?php if($select=="with"){echo 'checked="checked"';}?>>With<br>
<br>
<label>for bootstrap without last name</label><br><input type="radio" name="lname" value="without" <?php if($select=="without"){echo 'checked="checked"';}?>>Without<br>
<label>for bootstrap with last name</label><br><input type="radio" name="lname" value="with" <?php if($select=="with"){echo 'checked="checked"';}?>>With<br>
<br>
<label>for bootstrap without first name</label><br><input type="radio" name="fname" value="without" <?php if($select=="without"){echo 'checked="checked"';}?>>Without<br>
<label>for bootstrap with first name</label><br><input type="radio" name="fname" value="with" <?php if($select=="with"){echo 'checked="checked"';}?>>With<br>
<br>
<label>for bootstrap without website</label><br><input type="radio" name="website" value="without" <?php if($select=="without"){echo 'checked="checked"';}?>>Without<br>
<label>for bootstrap with website</label><br><input type="radio" name="website" value="with" <?php if($select=="with"){echo 'checked="checked"';}?>>With<br>
<input type="submit" name="submit">
</form>
	
<?php }

//form for user to select options for framework

