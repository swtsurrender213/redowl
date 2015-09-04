<?php
/**
 * The sidebar containing the main widgets areas
 *
 * @package Nadzhq (nadzhq@gmail.com)
 * @subpackage nadzhq Theme
 * @since nadzhq 1.0
 */

?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
<div class="col-md-2 col-xs-12">
<div id="sidebar">
  <aside id="sidebar-core" class="sidebar widget-area one-third right" role="complementary">
   <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </aside>
</div>
</div>
<?php } ?>




	
				