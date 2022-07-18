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
		jobpass_handle_form();
	}
	echo jobpass_display_form();
}

function jobpass_display_form() {
	return '<div class="wrap">
<div class="row jobpassHeader">
		<div>
			<h1><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 2000" fill="#0f0649" width="30px"><path d="M1225.2 1013.8c61.9 0 110-15.8 144.3-47.5s51.4-76.6 51.4-134.7v-1.4c0-59.1-17.1-104.2-51.4-135.4s-82.4-46.8-144.3-46.8h-145.4v1.7h-.3v364.1h.3 145.4 0zm441.5-537.3l-447-.1c72.4 0 194.2 14.8 248.5 44.1s96.6 70.4 126.8 123.2c30.2 52.9 45.4 114.8 45.4 185.7v1.4c0 70.5-15.1 132.2-45.4 185-30.3 52.9-72.5 93.9-126.8 123.2s-117.6 43.9-190 43.9h-198.6v323.7h587.2c48.1 0 87.1-39 87.1-87.1v-856c-.1-48-39.1-87-87.2-87zm-980.9 758.4c0 43.3-11.9 76.3-35.7 99s-58.3 34-103.6 34c-28.1 0-52-4.8-71.8-14.3s-35-22.9-45.7-40-16.8-36.8-18.2-59h0c-.4-1.9-2.1-3.2-4-3.2h-202c-2.2 0-4.1 1.8-4.1 4.1v.9c1.9 53.7 17 100.6 45.4 140.8 28.3 40.2 68.1 71.3 119.3 93.3 51.2 22.1 112.3 32.4 183.2 33.1 107 1 195.6-24.5 260.4-75.5 62.6-49.2 92.5-120.8 92.5-211.4v-56.6H685.7l.1 54.8h0zm0-758.4h215.8V1012H685.8z"/><path d="M1735.7 893l52.8-122.9c5-11.7 7.8-25.5 8-39.7l2.7-187.7c.4-30.8-15-56.2-34.2-56.1l-90.3.5-2.7 433.8h30.6c13.3-.1 25.6-10.5 33.1-27.9z" stroke="#0f0649" stroke-width="21.194" stroke-miterlimit="10"/></svg>
			' . __( 'JobPass - Postuler partout, en 1 clic', 'jobpass' ) . '
			</h1>
		</div>
		<div>
		<a href="https://beta.jobpass.com" target="blank" class="button jobpassBtn">
			Accéder à JobPass
		</a>
	</div>
	</div>
                <div class="jobpassIntroduction">
	                <p>' . __( 'Vous trouverez toutes les informations pour configurer JobPass sur votre site WordPress sur votre espace recruteur', 'jobpass' ) . ' <a href="https://beta.jobpass.com/recruiter/" target="_blank">beta.jobpass.com</a>
                        <br />
                        ' . __( 'Ajoutez l\'ID de votre JobTag dans champs ci-dessous', 'jobpass' ) . '
                        <br />
                        ' . __( 'Documentation', 'jobpass' ) . ' : <a href="https://support.jobpass.com" target="_blank">https://support.jobpass.com/</a>
                    </p>
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
					<input type="text" name="organisationId" value="' . get_option( 'organisationId' ) . '"/>
				</label>
				<label>
						Autoriser les candidatures spontanées ?
						<br />
						<input size="76" name="spontaneousApplication" type="checkbox" id="spontaneousApplication" ' . checked( esc_attr(get_option("spontaneousApplication")), 1) .' value="1" />
						
				</label>
				<label>
				<span>Description candidature spontanée</span>
				<br>
				<textarea name="spontaneousDescription"  class="all-options" style="width: 100%" rows="5" >'. stripslashes(get_option( 'spontaneousDescription' )) .  '</textarea>

			</label>
			<label>
						Activer les crédits ?
						<br />
						<input size="76" name="allowCredits" type="checkbox" id="allowCredits" ' . checked( esc_attr(get_option("allowCredits")), 1) .' value="1" />
						
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
					
					<input type="color" name="headerBackgroundColor" value="' . get_option( 'headerBackgroundColor' ) . '"/>
				</label>
				<label>
					<span class="mr-5">' . __('Couleur du titre principal', 'jobpass' ) . ' </span>
					
					<input type="color" name="mainTitle" value="'. get_option( 'mainTitle' ) . '">
				</label>
				<label>
					<span class="mr-5">' . __('Couleur des titres', 'jobpass' ) . ' </span>
					
					<input type="color" name="fontTitleColor" value="'. get_option( 'fontTitleColor' ) . '">
				</label>
				<label>
					<span class="mr-5">' . __('Couleur des données de l\'offre', 'jobpass' ) . ' </span>
					
					<input type="color" name="jobOffersData" value="'. get_option( 'jobOffersData' ) . '">
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
				<input type="text" name="companyName" value="' . get_option( 'companyName' ) . '" /> 
			</label>
			<label>
				<span>Description de votre entreprise</span>
				<br>
				<textarea name="companyDescription"  class="all-options" style="width: 100%" rows="5" >'.stripslashes(get_option( 'companyDescription' )) .'</textarea>
			</label>
			<label>
			</label>
			<input class="button button-primary" type="submit" value="' . __( 'Enregistrer', 'jobpass' ) . '" />
		</div>
			</form>
        </div>
        <style>

				.wrap {
					background-color: #fff;
					border-radius: 8px;
					padding: 3.3rem 2rem;
				}
            .jobpassDiv,
            .jobpassIntroduction {
                max-width: 100%;
                padding: 20px;
            }

            .jobpassDiv {

                background: #FFF;
                border-radius: 8px ;
				box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
				margin-bottom: 2rem;
            }
            .jobpassIntroduction {
                background: #EFF9FF;
                border-radius: 8px;
                margin: 0 0 25px 0;
                font-size: 17px;
                line-height: 25px;
            }
            .jobpassDiv label {
                display: block;
                margin: 0 0 20px;
            }
            .jobpassDiv input {
                border: 1px solid #aaa;
                background: #F7F7F7;
            }
            .jp_error, .jp_success {
                margin: 10px 0px;
                padding: 4px 20px;
                border: 1px solid transparent;
                border-left-width: 4px;
                max-width: 100%;
            }
            .jp_error p, .jp_success p {
                margin: 3px 0;
                padding: 2px;
            }
            .jp_success {
                color: #7FC03F;
                background-color: #DFF2BF;
                border-left-color: #7FC03F;
            }
            .jp_error {
                color: #C03F3F;
                background-color: #FFD2D2;
                border-left-color: #C03F3F;
            }
						h1 {
							color: #0F0649;
							font-weight: 700;
						}
						.clear_blue {
							color: #7BC6E8;
						}

						.row {
							-jp-gutter-x: 1.5rem;
							-jp-gutter-y: 0;
							display: flex;
							flex-wrap: wrap;
							margin-top: calc(var(-jp-gutter-y) * -1);
							margin-right: calc(var(-jp-gutter-x) / -2);
							margin-left: calc(var(-jp-gutter-x) / -2);
						}

						.jobpassHeader {
							justify-content:space-between;
							align-items:center;
							position: sticky;
							top: 30px;
							padding: 20px 0; 
							background-color: #fff;
						}
						.jobpassHeader h1 {
							display:flex;
							align-items:center;
							font-weight: 700 !important;
						}

						.jobpassHeader h1 svg {
							margin-right: 30px;
						}

						.jobpassBtn {
							padding: 10px 20px !important;
							background-color: #0F0649 !important;
							color: #fff !important;
							font-weight: 700 !important;
							font-size: 16px !important;
							border-radius: 8px !important;
							text-decoration: none !important;
						}

						.jobpassBtn:hover: {
							background-color: #7BC6E8 !important;
							color: #fff !important !important;
							transition:0.5s all !important;
							-webkit-transition:0.5s all !important;
							-moz-transition:0.5s all !important;
							-o-transition:0.5s all !important;
						}
						.jobpassHeader {
							margin-bottom: 2rem;
						}

						.mr-5 {
							margin-right: 3rem;
							min-width:300px;
							display:inline-flex;
						}

        </style>
		<script id="ze-snippet"src="https://static.zdassets.com/ekr/snippet.js?key=2c6362e5-111f-4c7b-a3df-f604fd35decb"></script>

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
		if ( isset( $_POST['jobpassIdKey'] ) && isset( $_POST['organisationId'] ) && isset($_POST['headerBackgroundColor']) && isset($_POST['fontTitleColor']) ) {
			update_option( 'jobpassIdKey', sanitize_text_field( $_POST['jobpassIdKey'] ) );
			update_option('organisationId', sanitize_text_field( $_POST['organisationId']));
			?>

		<?php 
			if( isset($_POST['headerBackgroundColor']) && isset($_POST['fontTitleColor'])) {
				update_option('headerBackgroundColor', $_POST['headerBackgroundColor']);
				update_option('fontTitleColor', $_POST['fontTitleColor']);
				update_option('mainTitle', $_POST['mainTitle']);
				update_option('jobOffersData', $_POST['jobOffersData']);
			}
		?>
		<?php
				if ( isset( $_POST['jobpassIdKey'] ) && isset( $_POST['companyDescription']) ) {
					update_option( 'companyName', sanitize_text_field( $_POST['companyName'] ) );
					update_option('companyDescription',  sanitize_textarea_field($_POST['companyDescription']));
				}
		?>
		<?php
				if ( isset( $_POST['spontaneousDescription'] ) ) {
					update_option('spontaneousDescription',  sanitize_textarea_field($_POST['spontaneousDescription']));
				}
		?>
		

		<?php 
			$allowSpontaneous = $_POST['spontaneousApplication'] ? $_POST['spontaneousApplication'] : '';
			update_option('spontaneousApplication',esc_html($allowSpontaneous ));

			$allowCredits = $_POST['allowCredits'] ? $_POST['allowCredits'] : '';
			update_option('allowCredits',esc_html($allowCredits))
			
		?>

		<?php 
				$content = '';
				if (isset($_POST) && !empty($_POST)) {
					if (isset($_POST['submit']) && $_POST['submit'] != '') {
						$content=$_POST['mycustomeditor'];
					}
				}
				$editor_id = 'mycustomeditor';
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

add_filter('plugin_action_links', 'wptuts_plugin_settings_link', 10, 2);
function wptuts_plugin_settings_link($links, $file) {

    if ( $file == 'jobpass/jobpass.php' ) {
        /* Insert the link at the end*/
        $links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'options-general.php?page=jobpass' ), __( 'Paramètres', 'plugin_domain' ) );
				$links['jobpass_register'] = sprintf( '<a href="https://beta.jobpass.com/recruiter/auth/register/" target="_blank"> Inscription Recruteur </a>' );
				$links['organisation'] = sprintf('<a href="https://beta.jobpass.com/recruiter/" target="_blank">Espace recruteur</a>');
    }
    return $links;

}
