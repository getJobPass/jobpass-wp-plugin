<?php
/**
* Template name: Single JobPass offer
* @author JobPass
*
**/

defined( 'ABSPATH' ) || exit;

get_header();
 ?>
<header class="py-7 bg-light">
  <div class="container">
    <div class="row justify-content-center align-items-center py-4 px-3">
      <div class="col-md-8">
          <a href="#"><span class="h6"><i class="fas fa-arrow-left"></i> Retour aux offres</span></a>
          <h1nce
          ><?php the_title() ?></h1>
      </div>
      <div class="col-md-4">
          <form action="https://jobpass.live" method="post">
            <input type="button">
          </form>
      </div>
    </div>
  </div>
</header>
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
