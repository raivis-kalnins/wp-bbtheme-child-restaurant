<?php
defined( 'ABSPATH' ) || exit;

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
        'hero_image'=>$assets . 'hero.jpg', 'about_image'=>$assets . 'about.jpg',
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
    $id = wp_insert_attachment( array( 'post_mime_type'=>$filetype['type'] ?: 'image/jpeg', 'post_title'=>$title, 'post_name'=>'wpbb-restaurant-' . $slug, 'post_status'=>'inherit' ), $target );
    if ( $id && ! is_wp_error( $id ) ) {
        if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) require_once ABSPATH . 'wp-admin/includes/image.php';
        $meta = wp_generate_attachment_metadata( $id, $target ); if ( $meta ) wp_update_attachment_metadata( $id, $meta ); update_post_meta( $id, '_wp_attachment_image_alt', $title );
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
    return $content . '<!-- wp:group {"className":"wp-theme-section-shell wpbb-restaurant-finder-section","layout":{"type":"default"}} --><div class="wp-block-group wp-theme-section-shell wpbb-restaurant-finder-section"><!-- wp:wpbb/row {"containerClass":"container"} --><!-- wp:wpbb/column {"xs":12} --><!-- wp:wpbb/sector-finder {"context":"restaurant","limit":8} /--><!-- /wp:wpbb/column --><!-- /wp:wpbb/row --></div><!-- /wp:group -->';
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
    if ( !is_singular('menu_item') || !in_the_loop() || !is_main_query() ) return $content; $id=get_the_ID(); $image=get_the_post_thumbnail_url($id,'large'); $gallery=function_exists('wp_theme_item_gallery_single_markup')?wp_theme_item_gallery_single_markup($id):'';
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
function wpbb_restaurant_reservation_form(){$success=isset($_GET['reservation'])&&'received'===sanitize_key(wp_unslash($_GET['reservation']));ob_start();?><section class="wpbb-sector-request" id="reservation"><p class="wp-theme-sector-eyebrow"><?php echo esc_html(__( 'Reservations', 'wp-bbtheme-child-restaurant' ));?></p><h2><?php echo esc_html(__( 'Request a table.', 'wp-bbtheme-child-restaurant' ));?></h2><?php if($success):?><div class="alert alert-success"><?php echo esc_html(__( 'Thanks. Your table request has been received.', 'wp-bbtheme-child-restaurant' ));?></div><?php endif;?><form method="post" action="<?php echo esc_url(admin_url('admin-post.php'));?>"><input type="hidden" name="action" value="wpbb_restaurant_reserve"><?php wp_nonce_field('wpbb_restaurant_reserve','wpbb_restaurant_nonce');?><label><span><?php echo esc_html(__( 'Name', 'wp-bbtheme-child-restaurant' ));?></span><input name="name" required></label><label><span><?php echo esc_html(__( 'Email', 'wp-bbtheme-child-restaurant' ));?></span><input type="email" name="email" required></label><label><span><?php echo esc_html(__( 'Date', 'wp-bbtheme-child-restaurant' ));?></span><input type="date" name="date" required></label><label><span><?php echo esc_html(__( 'Time', 'wp-bbtheme-child-restaurant' ));?></span><input type="time" name="time" required></label><label><span><?php echo esc_html(__( 'Party size', 'wp-bbtheme-child-restaurant' ));?></span><input type="number" min="1" name="party" required></label><label><span><?php echo esc_html(__( 'Phone', 'wp-bbtheme-child-restaurant' ));?></span><input type="tel" name="phone"></label><label class="is-wide"><span><?php echo esc_html(__( 'Dietary or accessibility notes', 'wp-bbtheme-child-restaurant' ));?></span><textarea name="notes"></textarea></label><button class="btn btn-primary" type="submit"><?php echo esc_html(__( 'Request table', 'wp-bbtheme-child-restaurant' ));?></button></form></section><?php return ob_get_clean();}
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

