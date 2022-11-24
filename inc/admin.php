<?php
defined( 'ABSPATH' ) or die( 'Hack me not' );

add_action( 'admin_menu', 'jobpass_settings' );
function jobpass_settings() {
	add_menu_page("JobPass","JobPass",'manage_options',"jobpass",'jobpass_config_page', plugin_dir_url( __FILE__ ) . 'images/icone-jobpass_square.jpg',5,);

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
	 <svg data-name="Calque 1" width="100px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1680.418 579.746"><path d="m1311.374 752.394-117.752-50.563a101.016 101.016 0 0 0-38.07-7.673L975.923 691.6c-29.512-.394-53.81 14.362-53.712 32.758l.394 86.47 415.33 2.557V784.07c0-12.69-9.935-24.495-26.561-31.676Z" transform="translate(-167.2 -681.446)" style="fill:#0f0649;stroke:#0f0649;stroke-miterlimit:10;stroke-width:20.291752849547336px"/><path d="M1787.892 1251.046H972.283c-27.446 0-49.58-21.642-49.58-48.2V762.723c0-26.659 22.232-48.2 49.58-48.2h815.609c27.446 0 49.58 21.642 49.58 48.2v440.022c0 26.655-22.134 48.301-49.58 48.301Z" transform="translate(-167.2 -681.446)" style="fill:none;stroke:#0f0649;stroke-miterlimit:10;stroke-width:20.291752849547336px"/><path d="M215.108 1123.948a84.1 84.1 0 0 1-34.726-32.561c-8.263-13.969-12.69-30.4-13.182-49.088v-1.869h60.991l.2 1.279a48.465 48.465 0 0 0 5.312 20.56 34.316 34.316 0 0 0 13.28 13.969c5.8 3.344 12.69 5.017 20.954 5.017 13.182 0 23.216-3.935 30.2-11.9 6.985-7.869 10.428-19.379 10.428-34.528V830.01h62.86v205.4q0 47.514-26.954 73.779c-18 17.511-43.284 26.364-75.846 26.364q-31.137.003-53.517-11.605ZM462.122 1121.1a94.611 94.611 0 0 1-38.366-39.94c-9.05-17.412-13.674-38.169-13.674-62.368v-.394q0-36 13.871-61.876a97.157 97.157 0 0 1 38.562-39.841c16.527-9.247 35.906-13.969 58.04-13.969q33.5 0 58.335 13.87a95.117 95.117 0 0 1 38.562 39.743c9.149 17.314 13.773 37.972 13.773 62.172v.393c0 24.3-4.526 45.055-13.674 62.467a95.512 95.512 0 0 1-38.366 39.841q-24.789 13.87-58.531 13.87-33.792-.298-58.532-13.968Zm84.5-41.907c7.181-5.312 12.788-13.084 16.723-23.315s5.9-22.625 5.9-37.185v-.393c0-14.264-1.968-26.561-6-36.693-4.033-10.231-9.641-18-16.92-23.314s-15.838-7.969-25.675-7.969c-9.739 0-18.2 2.656-25.479 8.165s-12.985 13.182-16.92 23.315c-4.033 10.132-6 22.33-6 36.594v.394q0 21.838 5.9 37.185c3.935 10.231 9.641 18 16.921 23.314q11.067 7.968 25.97 7.968c9.842-.004 18.302-2.659 25.582-8.07ZM752.813 1123.555a71.926 71.926 0 0 1-26.855-31.283h-1.181v38.07h-60.794V830.01h60.794v115.884h1.279a72.587 72.587 0 0 1 27.151-31.775c12-7.673 25.872-11.509 41.71-11.509q28.036 0 48.4 13.87c13.576 9.247 24 22.429 31.283 39.743q11.067 25.969 11.018 62.368v.2q0 36.151-11.018 62.27c-7.378 17.313-17.806 30.692-31.381 39.939-13.576 9.346-29.807 13.969-48.5 13.969-16.132-.101-30.101-3.839-41.906-11.414Zm47.908-47.022c7.378-5.312 12.985-12.985 16.92-22.823s5.9-21.543 5.9-34.922v-.2c0-13.575-1.967-25.282-6-35.02s-9.739-17.314-17.019-22.626c-7.378-5.312-16.035-7.87-25.97-7.87a43.181 43.181 0 0 0-25.872 7.968c-7.378 5.312-13.281 12.985-17.511 22.823s-6.394 21.445-6.394 34.725v.2c0 13.477 2.066 25.085 6.2 34.922s10.034 17.412 17.51 22.823a43.691 43.691 0 0 0 25.97 7.968q15.199-.001 26.266-7.968ZM1272.615 1036.1c-11.608.689-20.56 3.444-26.659 8.165s-9.148 11.018-9.148 18.986v.394c0 8.165 3.147 14.559 9.345 19.281 6.2 4.624 14.658 6.984 25.183 6.984a53.38 53.38 0 0 0 24.2-5.312 41.289 41.289 0 0 0 16.822-14.559 36.443 36.443 0 0 0 6.1-20.757v-16.231ZM1089.052 893.854c-10.034-9.05-24-13.673-42.006-13.673h-42.5v106.537h42.5c18 0 32.07-4.623 42.006-13.87C1099.086 963.6 1104 950.517 1104 933.6v-.4c0-17.113-4.914-30.2-14.948-39.346Z" transform="translate(-167.2 -681.446)" style="fill:#0f0649"/><path d="M1785.433 741.672H972.578a57.811 57.811 0 0 0-57.843 57.843v389.261a57.811 57.811 0 0 0 57.843 57.843h812.855a57.811 57.811 0 0 0 57.843-57.843V799.515a57.811 57.811 0 0 0-57.843-57.843ZM1167.947 933.5c0 20.56-4.427 38.463-13.182 53.908a92.176 92.176 0 0 1-36.989 35.906c-15.838 8.558-34.233 12.788-55.383 12.788h-57.844v94.537h-62.86V830.306h120.7q31.576 0 55.383 12.788A92.176 92.176 0 0 1 1154.765 879c8.853 15.445 13.182 33.447 13.182 54.105Zm211.4 197.139h-60.795v-33.053h-1.279a75.933 75.933 0 0 1-16.231 19.576 70.451 70.451 0 0 1-22.331 12.69 81.012 81.012 0 0 1-27.151 4.328c-14.854 0-27.937-2.853-39.25-8.657a65.688 65.688 0 0 1-26.463-23.9q-9.442-15.347-9.443-34.824v-.394q0-30.4 22.822-47.809 22.723-17.412 64.238-20.068l55.187-3.443v-13.679c0-9.837-3.148-17.609-9.346-23.314s-15.346-8.559-27.249-8.559c-11.411 0-20.363 2.361-27.052 6.985a28.6 28.6 0 0 0-12.3 17.8l-.394 1.869h-55.777l.2-2.459a70.643 70.643 0 0 1 13.87-36.595q11.952-16.083 33.349-25.085c14.264-6 31.085-9.05 50.662-9.05 19.281 0 36 3.049 50.17 9.247s25.183 14.854 32.955 26.167c7.87 11.215 11.8 24.4 11.8 39.349v152.872Zm228.52-67.877c0 14.559-4.132 27.249-12.494 38.07s-19.772 19.281-34.43 25.281-31.578 9.051-50.662 9.051q-30.84 0-52.531-8.952c-14.461-6-25.774-14.264-33.84-24.889a74.374 74.374 0 0 1-14.56-36.988l-.2-1.869h59.319l.393 1.869c1.967 8.756 6.3 15.543 13.084 20.363s16.231 7.28 28.331 7.28a60.878 60.878 0 0 0 19.773-2.853c5.41-1.869 9.641-4.525 12.592-7.968a18.668 18.668 0 0 0 4.427-12.493v-.2a17.759 17.759 0 0 0-6.493-14.362c-4.328-3.64-11.9-6.591-22.921-8.952l-37.873-8.165q-32.465-6.641-48.892-22.921c-10.919-10.821-16.428-24.593-16.428-41.218v-.2c0-14.264 3.837-26.659 11.51-37.087s18.592-18.494 32.659-24.2c14.068-5.8 30.594-8.657 49.383-8.657 19.675 0 36.5 3.148 50.269 9.444s24.4 14.854 31.873 25.478a65.812 65.812 0 0 1 11.8 35.611v2.066h-55.974l-.2-1.672a30.059 30.059 0 0 0-11.117-19.872c-6.492-5.312-15.247-7.968-26.56-7.968a50.234 50.234 0 0 0-18.1 2.951 27.369 27.369 0 0 0-11.9 8.165 19.5 19.5 0 0 0-4.132 12.494v.2a18.326 18.326 0 0 0 6.69 14.363c4.427 3.935 12.3 6.984 23.511 9.345l37.874 8.165q35.118 7.23 50.465 21.839c10.231 9.739 15.346 22.724 15.346 39.152v.3Zm219.371 0c0 14.559-4.132 27.249-12.493 38.07s-19.773 19.281-34.431 25.281-31.577 9.051-50.662 9.051q-30.84 0-52.531-8.952c-14.461-6-25.773-14.264-33.84-24.889a74.363 74.363 0 0 1-14.559-36.988l-.2-1.869h59.319l.393 1.869c1.968 8.756 6.3 15.543 13.084 20.363s16.232 7.28 28.331 7.28a60.874 60.874 0 0 0 19.773-2.853c5.411-1.869 9.641-4.525 12.592-7.968a18.668 18.668 0 0 0 4.427-12.493v-.2a17.757 17.757 0 0 0-6.493-14.362c-4.328-3.64-11.9-6.591-22.921-8.952l-37.873-8.165q-32.463-6.641-48.891-22.921c-10.92-10.821-16.429-24.593-16.429-41.218v-.2c0-14.264 3.837-26.659 11.51-37.087s18.592-18.494 32.66-24.2c14.067-5.8 30.594-8.657 49.383-8.657 19.674 0 36.5 3.148 50.268 9.444s24.4 14.854 31.873 25.478a65.821 65.821 0 0 1 11.8 35.611v2.066h-55.974l-.2-1.672a30.061 30.061 0 0 0-11.116-19.872c-6.493-5.312-15.248-7.968-26.561-7.968a50.229 50.229 0 0 0-18.1 2.951 27.367 27.367 0 0 0-11.9 8.165 19.5 19.5 0 0 0-4.131 12.494v.2a18.325 18.325 0 0 0 6.689 14.363c4.427 3.935 12.3 6.984 23.511 9.345l37.874 8.165q35.12 7.23 50.465 21.839c10.231 9.739 15.346 22.724 15.346 39.152v.3Z" transform="translate(-167.2 -681.446)" style="fill:#0f0649"/></svg>
	  <h1>' . __( 'JobPass - Le Passeport professionnel', 'jobpass' ) . '</h1>
	</div>
	<div>
	  <a href="https://beta.jobpass.com" target="blank" class="button jobpassBtn">
		Accéder à JobPass
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
		  >Configurez JobPass rapidement et simplement et utilisez ce plugin pour
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
			name="JobPassOrganisationId"
			value="' . get_option( 'JobPassOrganisationId' ) . '"
		  />
		</label>
		<label>
		  Autoriser les candidatures spontanées ?
		  <br />
		  <input size="76" name="JobPassSpontaneousApplication" type="checkbox"
		  id="JobPassSpontaneousApplication" ' .
		  checked((get_option("JobPassSpontaneousApplication")), 1, false) .'
		  value="1" />
		</label>
		<label>
		  <span>Description candidature spontanée</span>
		  <br />
		  <textarea
			name="JobPassSpontaneousDescription"
			class="all-options"
			style="width: 100%"
			rows="5"
		  >
  '. stripslashes(get_option( 'JobPassSpontaneousDescription' )) .  '</textarea
		  >
		</label>
		<label>
		  Activer les crédits ?
		  <br />
		  <input size="76" name="JobPassAllowCredits" type="checkbox"
		  id="JobPassAllowCredits" ' .
		  checked((get_option("JobPassAllowCredits")), 1, false) .' value="1" />
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
		  <span class="mr-5">' . __( 'Couleur de fond', 'jobpass' ) . '</span>
  
		  <input
			type="color"
			name="JobPassHeaderBackgroundColor"
			value="' . get_option( 'JobPassHeaderBackgroundColor' ) . '"
		  />
		</label>
		<label>
		  <span class="mr-5"
			>' . __('Couleur du titre principal', 'jobpass' ) . '
		  </span>
  
		  <input
			type="color"
			name="JobPassMainTitle"
			value="'. get_option( 'JobPassMainTitle' ) . '"
		  />
		</label>
		<label>
		  <span class="mr-5">' . __('Couleur des titres', 'jobpass' ) . ' </span>
  
		  <input
			type="color"
			name="JobPassFontTitleColor"
			value="'. get_option( 'JobPassFontTitleColor' ) . '"
		  />
		</label>
		<label>
		  <span class="mr-5"
			>' . __('Couleur des données de l\'offre', 'jobpass' ) . '
		  </span>
  
		  <input
			type="color"
			name="JobPassOffersData"
			value="'. get_option( 'JobPassOffersData' ) . '"
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
		  <span>Nom de votre entreprise</span>
		  <br />
		  <input
			type="text"
			name="JobPassCompanyName"
			value="' . get_option( 'JobPassCompanyName' ) . '"
		  />
		</label>
		<label>
		  <span>Description de votre entreprise</span>
		  <br />
		  <textarea
			name="JobPassCompanyDescription"
			class="all-options"
			style="width: 100%"
			rows="5"
		  >
  '.stripslashes(get_option( 'JobPassCompanyDescription' )) .'</textarea
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
		if ( isset( $_POST['jobpassIdKey'] ) && isset( $_POST['JobPassOrganisationId'] ) && isset($_POST['JobPassHeaderBackgroundColor']) && isset($_POST['JobPassFontTitleColor']) ) {
			update_option( 'jobpassIdKey', sanitize_text_field( $_POST['jobpassIdKey'] ) );
			update_option('JobPassOrganisationId', sanitize_text_field( $_POST['JobPassOrganisationId']));
			?>

<?php 
			if( isset($_POST['JobPassHeaderBackgroundColor']) && isset($_POST['JobPassFontTitleColor'])) {
				update_option('JobPassHeaderBackgroundColor', sanitize_hex_color($_POST['JobPassHeaderBackgroundColor']));
				update_option('JobPassFontTitleColor', sanitize_hex_color($_POST['JobPassFontTitleColor']));
				update_option('JobPassMainTitle', sanitize_hex_color($_POST['JobPassMainTitle']));
				update_option('JobPassOffersData', sanitize_hex_color($_POST['JobPassOffersData']));
			}
		?>
<?php
				if ( isset( $_POST['jobpassIdKey'] ) && isset( $_POST['JobPassCompanyDescription']) ) {
					update_option( 'JobPassCompanyName', sanitize_text_field( $_POST['JobPassCompanyName'] ) );
					update_option('JobPassCompanyDescription',  sanitize_textarea_field($_POST['JobPassCompanyDescription']));
				}
		?>
<?php
				if ( isset( $_POST['JobPassSpontaneousDescription'] ) ) {
					update_option('JobPassSpontaneousDescription',  sanitize_textarea_field($_POST['JobPassSpontaneousDescription']));
				}
		?>
<?php 
			$JobPassAllowSpontaneous = sanitize_key($_POST['JobPassSpontaneousApplication']) ? sanitize_key($_POST['JobPassSpontaneousApplication']) : '';
			update_option('JobPassSpontaneousApplication',sanitize_key($JobPassAllowSpontaneous ));

			$JobPassAllowCredits = sanitize_key($_POST['JobPassAllowCredits']) ? sanitize_key($_POST['JobPassAllowCredits']) : '';
			update_option('JobPassAllowCredits',sanitize_key($JobPassAllowCredits))
			
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