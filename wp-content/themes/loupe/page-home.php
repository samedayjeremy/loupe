<?php get_header(); ?>


<?php
    if(is_paged() && !is_archive()) {
        $paged = get_query_var("page");
        
        echo "paged";
        var_dump($paged);
        //exit;
    } else {
        $paged = get_query_var('paged');
        echo "not paged";
        var_dump($paged);
        //exit;
    }
    
    $first = true && ($paged === 0 || $paged === 1);
    $ppp = $first ? 9 : 8;

    global $wp_query;
    $args = array_merge($wp_query->query_vars, array( 'post_type' => 'watch', "posts_per_page"=>$ppp, "paged"=>$paged, "page_id"=>null, "p"=>null));
    query_posts( $args );
   //print_r($args);
    if ( have_posts() ) :
    echo "<div class='watch-content'>";

    $ctr = 0;
    while ( have_posts() ) : the_post();
        if($first) {
            $first = false;
            ?>
            <div class='row first dark'>
                <div class='col-md-6'><a href='<?php the_permalink(); ?>'><?php the_post_thumbnail("large"); ?></a></div>
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
                echo "<div class='row'>";
            }
            ?>
            <div class='col-md-3 dark watch-box'>
                <a href='<?php the_permalink(); ?>'>
                    <?php the_post_thumbnail("thumbnail"); ?>
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
</div>
<div class="loading"></div>
    <div class="load-more">
        <?php echo get_next_posts_link( 'Load More' ); ?>
    </div>

    </div> <!-- end watch-content -->

    

<?php
    endif;
?>
<?php get_footer(); ?>