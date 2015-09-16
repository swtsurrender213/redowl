<?php

//hook to add menu to settings in dashboard
add_action('admin_menu', 'facebookfeed_admin');


function facebookfeed_admin() {

/***Parameters***/
//basic title
//name that appears in the settings menu
//capability - manage options means the user can change options
//get the location of the current page  __FILE__  
//function to process the option page actions
	
add_options_page('FacebookFeed','FacebookFeed','manage_options',__FILE__ ,'facebookfeed_process');

}

//function to process our form when submitted
function facebookfeed_process(){ 





//check to see if the form has been submitted
if(isset($_POST["Submit"])){
	
	$ai=$_POST["AI"]; 
	$ac=$_POST["AC"];
	$selected=$_POST["facebookNfeed"];
	echo "The form you have selected is ".$_POST['facebookNfeed'];
	update_option("AI",$ai);
	echo '<br>'."The form you text is ".$_POST['AI'];
	update_option("AC",$ac);
	echo '<br>'."The form you text is ".$_POST['AC'];
	update_option("facebookNfeed",$selected);
//insert users selection into the options table
}
else{
//default value if the form has not been submitted
	
	//check to see if option exists
	
	$existing=get_option("facebookNfeed");
	
	if(empty($existing)){
	$selected="facebookNfeed";
	//insert user selection into the database
	add_option("facebookNfeed",$selected);
    }
	else{$selected=$existing;}
	
	
	
	$existing1=get_option("AI");
	
	if(empty($existing1)){
	$ai="AI";
	//insert user selection into the database
	add_option("AI",$ai);
    }
	else{$ai=$existing1;}
	
	$existing2=get_option("AC");
	
	if(empty($existing2)){
	$ac="AC";
	//insert user selection into the database
	add_option("AC",$ac);
    }
	else{$ac=$existing2;}

} //end not submitted

?>


<h1>Turn Facebook on or off</h1>
<form name="facebookfeed_admin" action="" method="post" >
<label>Show Facebook</label> 
<input type="radio" name="facebookNfeed" id="facebookfeed" value="show" <?php if($selected=="show"){echo 'checked="checked"';} ?> /><br>
<label>Unshow Facebook</label> 
<input type="radio" name="facebookNfeed" id="facebookfeed" value="unshow" <?php if($selected=="unshow"){echo 'checked="checked"';} ?> /><br>
<h1>Please Type The Two Codes</h1><br>
<label>Account Id</label> 
<input type="text" name="AI"><br>
<label>Account Code</label> 
<input type="text" name="AC"><br>
<input type="submit" name="Submit" value="Submit" />
</form>

<?php } ?>

