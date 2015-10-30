<?php



/**
 * ----------------------------------------------------------------------------------------
 * 1.0 - Define constants.
 * ----------------------------------------------------------------------------------------
 */
define( 'THEMEROOT', get_stylesheet_directory_uri() );
define( 'IMAGES', THEMEROOT . '/img' );
define( 'SCRIPTS', THEMEROOT . '/lib' );




/**
 * The default functions.php
 */


if ( ! isset( $content_width ) )
  $content_width = 722;


/**
 * Provides a standard format for the page title depending on the view. This is
 * filtered so that plugins can provide alternative title formats.
 *
 * @param       string    $title    Default title text for current view.
 * @param       string    $sep      Optional separator.
 * @return      string              The filtered title.
 * @package     nadzhq
 * @subpackage  includes
 * @version     1.0.0
 * @since       1.0.0
 */
function nadzhq_minimal_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
        return $title;
    } // end if

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title = "$title $sep $site_description";
    } // end if

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ) {
        $title = sprintf( __( 'Page %s', 'nadzhq-minimal' ), max( $paged, $page ) ) . " $sep $title";
    } // end if

    return $title;

} // end nadzhq_minimal_wp_title
add_filter( 'wp_title', 'nadzhq_minimal_wp_title', 10, 2 );

/**
 * ----------------------------------------------------------------------------------------
 * Display meta information for a specific post.
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'nadzhq_minimal_post_meta' ) ) {
  function nadzhq_minimal_post_meta() {
    echo '<ul class="list-inline entry-meta">';

    if ( get_post_type() === 'post' ) {
      // If the post is sticky, mark it.
      if ( is_sticky() ) {
        echo '<li class="meta-featured-post"><i class="fa fa-thumb-tack"></i> ' . __( 'Sticky', 'nadzhq-minimal' ) . ' </li>';
      }

      // Get the post author.
      printf(
        '<li class="meta-author"><a href="%1$s" rel="author">%2$s</a></li>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        get_the_author()
      );

      // Get the date.
      echo '<li class="meta-date"> ' . get_the_date() . ' </li>';

      // The categories.
      $category_list = get_the_category_list( ', ' );
      if ( $category_list ) {
        echo '<li class="meta-categories"> ' . $category_list . ' </li>';
      }

      // The tags.
      $tag_list = get_the_tag_list( '', ', ' );
      if ( $tag_list ) {
        echo '<li class="meta-tags"> ' . $tag_list . ' </li>';
      }

      // Comments link.
      if ( comments_open() ) :
        echo '<li>';
        echo '<span class="meta-reply">';
        comments_popup_link( __( 'Leave a comment', 'nadzhq-minimal' ), __( 'One comment so far', 'nadzhq-minimal' ), __( 'View all % comments', 'nadzhq-minimal' ) );
        echo '</span>';
        echo '</li>';
      endif;

      // Edit link.
    
        echo '<li>';
        edit_post_link( __( 'Edit', 'nadzhq-minimal' ), '<span class="meta-edit">', '</span>' );
        echo '</li>';
    
       echo '</ul>';
    }
  }
}



//----------------------------------------------------------------------------------
//  Add Meta Box For Post Thumbnails
//----------------------------------------------------------------------------------

function nadzhq_minimal_custom_theme_setup() {
add_theme_support( 'automatic-feed-links' );
add_theme_support('post-thumbnails');
add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'status', 'quote', 'link', 'chat' ) );

load_theme_textdomain('nadzhq-minimal', get_template_directory() . '/languages');


}
add_action( 'after_setup_theme', 'nadzhq_minimal_custom_theme_setup' );



function nadzhq_minimal_frontend_scripts(){

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
  
    // Add Styles
    wp_enqueue_style('nadzhq-minimal-superfish', get_template_directory_uri() .'/lib/extensions/superfish/css/superfish.css');
    wp_enqueue_style('nadzhq-minimal-superfish-vertical', get_template_directory_uri() .'/lib/extensions/superfish/css/superfish-vertical.css');
    wp_enqueue_style('nadzhq-minimal-bootstrap', get_template_directory_uri() .'/lib/extensions/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('nadzhq-minimal-default-color', get_template_directory_uri() .'/styles/colors/default-color.css');
    wp_enqueue_style('nadzhq-minimal-bootstrap-sidebar', get_template_directory_uri() .'/styles/sidebar.css');
    wp_enqueue_style('nadzhq-minimal-font-awesome', get_template_directory_uri() .'/lib/extensions/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('nadzhq-minimal-components-css', get_template_directory_uri() .'/styles/components.css');

    // Register Scripts
    wp_enqueue_script('nadzhq-minimal-bootstrap-js', get_template_directory_uri() .'/lib/extensions/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.1.1', true );
     wp_enqueue_script('nadzhq-minimal-js', get_stylesheet_directory_uri() .'/lib/extensions/custom-js/custom.js');
    wp_enqueue_script('nadzhq-minimal-superfish', get_stylesheet_directory_uri() .'/lib/extensions/superfish/js/superfish.js', array(), '1.7.4', true );


// Add Superfish menus.


wp_enqueue_style( 'nadzhq-style', get_stylesheet_uri() ); //default

}


add_action('wp_enqueue_scripts','nadzhq_minimal_frontend_scripts');


/* CUSTOM MENUS */  

register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'nadzhq-minimal' ),
    ) );


//----------------------------------------------------------------------------------
//  ADD CUSTOM 'get_comments_popup_link' FUNCTION - Credit to http://www.thescubageek.com/code/wordpress-code/add-get_comments_popup_link-to-wordpress/
//----------------------------------------------------------------------------------

// Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
function nadzhq_minimal_get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments','nadzhq-minimal' );
    if ( false === $one ) $one = __( '1 Comment','nadzhq-minimal' );
    if ( false === $more ) $more = __( '% Comments','nadzhq-minimal' );
    if ( false === $none ) $none = __( 'Comments Off','nadzhq-minimal' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','nadzhq-minimal');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = esc_url( home_url( '/' ));
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','nadzhq-minimal'), $title ) ) . '">';
    $str .= get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}

// Modifies WordPress's built-in comments_number() function to return string instead of echo
function nadzhq_minimal_get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __( '% Comments', 'nadzhq-minimal' ) : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __( 'No Comments', 'nadzhq-minimal' ) : $zero;
    else // must be one
        $output = ( false === $one ) ? __( '1 Comment', 'nadzhq-minimal' ) : $one;
 
    return apply_filters('comments_number', $output, $number);
}


//----------------------------------------------------------------------------------
//  Register Sidebar
//----------------------------------------------------------------------------------


function nadzhq_minimal_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar', 'nadzhq-minimal' ),
    'id' => 'sidebar-1',
    'before_widget' => '<aside class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

 
 }
add_action( 'widgets_init', 'nadzhq_minimal_widgets_init' );



// return entry meta information for posts, used by multiple loops.
if(!function_exists('nadzhq_minimal_entry_meta')) :
    function nadzhq_minimal_entry_meta() {
        echo '<span class="byline author">'. __('<i class="fa fa-pencil"></i>&nbsp;Written by', 'nadzhq-minimal') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .', </a></span>';
        echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate><i class="fa fa-clock-o"></i>&nbsp;'. get_the_time('F jS, Y') .'</time>';
    }
endif;


// Posts Alternate Classes.
function nadzhq_minimal_oddeven_post_class ( $classes ) {
   global $current_class;
   $classes[] = $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   return $classes;
}
add_filter ( 'post_class' , 'nadzhq_minimal_oddeven_post_class' );
global $current_class;
$current_class = 'odd';



/**
 ** Sidebar Menus
 **/
function nadzhq_minimal_sidebar_nav(){


$menu_default_setting = array(
    'theme_location'  => 'primary',
    'container'       => false,
    'menu_class'      => 'menu',
    'menu_id'         => false,
    'echo'            => true,
    'link_before'     => '<i class="fa fa-angle-right"></i>&nbsp;',
    'fallback_cb'     => 'nadzhq_minimal_custom_fallback_message',
    'items_wrap'      => '<ul class="sf-menu sf-vertical">%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''
);

wp_nav_menu( $menu_default_setting );

}



/**
 ** A fallback when no navigation is selected by default, otherwise it throws some nasty errors in your face.
 **/
function nadzhq_minimal_custom_fallback_message(){

    echo '<div class="alert alert-success">';
    // Translators 1: Link to Menus, 2: Link to Customize
    printf( __( 'Please assign a menu to the primary menu location under %1$s or select the menu from the general option setting page.', 'nadzhq-minimal' ),
        sprintf(  __( '<a href="%s">Menus</a>', 'nadzhq-minimal' ),
            get_admin_url( get_current_blog_id(), 'nav-menus.php' )
        ),
        sprintf(  __( '<a href="%s">Customize</a>', 'nadzhq-minimal' ),
            get_admin_url( get_current_blog_id(), 'customize.php' )
        )
    );
    echo '</div>';

}










