<?php
    $args = array(
        'post_status' => 'publish', 
        'posts_per_page' => '-1',
        'post_type' => 'pubIllustration',
        'orderby' => 'rand'
    );
    $my_query = new WP_Query($args);
?>

<!-- Slider main container -->
<div class="publications">
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            ?>    
                <div class="swiper-slide">                    
                    <img src="<?php echo get_field("image")["sizes"]["medium"]; ?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>">
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            endif;
            ?>        
        </div>
    </div>
</div>


<script>
    var mySwiper = new Swiper('.swiper-container', {
    loop: true,
    speed: 1000,
    autoplay: {
        delay: 3000,
    },
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
        rotate: 0,
        stretch: 80,
        depth: 200,
        modifier: 1,
        slideShadows: false,
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

})
</script>