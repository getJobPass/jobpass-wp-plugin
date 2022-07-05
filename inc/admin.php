<?php
defined( 'ABSPATH' ) or die( 'Hack me not' );

add_action( 'admin_menu', 'jobpass_settings' );
function jobpass_settings() {
	add_options_page(
		"jobpass",
		"jobpass",
		'manage_options',
		"jobpass",
		'jobpass_config_page' );
}

function jobpass_config_page() {
	if ( isset( $_POST['updated'] ) && $_POST['updated'] === 'true' ) {
		jobpass_handle_form();
	}
	echo jobpass_display_form();
}

function jobpass_display_form() {
	return '<div class="wrap">
                <div class="jobpassIntroduction">
                	<h3><svg  width="30px" id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1713.076 1155.111"><defs><style>.cls-1{fill:#0f0649;}.cls-2{fill:none;}</style></defs><path class="cls-1" d="M1253.165,1015.2q102.429,0,159.181-52.4t56.738-148.541v-1.576q0-97.7-56.738-149.329-56.736-51.6-159.181-51.616H1092.783v1.9h-.373V1015.2h160.755Z" transform="translate(-123.133 -422.444)"/><path class="cls-1" d="M1740.113,422.61l-493.077-.166c79.849,0,214.168,16.32,274.055,48.628s106.506,77.621,139.874,135.933S1711,733.618,1711,811.889v1.577q0,116.634-50.039,204.1t-139.874,135.933q-89.831,48.465-209.613,48.464H1092.41V1559h647.7a96.1,96.1,0,0,0,96.1-96.095V518.705A96.1,96.1,0,0,0,1740.113,422.61Z" transform="translate(-123.133 -422.444)"/><path class="cls-1" d="M658.2,1259.1q0,71.716-39.4,109.21-39.417,37.5-114.264,37.5-46.506,0-79.194-15.789-32.714-15.789-50.434-44.079t-20.094-65.132l-.79-61.852H123.133v63.826q3.141,88.816,50.039,155.263,46.874,66.459,131.6,102.961c56.464,24.341,123.846,35.764,202.124,36.513,117.974,1.128,215.755-27.026,287.234-83.224,69.006-54.255,102.049-133.224,102.049-233.224v-62.443L658.2,1198.6Z" transform="translate(-123.133 -422.444)"/><rect class="cls-1" x="535.062" y="0.165" width="237.984" height="590.693"/><polygon class="cls-2" points="535.062 776.156 773.046 776.187 773.046 590.858 535.062 590.858 535.062 776.156"/></svg>
                	' . __( 'JobPass - Postuler partout, en 1 clic', 'jobpass' ) . '
                	</h3>
	                <p>' . __( 'Vous trouverez toutes les informations pour configurer JobPass sur votre site WordPress sur votre espace recruteur', 'jobpass' ) . ' <a href="https://beta.jobpass.com/recruiter/" target="_blank">beta.jobpass.com</a>
                        <br />
                        ' . __( 'Ajoutez l\'ID de votre JobTag dans champs ci-dessous', 'jobpass' ) . '
                        <br />
                        ' . __( 'Documentation', 'jobpass' ) . ' : <a href="https://support.jobpass.com" target="_blank">https://support.jobpass.com/</a>
                    </p>
                </div>

            <form method="post" action="">
                <div class="jobpassDiv">
                    <input type="hidden" name="updated" value="true" />
    			    ' . wp_nonce_field( 'jobpass_update', 'jobpass_form' ) . '
                    <label>
                        ' . __( 'JobTag ID', 'jobpass' ) . '
                        <br />
                        <input type="text" name="jobpassIdKey" value="' . get_option( 'jobpassIdKey' ) . '"/>
                    </label>

                    <input class="button button-primary" type="submit" value="' . __( 'Enregistrer', 'jobpass' ) . '" />
                </div>
			</form>
        </div>

        <style type="text/css">
            .jobpassDiv,
            .jobpassIntroduction {
                max-width: 100%;
                padding: 20px;
            }

            .jobpassDiv {

                background: #FFF;
                border: 1px solid #eee;
                border-bottom: 2px solid #ddd;
            }

            .jobpassIntroduction {
                background: #EFF9FF;
                border: 1px solid #0F0649;
                border-radius: 8px;
                margin: 25px 0;
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

            .jobpassDiv input[type=text] {
            }

            .jobpassDiv input[type=submit] {
                font-size: 18px;
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

						h3 {
							color: #0F0649
						}
        </style>
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
		if ( isset( $_POST['jobpassIdKey'] ) ) {
			update_option( 'jobpassIdKey', sanitize_text_field( $_POST['jobpassIdKey'] ) );

			?>

            <div class="jp_success updated">
                <p><?php echo __( 'Vos paramètres ont été sauvegardés', 'jobpass' ); ?></p>
            </div>
			<?php
		} else {
			?>
            <div class="jp_error">
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
