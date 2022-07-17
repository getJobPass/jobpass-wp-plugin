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

$jp_validTrough = get_post_meta($post -> ID, 'jp_validTrough', true);
$formatted_validTrough = strtotime($formatted_validTrough); 

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
<header style="background:<?php echo esc_attr(get_option( 'headerBackgroundColor' )) ?>;" class="offer_header">
  <div class="container">
    <div class="row justify-content-center align-items-center py-5 ">
      <div class="col-md-8">
          <a href="/recrutement" ><span class="h6"><i class="fas fa-arrow-left"></i> Retour aux offres</span></a>
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
          target="_blank"
          data-sid="<?php if(get_option('jobpassIdKey') ) { echo esc_attr(get_option('jobpassIdKey'));} ?>"
          >
        <img src="<?php echo esc_attr( plugin_dir_url(__FILE__) . 'assets/jobpass-icon.svg' )?>" width="30px" style="margin-right:5px" />
          Postuler avec JobPass</a>
      </div>
    </div>
  </div>
</header>
<section id="jp_content-offer" style="margin: 30px 0;">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php the_content()?>
            <?php  if(get_option('allowCredits')){?>
            <small>Powered by <a href="https://jobpass.com" target="_blank">JobPass</a></small>
            <?php }?>
        </div>
        <aside class="col-md-4 jp-company">
          <div class="card" style="max-height: 100%; height: auto ">
            <h3>À propos de <?php echo get_option('companyName');?></h3>
            <p>
              <?php echo stripslashes(get_option('companyDescription'));?>
            </p>
            </div>
        </aside>
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
<?php 
	$content= get_the_content(); 
	$logo = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $logo, 'full' );
?>

<script type="application/ld+json">
    {
      "@context" : "https://schema.org/",
      "@type" : "JobPosting",
      "title" : "<?php the_title() ?>",
      "description" : "<?php echo wp_strip_all_tags( $content )?>",
      "identifier": {
        "@type": "PropertyValue",
        "name": "<?php echo get_option('companyName') ?>",
        "value": "<?php the_ID() ?>"
      },
      "datePosted" : "<?php echo get_the_date('Y/m/d g:ia') ?>",
      "validThrough" : " <?php echo date('Y-m-dTg:i', $formatted_validTrough) ?>",
      "employmentType" : "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?>",
      "hiringOrganization" : {
        "@type" : "Organization",
        "name" : "<?php echo get_option('companyName') ?>",
        "sameAs" : "<?php echo get_site_url() ?>",
        "logo" : "<?php echo $image[0] ?>"
      },
      "jobLocation": {
      "@type": "Place",
        "address": {
        "@type": "City",
        "streetAddress": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_completeAddress', true ) ); ?>",
        "addressLocality": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?>",
        "addressRegion": "",
        "postalCode": "",
        "addressCountry": "FR"
        }
      },
      "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "EUR",
        "value": {
          "@type": "QuantitativeValue",
          "value": <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_salary', true ) ); ?>,
          "unitText": "MONTH"
        }
      }
    }
  </script>
  
<?
  get_footer();
?>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/2fba8b9ac4.js" crossorigin="anonymous"></script> -->
