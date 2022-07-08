<?php
/** 
 *  @author JobPass Team
 *  @link https://jobpass.com/ 
 *
*/

function jobpass_offer_meta_box() {
    add_meta_box( 'joboffer-info', __( 'Détails de l\'offre', 'jp' ), 'jobpass_offer_display_callback', 'joboffers' );
}
add_action( 'add_meta_boxes', 'jobpass_offer_meta_box' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
    
    function jobpass_offer_display_callback( $post ) {
        include(__DIR__ . '/job_infos_form.php');
  }



function hcf_save_meta_box( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
        $post_id = $parent_id;
    }
    $fields = [
        'jp_place',
        'jp_startDate',
        'jp_contract',
        'jp_remote',
        'jp_salary', 
        'jp_experience',
    ];
    foreach ( $fields as $field ) {
        if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
     }
}
add_action( 'save_post', 'hcf_save_meta_box' );

