<?php

function theme_setup() {
    register_nav_menu('primary', 'Main Menu');
    register_nav_menu('socialnav', 'Social Menu');
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'theme_setup' );


//Define custom image sizes here
//REFERENCE: https://codex.wordpress.org/Function_Reference/add_image_size
function image_sizes() {
    add_image_size('square300', 300, 300, true);
    add_image_size('bigimage', 0, 450, false);
    add_image_size('singleimage', 450, 450, false);


    ///add_image_size('slider', 1300, 1000, true);
    //add_image_size('magnified', 1300, 1000, false);
    //add_image_size('detail', 600, 500, false);
    //add_image_size('list-grid', 400, 400, false);
}

add_action('init', 'image_sizes', 0);

function custom_post_type_init() {
    $post_types = array(
        array("slug" => "watch", "plural" => "Watches", "singular" => "Watch", "rewrite" => "watch", "public" => true, "archive" => true, "supports" => array('title', 'editor'), "taxonomies"=>array())
    );  
    foreach ($post_types as $pt) {
        $supports = array('title', 'editor', 'post_tags', 'thumbnail', 'excerpt', "comments");
        $public = isset($pt['public']) ? $pt['public'] : false;
        register_post_type($pt["slug"], array(
            'labels' => array(
                'name' => $pt["plural"],
                'singular_name' => $pt["singular"]
            ),
            'show_ui' => true,
            'publicly_queryable' => isset($pt["publicly_queryable"]) ? $pt["publicly_queryable"] : $public,
            'public' => isset($pt['public']) ? $pt['public'] : false,
            'has_archive' => isset($pt['archive']) ? $pt['archive'] : true,
            'rewrite' => array('hierarchical' => true, 'with_front' => true, 'slug' => isset($pt["rewrite"]) ? $pt["rewrite"] : $pt["slug"]),
            'supports' => isset($pt['supports']) ? $pt['supports'] : $supports,
            'taxonomies' => isset($pt['taxonomies']) ? $pt['taxonomies'] : array('post_tag'),
            'hierarchical' => false,
                )
        );
    }
}
add_action('init', 'custom_post_type_init');
add_action( 'init', 'create_my_taxonomies', 0 );

function create_my_taxonomies() {
    $taxonomies = array(
        array("name_tax" => "manufacturer", "related_tax" => "watch", "name" => "Manufacturer", "add_new_item" => "Add New Watch Manufacturer", "new_item_name" => "New Watch Manufacturer", "hierarchical"=>true),
        array("name_tax" => "model", "related_tax" => "watch", "name" => "Model", "add_new_item" => "Add New Watch Model", "new_item_name" => "New Watch Model", "hierarchical"=>false),
        array("name_tax" => "year-manufactured", "related_tax" => "watch", "name" => "Year Manufactured", "add_new_item" => "Add New Year Manufactured", "new_item_name" => "New Year Manufactured", "hierarchical"=>false),
        array("name_tax" => "style", "related_tax" => "watch", "name" => "Style", "add_new_item" => "Add New Watch Style", "new_item_name" => "New Watch Style", "hierarchical"=>false),
        array("name_tax" => "price", "related_tax" => "watch", "name" => "Price Range", "add_new_item" => "Add New Price Range", "new_item_name" => "New Price Range", "hierarchical"=>true)
    );
    foreach ($taxonomies as $tax) {
        register_taxonomy(
            $tax["name_tax"],
            $tax["related_tax"],
            array(
                'labels' => array(
                    'name' => $tax["name"],
                    'add_new_item' => $tax["add_new_item"],
                    'new_item_name' => $tax["new_item_name"]
                ),
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => $tax["hierarchical"]
            )
        );
    }
}

add_filter( 'post_thumbnail_html', 'gallery_first_image', 20, 5 );
function gallery_first_image( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    if ( empty( $html ) ) {
        // return you fallback image either from post of default as html img tag.
        $images = get_field("gallery", $post_id);
        if($images) {
            $first = $images[0];
            $html = "<img src='".$first['sizes'][$size]."' />";
        } else {
            $html = "";
        }
    }
    return $html;
}

function post_date($post = 0) {
    $post = get_post($post);

    $date = strtotime($post->post_date);
    $month = date("m", $date);
    $day = date("d", $date);

    echo "<div class='post-date'>";
        echo "<div class='month'>$month</div>";
        echo "<div class='day'>$day</div>";
    echo "</div>";
}

function print_tax_terms($post, $tax) {
    $terms = wp_get_post_terms($post->ID, $tax, array("fields" => "all"));
    if($terms) {
        echo "<div class='terms'>";
            foreach($terms as $t) {
                $url = "/?".$t->taxonomy."=".$t->slug;
                echo "<a href='$url' class='tax-term'>".$t->name."</a>";
            }
        echo "</div>";
    }
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return "...";
}
add_filter('excerpt_more', 'new_excerpt_more');
?>