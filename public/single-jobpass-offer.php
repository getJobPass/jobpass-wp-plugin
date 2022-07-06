<?php
/**
* Template name: Single JobPass offer
* @author JobPass
*
**/

defined( 'ABSPATH' ) || exit;

get_header();
 ?>
<div class="">
    <?php the_title() ?>

</div>
<script type="text/javascript">
    console.log('jobpass_loaded')
</script>

<?php
    add_action("wp_footer",function(){ ?> <link rel='stylesheet' id='fontawesome-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' media='all' /> <?php });

    function jp_add_scripts(){
    wp_deregister_script( 'jquery' );

    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"', true);

}
add_action('wp_enqueue_scripts','jp_add_scripts');

 ?>
