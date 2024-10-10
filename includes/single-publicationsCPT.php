<?php
$args = array(
    'post_status' => 'publish', 
    'posts_per_page' => '1',
    'post_type' => 'pubIllustration',
    'orderby' => 'rand'
);
$my_query = new WP_Query( $args );  
?>

<div class="singleGallerie animated fadeInLeft">
    <?php
    if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
    ?>    
        <!-- Photo -->
        <div class="img">
            <a href="/galerie">
                <img src="<?php echo get_field("image")["sizes"]["medium"]; ?>" alt="Lien vers la galerie Une Carte de Toi" title="Voir toutes les aquarelles">
            </a>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
    endif;
    ?>
</div>