<?php
/*
  Plugin Name: JobPass
  Plugin URI: https://wordpress.org/plugins/jobpass/
  Description: Ne recevez que des candidatures complètes et optimisez vos recrutements en permettant à vos candidats de postuler en un clic depuis votre site web ou votre point de vente !
  Author: JobPass
  Author URI: https://jobpass.com
  Version: 1.0.0
  License: GPL v2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die();

define( 'JOBPASS_FILE'            	, __FILE__ );
define( 'JOBPASS_PATH'       		, realpath( plugin_dir_path( JOBPASS_FILE ) ) . '/' );
/*
if(is_user_admin()) {
	require(JOBPASS_PATH . '/inc/admin.php');
}
*/

if ( is_admin() ) {
	// we are in admin mode
	//require_once __DIR__ . '/admin/plugin-name-admin.php';
	require_once __DIR__ . '/inc/admin.php';
}

function rewrite_hiring_space() {

  return flush_rewrite_rules();
  }
  add_action('init', 'rewrite_hiring_space');

/* Inline script printed out in the footer */
add_action('wp_footer', 'jobpass_add_script_wp_footer');
function jobpass_add_script_wp_footer() {

    if( get_option( 'jobpassIdKey' )) {
    ?>
        <script type="text/javascript">
            var el = document.createElement('script');
            el.setAttribute('src', 'https://cdn.jobpass.com/jobtag.js');
            el.setAttribute('type', 'text/javascript');
            el.setAttribute('async', true);
            el.setAttribute('data-sid', '<?php echo get_option( "jobpassIdKey" ); ?>');
            if (document.body !== null) {
                document.body.appendChild(el);
            }
        </script>
    <?php
    } else {
	    ?>
        <script type="text/javascript">
            console.log("JobPass : JobTag cannot be found")
        </script>
	    <?php
    }
}
function joboffers_post_type() {
	register_post_type( 'joboffers',
		array(
			'labels' => array(
				'name' => __('Offres d\'emploi'),
				'singular_name' => __( 'Offre d\'emploi' ),
				'all_items' => 'Toutes les offres',
				'edit_item' => 'Modifier l\'offre',
				'update_item' => 'Mettre à jour l\'offre',
				'add_new_item' => 'Ajouter une offre d\'emploi',
				'new_item_name' => 'Nouvelle offre d\'emploi',
			),
			'public' => true,
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'has_archive' => true,
            'rewrite' => array('slug' => 'recrutement'),
			'show_in_menu' => true
            
		)
	);
}
add_action('init', 'joboffers_post_type');

// function create_joboffers_taxonomy() {
//     register_taxonomy('categorie','joboffers',array(
//         'hierarchical' => false,
//         'labels' => array(
//             'name' => _x( 'Catégories', 'taxonomy general name' ),
//             'singular_name' => _x( 'Catégorie', 'taxonomy singular name' ),
//             'menu_name' => __( 'Catégories' ),
//             'all_items' => __( 'Toutes les catégories' ),
//             'edit_item' => __( 'Modifier les catégories' ),
//             'update_item' => __( 'Mettre à jour les catégories' ),
//             'add_new_item' => __( 'Ajouter des catégories' ),
//             'new_item_name' => __( 'Nouvelle catégorie' ),
//         ),
//     'show_ui' => true,
//     'show_in_rest' => true,
//     'show_admin_column' => true,
//     'rewrite' => array('slug' => 'recrutement/categorie'),

//     ));
// }
// add_action( 'init', 'create_joboffers_taxonomy', 0 );

add_filter('single_template', 'joboffer_template');

// function wpa_course_post_link( $post_link, $id = 0 ){
//     $post = get_post($id);  
//     if ( is_object( $post ) ){
//         $terms = wp_get_object_terms( $post->ID, 'joboffers' );
//         if( $terms ){
//             return str_replace( '%recrutement%' , $terms[0]->slug , $post_link );
//         }
//     }
//     return $post_link;  
// }
// add_filter( 'post_type_link', 'wpa_course_post_link', 10, 3 );

function joboffer_template($single) {

    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'joboffers' ) {
        if ( file_exists( JOBPASS_PATH . '/public/single-jobpass-offer.php' ) ) {
            return JOBPASS_PATH . '/public/single-jobpass-offer.php';
    }
}
    return $single;
}


function add_css_file() {
    ?>
<link rel="stylesheet" href="<?php echo esc_url('/wp-content/plugins/jobpass/public/assets/jobpass.css' ); ?>"/>
    <script src="https://kit.fontawesome.com/2fba8b9ac4.js" crossorigin="anonymous"></script>
    <?php
 }
 add_action( 'jobpass-style', 'add_css_file' );

 include(__DIR__ . '/inc/metajoboffers-fields.php');


 add_filter('template_include', 'joboffers_archive', 100);

function joboffers_archive( $template ) {
  if ( is_post_type_archive('joboffers') ) {
    $theme_files = array('archives-joboffers.php', 'jobpass/joboffers-archive.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return JOBPASS_PATH . '/public/archives-joboffers.php';
    }
  }
  return $template;
}

function template_chooser($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'joboffers' )   
  {
    return locate_template(JOBPASS_PATH . '/public/job-search.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'template_chooser');    

