<?php
/**
 * Template name: Single JobPass offer
 * Author: JobPass
 **/

do_action('jobpass-style');
defined( 'ABSPATH' ) || exit;
get_header();

$jp_start_date = get_post_meta( $post->ID, 'jp_startDate', true );
$formatted_date = strtotime( $jp_start_date );

$jp_valid_through = get_post_meta( $post->ID, 'jp_validThrough', true );
$formatted_valid_through = strtotime( $jp_valid_through );


function jobpass_get_organisation_id() {
    if ( get_option( 'JobPassOrganisationId' ) ) {
        $jp_organisation_id = get_option( 'JobPassOrganisationId' );
    }
    else {
        // Ajoutez ici le code à exécuter si l'option 'JobPassOrganisationId' n'est pas définie
    }
}
add_action( 'wp_footer', 'jobpass_get_organisation_id' );
?>

<div class="jobpass-content">
    <header style="background:<?php echo esc_attr( get_option( 'JobPassHeaderBackgroundColor' ) ); ?>;"
        class="offer_header">
        <div class="container">
            <div class="row justify-content-center align-items-center py-5 ">
                <div class="col-md-8">
                    <a href="/recrutement"><span class="h6"><i class="fas fa-arrow-left"></i> Retour aux
                            offres</span></a>
                    <h1><?php the_title(); ?></h1>
                    <ul class="jp_offer-metas">
                        <?php if ( get_post_meta( get_the_ID(), 'jp_place', true ) ) : ?>
                        <li><i class="fas fa-map-marker"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ( get_post_meta( $post->ID, 'jp_startDate', true ) ) : ?>
                        <li><i class="fas fa-calendar-alt"></i>
                            <?php echo esc_attr( date( 'j/m/Y', $formatted_date ) ); ?></li>
                        <?php endif; ?>
                        <?php if ( get_post_meta( get_the_ID(), 'jp_contract', true ) ) : ?>
                        <li><i class="fas fa-briefcase"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ( get_post_meta( get_the_ID(), 'jp_remote', true ) ) : ?>
                        <li><i class="fas fa-house-user"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_remote', true ) ); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ( get_post_meta( get_the_ID(), 'jp_salary', true ) ) : ?>
                        <li><i class="fas fa-euro-sign"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_salary', true ) ); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ( get_post_meta( get_the_ID(), 'jp_experience', true ) ) : ?>
                        <li><i class="fas fa-user-tie"></i>
                            <?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_experience', true ) ); ?>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-3 text-center">
                    <?php
// Récupérer les valeurs JobpassIdKey et JobpassOrganisationId
$jobpass_id_key = get_option('JobpassIdKey');
$jobpass_organisation_id = get_option('JobpassOrganisationId');

// Vérifier si l'option JobpassManyEntities est vraie
if (get_option('JobpassManyEntities')) {
    // Récupérer les entités liées à l'offre
    $entities = get_the_terms($post->ID, 'entite'); // Remplacez 'nom_de_la_taxonomy' par le nom réel de votre taxonomy

    if ($entities && !is_wp_error($entities)) {
        foreach ($entities as $entity) {
            // Récupérer les valeurs de script_id et d'organisation_id
            $script_id = get_term_meta($entity->term_id, 'script_id', true);
            $organisation_id = get_term_meta($entity->term_id, 'organization_id', true);

            // Afficher les informations
            ?>
                    <a href="https://jobpass.live/<?php echo $organisation_id; ?>"
                        class="btn btnJobPass btn-lg align-items-center" style="display:inline-flex; font-size:16px;"
                        target="_blank" data-sid="<?php if ( $script_id ) { echo $script_id; } ?>">
                        Postuler avec
                        <img src="https://images.ctfassets.net/nla4ils4bv6t/01MpLFfhVRnPnYteKTv4o5/22ed578b64b6f66f8e8477e046bed3e3/white-logo-jobpass.svg"
                            width="70px" style="margin-left:5px; " />
                    </a>
                    <?php 
        }
    }
} else {
    ?>
                    <a href="https://jobpass.live/<?php echo $jobpass_organisation_id; ?>"
                        class="btn btnJobPass btn-lg align-items-center" style="display:inline-flex; font-size:16px;"
                        target="_blank" data-sid="<?php if ( $jobpass_id_key ) { echo $jobpass_id_key; } ?>">
                        Postuler avec
                        <img src="https://images.ctfassets.net/nla4ils4bv6t/01MpLFfhVRnPnYteKTv4o5/22ed578b64b6f66f8e8477e046bed3e3/white-logo-jobpass.svg"
                            width="70px" style="margin-left:5px; " />
                    </a>
                    <?php
}
    ?>
                </div>
            </div>
        </div>
    </header>

    <section id="jp_content-offer" style="margin: 30px 0 !important;">
        <div class="container JpOfferContent">
            <div class="row justify-content-center">
                <div class="col-md-7" style="margin: 30px 0;">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; ?>
                    <?php if ( get_option( 'JobPassAllowCredits' ) ) : ?>
                    <p style="margin-top: 30px;">
                        <small>Powered by <a href="https://jobpass.com" target="_blank">JobPass</a></small>
                    </p>
                    <?php endif; ?>
                </div>
                <aside class="col-md-4 jp-company">
                    <div class="card" style="max-height: 100%; height: auto; margin: 30px 0; ">
                        <h3>À propos de <?php echo esc_html( get_option( 'JobPassCompanyName' ) ); ?></h3>
                        <p>
                            <?php echo stripslashes( esc_html( get_option( 'JobPassCompanyDescription' ) ) ); ?>
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section>
        <?php
        $joboffers = array(
            'post_type' => 'joboffers',
            'posts_per_page' => '3',
            'orderby' => 'rand'
        );

        $other_jobs = new WP_Query( $joboffers );
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Code pour afficher les autres offres d'emploi -->
                </div>
            </div>
        </div>
    </section>
</div>

<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "JobPosting",
    "title": "<?php the_title(); ?>",
    "description": "<?php echo wp_strip_all_tags( esc_attr( esc_attr( $jp_offer_content ) ) ); ?>",
    "identifier": {
        "@type": "PropertyValue",
        "name": "<?php echo esc_html( get_option( 'JobPassCompanyName' ) ); ?>",
        "value": "<?php the_ID(); ?>"
    },
    "datePosted": "<?php echo esc_attr( get_the_date( 'Y/m/d g:ia' ) ); ?>",
    "validThrough": " <?php echo esc_attr( date( 'Y-m-dTg:i', $formatted_valid_through ) ); ?>",
    "employmentType": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_contract', true ) ); ?>",
    "hiringOrganization": {
        "@type": "Organization",
        "name": "<?php echo esc_attr( get_option( 'JobPassCompanyName' ) ); ?>",
        "sameAs": "<?php echo esc_attr( get_site_url() ); ?>",
        "logo": "<?php echo esc_attr( $jp_company_image[0] ); ?>"
    },
    "jobLocation": {
        "@type": "Place",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_completeAddress', true ) ); ?>",
            "addressLocality": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_place', true ) ); ?>",
            "addressRegion": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_postalCode', true ) ); ?>",
            "postalCode": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_addressRegion', true ) ); ?>",
            "addressCountry": "FR"
        }
    },
    "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "EUR",
        "value": {
            "@type": "QuantitativeValue",
            "value": "<?php echo esc_attr( get_post_meta( get_the_ID(), 'jp_salary', true ) ); ?>",
            "unitText": "MONTH"
        }
    }
}
</script>

<?php  get_footer(); ?>