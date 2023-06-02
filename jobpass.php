<?php
/*
  Plugin Name: Jobpass
  Plugin URI: https://wordpress.org/plugins/jobpass/
  Description: Ce plugin Jobpass pour WordPress vous permet de simplement poster vos offres d'emploi sur votre site et de simplfier vos process de candidatures en permettant à vos candidats de vous partager toutes leurs informations en quelques clics ! Votre recrutement simple, rapide et sécurisé ! 
  Author: JobPass
  Author URI: https://jobpass.com
  Version: 1.1.1
  License: GPL v2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
defined( 'ABSPATH' ) or die();

define( 'JOBPASS_FILE', __FILE__ );
define( 'JOBPASS_PATH', realpath( plugin_dir_path( JOBPASS_FILE ) ) . '/' );

if ( is_admin() ) {
	require_once __DIR__ . '/inc/admin.php';
}

function jobpass_rewrite_hiring_space() {
	flush_rewrite_rules();
}
add_action('init', 'jobpass_rewrite_hiring_space');

/* Inline script printed out in the footer */
add_action('wp_footer', 'jobpass_add_script_wp_footer');
function jobpass_add_script_wp_footer() {
	$jobpassIdKey = get_option('jobpassIdKey');
	if (is_singular('joboffers')) {
		?>
<script type="text/javascript">
var el = document.createElement('script');
el.setAttribute('src', 'https://cdn.jobpass.com/jobtag.js');
el.setAttribute('type', 'text/javascript');
el.setAttribute('async', true);
// el.setAttribute('data-sid', '<?php echo esc_attr($jobpassIdKey); ?>');
if (document.body !== null) {
    document.body.appendChild(el);
}
</script>
<?php
	} else {
		?>
<script type="text/javascript">
console.log("JobPass: JobTag cannot be found");
</script>
<?php
	}
}

function jobpass_register_entite_taxonomy() {
	$labels = array(
		'name' => __( 'Entités' ),
		'singular_name' => __( 'Entité' ),
		'search_items' => __( 'Rechercher une entité' ),
		'all_items' => __( 'Toutes les entités' ),
		'edit_item' => __( 'Modifier l\'entité' ),
		'update_item' => __( 'Mettre à jour l\'entité' ),
		'add_new_item' => __( 'Ajouter une nouvelle entité' ),
		'new_item_name' => __( 'Nom de la nouvelle entité' ),
		'menu_name' => __( 'Entités' ),
	);

	register_taxonomy( 'entite', 'entite', array(
		'hierarchical' => true,
		'labels' => $labels,
		'rewrite' => array( 'slug' => 'entite' ),
		'show_admin_column' => true,
		'show_in_rest' => true,
	));
}
add_action( 'init', 'jobpass_register_entite_taxonomy' );

function jobpass_joboffers_post_type() {
	$enable_taxonomy = get_option('JobpassManyEntities');
	$taxonomies = array();
	if ($enable_taxonomy) {
		$taxonomies[] = 'entite';
	}

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
			'show_in_menu' => false,
			'taxonomies' => $taxonomies
		)
	);
}
add_action('init', 'jobpass_joboffers_post_type');

add_filter('single_template', 'jobpass_joboffer_template');

// Ajoute les champs d'entrée personnalisés dans le formulaire de création/édition des catégories
function jobpass_category_fields( $tag ) {
	$organization_id = get_term_meta( $tag->term_id, 'organization_id', true );
	$script_id = get_term_meta( $tag->term_id, 'script_id', true );
	?>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="organization_id"><?php _e( 'Organization ID' ); ?></label>
    </th>
    <td>
        <input type="text" name="organization_id" id="organization_id"
            value="<?php echo esc_attr( $organization_id ); ?>">
        <p class="description"><?php _e( 'Ajoutez l\'Organisation ID de votre entité' ); ?></p>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="script_id"><?php _e( 'Script ID' ); ?></label>
    </th>
    <td>
        <input type="text" name="script_id" id="script_id" value="<?php echo esc_attr( $script_id ); ?>">
        <p class="description"><?php _e( 'Ajoutez le ScriptID de votre entité' ); ?></p>
    </td>
</tr>
<?php
}
add_action( 'entite_edit_form_fields', 'jobpass_category_fields', 10, 2 );
add_action( 'entite_add_form_fields', 'jobpass_category_fields', 10, 2 );

// Enregistre les valeurs des champs d'entrée personnalisés
function jobpass_save_category_fields( $term_id ) {
	if ( isset( $_POST['organization_id'] ) ) {
		update_term_meta( $term_id, 'organization_id', sanitize_text_field( $_POST['organization_id'] ) );
	}
	if ( isset( $_POST['script_id'] ) ) {
		update_term_meta( $term_id, 'script_id', sanitize_text_field( $_POST['script_id'] ) );
	}
}
add_action( 'edited_entite', 'jobpass_save_category_fields', 10, 2 );
add_action( 'create_entite', 'jobpass_save_category_fields', 10, 2 );

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
	wp_enqueue_style('jobpass-css', plugin_dir_url(__FILE__) . 'public/assets/jobpass.css');
	wp_enqueue_style('fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}

add_action( 'wp_enqueue_scripts', 'jobpass_add_css_file' );

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

function jobpass_template_chooser($jobpass_template) {
	global $wp_query;
	$post_type = get_query_var('post_type');
	if( $wp_query->is_search && $post_type == sanitize_key('joboffers') ) {
		return locate_template(JOBPASS_PATH . '/public/job-search.php');  // redirect to archive-search.php
	}
	return $jobpass_template;
}
add_filter('template_include', 'jobpass_template_chooser');

function jobpass_plugin_settings() {
	add_settings_section(
		'jobpass_taxonomy_section',
		 'Options de la taxonomie',
		'jobpass_taxonomy_section_callback',
		'jobpass_plugin'
	);

	add_settings_field(
		'jobpass_enable_taxonomy',
		'Activer la taxonomie Entité',
		'jobpass_enable_taxonomy_callback',
		'jobpass_plugin',
		'jobpass_taxonomy_section'
	);

	register_setting('jobpass_plugin', 'jobpass_enable_taxonomy');
}
add_action('admin_init', 'jobpass_plugin_settings');

function jobpass_taxonomy_section_callback() {
	echo 'Choisissez les options de la taxonomie pour le type "joboffers".';
}

function jobpass_enable_taxonomy_callback() {
	$enable_taxonomy = get_option('jobpass_enable_taxonomy');
	echo '<input type="checkbox" name="jobpass_enable_taxonomy" value="1" ' . checked(1, $enable_taxonomy, false) . ' />';
}
?>