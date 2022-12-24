<?php
/*
  Plugin Name: JobPass
  Plugin URI: https://wordpress.org/plugins/jobpass/
  Description: Ne recevez que des candidatures complètes et optimisez vos recrutements en permettant à vos candidats de postuler en un clic depuis votre site web ou votre point de vente !
  Author: JobPass
  Author URI: https://jobpass.com
  Version: 1.0.6
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



add_action('init', 'jobpass_joboffers_post_type');

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
        'view_item' => 'Voir l\'offre',
        'view_items' => 'Voir les offres',
        "search_items" => "Rechercher des offres d'emplois",
        "not_found" =>  "Aucune offre d'emploi trouvée",
        "featured_image" =>  "Image mise en avant pour cette offre",
        "name_admin_bar" =>  "Offre d'emploi",
			),
      
			'public' => true,
      "show_ui" => true,
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'has_archive' => true,
            'rewrite' => array('slug' => 'recrutement'),
			'show_in_menu' => false,
      'capability_type' => 'post',
            
		)
	);
  register_taxonomy('etablissements', ['joboffers'], [
		'label' => __('Établissements', 'txtdomain'),
		'hierarchical' => true,
		'rewrite' => ['slug' => 'etablissement'],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'labels' => [
			'singular_name' => __('Établissement', 'txtdomain'),
			'all_items' => __('Tous les établissements', 'txtdomain'),
			'edit_item' => __('Modifier l\'établissement', 'txtdomain'),
			'view_item' => __('Voir l\'établissement', 'txtdomain'),
			'update_item' => __('Mettre à jour l\'établissement', 'txtdomain'),
			'add_new_item' => __('Ajouter un nouvel établissement', 'txtdomain'),
			'new_item_name' => __('Nom de l\'établissement', 'txtdomain'),
			'search_items' => __('Rechercher un établissement', 'txtdomain'),
			'parent_item' => __('Établissement parent', 'txtdomain'),
			'parent_item_colon' => __('Établissement parent :', 'txtdomain'),
			'not_found' => __('Aucun établissement trouvé', 'txtdomain'),
		]
	]);
	
  register_taxonomy_for_object_type( 'etablissements', 'joboffers' );
}

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


 function mj_taxonomy_add_custom_meta_field() {
  ?>
<div class="form-field">
    <label for="term_meta[class_term_meta]"><?php _e( 'Add Class', 'MJ' ); ?></label>
    <input type="text" name="term_meta[class_term_meta]" id="term_meta[class_term_meta]" value="">
    <p class="description"><?php _e( 'Enter a value for this field','MJ' ); ?></p>
</div>
<?php
}
add_action( 'etablissements_add_form_fields', 'mj_taxonomy_add_custom_meta_field', 10, 2 );



 function mj_taxonomy_edit_custom_meta_field($term) {

  $t_id = $term->term_id;
  $term_meta = get_option( "taxonomy_$t_id" ); 
 ?>
<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[class_term_meta]"><?php _e( 'Add Class', '' ); ?></label></th>
    <td>
        <input type="text" name="term_meta[class_term_meta]" id="term_meta[class_term_meta]"
            value="<?php echo esc_attr( $term_meta['class_term_meta'] ) ? esc_attr( $term_meta['class_term_meta'] ) : ''; ?>">
        <p class="description"><?php _e( 'Enter a value for this field','MJ' ); ?></p>
    </td>
</tr>
<?php
}

add_action( 'etablissements_edit_form_fields','mj_taxonomy_edit_custom_meta_field', 10, 2 );

 function mj_save_taxonomy_custom_meta_field( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {

      $t_id = $term_id;
      $term_meta = get_option( "taxonomy_$t_id" );
      $cat_keys = array_keys( $_POST['term_meta'] );
      foreach ( $cat_keys as $key ) {
          if ( isset ( $_POST['term_meta'][$key] ) ) {
              $term_meta[$key] = $_POST['term_meta'][$key];
          }
      }
      // Save the option array.
      update_option( "taxonomy_$t_id", $term_meta );
  }

}  
add_action( 'edited_etablissements', 'mj_save_taxonomy_custom_meta_field', 10, 2 );  
add_action( 'create_etablissements', 'mj_save_taxonomy_custom_meta_field', 10, 2 );