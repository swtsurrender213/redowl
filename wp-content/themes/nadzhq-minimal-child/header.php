<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
        
	<?php wp_head(); ?>
	
    


</head>

<body <?php body_class(); ?>>
	
<div id="wrapper">

        <!-- Page content -->
        <div id="page-content-wrapper">
                 
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
       
<div class="col-md-2">
    

   <!-- Sidebar -->
        <div id="sidebar-wrapper">



        <div id="top"> 
		
		
      <div class="logo" style="margin-left: 10px;">
        <a title="Home" href="http://localhost/redowl/">
		<img src="http://localhost/redowl/wp-content/uploads/2015/RedOwlLogo1.png"
		onmouseover="this.src='http://localhost/redowl/wp-content/uploads/2015/RedOwlLogo12.png'"
		onmouseout="this.src='http://localhost/redowl/wp-content/uploads/2015/RedOwlLogo1.png'">
		</div>
   
    
    </div>
   
          

 <?php nadzhq_minimal_sidebar_nav() ;?>    

    
        </div>
     <!--End Sidebar -->



</div>