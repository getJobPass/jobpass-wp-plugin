<?php
defined( 'ABSPATH' ) or die( 'Hack me not' );

add_action( 'admin_menu', 'jobpass_settings' );
function jobpass_settings() {
	add_menu_page("Jobpass","Jobpass",'manage_options',"jobpass",'jobpass_config_page', plugin_dir_url( __FILE__ ) . 'images/icone-jobpass_square.jpg',5,);

	add_submenu_page(
        'jobpass',
        'Toutes les offres', //page title
        'Toutes les offres d\'emploi', //menu title
        'manage_options', //capability,
        'edit.php?post_type=joboffers',//menu slug
        
    );
	add_submenu_page(
        'jobpass',
        'Ajouter une offre', //page title
        'Ajouter une offre d\'emploi', //menu title
        'manage_options', //capability,
        'post-new.php?post_type=joboffers',//menu slug
        
    );
	add_submenu_page(
        'jobpass',
        'Entités', //page title
        'Entités', //menu title
        'manage_options', //capability,
        'edit-tags.php?taxonomy=entity&post_type=joboffers',
        
    );
}

function jobpass_config_page() {
	if ( isset( $_POST['updated'] ) && $_POST['updated'] === 'true' ) {
		sanitize_key(jobpass_handle_form());
	}
	echo jobpass_display_form();
}

function jobpass_display_form() {
	return '
	<div class="row jp_header" style="background-color: #fff">
	<div class="jp_logo-container">
	<svg
	id="Calque_2"
	data-name="Calque 2"
	xmlns="http://www.w3.org/2000/svg"
	viewBox="0 0 1664.56 475.37"
	class="logo"
	width:100px;
  >
	<defs>
	  <style>
		.cls-1 {
		  fill: #273547;
		}
	  </style>
	</defs>
	<g id="Calque_1-2" data-name="Calque 1">
	  <g>
		<path
		  class="cls-1"
		  d="m1317.27,286.47c3.22,19.99,21.13,27.43,40.88,27.43s29.86-8.37,29.86-18.6c0-7.9-5.97-13.95-22.97-17.2l-46.86-9.3c-42.72-7.91-67.07-31.15-67.07-67.89,0-47.89,40.88-79.05,99.22-79.05s95.55,26.5,104.73,66.96l-67.07,13.48c-2.3-14.41-16.08-27.43-38.59-27.43-19.75,0-26.18,9.76-26.18,18.13,0,6.51,2.76,13.02,17.46,16.27l54.2,11.16c43.64,9.3,63.85,35.8,63.85,70.21,0,51.61-44.1,78.58-104.73,78.58-54.2,0-100.6-19.99-108.41-67.89l71.66-14.88Z"
		/>
		<path
		  class="cls-1"
		  d="m1523.08,286.47c3.22,19.99,21.13,27.43,40.88,27.43s29.86-8.37,29.86-18.6c0-7.9-5.97-13.95-22.97-17.2l-46.86-9.3c-42.72-7.91-67.07-31.15-67.07-67.89,0-47.89,40.88-79.05,99.22-79.05s95.55,26.5,104.73,66.96l-67.07,13.48c-2.3-14.41-16.08-27.43-38.59-27.43-19.75,0-26.18,9.76-26.18,18.13,0,6.51,2.76,13.02,17.46,16.27l54.2,11.16c43.64,9.3,63.85,35.8,63.85,70.21,0,51.61-44.1,78.58-104.73,78.58-54.2,0-100.6-19.99-108.41-67.89l71.66-14.88Z"
		/>
		<path
		  class="cls-1"
		  d="m0,335.38c17.26,17.14,40.4,28.56,68.66,32.42,7.01.96,14.34,1.45,21.98,1.45,75.34,0,125.56-49.3,125.56-119.05V.07h-76.94v69.76l.2,180.37c0,29.76-19.53,50.69-48.83,50.69-8.31,0-15.65-1.52-21.97-4.41-2.29-1.05-4.45-2.27-6.48-3.67L0,335.38Z"
		/>
		<path
		  class="cls-1"
		  d="m863.11,121.79c-30.71,0-54.9,9.77-72.58,26.98v-20.01h-74.44v.31l79.72,92.05c9.83-21.53,31.54-36.51,56.75-36.51,34.45,0,62.37,27.92,62.37,62.37s-27.92,62.37-62.37,62.37c-25.22,0-46.92-14.97-56.75-36.51l-79.72,95.64v106.88h74.44v-133.06c17.68,17.21,41.87,26.98,72.58,26.98,61.88,0,113.98-49.78,113.98-123.75s-52.11-123.75-113.98-123.75Z"
		/>
		<path
		  class="cls-1"
		  d="m1166.64,130.36v19.77c-17.92-16.08-41.8-25.26-71.66-25.26-61.09,0-112.54,49.61-112.54,122.19s51.45,122.19,112.54,122.19c29.86,0,53.74-9.19,71.66-25.26v21.17h73.5v-234.79h-73.5Zm-62.62,178.99c-34.35,0-62.2-27.85-62.2-62.2s27.85-62.2,62.2-62.2,62.2,27.85,62.2,62.2-27.85,62.2-62.2,62.2Z"
		/>
		<path
		  class="cls-1"
		  d="m350.8,124.17c-70.69,0-129.28,49.3-129.28,122.77s58.59,123.24,129.28,123.24,127.89-49.3,127.89-123.24-58.59-122.77-127.89-122.77Zm-.7,185.2c-34.35,0-62.2-27.85-62.2-62.2s27.85-62.2,62.2-62.2,62.2,27.85,62.2,62.2-27.85,62.2-62.2,62.2Z"
		/>
		<path
		  class="cls-1"
		  d="m631.49,121.85c-30.23,0-54.41,9.3-72.55,25.58V0h-74.41v367.87h74.41v-24.2c18.13,16.28,42.32,25.58,72.55,25.58,61.85,0,113.93-49.76,113.93-123.7s-52.08-123.7-113.93-123.7Zm-8.45,187.53c-34.35,0-62.2-27.85-62.2-62.2s27.85-62.2,62.2-62.2,62.2,27.85,62.2,62.2-27.85,62.2-62.2,62.2Z"
		/>
	  </g>
	</g>
  </svg>
	  <h1>' . __( 'Jobpass - Le Passeport professionnel', 'jobpass' ) . '</h1>
	</div>
	<div>
	  <a href="https://beta.jobpass.com" target="blank" class="button jobpassBtn">
		Accéder à Jobpass
	  </a>
	</div>
  </div>
  
  <div class="wrap">
  <div>
	<div class="jp_intro jobpassDiv">
	  <h2>
		Ne recevez que des candidatures complètes & <br />permettez à vos
		candidats de postuler en 1 clic !
	  </h2>
	  <p>
		<strong
		  >Configurez Jobpass rapidement et simplement et utilisez ce plugin pour
		  :</strong
		>
	  </p>
	  <ul class="fa-ul">
		<li>
		  <span class="fa-li"><i class="fas fa-inbox"></i></span> Installer vos
		  récepteurs de candidatures
		</li>
		<li>
		  <span class="fa-li"><i class="fas fa-cogs"></i></span> Configurer votre
		  espace recrutement
		</li>
		<li>
		  <span class="fa-li"><i class="fas fa-bullhorn"></i></span> Diffuser vos
		  offres d\'emploi
		</li>
		<li>
		  <span class="fa-li"><i class="fas fa-trophy"></i></span> Recruter plus
		  rapidement
		</li>
	  </ul>
	  <p>
		<strong>Besoin d\'aide dans la configuration du plugin ?</strong
		><a
		  href="https://support.jobpass.com/installer-configurer-lextension-jobpass-pour-wordpress"
		  target="_blank"
		  >Consultez notre centre d\'aide !</a
		>
	  </p>
	</div>
  
	<form method="post" action="" id="jobpass_options" accept-charset="utf-8">
	  <div class="jobpassDiv">
		<h2>Informations de connexion</h2>
		<input type="hidden" name="updated" value="true" />
		' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
		<label>
		  ' . __( 'Script ID', 'jobpass' ) . '
		  <br />
		  <input
			type="text"
			name="jobpassIdKey"
			value="' . get_option( 'jobpassIdKey' ) . '"
		  />
		</label>
		<label>
		  ' . __( 'Organisation ID', 'jobpass' ) . '
		  <br />
		  <input
			type="text"
			name="JobpassOrganisationId"
			value="' . get_option( 'JobpassOrganisationId' ) . '"
		  />
		</label>
		<label>
		  Autoriser les candidatures spontanées ?
		  <br />
		  <input size="76" name="JobpassSpontaneousApplication" type="checkbox"
		  id="JobpassSpontaneousApplication" ' .
		  checked((get_option("JobpassSpontaneousApplication")), 1, false) .'
		  value="1" />
		</label>
		<label>
		  <span>Description candidature spontanée</span>
		  <br />
		  <textarea
			name="JobpassSpontaneousDescription"
			class="all-options"
			style="width: 100%"
			rows="5"
		  >
  '. stripslashes(get_option( 'JobpassSpontaneousDescription' )) .  '</textarea
		  >
		</label>
		<label>
		  Activer les crédits ?
		  <br />
		  <input size="76" name="JobpassAllowCredits" type="checkbox"
		  id="JobpassAllowCredits" ' .
		  checked((get_option("JobpassAllowCredits")), 1, false) .' value="1" />
		</label>
		<input
		  class="button button-primary"
		  type="submit"
		  value="' . __( 'Enregistrer', 'jobpass' ) . '"
		/>
	  </div>
	  <div class="jobpassDiv">
		<h2>Design de vos offres d\'emploi</h2>
		<input type="hidden" name="updated" value="true" />
		' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
		<label>
		  <span class="mr-5">' .'<span class="mr-5"><strong>' . __('Couleur de fond', 'jobpass' ) . ' </strong></span>' . '
		  <input
			type="text"
			class="color-picker"
			data-alpha-enabled="false"
			data-default-color="#EFF9FF"
			name="JobpassHeaderBackgroundColor"
			value="' .  esc_attr( get_option( 'JobpassHeaderBackgroundColor', '#EFF9FF'  ) ) . '"
		  />
		  </label>
		  <label>
		  <span class="mr-5">' .'<span class="mr-5"><strong>' . __('Couleur du titre principal', 'jobpass' ) . ' </strong></span>' . '
		  <input
			type="text"
			class="color-picker"
			data-alpha-enabled="false"
			data-default-color="#0F0649"
			name="JobpassMainTitle"
			value="' .  esc_attr( get_option( 'JobpassMainTitle', '#0F0649'  ) ) . '"
		  />
		  </label>
		  <label>
		  <span class="mr-5">' .'<span class="mr-5"><strong>' . __('Couleur des titres', 'jobpass' ) . ' </strong></span>' . '
		  <input
			type="text"
			class="color-picker"
			data-alpha-enabled="false"
			data-default-color="#0F0649"
			name="JobpassFontTitleColor"
			value="' .  esc_attr( get_option( 'JobpassFontTitleColor', '#0F0649'  ) ) . '"
		  />
		  </label>
		  <label>
		  <span class="mr-5">' .'<span class="mr-5"><strong>' . __('Couleur des données de l\'offre', 'jobpass' ) . ' </strong></span>' . '
		  <input
			type="text"
			class="color-picker"
			data-alpha-enabled="false"
			data-default-color="#6B7280"
			name="JobpassOffersData"
			value="' .  esc_attr( get_option( 'JobpassOffersData', '#6B7280'  ) ) . '"
		  />
		  </label>
		<input
		  class="button button-primary"
		  type="submit"
		  value="' . __( 'Enregistrer', 'jobpass' ) . '"
		/>
	  </div>
	  <div class="jobpassDiv">
		<h2>Présentation de l\'entreprise</h2>
		<input type="hidden" name="updated" value="true" />
		' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
		
		<label>
		  <span>Description de votre entreprise</span>
		  <br />
		  <textarea
			name="JobpassCompanyDescription"
			class="all-options"
			style="width: 100%"
			rows="5"
		  >
  '.stripslashes(get_option( 'JobpassCompanyDescription' )) .'</textarea
		  >
		</label>
		<label> </label>
		<input
		  class="button button-primary"
		  type="submit"
		  value="' . __( 'Enregistrer', 'jobpass' ) . '"
		/>
	  </div>
	</form>
  </div>
  
  </div>
		  <style>

        </style>
		<script type="text/javascript" id="hs-script-loader" async defer src="//js-eu1.hs-scripts.com/25126081.js"></script>
		'
        ;
}

function jobpass_handle_form() {
	if (
		! isset( $_POST['jobpass_form'] ) ||
		! wp_verify_nonce( $_POST['jobpass_form'], 'jobpass_update' )
	) { ?>
<div class="error">
    <p><?php echo __( 'Sorry, an error occured. Please try again. Contact us if the problem persist.', 'jobpass' ); ?>
    </p>
</div> <?php
		exit;
	} else {
		// Handle our form data
		if ( isset( $_POST['jobpassIdKey'] ) && isset( $_POST['JobpassOrganisationId'] ) && isset($_POST['JobpassHeaderBackgroundColor']) && isset($_POST['JobpassFontTitleColor']) ) {
			update_option( 'jobpassIdKey', sanitize_text_field( $_POST['jobpassIdKey'] ) );
			update_option('JobpassOrganisationId', sanitize_text_field( $_POST['JobpassOrganisationId']));
			?>

<?php 
			if( isset($_POST['JobpassHeaderBackgroundColor']) && isset($_POST['JobpassFontTitleColor'])) {
				update_option('JobpassHeaderBackgroundColor', sanitize_hex_color($_POST['JobpassHeaderBackgroundColor']));
				update_option('JobpassFontTitleColor', sanitize_hex_color($_POST['JobpassFontTitleColor']));
				update_option('JobpassMainTitle', sanitize_hex_color($_POST['JobpassMainTitle']));
				update_option('JobpassOffersData', sanitize_hex_color($_POST['JobpassOffersData']));
			}
			
		?>
<?php
				if ( isset( $_POST['jobpassIdKey'] ) && isset( $_POST['JobpassCompanyDescription']) ) {
					update_option( 'JobpassCompanyName', sanitize_text_field( $_POST['JobpassCompanyName'] ) );
					update_option('JobpassCompanyDescription',  sanitize_textarea_field($_POST['JobpassCompanyDescription']));
				}
		?>
<?php
				if ( isset( $_POST['JobpassSpontaneousDescription'] ) ) {
					update_option('JobpassSpontaneousDescription',  sanitize_textarea_field($_POST['JobpassSpontaneousDescription']));
				}
		?>
<?php 
			$JobpassAllowSpontaneous = sanitize_key($_POST['JobpassSpontaneousApplication']) ? sanitize_key($_POST['JobpassSpontaneousApplication']) : '';
			update_option('JobpassSpontaneousApplication',sanitize_key($JobpassAllowSpontaneous ));

			$JobpassAllowCredits = sanitize_key($_POST['JobpassAllowCredits']) ? sanitize_key($_POST['JobpassAllowCredits']) : '';
			update_option('JobpassAllowCredits',sanitize_key($JobpassAllowCredits))
			
		?>
<?php 
				$jobpass_content = '';
				if (isset($_POST) && !empty($_POST)) {
					if (isset($_POST['submit']) && $_POST['submit'] != '') {
						$jobpass_content=sanitize_key($_POST['jobpass_editor']);
					}
				}
				$jobpass_editor_id = 'jobpass_editor';
		?>

<div class="notice notice-success is-dismissible">
    <p><?php echo __( 'Vos paramètres ont été sauvegardés', 'jobpass' ); ?></p>
</div>
<?php
		} else {
			?>
<div class="notice notice-error is-dismissible">
    <p><?php echo __( 'Désolé, vos paramètres n\'ont pas pu être sauvegardés', 'jobpass' ); ?></p>
</div>
<?php
		}
	}
}

add_filter('plugin_action_links', 'jobpass_plugin_settings_link', 10, 2);
function jobpass_plugin_settings_link($jp_links, $jp_file) {

    if ( $jp_file == 'jobpass/jobpass.php' ) {
        /* Insert the link at the end*/
        $jp_links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'options-general.php?page=jobpass' ), __( 'Paramètres', 'plugin_domain' ) );
				$jp_links['jobpass_register'] = sprintf( '<a href="https://beta.jobpass.com/recruiter/auth/register/" target="_blank"> Inscription Recruteur </a>' );
				$jp_links['organisation'] = sprintf('<a href="https://beta.jobpass.com/recruiter/" target="_blank">Espace recruteur</a>');
    }
    return $jp_links;

}

add_action( 'admin_enqueue_scripts', 'jobpass_load_admin_style' );
function jobpass_load_admin_style() {
    //OR
    wp_enqueue_style( 'admin_css', plugin_dir_url(__FILE__). 'style/style.css', false, '1.0.0' );
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}

function jp_color_picker($hook) {
    
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/js/wp-color-picker-alpha.min.js',  __FILE__ ), array( 'wp-color-picker' ), '3.0.0', true );
    wp_enqueue_script( 'wp-color-picker-init',  plugins_url( '/js/wp-color-picker-init.js',  __FILE__ ), array( 'wp-color-picker-alpha' ), '3.0.0', true );
}
add_action( 'admin_enqueue_scripts',  'jp_color_picker' );