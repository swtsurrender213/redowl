<?php
session_start();
	require_once( 'facebookfeed/Facebook/FacebookSession.php' );
	require_once( 'facebookfeed/Facebook/FacebookRedirectLoginHelper.php' );
	require_once( 'facebookfeed/Facebook/FacebookRequest.php' );
	require_once( 'facebookfeed/Facebook/GraphObject.php' );
	require_once( 'facebookfeed/Facebook/GraphUser.php' );
	require_once( 'facebookfeed/Facebook/FacebookSDKException.php' );
	require_once( 'facebookfeed/Facebook/FacebookRequestException.php' );
	require_once( 'facebookfeed/Facebook/HttpClients/FacebookHttpable.php' );
	require_once( 'facebookfeed/Facebook/HttpClients/FacebookCurl.php' );
	require_once( 'facebookfeed/Facebook/HttpClients/FacebookCurlHttpClient.php' );
	require_once( 'facebookfeed/Facebook/Entities/AccessToken.php' );
	require_once( 'facebookfeed/Facebook/Entities/SignedRequest.php' );
	require_once( 'facebookfeed/Facebook/FacebookResponse.php' );
	require_once( 'facebookfeed/Facebook/FacebookPermissionException.php');
	require_once( 'facebookfeed/Facebook/FacebookAuthorizationException.php');
	 
	use facebookfeed\Facebook\FacebookSession;
	use facebookfeed\Facebook\FacebookRedirectLoginHelper;
	use facebookfeed\Facebook\FacebookRequest;
	use facebookfeed\Facebook\GraphObject;
	use facebookfeed\Facebook\FacebookSDKException;
	use facebookfeed\Facebook\FacebookRequestException;
	use facebookfeed\Facebook\FacebookResponse;
	use facebookfeed\Facebook\FacebookPermissionException;
	use facebookfeed\Facebook\GraphUser;
	use facebookfeed\Facebook\FacebookAuthorizationException;
	
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


	/*
	Plugin Name: Facebook NewsFeed
	Plugin URI: http://jts.name
	Description: Plugin for a custom page
	Author: Tommy
	Version:1.0
	Author URI: http://jts.name
	*/

function show_facebookfeed_bootstrap($error=""){?>
<?php
	
	 
	
	// if have an session with facebook so users will get an request a username
	if ( $session) {
		
  //print_r($session);
  //profile
  try {
    $request = new FacebookRequest($session, 'GET', '/me?fields=name,hometown,profile');
    $response = $request -> execute();
    $me = $response->getGraphObject();
    $name=$me->getProperty("name");
	$hometowninfo=$me->getProperty("hometown");
	$hometown=$hometowninfo->getProperty("name");
	$profile=$me->getProperty("profile");
	$url=$profile->getProperty("url");
	echo '<img src="'.$url.'"alt="profile" />';
	echo "<p>"."Page For" .$name. "from" .$hometown."</p>";
 
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
			$request2 = new FacebookRequest($session, 'GET',$postid."/?fields=picture,link");
			$response2 = $request2 -> execute();
			$getGraphObject = $response2->getGraphObject();
			$postpicture=$getGraphObject->getProperty("picture");
			$postlink=$getGraphObject->getProperty("link");
		}
		catch(FacebookRequestException $e) {
 
    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();
 
  }
		echo '<tr>';
		//post image in the first col
		echo '<td><a href="'.$postlink.'"><img style="height:60px; width:60px;" src="'.$postpicture.'"alt="postpicture" /></a></td>';
		
		echo '<td>';
		//check if object contains message or story
		if(isset($post->message)){
		echo '<p>'.$post->message.'</p>';
		}
		if(isset($post->story)){
		echo '</p>'.$post->story.'</p>';
		}
		
		if(isset($post->created_time)){
			echo'<em style="font-size:small">'.$post->created_time.'</em>';
		}
		echo '</tr></td>';
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
}