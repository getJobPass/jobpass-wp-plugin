<?php
/**
* Template name: Single JobPass offer
* @author JobPass
*
**/

defined( 'ABSPATH' ) || exit;

get_header();

do_action('your_hook_name');
 ?>
<div class="jobpass-content">
<header class="py-7 bg-light">
  <div class="container">
    <div class="row justify-content-center align-items-center py-5 ">
      <div class="col-md-8">
          <a href="#" ><span class="h6"><i class="fas fa-arrow-left"></i> Retour aux offres</span></a>
          <h1
          ><?php the_title() ?></h1>
      </div>
      <div class="col-md-4  text-center">
          <a href="#" class="btnJobPass btn btn-lg">Postuler avec JobPass</a>
      </div>
    </div>
  </div>
</header>
</div> 
<?
  get_footer();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2fba8b9ac4.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="<?php JOBPASS_PATH . '/public/assets/jobpass.css' ?>>
