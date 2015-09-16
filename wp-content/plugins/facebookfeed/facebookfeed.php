<?php

/*
	Plugin Name: Facebook NewsFeed
	Plugin URI: http://jts.name
	Description: Plugin for a custom page
	Author: Tommy
	Version:1.0
	Author URI: http://jts.name
	*/
	
session_start();
	require_once( '/Facebook/FacebookSession.php' );
	require_once( '/Facebook/FacebookRedirectLoginHelper.php' );
	require_once( '/Facebook/FacebookRequest.php' );
	require_once( '/Facebook/GraphObject.php' );
	require_once( '/Facebook/GraphUser.php' );
	require_once( '/Facebook/FacebookSDKException.php' );
	require_once( '/Facebook/FacebookRequestException.php' );
	require_once( '/Facebook/HttpClients/FacebookHttpable.php' );
	require_once( '/Facebook/HttpClients/FacebookCurl.php' );
	require_once( '/Facebook/HttpClients/FacebookCurlHttpClient.php' );
	require_once( '/Facebook/Entities/AccessToken.php' );
	require_once( '/Facebook/Entities/SignedRequest.php' );
	require_once( '/Facebook/FacebookResponse.php' );
	require_once( '/Facebook/FacebookPermissionException.php');
	require_once( '/Facebook/FacebookAuthorizationException.php');
	 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookResponse;
	use Facebook\FacebookPermissionException;
	use Facebook\GraphUser;
	use Facebook\FacebookAuthorizationException;
	


require_once(dirname(__FILE__ ) . "/admin/facebookfeed_options.php"); 

function facebookfeed(){

	
	 
	 //creates session facebook, appication id and secret code
	FacebookSession::setDefaultApplication('114220975597538', '59762df3bcc8eb9187ab869d91ce5fd0');

	// helps to create an session with facebook after user login
	//$helper = new FacebookRedirectLoginHelper('http://localhost/facebookapp/index.php' );
	//to start session and catch any errors and all errors will be asked
	//try {
	  //$session = $helper->getSessionFromRedirect();
	//} catch( FacebookRequestException $ex ) {
	  //echo $e->getMessage();
	//} catch( Exception $ex ) {
	 // echo $e->getMessage();
	//}

	$session = new FacebookSession('CAABn4iStJZBIBAFygMwcNtUD4VsZAq0c3roUEZBZCwE6ikWA0RfwCPunJfd27SKN5svnJM7tW1IsySdrorvZCBf7JvzJF2h3y4b955OVuPqk56NuHtwfL8bnQ4mfjqtanvWl7CyifYKbDzR91KSgStnYtToA9iGEZBBvsMPv6dz0whumUAZCOky');

	
	 $facebookNfeed=get_option("facebookNfeed");
	
	if($facebookNfeed=="show"){
	
	// if have an session with facebook so users will get an request a username
	if ( $session) {
		
  //print_r($session);
  //profile
  try {
    $request = new FacebookRequest($session, 'GET', '/me?fields=name,hometown');
    $response = $request -> execute();
    $me = $response->getGraphObject();
    $name=$me->getProperty("name");
	$hometowninfo=$me->getProperty("hometown");
	$hometown=$hometowninfo->getProperty("name");
  } catch(FacebookRequestException $e) {
 
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
 
  }
  
  //get posts
   try {
    $request1 = new FacebookRequest($session, 'GET', '/me/feed?limit=5');
    $response1 = $request1 -> execute();
    $posts = $response1-> getGraphObject()->asArray();
	
	//var_dump($posts);
	echo '<h2>Latest Posts</h2>';
	echo '<table border="1" >';
	// echo out the object inside the array
	foreach ($posts["data"] as $post){
		
		try {
			$postid='/'.$post->id;
			$request2 = new FacebookRequest($session, 'GET',$postid."/?fields=link,full_picture");
			$response2 = $request2 -> execute();
			$getGraphObject = $response2->getGraphObject();
			$postpicture=$getGraphObject->getProperty("full_picture");
			//echo $postpicture; exit;
			$postlink=$getGraphObject->getProperty("link");
		}
		catch(FacebookRequestException $e) {
 
    //echo "Exception occured, code: " . $e->getCode();
    //echo " with message: " . $e->getMessage();
 
  }?>
  
  
  
  <?php
		echo '<tr>';
		//post image in the first col
		echo '<td><a href="'.$postlink.'"><img src="'.$postpicture.'"alt="postpicture" /></a></td>';
		
		echo '<td>';
		//check if object contains message or story
		if(isset($post->message)){
		echo '<p style="padding:20px;">'.$post->message.'</p>';
		}
		if(isset($post->story)){
		echo '<p style="padding:20px;">'.$post->story.'</p>';
		}
		
		if(isset($post->created_time)){
			echo'<em style="font-size:small">'.$post->created_time.'</em>';
		}
		echo '</td></tr>';
	}
	
	
	echo'</table>';
  } catch(FacebookRequestException $e) {
 
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
 
  }
  
  
  
}

//else {
 // $auth_url = $helper->getLoginUrl();
// echo '<a href="' . $auth_url . '">Login</a>';

//}
} //end maim
}//end of get options

add_shortcode( 'fb', 'facebookfeed_shortcode');

function facebookfeed_shortcode(){
		// prevents the sending of any data to the page until the function below
		// has excute
	ob_start();
	// name of our main plugin function
	facebookfeed();
	return ob_get_clean();
	
}	