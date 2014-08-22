<?php get_header(); ?>


<?php
    if(is_paged() && !is_archive()) {
        $paged = get_query_var("page");
        
        //echo "paged";
        //var_dump($paged);
        //exit;
    } else {
        $paged = get_query_var('paged');
        //echo "not paged";
        //var_dump($paged);
        //exit;
    }
    
    $first = true && ($paged === 0 || $paged === 1);
    $ppp = $first ? 9 : 8;

    global $wp_query;
    $wp_args = $wp_query->query_vars;
    /*$total_args = array_merge($wp_args, array( 'post_type' => 'watch', "page_id"=>null, "p"=>null));
    $total_posts = new WP_Query($total_args);
    var_dump($total_posts->max_num_pages);
    echo "COUNT";
    var_dump($total_posts->found_posts);
    echo "<script>var total_pages= ".ceil($total_posts->found_posts / 8.0).";</script>";*/
    $args = array_merge($wp_args, array( 'post_type' => 'watch', "posts_per_page"=>$ppp, "paged"=>$paged, "page_id"=>null, "p"=>null));

    if(isset($_GET['manufacturer']) || isset($_GET['price'])) {
        //print_r($_GET['manufacturer']);
        $manufacturers = array();
        $prices = array();
        if(isset($_GET['manufacturer'])) { $manufacturers = explode(",", $_GET['manufacturer']); }
        if(isset($_GET['price'])) { $prices = explode(",", $_GET['price']); }
        $manufacturers = explode(",", $_GET['manufacturer']);
        //$args['manufacturer'] = $manufacturers;
        $args['tax_query'] = array(
        'relation' => 'OR',
            array(
                'taxonomy' => 'manufacturer',
                'terms' => $manufacturers,
                'field' => 'slug',
            ),
            array(
                'taxonomy' => 'price',
                'terms' => $prices,
                'field' => 'slug',
            )
        );
    }

    query_posts( $args );
    print_r($args['tax_query']);
    if ( have_posts() ) :
    echo "<div class='watch-content'>";

    $ctr = 0;
    while ( have_posts() ) : the_post();

        if($first) {
            $first = false;
            ?>
            <div class='row first dark watch-set'>
                <div class='col-md-6'><div class='carousel-wrap'><a href='<?php the_permalink(); ?>' class='first-pic'><?php the_post_thumbnail("singleimage"); ?></a></div></div>
                <div class='col-md-6 info'>

                    <?php post_date(); ?>
                    <h1><?php the_title(); ?></h1>
                    <?php the_excerpt(); ?>
                    <a href='<?php the_permalink(); ?>'>Learn More</a>
                </div>
            </div>
            <?php
        } else {
            if($ctr % 4 == 0) {
                echo "<div class='row watch-set'>";
            }
            ?>
            <div class='col-md-3 dark watch-box'>
                <a href='<?php the_permalink(); ?>'>
                    <?php the_post_thumbnail("square300"); ?>
                    <div class='date-title'>
                        <?php post_date(); ?>
                        <div class='title-wrapper'>
                            <h2><?php the_title(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            if($ctr % 4 == 3) {
                echo "</div>";
            }
            $ctr++;
        }
    endwhile;
?>


    </div> <!-- end watch-content -->

<?php if (get_next_posts_link("")) { ?>
    <div class="load-more">
        <?php echo get_next_posts_link( '' ); ?>
    </div>
<?php } ?>

    

<?php
    endif;
?>
<?php get_footer(); ?>