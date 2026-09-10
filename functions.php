<?php
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/inc/frontend-password-protection.php';

function wpbb_restaurant_project_mode( $mode ) { return 'restaurant'; }
add_filter( 'wp_theme_project_mode', 'wpbb_restaurant_project_mode' );

function wpbb_restaurant_assets() {
    $theme = wp_get_theme();
    $manifest = get_stylesheet_directory() . '/dist/.vite/manifest.json';
    if ( ! is_readable( $manifest ) ) return;
    $data = json_decode( (string) file_get_contents( $manifest ), true );
    if ( ! is_array( $data ) ) return;
    if ( ! empty( $data['src/scss/public.scss']['file'] ) ) {
        wp_enqueue_style( 'wpbb-restaurant-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/scss/public.scss']['file'], '/' ), array(), $theme->get( 'Version' ) );
        if ( function_exists( 'wp_theme_sector_customizer_css' ) ) wp_add_inline_style( 'wpbb-restaurant-app', wp_theme_sector_customizer_css( '#6D2E2E', '18px', '--sector-primary', '--sector-radius' ) );
    }
    if ( ! empty( $data['src/js/main.js']['file'] ) ) wp_enqueue_script( 'wpbb-restaurant-app', get_stylesheet_directory_uri() . '/dist/' . ltrim( $data['src/js/main.js']['file'], '/' ), array(), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'wpbb_restaurant_assets', 30 );

function wpbb_restaurant_dark_mode_bootstrap() { echo '<script>(function(){try{var m=localStorage.getItem("wpThemeMode");if(m==="dark"){document.documentElement.classList.add("is-dark-theme");document.documentElement.setAttribute("data-theme","dark");}}catch(e){}})();</script>'; }
add_action( 'wp_head', 'wpbb_restaurant_dark_mode_bootstrap', 1 );


function wpbb_restaurant_demo_profile( $profile ) {
    $assets = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/img/demo/';
    return array_merge( $profile, array(
        'id'=>'restaurant', 'name'=>__( 'Restaurant', 'wp-bbtheme-child-restaurant' ), 'commerce'=>false,
        'eyebrow'=>__( 'Seasonal food, straightforward booking', 'wp-bbtheme-child-restaurant' ), 'hero_title'=>__( 'A restaurant website that lets the menu do the convincing.', 'wp-bbtheme-child-restaurant' ), 'hero_text'=>__( 'Show dishes, dietary details, opening information and table reservations without turning the site into a delivery-app interface.', 'wp-bbtheme-child-restaurant' ),
        'hero_image'=>$assets . 'hero-photo.jpg', 'about_image'=>$assets . 'about-photo.jpg',
        'primary_label'=>__( 'View the menu', 'wp-bbtheme-child-restaurant' ), 'primary_url'=>'#finder',
        'secondary_label'=>__( 'Explore services', 'wp-bbtheme-child-restaurant' ), 'secondary_url'=>wp_theme_demo_page_url( 'services' ),
        'services_eyebrow'=>__( 'What we do', 'wp-bbtheme-child-restaurant' ), 'services_heading'=>__( 'Food, hospitality and reservations presented with the right amount of detail.', 'wp-bbtheme-child-restaurant' ),
        'about_eyebrow'=>__( 'Why choose us', 'wp-bbtheme-child-restaurant' ), 'about_title'=>__( 'Let the food, room and hospitality have space.', 'wp-bbtheme-child-restaurant' ), 'about_text'=>__( 'The menu is structured content rather than a PDF-only dead end, while reservations and practical information stay easy to find.', 'wp-bbtheme-child-restaurant' ),
        'industries_eyebrow'=>__( 'Built around your needs', 'wp-bbtheme-child-restaurant' ), 'industries_heading'=>__( 'Lunch, dinner, private dining and seasonal menus in one flexible restaurant system.', 'wp-bbtheme-child-restaurant' ),
        'process_eyebrow'=>__( 'How it works', 'wp-bbtheme-child-restaurant' ), 'process_heading'=>__( 'Explore the menu, choose a time and send a table request.', 'wp-bbtheme-child-restaurant' ), 'faq_heading'=>__( 'Dietary, booking and visit questions answered before arrival.', 'wp-bbtheme-child-restaurant' ),
        'services'=>array(array( __( 'Lunch & dinner', 'wp-bbtheme-child-restaurant' ), __( 'Separate menu sections with clear dish and price information.', 'wp-bbtheme-child-restaurant' ) ),
array( __( 'Private dining', 'wp-bbtheme-child-restaurant' ), __( 'Present group spaces, menus and enquiry routes.', 'wp-bbtheme-child-restaurant' ) ),
array( __( 'Wine & drinks', 'wp-bbtheme-child-restaurant' ), __( 'Use the same structured catalogue approach for drinks or pairings.', 'wp-bbtheme-child-restaurant' ) ),
array( __( 'Reservations', 'wp-bbtheme-child-restaurant' ), __( 'Capture table date, time, party size and notes directly.', 'wp-bbtheme-child-restaurant' ) )), 'industries'=>array(array( __( 'Seasonal menu', 'wp-bbtheme-child-restaurant' ), __( 'Keep changing dishes editable without rebuilding page layouts.', 'wp-bbtheme-child-restaurant' ) ),
array( __( 'Dietary discovery', 'wp-bbtheme-child-restaurant' ), __( 'Vegetarian, vegan and gluten-free tags support quick filtering.', 'wp-bbtheme-child-restaurant' ) ),
array( __( 'Private events', 'wp-bbtheme-child-restaurant' ), __( 'Create clear routes for group and occasion enquiries.', 'wp-bbtheme-child-restaurant' ) ),
array( __( 'Local stories', 'wp-bbtheme-child-restaurant' ), __( 'Use journal content for producers, ingredients and events.', 'wp-bbtheme-child-restaurant' ) )), 'stats'=>array(array( '28', __( 'Menu dishes', 'wp-bbtheme-child-restaurant' ) ),
array( '4', __( 'Menu sections', 'wp-bbtheme-child-restaurant' ) ),
array( '6', __( 'Dietary tags', 'wp-bbtheme-child-restaurant' ) ),
array( '2 min', __( 'Reservation request', 'wp-bbtheme-child-restaurant' ) )), 'process'=>array(array( '01', __( 'Explore', 'wp-bbtheme-child-restaurant' ), __( 'Filter dishes by course, dietary preference and price.', 'wp-bbtheme-child-restaurant' ) ),
array( '02', __( 'Reserve', 'wp-bbtheme-child-restaurant' ), __( 'Choose date, time and party size.', 'wp-bbtheme-child-restaurant' ) ),
array( '03', __( 'Visit', 'wp-bbtheme-child-restaurant' ), __( 'Receive confirmation from the restaurant team.', 'wp-bbtheme-child-restaurant' ) )),
        'cta_title'=>__( 'Make the next table easy to book.', 'wp-bbtheme-child-restaurant' ), 'cta_text'=>__( 'Use the menu catalogue and reservation workflow as a practical base for restaurants, cafes, bistros and dining rooms.', 'wp-bbtheme-child-restaurant' ), 'footer_text'=>__( 'Seasonal menus, dietary filters and direct table reservations in one straightforward restaurant website.', 'wp-bbtheme-child-restaurant' ),
        'page_labels'=>array('about'=>__( 'About', 'wp-bbtheme-child-restaurant' ),'services'=>__( 'Services', 'wp-bbtheme-child-restaurant' ),'industries'=>__( 'Solutions', 'wp-bbtheme-child-restaurant' ),'contact'=>__( 'Contact', 'wp-bbtheme-child-restaurant' ),'blog'=>__( 'Insights', 'wp-bbtheme-child-restaurant' )),
        'palette'=>array('theme_brand_color'=>'#6D2E2E','theme_accent_color'=>'#68744A','theme_background_color'=>'#f7f8fb','theme_surface_color'=>'#ffffff','theme_border_color'=>'#dfe4ee','theme_radius'=>'22px')
    ) );
}
add_filter( 'wp_theme_demo_profile', 'wpbb_restaurant_demo_profile', 20 );


function wpbb_restaurant_pattern_markup( $name ) {
    $path = get_stylesheet_directory() . '/patterns/' . sanitize_file_name( $name ) . '.php';
    if ( ! is_readable( $path ) ) return '';
    ob_start(); include $path; return trim( (string) ob_get_clean() );
}

function wpbb_restaurant_extra_home_sections( $content, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'restaurant' ) return $content;
    return $content . wpbb_restaurant_pattern_markup( 'sector-proof' );
}
add_filter( 'wp_theme_demo_extra_home_sections', 'wpbb_restaurant_extra_home_sections', 25, 2 );

function wpbb_restaurant_blog_profile( $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'restaurant' ) return $profile;
    $profile['blog_eyebrow'] = __( 'Insights', 'wp-bbtheme-child-restaurant' );
    $profile['blog_archive_title'] = __( 'Seasonal notes, producer stories and restaurant news.', 'wp-bbtheme-child-restaurant' );
    $profile['blog_archive_intro'] = __( 'Editorial content for ingredients, events and the thinking behind the menu.', 'wp-bbtheme-child-restaurant' );
    return $profile;
}
add_filter( 'wp_theme_demo_profile', 'wpbb_restaurant_blog_profile', 90 );


function wpbb_restaurant_demo_attachment( $filename, $title ) {
    $slug = sanitize_title( pathinfo( $filename, PATHINFO_FILENAME ) );
    $existing = get_page_by_path( 'wpbb-restaurant-' . $slug, OBJECT, 'attachment' );
    if ( $existing ) return $existing->ID;
    $source = get_stylesheet_directory() . '/assets/img/demo/' . basename( $filename );
    if ( ! is_readable( $source ) ) return 0;
    $uploads = wp_upload_dir(); $dir = trailingslashit( $uploads['basedir'] ) . 'wpbb-restaurant'; wp_mkdir_p( $dir );
    $target = $dir . '/' . basename( $filename ); if ( ! file_exists( $target ) ) copy( $source, $target );
    $filetype = wp_check_filetype( $target );
    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
    $id = wp_insert_attachment( array( 'post_mime_type'=>$filetype['type'] ?: 'image/jpeg', 'post_title'=>$title, 'post_name'=>'wpbb-restaurant-' . $slug, 'post_status'=>'inherit' ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wpbb_child_381048_generate_attachment_metadata( $id, $target ); if ( $meta ) wp_update_attachment_metadata( $id, $meta ); update_post_meta( $id, '_wp_attachment_image_alt', $title );
        return (int) $id;
    }
    return 0;
}

function wpbb_restaurant_register_directory() {
    register_post_type( 'menu_item', array(
        'labels'=>array('name'=>__( 'Menu Items', 'wp-bbtheme-child-restaurant' ),'singular_name'=>__( 'Menu Item', 'wp-bbtheme-child-restaurant' ),'add_new_item'=>__( 'Add Menu Item', 'wp-bbtheme-child-restaurant' )),
        'public'=>true,'show_in_rest'=>true,'has_archive'=>'menu','rewrite'=>array('slug'=>'menu'),'menu_icon'=>'dashicons-food','supports'=>array('title','editor','excerpt','thumbnail','page-attributes')
    ) );
    register_taxonomy( 'menu_section', 'menu_item', array( 'label'=>__( 'Menu sections', 'wp-bbtheme-child-restaurant' ), 'public'=>true, 'show_in_rest'=>true, 'hierarchical'=>true, 'rewrite'=>array('slug'=>'menu-section') ) ); register_taxonomy( 'dietary', 'menu_item', array( 'label'=>__( 'Dietary', 'wp-bbtheme-child-restaurant' ), 'public'=>true, 'show_in_rest'=>true, 'hierarchical'=>true, 'rewrite'=>array('slug'=>'dietary') ) );
}
add_action( 'init', 'wpbb_restaurant_register_directory', 12 );

function wpbb_restaurant_meta_fields() { return array('price'=>__( 'Price', 'wp-bbtheme-child-restaurant' ),'allergens'=>__( 'Allergens', 'wp-bbtheme-child-restaurant' ),'calories'=>__( 'Calories', 'wp-bbtheme-child-restaurant' ),'origin'=>__( 'Key ingredient / origin', 'wp-bbtheme-child-restaurant' )); }
function wpbb_restaurant_meta_box() { add_meta_box( 'wpbb-restaurant-details', __( 'Menu Item details', 'wp-bbtheme-child-restaurant' ), 'wpbb_restaurant_meta_box_render', 'menu_item', 'normal', 'high' ); }
add_action( 'add_meta_boxes', 'wpbb_restaurant_meta_box' );
function wpbb_restaurant_meta_box_render( $post ) {
    wp_nonce_field( 'wpbb_restaurant_save', 'wpbb_restaurant_nonce' ); echo '<div style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px">';
    foreach ( wpbb_restaurant_meta_fields() as $key=>$label ) { $value=get_post_meta($post->ID,'_restaurant_'.$key,true); echo '<label><strong>'.esc_html($label).'</strong><input class="widefat" type="text" name="wpbb_restaurant['.esc_attr($key).']" value="'.esc_attr($value).'"></label>'; } echo '</div>';
}
function wpbb_restaurant_save_meta( $post_id ) {
    if ( empty($_POST['wpbb_restaurant_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpbb_restaurant_nonce'])),'wpbb_restaurant_save') || !current_user_can('edit_post',$post_id) ) return;
    $values=isset($_POST['wpbb_restaurant'])&&is_array($_POST['wpbb_restaurant'])?wp_unslash($_POST['wpbb_restaurant']):array(); foreach(wpbb_restaurant_meta_fields() as $key=>$label) update_post_meta($post_id,'_restaurant_'.$key,sanitize_text_field($values[$key]??''));
}
add_action( 'save_post_menu_item', 'wpbb_restaurant_save_meta' );

function wpbb_restaurant_directory_configs( $configs ) {
    $configs['restaurant'] = array(
      'post_type'=>'menu_item','eyebrow'=>__( 'Menu', 'wp-bbtheme-child-restaurant' ),'title'=>__( 'Explore today’s menu.', 'wp-bbtheme-child-restaurant' ),'intro'=>__( 'Filter by course, dietary preference or price while keeping the menu easy to scan.', 'wp-bbtheme-child-restaurant' ),'keyword_label'=>__( 'Search dishes', 'wp-bbtheme-child-restaurant' ),'keyword_placeholder'=>__( 'Ingredient or dish', 'wp-bbtheme-child-restaurant' ),'button_label'=>__( 'Filter menu', 'wp-bbtheme-child-restaurant' ),'results_label'=>__( 'dishes', 'wp-bbtheme-child-restaurant' ),'limit'=>8,'default_sort'=>'featured',
      'filters'=>array(array('type'=>'taxonomy','key'=>'section','label'=>__( 'Menu section', 'wp-bbtheme-child-restaurant' ),'taxonomy'=>'menu_section','all_label'=>'All sections'),array('type'=>'taxonomy','key'=>'dietary','label'=>__( 'Dietary', 'wp-bbtheme-child-restaurant' ),'taxonomy'=>'dietary','all_label'=>'Any dietary'),array('type'=>'meta_max','key'=>'max_price','label'=>__( 'Max price', 'wp-bbtheme-child-restaurant' ),'meta_key'=>'_restaurant_price','placeholder'=>'Any','step'=>1)),'sorts'=>array('featured'=>array('label'=>__( 'Menu order', 'wp-bbtheme-child-restaurant' ),'orderby'=>'menu_order','order'=>'ASC'),'price-asc'=>array('label'=>__( 'Price: low to high', 'wp-bbtheme-child-restaurant' ),'orderby'=>'meta_value_num','order'=>'ASC','meta_key'=>'_restaurant_price'),'price-desc'=>array('label'=>__( 'Price: high to low', 'wp-bbtheme-child-restaurant' ),'orderby'=>'meta_value_num','order'=>'DESC','meta_key'=>'_restaurant_price')),'card_taxonomies'=>array('menu_section','dietary'),'card_meta'=>array(array('key'=>'_restaurant_price','label'=>__( 'Price', 'wp-bbtheme-child-restaurant' ),'format'=>'money','currency'=>'£'),array('key'=>'_restaurant_allergens','label'=>__( 'Allergens', 'wp-bbtheme-child-restaurant' )),array('key'=>'_restaurant_calories','label'=>__( 'Calories', 'wp-bbtheme-child-restaurant' ),'suffix'=>' kcal')),'card_button'=>__( 'View dish', 'wp-bbtheme-child-restaurant' )
    ); return $configs;
}
add_filter( 'wp_theme_sector_directory_configs', 'wpbb_restaurant_directory_configs' );

function wpbb_restaurant_seed_directory( $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'restaurant' ) return;
    $rows=array(array('title'=>'Roast Squash & Labneh','slug'=>'roast-squash-labneh','excerpt'=>'Charred squash, cultured labneh, hazelnut and herb oil.','content'=>'Charred squash, cultured labneh, hazelnut and herb oil.','terms'=>array('menu_section'=>'Starters','dietary'=>'Vegetarian'),'meta'=>array('price'=>'11','allergens'=>'Milk, nuts','calories'=>'340','origin'=>'Local squash'),'image'=>'item-1.jpg'),array('title'=>'Cured Sea Trout','slug'=>'cured-sea-trout','excerpt'=>'Citrus-cured trout, dill, cucumber and rye crisp.','content'=>'Citrus-cured trout, dill, cucumber and rye crisp.','terms'=>array('menu_section'=>'Starters','dietary'=>'Pescatarian'),'meta'=>array('price'=>'13','allergens'=>'Fish, gluten','calories'=>'290','origin'=>'North Atlantic trout'),'image'=>'item-2.jpg'),array('title'=>'Pan-Roasted Sea Bass','slug'=>'pan-roasted-sea-bass','excerpt'=>'Sea bass, crushed potatoes, greens and caper butter.','content'=>'Sea bass, crushed potatoes, greens and caper butter.','terms'=>array('menu_section'=>'Mains','dietary'=>'Gluten free'),'meta'=>array('price'=>'26','allergens'=>'Fish, milk','calories'=>'610','origin'=>'Day-boat fish'),'image'=>'item-3.jpg'),array('title'=>'Wild Mushroom Barley','slug'=>'wild-mushroom-barley','excerpt'=>'Pearl barley, roasted mushrooms, herbs and aged cheese.','content'=>'Pearl barley, roasted mushrooms, herbs and aged cheese.','terms'=>array('menu_section'=>'Mains','dietary'=>'Vegetarian'),'meta'=>array('price'=>'21','allergens'=>'Gluten, milk','calories'=>'560','origin'=>'Woodland mushrooms'),'image'=>'item-4.jpg'),array('title'=>'Herb-Roasted Chicken','slug'=>'herb-roasted-chicken','excerpt'=>'Free-range chicken, roast roots and chicken jus.','content'=>'Free-range chicken, roast roots and chicken jus.','terms'=>array('menu_section'=>'Mains','dietary'=>'Gluten free'),'meta'=>array('price'=>'24','allergens'=>'None declared','calories'=>'690','origin'=>'Free-range chicken'),'image'=>'item-5.jpg'),array('title'=>'Dark Chocolate Tart','slug'=>'dark-chocolate-tart','excerpt'=>'Dark chocolate, crème fraîche and sea salt caramel.','content'=>'Dark chocolate, crème fraîche and sea salt caramel.','terms'=>array('menu_section'=>'Desserts','dietary'=>'Vegetarian'),'meta'=>array('price'=>'9','allergens'=>'Gluten, milk, eggs','calories'=>'430','origin'=>'70% dark chocolate'),'image'=>'item-6.jpg'));
    foreach($rows as $i=>$row){
      foreach($row['terms'] as $tax=>$term) if(taxonomy_exists($tax)&&!term_exists($term,$tax)) wp_insert_term($term,$tax);
      $existing=get_page_by_path($row['slug'],OBJECT,'menu_item'); $args=array('post_type'=>'menu_item','post_status'=>'publish','post_title'=>$row['title'],'post_name'=>$row['slug'],'menu_order'=>$i,'post_excerpt'=>$row['excerpt'],'post_content'=>'<!-- wp:paragraph --><p>'.esc_html($row['content']).'</p><!-- /wp:paragraph -->');
      if($existing){$args['ID']=$existing->ID;$id=wp_update_post($args);}else{$id=wp_insert_post($args);} if(!$id||is_wp_error($id))continue;
      foreach($row['terms'] as $tax=>$term)wp_set_object_terms($id,$term,$tax); foreach($row['meta'] as $key=>$value)update_post_meta($id,'_restaurant_'.$key,$value); $img=wpbb_restaurant_demo_attachment($row['image'],$row['title']); if($img)set_post_thumbnail($id,$img); update_post_meta($id,'_wp_theme_demo_menu_item',1);
    }
}
add_action( 'wp_theme_seed_sector_pages', 'wpbb_restaurant_seed_directory', 25 );

function wpbb_restaurant_after_hero_finder( $content, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'restaurant' ) return $content;
    return $content . '<!-- wp:wpbb/bootstrap-div {"containerClass":"","utilityClasses":"wp-theme-section-shell wpbb-restaurant-finder-section","className":"wpbb-v62-section"} --><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"restaurant","limit":8} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --><!-- /wp:wpbb/bootstrap-div -->';
}
add_filter( 'wp_theme_demo_after_hero_sections', 'wpbb_restaurant_after_hero_finder', 20, 2 );

function wpbb_restaurant_navigation( $items, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'restaurant' ) return $items;
    array_splice( $items, 1, 0, array( array('key'=>'menu_item','title'=>__( 'Menu', 'wp-bbtheme-child-restaurant' ),'type'=>'post_type_archive','object'=>'menu_item','locations'=>array('header','footer')) ) ); return $items;
}
add_filter( 'wp_theme_demo_navigation_items', 'wpbb_restaurant_navigation', 20, 2 );

function wpbb_restaurant_header_search_types( $types ) { if(post_type_exists('menu_item'))$types[]='menu_item'; return array_values(array_unique($types)); }
add_filter( 'wp_theme_header_search_post_types', 'wpbb_restaurant_header_search_types' );

function wpbb_restaurant_single_content( $content ) {
    if ( !is_singular('menu_item') || !in_the_loop() || !is_main_query() ) return $content; $content=wpbb_child_381043_dedupe_single_body($content,get_the_excerpt()); $id=get_the_ID(); $image=get_the_post_thumbnail_url($id,'large'); $gallery = function_exists( 'wpbb_child_381045_gallery_single_markup' ) ? wpbb_child_381045_gallery_single_markup( $id ) : ''; if ( ! $gallery && function_exists( 'wp_theme_item_gallery_single_markup' ) ) $gallery = wp_theme_item_gallery_single_markup( $id );
    $facts=''; foreach(wpbb_restaurant_meta_fields() as $key=>$label){$value=get_post_meta($id,'_restaurant_'.$key,true);if(''!==trim((string)$value))$facts.='<div><small>'.esc_html($label).'</small><strong>'.esc_html($value).'</strong></div>';}
    $html='<section class="wpbb-sector-single"><div class="container"><div class="wpbb-sector-single__hero"><div class="wpbb-sector-single__media">'.($gallery?:($image?'<img src="'.esc_url($image).'" alt="'.esc_attr(get_the_title()).'">':'')).'</div><div><p class="wp-theme-sector-eyebrow">'.esc_html('Menu Item').'</p><h1>'.esc_html(get_the_title()).'</h1><p class="wp-theme-sector-lead">'.esc_html(get_the_excerpt()).'</p><div class="wpbb-sector-single__facts">'.$facts.'</div></div></div><div class="wpbb-sector-single__content">'.$content.'</div>';
    if(function_exists('wpbb_restaurant_request_form'))$html.=wpbb_restaurant_request_form($id); return $html.'</div></section>';
}
add_filter( 'the_content', 'wpbb_restaurant_single_content', 25 );

function wpbb_restaurant_polylang_post_types( $types, $settings ) { $types['menu_item']='menu_item'; return $types; }
add_filter( 'pll_get_post_types', 'wpbb_restaurant_polylang_post_types', 10, 2 );
function wpbb_restaurant_pll_menu_section( $tax, $settings ) { $tax['menu_section']='menu_section'; return $tax; }
add_filter( 'pll_get_taxonomies', 'wpbb_restaurant_pll_menu_section', 10, 2 );
function wpbb_restaurant_pll_dietary( $tax, $settings ) { $tax['dietary']='dietary'; return $tax; }
add_filter( 'pll_get_taxonomies', 'wpbb_restaurant_pll_dietary', 10, 2 );

function wpbb_restaurant_mega_menu( $definitions, $profile ) {
    if ( ( $profile['id'] ?? '' ) !== 'restaurant' ) return $definitions; $archive=get_post_type_archive_link('menu_item')?:home_url('/menu/');
    $definitions['menu_item']=array('title'=>__( 'Menu navigation', 'wp-bbtheme-child-restaurant' ),'target_key'=>'menu_item','eyebrow'=>__( 'Menu', 'wp-bbtheme-child-restaurant' ),'heading'=>__( 'Explore the menu before you arrive.', 'wp-bbtheme-child-restaurant' ),'intro'=>__( 'Browse courses, dietary choices and seasonal dishes.', 'wp-bbtheme-child-restaurant' ),'columns'=>array(
      array('title'=>__( 'Explore', 'wp-bbtheme-child-restaurant' ),'links'=>array(array(__( 'Menu', 'wp-bbtheme-child-restaurant' ),__( 'Filter by course, dietary preference or price while keeping the menu easy to scan.', 'wp-bbtheme-child-restaurant' ),$archive),array(__( 'Services', 'wp-bbtheme-child-restaurant' ),__( 'Food, hospitality and reservations presented with the right amount of detail.', 'wp-bbtheme-child-restaurant' ),wp_theme_demo_page_url('services')),array(__( 'Solutions', 'wp-bbtheme-child-restaurant' ),__( 'Lunch, dinner, private dining and seasonal menus in one flexible restaurant system.', 'wp-bbtheme-child-restaurant' ),wp_theme_demo_page_url('industries')))),
      array('title'=>__( 'Plan', 'wp-bbtheme-child-restaurant' ),'links'=>array(array(__( 'How it works', 'wp-bbtheme-child-restaurant' ),__( 'Explore the menu, choose a time and send a table request.', 'wp-bbtheme-child-restaurant' ),wp_theme_demo_page_url('services')),array(__( 'About', 'wp-bbtheme-child-restaurant' ),__( 'The menu is structured content rather than a PDF-only dead end, while reservations and practical information stay easy to find.', 'wp-bbtheme-child-restaurant' ),wp_theme_demo_page_url('about')),array(__( 'Contact', 'wp-bbtheme-child-restaurant' ),__( 'Talk to the team about the next step.', 'wp-bbtheme-child-restaurant' ),wp_theme_demo_page_url('contact')))),
      array('title'=>__( 'Useful', 'wp-bbtheme-child-restaurant' ),'links'=>array(array(__( 'Insights', 'wp-bbtheme-child-restaurant' ),__( 'Editorial content for ingredients, events and the thinking behind the menu.', 'wp-bbtheme-child-restaurant' ),get_permalink(get_option('page_for_posts'))?:home_url('/blog/')),array(__( 'Search', 'wp-bbtheme-child-restaurant' ),__( 'Use the live finder to narrow the catalogue.', 'wp-bbtheme-child-restaurant' ),$archive),array(__( 'Enquire', 'wp-bbtheme-child-restaurant' ),__( 'Send the details needed for a useful response.', 'wp-bbtheme-child-restaurant' ),wp_theme_demo_page_url('contact'))))
    )); return $definitions;
}
add_filter('wp_theme_demo_mega_menu_definitions','wpbb_restaurant_mega_menu',20,2);

function wpbb_restaurant_register_reservations(){register_post_type('table_reservation',array('labels'=>array('name'=>__( 'Table Reservations', 'wp-bbtheme-child-restaurant' ),'singular_name'=>__( 'Table Reservation', 'wp-bbtheme-child-restaurant' )),'public'=>false,'show_ui'=>true,'show_in_menu'=>'edit.php?post_type=menu_item','supports'=>array('title')));}add_action('init','wpbb_restaurant_register_reservations',14);
function wpbb_restaurant_reservation_form(){$success=isset($_GET['reservation'])&&'received'===sanitize_key(wp_unslash($_GET['reservation']));ob_start();?><div class="wpbb-restaurant-reservation-shell"><section class="wpbb-sector-request" id="reservation"><p class="wp-theme-sector-eyebrow"><?php echo esc_html(__( 'Reservations', 'wp-bbtheme-child-restaurant' ));?></p><h2><?php echo esc_html(__( 'Request a table.', 'wp-bbtheme-child-restaurant' ));?></h2><?php if($success):?><div class="alert alert-success"><?php echo esc_html(__( 'Thanks. Your table request has been received.', 'wp-bbtheme-child-restaurant' ));?></div><?php endif;?><form method="post" action="<?php echo esc_url(admin_url('admin-post.php'));?>"><input type="hidden" name="action" value="wpbb_restaurant_reserve"><?php wp_nonce_field('wpbb_restaurant_reserve','wpbb_restaurant_nonce');?><label><span><?php echo esc_html(__( 'Name', 'wp-bbtheme-child-restaurant' ));?></span><input name="name" required></label><label><span><?php echo esc_html(__( 'Email', 'wp-bbtheme-child-restaurant' ));?></span><input type="email" name="email" required></label><label><span><?php echo esc_html(__( 'Date', 'wp-bbtheme-child-restaurant' ));?></span><input type="date" name="date" required></label><label><span><?php echo esc_html(__( 'Time', 'wp-bbtheme-child-restaurant' ));?></span><input type="time" name="time" required></label><label><span><?php echo esc_html(__( 'Party size', 'wp-bbtheme-child-restaurant' ));?></span><input type="number" min="1" name="party" required></label><label><span><?php echo esc_html(__( 'Phone', 'wp-bbtheme-child-restaurant' ));?></span><input type="tel" name="phone"></label><label class="is-wide"><span><?php echo esc_html(__( 'Dietary or accessibility notes', 'wp-bbtheme-child-restaurant' ));?></span><textarea name="notes"></textarea></label><button class="btn btn-primary" type="submit"><?php echo esc_html(__( 'Request table', 'wp-bbtheme-child-restaurant' ));?></button></form></section></div><?php return ob_get_clean();}
function wpbb_restaurant_append_reservation($content){if(!is_page('contact')||!in_the_loop()||!is_main_query())return$content;return$content.wpbb_restaurant_reservation_form();}add_filter('the_content','wpbb_restaurant_append_reservation',30);
function wpbb_restaurant_reserve_submit(){if(empty($_POST['wpbb_restaurant_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wpbb_restaurant_nonce'])),'wpbb_restaurant_reserve'))wp_die('Expired form.');$name=sanitize_text_field(wp_unslash($_POST['name']??''));$email=sanitize_email(wp_unslash($_POST['email']??''));$date=sanitize_text_field(wp_unslash($_POST['date']??''));$time=sanitize_text_field(wp_unslash($_POST['time']??''));$party=absint($_POST['party']??0);if(!$name||!is_email($email)||!$date||!$time||!$party)wp_die('Required fields missing.');$id=wp_insert_post(array('post_type'=>'table_reservation','post_status'=>'publish','post_title'=>sprintf('%s — %s %s',$name,$date,$time)));if($id&&!is_wp_error($id))foreach(array('name'=>$name,'email'=>$email,'date'=>$date,'time'=>$time,'party'=>$party,'phone'=>sanitize_text_field(wp_unslash($_POST['phone']??'')),'notes'=>sanitize_textarea_field(wp_unslash($_POST['notes']??'')))as$key=>$value)update_post_meta($id,'_restaurant_reservation_'.$key,$value);wp_safe_redirect(add_query_arg('reservation','received',wp_theme_demo_page_url('contact')).'#reservation');exit;}add_action('admin_post_wpbb_restaurant_reserve','wpbb_restaurant_reserve_submit');add_action('admin_post_nopriv_wpbb_restaurant_reserve','wpbb_restaurant_reserve_submit');

/**
 * v3.8.10.20: keep editable Mega Menu content out of public discovery / SEO.
 * The parent already registers these objects as private; child filters make the
 * intent explicit for Core XML sitemaps and common SEO plugins too.
 */
function wpbb_child_private_megamenu_post_type_args( $args, $post_type ) {
    if ( 'megamenu' !== $post_type ) return $args;
    $args['public'] = false;
    $args['publicly_queryable'] = false;
    $args['exclude_from_search'] = true;
    $args['has_archive'] = false;
    $args['rewrite'] = false;
    $args['query_var'] = false;
    return $args;
}
add_filter( 'register_post_type_args', 'wpbb_child_private_megamenu_post_type_args', 20, 2 );

function wpbb_child_private_megamenu_taxonomy_args( $args, $taxonomy ) {
    if ( 'megamenu-cat' !== $taxonomy ) return $args;
    $args['public'] = false;
    $args['publicly_queryable'] = false;
    $args['rewrite'] = false;
    $args['query_var'] = false;
    return $args;
}
add_filter( 'register_taxonomy_args', 'wpbb_child_private_megamenu_taxonomy_args', 20, 2 );

function wpbb_child_core_sitemap_post_types( $post_types ) {
    unset( $post_types['megamenu'] );
    return $post_types;
}
add_filter( 'wp_sitemaps_post_types', 'wpbb_child_core_sitemap_post_types', 20 );

function wpbb_child_core_sitemap_taxonomies( $taxonomies ) {
    unset( $taxonomies['megamenu-cat'] );
    return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'wpbb_child_core_sitemap_taxonomies', 20 );

function wpbb_child_mega_robots( $robots ) {
    if ( is_singular( 'megamenu' ) || is_tax( 'megamenu-cat' ) ) {
        $robots['noindex'] = true;
        $robots['nofollow'] = true;
    }
    return $robots;
}
add_filter( 'wp_robots', 'wpbb_child_mega_robots', 20 );

function wpbb_child_yoast_exclude_megamenu_post_type( $excluded, $post_type ) {
    return 'megamenu' === $post_type ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_post_type', 'wpbb_child_yoast_exclude_megamenu_post_type', 20, 2 );

function wpbb_child_yoast_exclude_megamenu_taxonomy( $excluded, $taxonomy ) {
    return 'megamenu-cat' === $taxonomy ? true : $excluded;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'wpbb_child_yoast_exclude_megamenu_taxonomy', 20, 2 );

function wpbb_child_yoast_mega_robots( $robots ) {
    if ( is_singular( 'megamenu' ) || is_tax( 'megamenu-cat' ) ) return 'noindex, nofollow';
    return $robots;
}
add_filter( 'wpseo_robots', 'wpbb_child_yoast_mega_robots', 20 );


/**
 * v3.8.10.21: global request-a-quote UI is opt-in by child theme.
 * Sector themes with their own quote journeys can keep it; the rest do not
 * expose an unrelated floating "My Quote" control or public route.
 */
if ( ! function_exists( 'wpbb_child_request_quote_enabled' ) ) {
    function wpbb_child_request_quote_enabled() {
        $enabled_themes = array(
            'wp-bbtheme-child-automotive',
            'wp-bbtheme-child-building-services',
            'wp-bbtheme-child-insurance',
            'wp-bbtheme-child-logistics',
            'wp-bbtheme-child-medicine',
            'wp-bbtheme-child-woo-tech-shop',
        );
        $enabled = in_array( get_stylesheet(), $enabled_themes, true );
        return (bool) apply_filters( 'wpbb_child_request_quote_enabled', $enabled, get_stylesheet() );
    }
}

function wpbb_child_request_quote_body_class( $classes ) {
    $classes[] = wpbb_child_request_quote_enabled() ? 'wpbb-request-quote-enabled' : 'wpbb-request-quote-disabled';
    return $classes;
}
add_filter( 'body_class', 'wpbb_child_request_quote_body_class', 30 );

function wpbb_child_request_quote_menu_items( $items ) {
    if ( wpbb_child_request_quote_enabled() ) return $items;
    $target = trim( (string) wp_parse_url( home_url( '/request-a-quote/' ), PHP_URL_PATH ), '/' );
    foreach ( $items as $key => $item ) {
        $path = trim( (string) wp_parse_url( $item->url, PHP_URL_PATH ), '/' );
        if ( $target && $path === $target ) unset( $items[ $key ] );
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'wpbb_child_request_quote_menu_items', 30 );

function wpbb_child_request_quote_disable_route() {
    if ( wpbb_child_request_quote_enabled() ) return;
    $request = isset( $GLOBALS['wp']->request ) ? trim( (string) $GLOBALS['wp']->request, '/' ) : '';
    if ( ! is_page( 'request-a-quote' ) && 'request-a-quote' !== $request ) return;

    global $wp_query;
    if ( $wp_query ) $wp_query->set_404();
    status_header( 404 );
    nocache_headers();
    $template = get_404_template();
    if ( $template ) {
        include $template;
        exit;
    }
    wp_die( esc_html__( 'Page not found.', 'wp-bbtheme-child' ), esc_html__( 'Not found', 'wp-bbtheme-child' ), array( 'response' => 404 ) );
}
add_action( 'template_redirect', 'wpbb_child_request_quote_disable_route', 1 );

function wpbb_child_request_quote_sitemap_args( $args, $post_type ) {
    if ( wpbb_child_request_quote_enabled() || 'page' !== $post_type ) return $args;
    $page = get_page_by_path( 'request-a-quote' );
    if ( $page ) {
        $excluded = isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array();
        $excluded[] = (int) $page->ID;
        $args['post__not_in'] = array_values( array_unique( $excluded ) );
    }
    return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'wpbb_child_request_quote_sitemap_args', 30, 2 );

require_once get_stylesheet_directory() . '/inc/seo-guardrails.php';

/** v3.8.10.24: identify generated legal pages independently of translated slugs. */
function wpbb_child_legal_page_body_class_v381024( $classes ) {
    if ( ! is_page() ) return $classes;
    $post = get_queried_object();
    if ( ! $post instanceof WP_Post ) return $classes;

    $is_legal = function_exists( 'is_privacy_policy' ) && is_privacy_policy();
    if ( ! $is_legal && false !== strpos( (string) $post->post_content, 'wp-theme-legal-section' ) ) {
        $is_legal = true;
    }
    if ( $is_legal ) $classes[] = 'wpbb-legal-page';
    return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'wpbb_child_legal_page_body_class_v381024', 40 );

/** v3.8.10.25: remove generated empty spacing without touching authored copy. */
if ( ! function_exists( 'wpbb_child_remove_empty_paragraphs_v381025' ) ) {
    function wpbb_child_remove_empty_paragraphs_v381025( $content ) {
        if ( is_admin() || ! is_string( $content ) || '' === $content ) return $content;
        return (string) preg_replace(
            '~<p(?:\\s[^>]*)?>(?:\\s|&nbsp;|&#160;|<br\\s*/?>)*</p>~i',
            '',
            $content
        );
    }
}
add_filter( 'the_content', 'wpbb_child_remove_empty_paragraphs_v381025', 120 );

/** v3.8.10.25: do not output a completely empty CTA block above the footer. */
if ( ! function_exists( 'wpbb_child_remove_empty_cta_v381025' ) ) {
    function wpbb_child_remove_empty_cta_v381025( $block_content, $block ) {
        if ( empty( $block['blockName'] ) || 'wpbb/cta-section' !== $block['blockName'] || ! is_string( $block_content ) ) return $block_content;
        if ( preg_match( '~<(?:img|picture|video|iframe|form|button|a)\\b~i', $block_content ) ) return $block_content;
        $plain = trim( html_entity_decode( wp_strip_all_tags( $block_content ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) ) );
        return '' === $plain ? '' : $block_content;
    }
}
add_filter( 'render_block', 'wpbb_child_remove_empty_cta_v381025', 120, 2 );



/** v3.8.10.29: make demo switching/imports self-healing across child themes. */
if ( ! function_exists( 'wpbb_child_demo_refresh_on_activation_v381029' ) ) {
    function wpbb_child_demo_refresh_on_activation_v381029() {
        // The parent importer stores one global version/profile. When a different
        // child theme is activated, invalidate that marker so its own profile is
        // imported instead of reusing the previous child's demo state.
        delete_option( 'wp_theme_demo_import_version' );
        delete_option( 'wp_theme_demo_menu_profile' );
    }
    add_action( 'after_switch_theme', 'wpbb_child_demo_refresh_on_activation_v381029', 5 );
}

if ( ! function_exists( 'wpbb_child_demo_integrity_guard_v381029' ) ) {
    function wpbb_child_demo_integrity_guard_v381029( $page_id = 0, $profile = array() ) {
        $page_id = absint( $page_id ?: get_option( 'page_on_front' ) );
        if ( ! $page_id || 'page' !== get_post_type( $page_id ) ) return;

        $content = (string) get_post_field( 'post_content', $page_id );
        // Never rewrite a real imported or edited homepage. This is only a guard
        // for the genuinely empty/near-empty page seen after switching demos.
        if ( strlen( trim( $content ) ) >= 120 ) return;

        if ( ! is_array( $profile ) ) $profile = array();
        $eyebrow = (string) ( $profile['eyebrow'] ?? __( 'Welcome', 'wp-theme' ) );
        $title = (string) ( $profile['hero_title'] ?? get_bloginfo( 'name' ) );
        $intro = (string) ( $profile['hero_text'] ?? __( 'A practical WordPress starter site ready to edit.', 'wp-theme' ) );
        $primary_label = (string) ( $profile['primary_label'] ?? __( 'Get started', 'wp-theme' ) );
        $primary_url = (string) ( $profile['primary_url'] ?? home_url( '/contact/' ) );
        $secondary_label = (string) ( $profile['secondary_label'] ?? __( 'Explore', 'wp-theme' ) );
        $secondary_url = (string) ( $profile['secondary_url'] ?? home_url( '/services/' ) );
        $services_heading = (string) ( $profile['services_heading'] ?? __( 'Useful services, clearly presented.', 'wp-theme' ) );
        $about_title = (string) ( $profile['about_title'] ?? __( 'A flexible starting point for the real site.', 'wp-theme' ) );
        $about_text = (string) ( $profile['about_text'] ?? $intro );
        $hero_image = esc_url( (string) ( $profile['hero_image'] ?? '' ) );
        $about_image = esc_url( (string) ( $profile['about_image'] ?? $hero_image ) );
        $services = ! empty( $profile['services'] ) && is_array( $profile['services'] ) ? array_slice( $profile['services'], 0, 4 ) : array();
        $stats = ! empty( $profile['stats'] ) && is_array( $profile['stats'] ) ? array_slice( $profile['stats'], 0, 4 ) : array();

        $out = '<!-- wp:wpbb/bootstrap-div {"containerClass":"","utilityClasses":"wp-theme-section-shell wp-theme-sector-hero wp-theme-demo-repair","className":"wpbb-v62-section"} --><!-- wp:wpbb/row {"containerClass":"container","customClasses":"align-items-center"} --><!-- wp:wpbb/column {"xs":12,"lg":6} --><p class="wp-theme-sector-eyebrow">' . esc_html( $eyebrow ) . '</p><h1>' . esc_html( $title ) . '</h1><p class="wp-theme-sector-lead">' . esc_html( $intro ) . '</p><div class="wp-theme-demo-buttons"><a class="btn btn-primary" href="' . esc_url( $primary_url ) . '">' . esc_html( $primary_label ) . '</a><a class="btn btn-outline-primary" href="' . esc_url( $secondary_url ) . '">' . esc_html( $secondary_label ) . '</a></div><!-- /wp:wpbb/column -->';
        if ( $hero_image ) $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><figure class="wp-theme-sector-page-image"><img src="' . $hero_image . '" alt="" loading="eager" decoding="async"></figure><!-- /wp:wpbb/column -->';
        $out .= '<!-- /wp:wpbb/row --><!-- /wp:wpbb/bootstrap-div -->';

        if ( 'automotive' === ( $profile['id'] ?? '' ) ) {
            $out .= '<!-- wp:wpbb/bootstrap-div {"containerClass":"","utilityClasses":"wp-theme-section-shell wpbb-automotive-finder-section","className":"wpbb-v62-section"} --><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"automotive","limit":8} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --><!-- /wp:wpbb/bootstrap-div -->';
        }

        $out .= '<!-- wp:wpbb/bootstrap-div {"containerClass":"","utilityClasses":"wp-theme-section-shell wp-theme-services-section","className":"wpbb-v62-section"} --><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><p class="wp-theme-sector-eyebrow">' . esc_html( (string) ( $profile['services_eyebrow'] ?? __( 'Services', 'wp-theme' ) ) ) . '</p><h2>' . esc_html( $services_heading ) . '</h2><!-- wp:wpbb/row {"gutterX":"gx-4","gutterY":"gy-4"} -->';
        foreach ( $services as $service ) {
            $service_title = is_array( $service ) ? (string) ( $service[0] ?? '' ) : '';
            $service_text = is_array( $service ) ? (string) ( $service[1] ?? '' ) : '';
            if ( '' === trim( $service_title ) ) continue;
            $out .= '<!-- wp:wpbb/column {"xs":12,"md":6,"lg":3} --><article class="wp-theme-sector-card"><h3>' . esc_html( $service_title ) . '</h3><p>' . esc_html( $service_text ) . '</p></article><!-- /wp:wpbb/column -->';
        }
        $out .= '<!-- /wp:wpbb/row --><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --><!-- /wp:wpbb/bootstrap-div -->';

        $out .= '<!-- wp:wpbb/bootstrap-div {"containerClass":"","utilityClasses":"wp-theme-section-shell wp-theme-about-section","className":"wpbb-v62-section"} --><!-- wp:wpbb/row {"containerClass":"container","customClasses":"align-items-center"} -->';
        if ( $about_image ) $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><figure class="wp-theme-sector-page-image"><img src="' . $about_image . '" alt="" loading="lazy" decoding="async"></figure><!-- /wp:wpbb/column -->';
        $out .= '<!-- wp:wpbb/column {"xs":12,"lg":6} --><p class="wp-theme-sector-eyebrow">' . esc_html( (string) ( $profile['about_eyebrow'] ?? __( 'About', 'wp-theme' ) ) ) . '</p><h2>' . esc_html( $about_title ) . '</h2><p class="wp-theme-sector-lead">' . esc_html( $about_text ) . '</p><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --><!-- /wp:wpbb/bootstrap-div -->';

        if ( $stats ) {
            $out .= '<!-- wp:wpbb/bootstrap-div {"containerClass":"","utilityClasses":"wp-theme-section-shell wp-theme-sector-proof","className":"wpbb-v62-section"} --><!-- wp:wpbb/row {"containerClass":"container","gutterX":"gx-3","gutterY":"gy-3"} -->';
            foreach ( $stats as $stat ) {
                $number = is_array( $stat ) ? (string) ( $stat[0] ?? '' ) : '';
                $label = is_array( $stat ) ? (string) ( $stat[1] ?? '' ) : '';
                $out .= '<!-- wp:wpbb/column {"xs":6,"lg":3} --><div class="wp-theme-sector-proof__item"><h3>' . esc_html( $number ) . '</h3><p>' . esc_html( $label ) . '</p></div><!-- /wp:wpbb/column -->';
            }
            $out .= '<!-- /wp:wpbb/row --><!-- /wp:wpbb/bootstrap-div -->';
        }

        $out .= '<!-- wp:wpbb/cta-section {"title":"' . esc_attr( (string) ( $profile['cta_title'] ?? __( 'Ready to make it yours?', 'wp-theme' ) ) ) . '","titleTag":"h2","text":"' . esc_attr( (string) ( $profile['cta_text'] ?? $intro ) ) . '","buttonText":"' . esc_attr( $primary_label ) . '","buttonUrl":"' . esc_url( $primary_url ) . '","className":"wp-theme-home-cta wp-theme-home-cta--bbuilder"} /-->';

        wp_update_post( array( 'ID' => $page_id, 'post_content' => $out ) );
        update_post_meta( $page_id, '_wp_theme_demo_repaired_381029', current_time( 'mysql' ) );
    }
    add_action( 'wp_theme_after_demo_import', 'wpbb_child_demo_integrity_guard_v381029', 99, 2 );
}


/* v3.8.10.30 visual icon configuration */
function wpbb_restaurant_visual_icon_config() {
    $config = array( 'base' => get_stylesheet_directory_uri(), 'icons' => array('tools-kitchen-2', 'building', 'calendar', 'map-pin', 'users', 'camera', 'briefcase', 'shield') );
    echo '<script>window.wpbbChildVisuals=' . wp_json_encode( $config ) . ';</script>';
}
add_action( 'wp_footer', 'wpbb_restaurant_visual_icon_config', 1 );


/* v3.8.10.30: realistic demo blog featured images. Runs only after the theme's explicit demo import. */
function wpbb_restaurant_demo_blog_photo_attachment( $filename, $title ) {
    $slug = sanitize_title( pathinfo( $filename, PATHINFO_FILENAME ) );
    $existing = get_page_by_path( 'restaurant-blog-' . $slug, OBJECT, 'attachment' );
    if ( $existing ) {
        if ( function_exists( 'wpbb_restaurant_refresh_bundled_attachment_v381041' ) ) wpbb_restaurant_refresh_bundled_attachment_v381041( (int) $existing->ID, 'assets/img/blog' );
        return (int) $existing->ID;
    }
    $source = get_stylesheet_directory() . '/assets/img/blog/' . basename( $filename );
    if ( ! is_readable( $source ) ) return 0;
    $uploads = wp_upload_dir();
    $dir = trailingslashit( $uploads['basedir'] ) . 'restaurant-blog';
    wp_mkdir_p( $dir );
    $target = $dir . '/' . basename( $filename );
    if ( ! file_exists( $target ) ) copy( $source, $target );
    $filetype = wp_check_filetype( $target );
    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
    $id = wp_insert_attachment( array(
        'post_mime_type' => $filetype['type'] ?: 'image/jpeg',
        'post_title' => $title,
        'post_name' => 'restaurant-blog-' . $slug,
        'post_status' => 'inherit',
    ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wpbb_child_381048_generate_attachment_metadata( $id, $target );
        if ( $meta ) wp_update_attachment_metadata( $id, $meta );
        update_post_meta( $id, '_wp_attachment_image_alt', $title );
        return (int) $id;
    }
    return 0;
}
function wpbb_restaurant_seed_demo_blog_photos( $page_id = 0, $profile = array() ) {
    $posts = get_posts( array( 'post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>12, 'orderby'=>'date', 'order'=>'DESC' ) );
    if ( ! $posts ) return;
    $images = array( 'blog-1.jpg','blog-2.jpg','blog-3.jpg','blog-4.jpg','blog-5.jpg','blog-6.jpg' );
    foreach ( $posts as $index => $post ) {
        $filename = $images[ $index % count( $images ) ];
        $attachment = wpbb_restaurant_demo_blog_photo_attachment( $filename, get_the_title( $post ) );
        if ( $attachment ) set_post_thumbnail( $post->ID, $attachment );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_restaurant_seed_demo_blog_photos', 70, 2 );


/** v3.8.10.31: apply bundled realistic media to already-imported demos after theme upgrade. */

/**
 * Refresh an already-imported demo attachment from the current child-theme asset.
 *
 * Image optimisation may have changed `_wp_attached_file` from e.g. item-1.jpg to
 * item-1.avif/webp. Resolve the bundled source by filename stem instead of requiring
 * the child theme to ship every generated format, then regenerate all WP sub-sizes.
 */
function wpbb_restaurant_refresh_bundled_attachment_v381041( $attachment_id, $asset_dir ) {
    $attachment_id = absint( $attachment_id );
    if ( ! $attachment_id || 'attachment' !== get_post_type( $attachment_id ) ) return false;

    $attached = (string) get_post_meta( $attachment_id, '_wp_attached_file', true );
    $stem = pathinfo( basename( $attached ), PATHINFO_FILENAME );
    if ( '' === $stem ) return false;

    $base = trailingslashit( get_stylesheet_directory() ) . trailingslashit( $asset_dir ) . $stem;
    $source = '';
    foreach ( array( '.jpg', '.jpeg', '.png', '.webp', '.avif' ) as $extension ) {
        if ( is_readable( $base . $extension ) ) {
            $source = $base . $extension;
            break;
        }
    }
    if ( ! $source ) return false;

    $target = get_attached_file( $attachment_id );
    if ( ! $target ) return false;

    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';

    $source_ext = strtolower( (string) pathinfo( $source, PATHINFO_EXTENSION ) );
    $target_ext = strtolower( (string) pathinfo( $target, PATHINFO_EXTENSION ) );
    $written = false;

    if ( $source_ext === $target_ext ) {
        $written = (bool) @copy( $source, $target );
    } else {
        $target_type = wp_check_filetype( $target );
        $target_mime = ! empty( $target_type['type'] ) ? (string) $target_type['type'] : '';
        $editor = wp_get_image_editor( $source );
        if ( ! is_wp_error( $editor ) && 0 === strpos( $target_mime, 'image/' ) ) {
            $saved = $editor->save( $target, $target_mime );
            $written = ! is_wp_error( $saved ) && is_readable( $target );
        }
    }

    // Some hosts can read AVIF/WebP but cannot encode it. Fall back to the bundled
    // source extension and update WordPress to the new original file explicitly.
    if ( ! $written ) {
        $fallback = trailingslashit( dirname( $target ) ) . $stem . '.' . $source_ext;
        if ( ! @copy( $source, $fallback ) ) return false;
        update_attached_file( $attachment_id, $fallback );
        $filetype = wp_check_filetype( $fallback );
        if ( ! empty( $filetype['type'] ) ) {
            wp_update_post( array( 'ID' => $attachment_id, 'post_mime_type' => $filetype['type'] ) );
        }
        $target = $fallback;
    }

    // Remove old generated sizes first. Otherwise stale JPG thumbnails can remain
    // referenced after the original was converted to AVIF/WebP by an optimiser.
    $old_meta = wp_get_attachment_metadata( $attachment_id );
    if ( is_array( $old_meta ) && ! empty( $old_meta['sizes'] ) && is_array( $old_meta['sizes'] ) ) {
        foreach ( $old_meta['sizes'] as $old_size ) {
            if ( empty( $old_size['file'] ) ) continue;
            $old_file = trailingslashit( dirname( $target ) ) . basename( (string) $old_size['file'] );
            if ( is_file( $old_file ) && wp_normalize_path( $old_file ) !== wp_normalize_path( $target ) ) @unlink( $old_file );
        }
    }

    $meta = wpbb_child_381048_generate_attachment_metadata( $attachment_id, $target );
    if ( $meta ) wp_update_attachment_metadata( $attachment_id, $meta );
    clean_attachment_cache( $attachment_id );
    return true;
}

function wpbb_restaurant_realistic_media_upgrade_v381041() {
    if ( ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) ) return;
    $done_key = 'wpbb_restaurant_realistic_media_upgrade_v381074';
    if ( get_option( $done_key ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;

    $pairs = array(array('wpbb-restaurant','assets/img/demo'),array('restaurant-blog','assets/img/blog'));
    foreach ( $pairs as $pair ) {
        $upload_prefix = $pair[0];
        $asset_dir = $pair[1];
        $ids = get_posts( array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array( array( 'key'=>'_wp_attached_file', 'value'=>$upload_prefix . '/', 'compare'=>'LIKE' ) ),
        ) );
        foreach ( $ids as $attachment_id ) {
            wpbb_restaurant_refresh_bundled_attachment_v381041( $attachment_id, $asset_dir );
        }
    }
    if ( function_exists( 'wpbb_restaurant_seed_directory' ) ) wpbb_restaurant_seed_directory( array( 'id'=>'restaurant' ) );
    if ( function_exists( 'wpbb_restaurant_seed_demo_blog_photos' ) ) wpbb_restaurant_seed_demo_blog_photos( 0, array() );
    update_option( $done_key, current_time( 'mysql' ), false );
}
add_action( 'admin_init', 'wpbb_restaurant_realistic_media_upgrade_v381041', 120 );


/* v3.8.10.42: full-width single-column demo rows + optional frontend demo protection. */
function wpbb_child_381042_repair_single_columns( $blocks ) {
    foreach ( $blocks as &$block ) {
        if ( 'wpbb/row' === ( $block['blockName'] ?? '' ) && ! empty( $block['innerBlocks'] ) ) {
            $column_indexes = array();
            foreach ( $block['innerBlocks'] as $index => $inner ) {
                if ( 'wpbb/column' === ( $inner['blockName'] ?? '' ) ) $column_indexes[] = $index;
            }
            if ( 1 === count( $column_indexes ) ) {
                $idx = $column_indexes[0];
                $attrs = $block['innerBlocks'][ $idx ]['attrs'] ?? array();
                if ( 12 === (int) ( $attrs['xs'] ?? 12 ) ) {
                    $attrs['xs'] = 12;
                    foreach ( array( 'sm', 'md', 'lg', 'xl', 'xxl' ) as $breakpoint ) unset( $attrs[ $breakpoint ] );
                    $block['innerBlocks'][ $idx ]['attrs'] = $attrs;
                }
            }
        }
        if ( ! empty( $block['innerBlocks'] ) ) $block['innerBlocks'] = wpbb_child_381042_repair_single_columns( $block['innerBlocks'] );
    }
    unset( $block );
    return $blocks;
}

function wpbb_child_381042_repair_demo_page_widths() {
    $pages = get_posts( array(
        'post_type' => 'page', 'post_status' => 'any', 'posts_per_page' => -1,
        'meta_key' => '_wp_theme_demo_managed', 'meta_value' => '1', 'fields' => 'ids',
    ) );
    foreach ( $pages as $page_id ) {
        $content = (string) get_post_field( 'post_content', $page_id );
        if ( false === strpos( $content, 'wpbb/column' ) ) continue;
        $blocks = parse_blocks( $content );
        $repaired = serialize_blocks( wpbb_child_381042_repair_single_columns( $blocks ) );
        if ( $repaired !== $content ) wp_update_post( array( 'ID' => $page_id, 'post_content' => $repaired ) );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_child_381042_repair_demo_page_widths', 140 );
function wpbb_child_381042_repair_demo_page_widths_once() {
    if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) return;
    $key = 'wpbb_381042_single_col_' . sanitize_key( get_stylesheet() );
    if ( get_option( $key ) ) return;
    wpbb_child_381042_repair_demo_page_widths();
    update_option( $key, 1, false );
}
add_action( 'admin_init', 'wpbb_child_381042_repair_demo_page_widths_once', 40 );

/**
 * v3.8.10.43: repair shared demo alignment and force one fresh media pass.
 *
 * The previous media migration was intentionally one-shot. This release uses a
 * new per-theme marker so sites that already ran v381041 receive the current
 * child-owned room/product/project/blog images as well.
 */
if ( ! function_exists( 'wpbb_child_381043_normalize_text' ) ) {
    function wpbb_child_381043_normalize_text( $value ) {
        $value = html_entity_decode( wp_strip_all_tags( (string) $value ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) );
        return trim( preg_replace( '/\\s+/u', ' ', $value ) );
    }
}

if ( ! function_exists( 'wpbb_child_381043_dedupe_single_body' ) ) {
    function wpbb_child_381043_dedupe_single_body( $content, $excerpt = '' ) {
        $excerpt_text = wpbb_child_381043_normalize_text( $excerpt );
        if ( '' === $excerpt_text ) return $content;

        $content_text = wpbb_child_381043_normalize_text( $content );
        if ( $content_text === $excerpt_text ) return '';

        if ( preg_match( '~^\\s*<p(?:\\s[^>]*)?>(.*?)</p>~is', (string) $content, $match ) ) {
            if ( wpbb_child_381043_normalize_text( $match[1] ) === $excerpt_text ) {
                return ltrim( substr( (string) $content, strlen( $match[0] ) ) );
            }
        }
        return $content;
    }
}

if ( ! function_exists( 'wpbb_child_381043_repair_block_alignment' ) ) {
    function wpbb_child_381043_repair_block_alignment( $blocks ) {
        foreach ( $blocks as &$block ) {
            if ( 'wpbb/row' === ( $block['blockName'] ?? '' ) ) {
                $attrs = $block['attrs'] ?? array();
                $classes = preg_split( '/\\s+/', trim( (string) ( $attrs['customClasses'] ?? '' ) ) );
                $classes = array_values( array_filter( array_map( 'sanitize_html_class', $classes ) ) );
                if ( in_array( 'wp-theme-sector-media-text', $classes, true ) ) {
                    $classes = array_values( array_diff( $classes, array( 'align-items-center', 'align-items-end' ) ) );
                    if ( ! in_array( 'align-items-start', $classes, true ) ) $classes[] = 'align-items-start';
                    $attrs['customClasses'] = implode( ' ', $classes );
                    $block['attrs'] = $attrs;
                }
            }
            if ( ! empty( $block['innerBlocks'] ) ) {
                $block['innerBlocks'] = wpbb_child_381043_repair_block_alignment( $block['innerBlocks'] );
            }
        }
        unset( $block );
        return $blocks;
    }
}

if ( ! function_exists( 'wpbb_child_381043_repair_demo_pages' ) ) {
    function wpbb_child_381043_repair_demo_pages() {
        // Repair every page that actually contains the theme's media/text row.
        // This also covers front pages imported before the managed-page marker existed.
        $page_ids = get_posts( array(
            'post_type' => 'page',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'fields' => 'ids',
        ) );
        foreach ( $page_ids as $page_id ) {
            $content = (string) get_post_field( 'post_content', $page_id );
            if ( false === strpos( $content, 'wp-theme-sector-media-text' ) ) continue;
            $repaired = serialize_blocks( wpbb_child_381043_repair_block_alignment( parse_blocks( $content ) ) );
            if ( $repaired !== $content ) {
                wp_update_post( array( 'ID' => $page_id, 'post_content' => $repaired ) );
                clean_post_cache( $page_id );
            }
        }
    }
}

if ( ! function_exists( 'wpbb_child_381043_refresh_media_once' ) ) {
    function wpbb_child_381043_refresh_media_once( $page_id = 0, $profile = array() ) {
        if ( ( function_exists( 'wp_doing_ajax' ) && wp_doing_ajax() ) || ( function_exists( 'wp_doing_cron' ) && wp_doing_cron() ) ) return;
        if ( ! current_user_can( 'manage_options' ) ) return;

        $current_stylesheet = sanitize_key( get_stylesheet() );
        $done_key = 'wpbb_child_381043_media_' . $current_stylesheet;
        $owner_key = 'wpbb_child_381043_media_owner';
        // Demo posts are shared while child themes are switched. Refresh again
        // whenever a different child theme last supplied the active media.
        if ( get_option( $done_key ) && $current_stylesheet === (string) get_option( $owner_key ) ) return;

        $defined = get_defined_functions();
        foreach ( (array) ( $defined['user'] ?? array() ) as $function_name ) {
            if ( ! preg_match( '/^wpbb_[a-z0-9_]+_realistic_media_upgrade_v381041$/', $function_name ) ) continue;
            delete_option( $function_name );
            call_user_func( $function_name );
        }

        // Correct stale titles/alt text left behind when the same demo posts were
        // reused while switching child themes.
        $post_ids = get_posts( array(
            'post_type' => 'any',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'meta_key' => '_thumbnail_id',
            'fields' => 'ids',
        ) );
        foreach ( $post_ids as $post_id ) {
            $thumbnail_id = (int) get_post_thumbnail_id( $post_id );
            if ( ! $thumbnail_id ) continue;
            $attached = (string) get_post_meta( $thumbnail_id, '_wp_attached_file', true );
            $attachment_name = (string) get_post_field( 'post_name', $thumbnail_id );
            if ( false === strpos( $attached, '-blog/' ) && 0 !== strpos( $attachment_name, 'wpbb-' ) ) continue;
            $title = get_the_title( $post_id );
            if ( '' === trim( (string) $title ) ) continue;
            wp_update_post( array( 'ID' => $thumbnail_id, 'post_title' => $title ) );
            update_post_meta( $thumbnail_id, '_wp_attachment_image_alt', $title );
            clean_post_cache( $post_id );
            clean_attachment_cache( $thumbnail_id );
        }

        wpbb_child_381043_repair_demo_pages();
        update_option( $done_key, current_time( 'mysql' ), false );
        update_option( $owner_key, $current_stylesheet, false );
    }
}
add_action( 'wp_theme_after_demo_import', 'wpbb_child_381043_refresh_media_once', 180, 2 );
add_action( 'admin_init', 'wpbb_child_381043_refresh_media_once', 130 );

/**
 * v3.8.10.45: shared rhythm, contrast, sector-media and gallery repair.
 */
require_once __DIR__ . '/inc/sector-consistency.php';

// v3.8.10.64 shared BBuilder/demo consistency layer.
require_once get_stylesheet_directory() . '/inc/bbuilder-system-v62.php';

/**
 * v3.8.10.64 PWA endpoint hardening.
 *
 * The parent theme links to ?wpbb-pwa=manifest and registers
 * ?wpbb-pwa=service-worker. Serve those endpoints before the normal template
 * loader so browsers always receive the expected MIME type and valid payload.
 * The service worker intentionally has no fetch handler: this prevents stale
 * worker-cached ES modules from causing Chromium cross-world preload warnings.
 */
if ( ! function_exists( 'wpbb_child_381063_serve_pwa_endpoint' ) ) {
    function wpbb_child_381063_serve_pwa_endpoint() {
        if ( empty( $_GET['wpbb-pwa'] ) ) return;
        $mode = sanitize_key( wp_unslash( $_GET['wpbb-pwa'] ) );
        if ( ! in_array( $mode, array( 'manifest', 'service-worker' ), true ) ) return;

        while ( ob_get_level() ) {
            @ob_end_clean();
        }
        nocache_headers();
        header( 'X-Content-Type-Options: nosniff' );

        if ( 'manifest' === $mode ) {
            header( 'Content-Type: application/manifest+json; charset=UTF-8' );
            $name = trim( (string) get_bloginfo( 'name' ) );
            if ( '' === $name ) $name = 'WP Base';
            $scope = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );
            if ( '' === $scope ) $scope = '/';
            $icons = array();
            foreach ( array( 192, 512 ) as $size ) {
                $file = get_stylesheet_directory() . '/assets/icons/icon-' . $size . '.png';
                if ( is_readable( $file ) ) {
                    $icons[] = array(
                        'src' => get_stylesheet_directory_uri() . '/assets/icons/icon-' . $size . '.png',
                        'sizes' => $size . 'x' . $size,
                        'type' => 'image/png',
                        'purpose' => 'any maskable',
                    );
                }
            }
            echo wp_json_encode( array(
                'name' => $name,
                'short_name' => function_exists( 'mb_substr' ) ? mb_substr( $name, 0, 24 ) : substr( $name, 0, 24 ),
                'start_url' => home_url( '/' ),
                'scope' => $scope,
                'display' => 'standalone',
                'background_color' => '#ffffff',
                'theme_color' => '#3155D9',
                'icons' => $icons,
            ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
            exit;
        }

        header( 'Content-Type: application/javascript; charset=UTF-8' );
        header( 'Service-Worker-Allowed: /' );
        echo "self.addEventListener('install',function(event){self.skipWaiting();});\n";
        echo "self.addEventListener('activate',function(event){event.waitUntil((async function(){try{var keys=await caches.keys();await Promise.all(keys.filter(function(k){return /^(wpbb|wp-theme|wpbase)/i.test(k);}).map(function(k){return caches.delete(k);}));}catch(e){}await self.clients.claim();})());});\n";
        exit;
    }
    add_action( 'template_redirect', 'wpbb_child_381063_serve_pwa_endpoint', -9999 );
}
// v3.8.10.75 structural/media/Woo repair.
require_once get_stylesheet_directory() . '/inc/v75-suite.php';

// v3.8.10.81: keep interactive wp-admin saves/updates fast.
require_once get_stylesheet_directory() . '/inc/v82-suite.php';
require_once get_stylesheet_directory() . '/inc/admin-performance.php';

// v3.8.10.83 premium Jobs-aligned sector presentation and multilingual managed-demo refresh.
require_once get_stylesheet_directory() . '/inc/v83-premium-suite.php';
// v3.8.10.97 final premium Jobs-aligned suite and mobile navigation.
require_once get_stylesheet_directory() . '/inc/v97-premium-suite.php';


/** 3.8.10.98 suite-wide layout/mobile finishing layer. */
function wpbb_suite_v98_enqueue(){
    $v = wp_get_theme()->get('Version');
    wp_enqueue_style('wpbb-suite-v98', get_stylesheet_directory_uri() . '/assets/suite-v98.css', array(), $v);
    wp_enqueue_script('wpbb-suite-v98', get_stylesheet_directory_uri() . '/assets/suite-v98.js', array(), $v, true);
}
add_action('wp_enqueue_scripts','wpbb_suite_v98_enqueue',999);

// v3.8.10.99 final suite-wide grid, branding, hero and mobile finish.
require_once get_stylesheet_directory() . '/inc/v99-finish.php';

// v3.8.11.00 cookie ownership, hero/colour and mobile navigation finish.
require_once get_stylesheet_directory() . '/inc/v100-finish.php';

// v3.8.11.02 navigation, legal, colour and media correction.
require_once get_stylesheet_directory() . '/inc/v101-finish.php';

// v3.8.11.04 deterministic mobile navigation and WooCommerce/alignment finish.
require_once get_stylesheet_directory() . '/inc/v104-finish.php';

// v3.8.11.05 legal/contact grid, mobile drawer and WooCommerce template finish.
require_once get_stylesheet_directory() . '/inc/v105-finish.php';

// v3.8.11.07 final search, WooCommerce, Jobs captcha/grid and responsive repair.
require_once get_stylesheet_directory() . '/inc/v107-finish.php';
