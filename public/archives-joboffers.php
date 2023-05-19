<?php 
/**
 * Template Name: JobPass Offers Archive
 * @author JobPass Team
 */
do_action('jobpass-style'); 
 defined('ABSPATH') || exit;
 get_header(); 
 ?>
<div class="jobpass-content">
    <header
        style="background-color: <?php echo esc_attr(get_option( 'JobPassHeaderBackgroundColor' )) ?>; margin-bottom: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"><?php post_type_archive_title(); ?></h1>
                </div>
                <div class="col-md-12" style="margin-top: 3rem">
                    <div style="display:block; margin:0 auto;">
                        <form role="search" action="<?php echo esc_attr(site_url('/')); ?>" method="get"
                            id="searchform">
                            <div class="row align-items-center justify-content-center" style="margin: 0 auto;">
                                <div class="col-md-8">
                                    <input type="text" name="s" placeholder="Rechercher une offre d'emploi"
                                        class="jp-search-input" />
                                </div>
                                <div class="col-md-3">
                                    <input type="hidden" name="post_type" value="joboffers" />
                                    <input type="submit" alt="Search" value="Rechercher" class="btn btn-search" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

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
                        <li><i class="fas fa-map-marker"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?></li>
                        <li><i class="fas fa-briefcase"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?></li>
                        <li><i class="fa fa-calendar-alt"></i> <?php echo date('j/m/Y', $formatted_date) ?></li>
                    </ul>
                    <a href="<?php the_permalink(); ?>" class="btn btn-show">Voir plus</a>

                </div>
            </div>
            <?php   endwhile; 
        else: ?>
            <h3 class="text-center">
                <i class="fas fa-times-circle" style="color:<?php echo esc_attr('JobPassTitleColor') ?>"></i><br />
                Aucune offre d'emploi disponible pour le moment
            </h3>
            <?php
        endif; ?>
        </div>
    </section>
    <section style="margin-bottom:30px; padding-bottom: 30px">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php
  if(get_option('JobPassSpontaneousApplication')){?>
                    <h2 class="text-center" style="margin-bottom:20px">Candidature spontanée</h2>
                    <p class="text-center" style="margin-bottom: 20px">
                        <?php echo stripslashes(esc_html(get_option('JobPassSpontaneousDescription')));?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <a href=" https://jobpass.live/<?php echo esc_attr(get_option('JobPassOrganisationId')) ?>"
                        target="_blank" class="btn btnJobPass btn-lg align-items-center" style="display:inline-flex; ">
                        Déposer mon

                        <img src="https://images.ctfassets.net/nla4ils4bv6t/01MpLFfhVRnPnYteKTv4o5/22ed578b64b6f66f8e8477e046bed3e3/white-logo-jobpass.svg"
                            width="70px" style="margin-left:5px; " />
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
h1 {
    color: <?php echo esc_attr(get_option('JobPassMainTitle')) ?> !important;
}

h2,
h3,
h4,
h5,
h6 {
    color: <?php echo esc_attr(get_option('JobPassFontTitleColor')) ?> !important;
}

h3 a {
    color: <?php echo esc_attr(get_option('JobPassFontTitleColor')) ?> !important;
    text-decoration: none;
    margin-top: 0 !important;
}

.jp_offer-metas li {
    color: <?php echo esc_attr(get_option('JobPassOffersData')) ?> !important;
}

.btn-show {
    background-color: <?php echo esc_attr(get_option('JobPassMainTitle'))?>;
    color: <?php echo esc_attr(get_option('JobPassHeaderBackgroundColor')) ?> !important;
    border-radius: 8px;

}

.card h3 {
    margin-top: 0;
    margin-bottom: 0;
}

.btn-search {
    background-color: <?php echo esc_attr(get_option('JobPassMainTitle'))?> !important;
    border-radius: 8px !important;
    padding: 10px 20px !important;
    width: 100%;
    color: #fff !important;

}
</style>
<?php get_footer(); ?>