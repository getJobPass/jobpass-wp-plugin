<?php 
/**
 * Template Name: JobPass Offers Archive
 * @author JobPass Team
 */
do_action('jobpass-style'); 
 defined('ABSPATH') || exit;
 get_header(); 
 ?> 

 <header style="background-color: <?php echo esc_attr(get_option( 'headerBackgroundColor' )) ?>">
    <div class="container">
        <div class="row">
            
                <h1 class="text-center"><?php post_type_archive_title(); ?></h1>
        </div>
    </div>
</header>
<?php



?>
<section class="container">
    <div class="row job_offers_list">
 <?php if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>    
        
        <div class="col-md-4">
            <div class="post card">
                <?php 
                    $jp_start_date = get_post_meta($post -> ID, 'jp_startDate', true);
                    $formatted_date = strtotime($jp_start_date);
                ?>
               <h3><a href="<?php the_permalink() ?>"> <?php the_title() ?></a></h3>
                <ul class="jp_offer-metas" style="margin-top: 10px">
                   <li><i class="fas fa-map-marker"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?></li>
                   <li><i class="fas fa-briefcase"></i> <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?></li>
                   <li><i class="fa fa-calendar-alt"></i> <?php echo date('j/m/Y', $formatted_date) ?></li>
                </ul>
                <a href="<?php the_permalink(); ?>" class="btn btn-show" >Voir plus</a>
            </div>
        </div>
    <?php   endwhile; 
        endif; ?>
        </div>
</section>

<style>
    h1 {
      color: <?php echo get_option('mainTitle') ?> !important;
    }

    h2, h3, h4, h5, h6 {
      color: <?php echo get_option('fontTitleColor') ?> !important;
    }
    h3 a {
        color: <?php echo get_option('fontTitleColor') ?> !important;
        text-decoration: none; 
        margin-top: 0 !important;
    }
    .jp_offer-metas {
      color: <?php echo get_option('jobOffersData') ?> !important;
    }
    .btn-show {
        background-color: <?php echo get_option('mainTitle')?>;
        color: <?php echo esc_attr(get_option( 'headerBackgroundColor' )) ?>;
    }
    .card h3 {
        margin-top: 0;
        margin-bottom: 0;
    }
</style>
<?php
  if(get_option('spontaneousApplication')){?>
        <h2>Candidature spontanée</h2>
  <?php } ?>
<?php get_footer(); ?>
