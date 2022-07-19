<?php
        /* Template Name: Job Search */        
        get_header(); ?>             
        <div class="contentarea">
            <div id="content" class="content_right">  
                     <h3>Search Result for : <?php echo esc_attr(htmlentities($s, ENT_QUOTES, 'UTF-8')); ?> </h3>       
                     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>    
                <div id="post-<?php the_ID(); ?>" class="posts">        
                     <article>        
                    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>        
                    <p><?php the_excerpt(); ?></p>        
                    <p align="right"><a href="<?php the_permalink(); ?>">Read     More</a></p>    
                    <span class="post-meta"> Post By <?php the_author(); ?>    
                     | Date : <?php echo esc_html(date('j F Y')); ?></span>    

                    </article><!-- #post -->    
                </div>
        <?php endwhile; ?>
    <?php endif; ?>

           </div><!-- content -->    
        </div><!-- contentarea -->   
        <?php get_sidebar(); ?>
        <?php get_footer(); ?>
 