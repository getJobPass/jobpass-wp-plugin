<?php
/** 
 *  @author JobPass Team
 *  @link https://jobpass.com/ 
 * **/

function joboffer_add_metadata() {
    // add meta box for joboffer
    $screens = array( 'joboffers' );
    
    foreach ( $screens as $screen ) {
    
        add_meta_box(
            'joboffer_sectionid',
            __( 'Détails de l\'offre', 'joboffer_textdomain' ),
            'joboffer_meta_box_callback',
            $screen
        );
     }
    }
    add_action( 'add_meta_boxes', 'joboffer_add_metadata' );
    
    /**
     * Prints the box content.
     *
     * @param WP_Post $post The object for the current post/page.
     */
    function joboffer_meta_box_callback( $post ) {
    
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'joboffer_save_meta_box_data', 'joboffer_meta_box_nonce' );
    
    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
    
    echo '<label for="joboffer_new_field">';
    _e( 'Lieu de l\'offre', 'joboffer_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="joboffer_new_field" name="joboffer_new_field" value="' . esc_attr( $value ) . '" size="100" />';
    }
    
    /**
     * When the post is saved, saves our custom data.
     *
     * @param int $post_id The ID of the post being saved.
     */
     function joboffer_save_meta_box_data( $post_id ) {
    
     if ( ! isset( $_POST['joboffer_meta_box_nonce'] ) ) {
        return;
     }
    
     if ( ! wp_verify_nonce( $_POST['joboffer_meta_box_nonce'], 'joboffer_save_meta_box_data' ) ) {
        return;
     }
    
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
     }
    
     // Check the user's permissions.
     if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
    
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    
     } else {
    
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
     }
    
     if ( ! isset( $_POST['joboffer_new_field'] ) ) {
        return;
     }
    
     $my_data = sanitize_text_field( $_POST['joboffer_new_field'] );
    
     update_post_meta( $post_id, '_my_meta_value_key', $my_data );
    }
    add_action( 'save_post', 'joboffer_save_meta_box_data' );