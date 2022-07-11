<?php
/**
* Template name: Single JobPass offer
* @author JobPass
*
**/
do_action('jobpass-style');
defined( 'ABSPATH' ) || exit;
get_header();


$jp_start_date = get_post_meta($post -> ID, 'jp_startDate', true);
$formatted_date = strtotime($jp_start_date);

function get_organisation_id() {
  if (get_option( 'organisationId' )) {
      $orgnisationId = get_option( 'organisationId' );
    }
  else {
    
  }
}
add_action('wp_footer', 'get_organisation_id');

 ?>
<div class="jobpass-content">
<header class="py-7 bg-light" style="background:<?php echo esc_attr(get_option( 'headerBackgroundColor' )) ?>">
  <div class="container">
    <div class="row justify-content-center align-items-center py-5 ">
      <div class="col-md-8">
          <a href="#" ><span class="h6"><i class="fas fa-arrow-left"></i> Retour aux offres</span></a>
          <h1
          ><?php the_title(); ?></h1>
          <ul class="jp_offer-metas">
    <li><i class="fas fa-map-marker"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?></li>
    <li><i class="fa fa-calendar-alt"></i> <?php echo date('j/m/Y', $formatted_date) ?></li>
    <li><i class="fa fa-briefcase"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?></li>
    <li><i class="fa fa-briefcase"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_remote', true ) ); ?></li>
    <li><i class="fa fa-euro-sign"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_salary', true ) ); ?></li>
    <li><i class="fa fa-user-tie"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_experience', true ) ); ?></li>
</ul>
      </div>
      <div class="col-md-4  text-center">
          <a href="<?php if(get_option('organisationId')) {
              echo esc_attr( 'https://jobpass.live/' . get_option('organisationId'));}  ?>" 
          class="btn btnJobPass btn-lg align-items-center"  
          style="display:inline-flex; font-size:16px;"
          data-sid="<?php if(get_option('jobpassIdKey') ) { echo esc_attr(get_option('jobpassIdKey'));} ?>"
          >
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 2000" fill="#fff" width="30px" style="margin-right: 5px"><path d="M1225.2 1013.8c61.9 0 110-15.8 144.3-47.5s51.4-76.6 51.4-134.7v-1.4c0-59.1-17.1-104.2-51.4-135.4s-82.4-46.8-144.3-46.8h-145.4v1.7h-.3v364.1h.3 145.4 0zm441.5-537.3l-447-.1c72.4 0 194.2 14.8 248.5 44.1s96.6 70.4 126.8 123.2c30.2 52.9 45.4 114.8 45.4 185.7v1.4c0 70.5-15.1 132.2-45.4 185-30.3 52.9-72.5 93.9-126.8 123.2s-117.6 43.9-190 43.9h-198.6v323.7h587.2c48.1 0 87.1-39 87.1-87.1v-856c-.1-48-39.1-87-87.2-87zm-980.9 758.4c0 43.3-11.9 76.3-35.7 99s-58.3 34-103.6 34c-28.1 0-52-4.8-71.8-14.3s-35-22.9-45.7-40-16.8-36.8-18.2-59h0c-.4-1.9-2.1-3.2-4-3.2h-202c-2.2 0-4.1 1.8-4.1 4.1v.9c1.9 53.7 17 100.6 45.4 140.8 28.3 40.2 68.1 71.3 119.3 93.3 51.2 22.1 112.3 32.4 183.2 33.1 107 1 195.6-24.5 260.4-75.5 62.6-49.2 92.5-120.8 92.5-211.4v-56.6H685.7l.1 54.8h0zm0-758.4h215.8V1012H685.8z"/><path d="M1735.7 893l52.8-122.9c5-11.7 7.8-25.5 8-39.7l2.7-187.7c.4-30.8-15-56.2-34.2-56.1l-90.3.5-2.7 433.8h30.6c13.3-.1 25.6-10.5 33.1-27.9z" stroke="#fff" stroke-width="21.194" stroke-miterlimit="10"/></svg>  
          Postuler avec JobPass</a>
      </div>
    </div>
  </div>
</header>
<section id="jp_content-offer">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php the_content()?>
        </div>
        <div class="col-md-4">
            <h3>À propos de <?php echo get_option('companyName');?></h3>
            <p>
              <?php echo get_option('companyDescription');?>
            </p>
        </div>
    </div>
  </div>
</section>
</div> 
<style>
    h1 {
      color: <?php echo get_option('mainTitle') ?> !important;
    }

    h2, h3, h4, h5, h6 {
      color: <?php echo get_option('fontTitleColor') ?> !important;
    }
    .jp_offer-metas {
      color: <?php echo get_option('jobOffersData') ?> !important;
    }
</style>
<?
  get_footer();
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2fba8b9ac4.js" crossorigin="anonymous"></script> -->
