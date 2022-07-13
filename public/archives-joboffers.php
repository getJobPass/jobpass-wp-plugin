<?php 
/**
 * Template Name: JobPass Offers Archive
 * @author JobPass Team
 */
do_action('jobpass-style'); 
 defined('ABSPATH') || exit;
 get_header(); 
 ?> 

 <header style="background-color: <?php get_option('headerBackgroundColor')  ?>">
    <div class="container">
        <div class="row">
        <h1><?php post_type_archive_title(); ?></h1>
        </div>
    </div>
</header
 <?php if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>    
    
            <div class="post">
               <a href="<?php the_permalink() ?>"> <?php the_title() ?></a>
            </div>
    <?php   endwhile; 
        endif; ?>
<?php get_footer(); ?>

 <script>
    console.log('working');
 </script>