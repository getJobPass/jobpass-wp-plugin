<?php
/*
  Plugin Name: Jobpass
  Plugin URI: https://wordpress.org/plugins/jobpass/
  Description: Ce plugin Jobpass pour WordPress vous permet de simplement poster vos offres d'emploi sur votre site et de simplfier vos process de candidatures en permettant à vos candidats de vous partager toutes leurs informations en quelques clics ! Votre recrutement simple, rapide et sécurisé ! 
  Author: JobPass
  Author URI: https://jobpass.com
  Version: 1.1.0
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

function jobpass_rewrite_hiring_space() {

  return flush_rewrite_rules();
  }
  add_action('init', 'jobpass_rewrite_hiring_space');

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
el.setAttribute('data-sid', '<?php echo esc_attr(get_option( "jobpassIdKey" )); ?>');
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
function jobpass_joboffers_post_type() {
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
			'show_in_menu' => false
            
		)
	);
}
add_action('init', 'jobpass_joboffers_post_type');

add_filter('single_template', 'jobpass_joboffer_template');

function jobpass_joboffer_template($single) {

    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'joboffers' ) {
        if ( file_exists( JOBPASS_PATH . '/public/single-jobpass-offer.php' ) ) {
            return JOBPASS_PATH . '/public/single-jobpass-offer.php';
    }
}
    return $single;
}


function jobpass_add_css_file() {
    ?>

<?php 
    wp_enqueue_style('jobpass-css', plugin_dir_url(__FILE__) . 'public/assets/jobpass.css') ;
    wp_enqueue_style('fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
 }

 add_action( 'jobpass-style', 'jobpass_add_css_file' );


 include(__DIR__ . '/inc/metajoboffers-fields.php');

add_filter('template_include', 'jobpass_joboffers_archive', 100);

function jobpass_joboffers_archive( $jobpass_template ) {
  if ( is_post_type_archive('joboffers') ) {
    $theme_files = array('archives-joboffers.php', 'jobpass/joboffers-archive.php');
    $exists_in_theme = locate_template($theme_files, false);
    if ( $exists_in_theme != '' ) {
      return $exists_in_theme;
    } else {
      return JOBPASS_PATH . '/public/archives-joboffers.php';
    }
  }
  return $jobpass_template;
}

function jobpass_template_chooser($jobpass_template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == sanitize_key('joboffers') )   
  {
    return locate_template(JOBPASS_PATH . '/public/job-search.php');  //  redirect to archive-search.php
  }   
  return $jobpass_template;   
}
add_filter('template_include', 'jobpass_template_chooser');    