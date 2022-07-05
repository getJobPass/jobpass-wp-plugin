<?php
/*
  Plugin Name: JobPass
  Plugin URI: https://wordpress.org/plugins/jobpass/
  Description: JobPass postulez partout, en 1 clic
  Author: JobPass
  Author URI: https://jobpass.com
  Version: 1.0.0
*/

defined( 'ABSPATH' ) or die( 'Hack me not' );

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

/* Inline script printed out in the footer */
add_action('wp_footer', 'jobpass_add_script_wp_footer');
function jobpass_add_script_wp_footer() {

    if( get_option( 'jobpassIdKey' )) {
    ?>
        <script type="text/javascript">
            var el = document.createElement('script');
            el.setAttribute('src', 'https://cdn.jobpass.com/jobslick.js');
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
			'rewrite' => array( 'slug' => 'offres-emploi'),
				'menu_position' => 5,

		)
	);
}
add_action('init', 'joboffers_post_type');

function create_joboffers_taxonomy() {
    register_taxonomy('categories','joboffers',array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x( 'Catégories', 'taxonomy general name' ),
            'singular_name' => _x( 'Catégorie', 'taxonomy singular name' ),
            'menu_name' => __( 'Catégories' ),
            'all_items' => __( 'Toutes les catégories' ),
            'edit_item' => __( 'Modifier les catégories' ),
            'update_item' => __( 'Mettre à jour les catégories' ),
            'add_new_item' => __( 'Ajouter des catégories' ),
            'new_item_name' => __( 'Nouvelle catégorie' ),
        ),
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    ));
}
add_action( 'init', 'create_joboffers_taxonomy', 0 );
