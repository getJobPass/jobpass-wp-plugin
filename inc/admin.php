<?php
defined( 'ABSPATH' ) or die( 'Hack me not' );

add_action( 'admin_menu', 'jobpass_settings' );
function jobpass_settings() {
	add_menu_page(
		"JobPass",
		"JobPass",
		'manage_options',
		"jobpass",
		'jobpass_config_page', 
		plugin_dir_url( __FILE__ ) . 'images/icone-jobpass_square.jpg',
		5,
	);

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
	<div class=" row jp_header" style="background-color: #fff; ">
	<div class="jp_logo-container">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 2000" fill="#0f0649" width="50px" height="50px"><path d="M1225.2 1013.8c61.9 0 110-15.8 144.3-47.5s51.4-76.6 51.4-134.7v-1.4c0-59.1-17.1-104.2-51.4-135.4s-82.4-46.8-144.3-46.8h-145.4v1.7h-.3v364.1h.3 145.4 0zm441.5-537.3l-447-.1c72.4 0 194.2 14.8 248.5 44.1s96.6 70.4 126.8 123.2c30.2 52.9 45.4 114.8 45.4 185.7v1.4c0 70.5-15.1 132.2-45.4 185-30.3 52.9-72.5 93.9-126.8 123.2s-117.6 43.9-190 43.9h-198.6v323.7h587.2c48.1 0 87.1-39 87.1-87.1v-856c-.1-48-39.1-87-87.2-87zm-980.9 758.4c0 43.3-11.9 76.3-35.7 99s-58.3 34-103.6 34c-28.1 0-52-4.8-71.8-14.3s-35-22.9-45.7-40-16.8-36.8-18.2-59h0c-.4-1.9-2.1-3.2-4-3.2h-202c-2.2 0-4.1 1.8-4.1 4.1v.9c1.9 53.7 17 100.6 45.4 140.8 28.3 40.2 68.1 71.3 119.3 93.3 51.2 22.1 112.3 32.4 183.2 33.1 107 1 195.6-24.5 260.4-75.5 62.6-49.2 92.5-120.8 92.5-211.4v-56.6H685.7l.1 54.8h0zm0-758.4h215.8V1012H685.8z"/><path d="M1735.7 893l52.8-122.9c5-11.7 7.8-25.5 8-39.7l2.7-187.7c.4-30.8-15-56.2-34.2-56.1l-90.3.5-2.7 433.8h30.6c13.3-.1 25.6-10.5 33.1-27.9z" stroke="#0f0649" stroke-width="21.194" stroke-miterlimit="10"/></svg>
	<h1>
	' . __( 'JobPass - Postulez partout, en 1 clic', 'jobpass' ) . '
	</div>
	<div>
	<a href="https://beta.jobpass.com" target="blank" class="button jobpassBtn">
		Accéder à JobPass
	</a>
	</h1>
	</div>
	</div>
	
	<div class="wrap">
			<div class="jp_intro jobpassDiv">
				<h2>Ne recevez que des candidatures complètes & <br>permettez à vos candidats de postuler en 1 clic !</h2>
				<p><strong>Configurez JobPass rapidement et simplement et utilisez ce plugin pour :</strong></p>
				<ul class="fa-ul">
					<li><span class="fa-li"><i class="fas fa-inbox"></i></span> Installer vos récepteurs de candidatures</li>
					<li><span class="fa-li"><i class="fas fa-cogs"></i></span> Configurer votre espace recrutement</li>
					<li><span class="fa-li"><i class="fas fa-bullhorn"></i></span> Diffuser vos offres d\'emploi</li>
					<li><span class="fa-li"><i class="fas fa-trophy"></i></span> Recruter plus rapidement</li>
				</ul>
			</div>
            
            <form method="post" action="" id="jobpass_options"  accept-charset="utf-8">
                <div class="jobpassDiv">
					<h2>Informations de connexion</h2>
                    <input type="hidden" name="updated" value="true" />
    			    ' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
                    <label>
                        ' . __( 'ID du récepteur', 'jobpass' ) . '
                        <br />
                        <input type="text" name="jobpassIdKey" value="' . get_option( 'jobpassIdKey' ) . '"/>
                    </label>
					<label>
					' . __( 'Id de l\'entreprise', 'jobpass' ) . '
					<br />
					<input type="text" name="JobPassOrganisationId" value="' . get_option( 'JobPassOrganisationId' ) . '"/>
				</label>
				<label>
						Autoriser les candidatures spontanées ?
						<br />
						<input size="76" name="JobPassSpontaneousApplication" type="checkbox" id="JobPassSpontaneousApplication" ' . checked((get_option("JobPassSpontaneousApplication")), 1, false) .' value="1" />
						
				</label>
				<label>
				<span>Description candidature spontanée</span>
				<br>
				<textarea name="JobPassSpontaneousDescription"  class="all-options" style="width: 100%" rows="5" >'. stripslashes(get_option( 'JobPassSpontaneousDescription' )) .  '</textarea>

			</label>
			<label>
						Activer les crédits ?
						<br />
						<input size="76" name="JobPassAllowCredits" type="checkbox" id="JobPassAllowCredits" ' . checked((get_option("JobPassAllowCredits")), 1, false) .' value="1" />
						
				</label>
                    <input class="button button-primary" type="submit" value="' . __( 'Enregistrer', 'jobpass' ) . '" />
                </div>
				<div class="jobpassDiv">
				<h2>
					Design de vos offres d\'emploi
				</h2>
				<input type="hidden" name="updated" value="true" />
				' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
				<label>
					<span class="mr-5">' . __( 'Couleur de fond', 'jobpass' ) . '</span>
					
					<input type="color" name="JobPassHeaderBackgroundColor" value="' . get_option( 'JobPassHeaderBackgroundColor' ) . '"/>
				</label>
				<label>
					<span class="mr-5">' . __('Couleur du titre principal', 'jobpass' ) . ' </span>
					
					<input type="color" name="JobPassMainTitle" value="'. get_option( 'JobPassMainTitle' ) . '">
				</label>
				<label>
					<span class="mr-5">' . __('Couleur des titres', 'jobpass' ) . ' </span>
					
					<input type="color" name="JobPassFontTitleColor" value="'. get_option( 'JobPassFontTitleColor' ) . '">
				</label>
				<label>
					<span class="mr-5">' . __('Couleur des données de l\'offre', 'jobpass' ) . ' </span>
					
					<input type="color" name="JobPassOffersData" value="'. get_option( 'JobPassOffersData' ) . '">
				</label>
				<input class="button button-primary" type="submit" value="' . __( 'Enregistrer', 'jobpass' ) . '" />
			</div>
			<div class="jobpassDiv">
			<h2>Présentation de l\'entreprise</h2>
			<input type="hidden" name="updated" value="true" />
			' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
			<label>
				<span>Nom de votre entreprise</span>
				<br />
				<input type="text" name="JobPassCompanyName" value="' . get_option( 'JobPassCompanyName' ) . '" /> 
			</label>
			<label>
				<span>Description de votre entreprise</span>
				<br>
				<textarea name="JobPassCompanyDescription"  class="all-options" style="width: 100%" rows="5" >'.stripslashes(get_option( 'JobPassCompanyDescription' )) .'</textarea>
			</label>
			<label>
			</label>
			<input class="button button-primary" type="submit" value="' . __( 'Enregistrer', 'jobpass' ) . '" />
		</div>
			</form>
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
            <p><?php echo __( 'Sorry, an error occured. Please try again. Contact us if the problem persist.', 'jobpass' ); ?></p>
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