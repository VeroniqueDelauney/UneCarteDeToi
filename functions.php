<?php

	if (! defined('WP_DEBUG')) {
		die( 'Direct access forbidden.' );
	}

	function enqueue_parent_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/assets/css/theme.css' ); // get_stylesheet_directory_uri pour thème enfant
    
		// wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        wp_enqueue_style( 'font-awesome-free', 'https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css' );


        wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
		wp_enqueue_script( 'app-script', get_stylesheet_directory_uri() . '/assets/js/app.js', array('skrollr', 'swiper-js') ); // On indique que c'est dépendant de skrollr
        
        
        
        // wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/assets/fontawesome/css/fontawesome.css' ); // get_stylesheet_directory_uri pour thème enfant
        // wp_enqueue_style( 'font-awesome2', get_stylesheet_directory_uri() . '/assets/fontawesome/css/regular.css' ); // get_stylesheet_directory_uri pour thème enfant
       
	}





	$path = '/js/app.js';
	
	add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

	include('acf.php');


	// Create shortcode to return a block of specific category
	function diwp_social_link_with_parameter($attr){	
		$args = shortcode_atts( array(		
				'cat' => '1',
				'color' => '#F0F',
				'textsize' => '16px'	
			), $attr );	
			$output = '<a href="'.$args['cat'].'" style="color:'.$args['color'].'; font-size:'.$args['textsize'].' ">Check Out My Facebook Page ' . $args['cat'] . '</a>';
		return $output;	
	}	
	add_shortcode( 'categoryBlocks' , 'diwp_social_link_with_parameter' );

	


// Shortcode pour les illustrations de la gallerie
function illustrationsShortCode() {
    ob_start();
    include('includes/gallerieCPT.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}    
add_shortcode('gallerieCPT', 'illustrationsShortCode');


// Shortcode pour 1 illustration de la gallerie
function singleIllustrationsShortCode() {
    ob_start();
    include('includes/single-gallerieCPT.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}    
add_shortcode('singleGallerieCPT', 'singleIllustrationsShortCode');


// Shortcode pour 1 illustration des publications
function singlePublicationsShortCode() {
    ob_start();
    include('includes/single-publicationsCPT.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}    
add_shortcode('singlePublicationsCPT', 'singlePublicationsShortCode');

// Shortcode pour les illustrations de la page des publications
function publicationsImgShortCode() {
    ob_start();
    include('includes/pubIllustrationCPT.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}    
add_shortcode('pubIllustrationCPT', 'publicationsImgShortCode');

// Shortcode pour les témoignages
function temoignagesImgShortCode() {
    ob_start();
    include('includes/temoignageCPT.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}    
add_shortcode('temoignageCPT', 'temoignagesImgShortCode');

// Shortcode pour 1 témoignage pour la page d'accueil
function singleTemoignageShortCode() {
    ob_start();
    include('includes/single-temoignageCPT.php');
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}    
add_shortcode('singleTemoignageCPT', 'singleTemoignageShortCode');
	
// CPT Gallerie
function unecartedetoi_register_post_types_illusGallerie() {	
    $labels = array(
        'name' => 'Illustrations',
        'all_items' => 'Illustrations',  // affiché dans le sous menu
        'singular_name' => 'Illustration',
        'add_new' => 'Ajouter une illustration',
        'add_new_item' => 'Ajouter une illustration',
        'edit_item' => 'Modifier une illustration',
        'view_item' => 'Voir illustration',
        'search_items' => 'Rechercher des illustrations',
        'menu_name' => 'Illustrations',
        'not_found' => 'Aucune illustration trouvée',
        'not_found_in_trash' => 'Aucune illustration trouvée dans la corbeille'
    );
	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array('title', 'thumbnail'),
        // 'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-edit-large',
        'meta_key' => 'Illustration', // nom du champ personnalisé
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
	);
	register_post_type( 'illustration', $args );
}
add_action( 'init', 'unecartedetoi_register_post_types_illusGallerie' ); // Le hook init lance la fonction

// CPT Illustrations de la page publications
function unecartedetoi_register_post_types_illusPublications() {	
    $labels = array(
        'name' => 'Illus publications',
        'all_items' => 'Illus publications',  // affiché dans le sous menu
        'singular_name' => 'Illu publication',
        'add_new' => 'Ajouter une illu de publication',
        'add_new_item' => 'Ajouter une illu de publication',
        'edit_item' => 'Modifier une illu de publication',
        'view_item' => 'Voir illu de publication',
        'search_items' => 'Rechercher des illus de publications',
        'menu_name' => 'Illus de publications',
        'not_found' => 'Aucune illu de publication trouvée',
        'not_found_in_trash' => 'Aucune illu de publication trouvée dans la corbeille'
    );
	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array('title', 'thumbnail'),
        // 'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-admin-appearance',
        'meta_key' => 'Illu de publication', // nom du champ personnalisé
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
	);
	register_post_type( 'pubIllustration', $args );
}
add_action( 'init', 'unecartedetoi_register_post_types_illusPublications' ); // Le hook init lance la fonction

// CPT Gallerie
function unecartedetoi_register_post_types_temoignage() {	
    $labels = array(
        'name' => 'Témoignages',
        'all_items' => 'Témoignages',  // affiché dans le sous menu
        'singular_name' => 'Témoignage',
        'add_new' => 'Ajouter un témoignage',
        'add_new_item' => 'Ajouter un témoignage',
        'edit_item' => 'Modifier un témoignage',
        'view_item' => 'Voir le témoignage',
        'search_items' => 'Rechercher des témoignages',
        'menu_name' => 'Témoignages',
        'not_found' => 'Aucun témoignage trouvé',
        'not_found_in_trash' => 'Aucun témoignage trouvé dans la corbeille'
    );
	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array('title', 'thumbnail'),
        // 'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-format-status',
        'meta_key' => 'Témoignage', // nom du champ personnalisé
        'orderby' => 'meta_value_num',
        'order' => 'ASC'
	);
	register_post_type( 'temoignage', $args );
}
add_action( 'init', 'unecartedetoi_register_post_types_temoignage' ); // Le hook init lance la fonction


	 
	// add_shortcode( 'social_links_para' , 'diwp_social_link_with_parameter' );
	 
	
	
	// function my_shortcode() {
	// 	$category_id = 17;
	// 	$query = new WP_Query ( array( 'category__in' => $category_id));
	// 	if ( $query -> have_posts() ) {
	// 		while ( $query -> have_posts() )
	// 		{
	// 			$query -> the_post();
				
	// 			$result = '<div class="item">';
	// 			$result .= '<div>' . get_the_title() . '<br /></div>';
	// 			$result .= '</div>';
	// 		}}
	// 		wp_reset_postdata();
	// 		return $result;
	// 	}
	// 	add_shortcode('postdisplay', 'my_shortcode'); // Shortcode name + function name
	
	

// // Create shortcode to return a block of specific category
	// function diwp_social_link_with_parameter($attr){
 
	// 	$args = shortcode_atts( array(
		 
	// 			'url' => '#',
	// 			'color' => '#F0F',
	// 			'textsize' => '16px'
	 
	// 		), $attr );
	 
	// 	$output = '<a href="'.$args['url'].'" style="color:'.$args['color'].'; font-size:'.$args['textsize'].' ">Check Out My Facebook Page</a>';
	// 	return $output;
	 
	// }




	// Create new menu zone for main menu
	function register_my_menu() {
		register_nav_menu('main-horizontal-menu',__( 'Main horizontal menu' ));
	}
	add_action( 'init', 'register_my_menu' );	


	/**
	 * Replace the home link URL
	 */
	add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
	function woo_custom_breadrumb_home_url() {
		return 'http://woocommerce.com';
	}


    // // Add text above product title
    // function append_text_to_product_title() {
    //     global $product;
    //     $product_title = $product->get_name();
    //     $product->set_name( $product_title . ' YOUR TEXT');
    // }
    // add_filter( 'woocommerce_short_description', 'append_text_to_product_title', 5 );


    // Le filtre retourne une valeur
    add_filter('woocommerce_short_description', function($short_description){ 
        // Get the product object
        global $product;
        // Get the dimensions (length, width, height)
        $length = $product->get_length();
        $width = $product->get_width();
        $height = $product->get_height();
        $category = $product->get_categories();
        $short_description.= '<i class="fa-light fa-ruler-combined"></i>' . $length.' x '. $height .' cms<br><i class="fa-light"><img src="' . get_stylesheet_directory_uri() . '/assets/img/fabrique_en_france.gif" alt="Imprimé en France"></i>Imprimé en France<br><i class="fa-light fa-truck"></i>Expédié chez vous sous 5 jours<br><i class="fa-light fa-lock"></i>Paiement sécurisé';
        return $short_description;
    });


    // Show stock on general shop page
    add_action( 'woocommerce_after_shop_loop_item', 'bbloomer_show_stock_shop', 10 );  
    function bbloomer_show_stock_shop() {
       global $product;
       $stock = $product->get_stock_quantity();
       if($stock == 1)
       echo '<div class="lastItem">PSST, C\'EST LE DERNIER</div>';
    }


    // Show product category on single product page
    function show_category_single_product() {
        $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
        if ( $product_cats && ! is_wp_error ( $product_cats ) )
        $single_cat = array_shift( $product_cats );
        echo '<h3>' . $single_cat->name . '</h3>';
    }
    add_action( 'woocommerce_single_product_summary', 'show_category_single_product', 2 );

    
    




    // // Show stock on single product
    // add_filter( 'woocommerce_get_availability', 'show_stock', 1, 2 );  
    // function show_stock() {
    //    global $product;
    //    $stock = $product->get_stock_quantity();
    //    if($stock == 1)
    //    echo '<div class="lastItem">C\'EST LE DERNIER</div>';
    // }

    

    // add_filter( 'woocommerce_get_availability', 'change_out_of_stock_text_woocommerce', 1, 2 );
    // function change_out_of_stock_text_woocommerce( $availability, $product_to_check ) {
    // // Change Out of Stock Text
    // if ( ! $product_to_check->is_in_stock() ) {
    //     $availability['availability'] = __('SOLD', 'woocommerce');
    // }
    // if()
    // return $availability;
    // }




    // Enlever la ligne de pagination page archive boutique
    // remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


    // Change number of items displayed per page
    add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', -1 );
    function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = -1;
    return $cols;
    }

    // Changer le titre "Produits similaires" en "Ceux-là ne sont pas mal non plus..."
    add_filter(  'gettext',  'change_related_products_title', 10, 3 );
    function change_related_products_title( $translated, $text, $domain  ) {        
        if( $text === 'Related products' && $domain === 'woocommerce' ){
            $translated = esc_html__( 'Ceux-là ne sont pas mal non plus...', $domain );
        }
        return $translated;        
    }





    
    // Enlever l'action qui appelle la tab de "More info"
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


    
