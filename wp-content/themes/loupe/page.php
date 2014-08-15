<?php get_header(); ?>


<?php
   
   //print_r($args);
    if ( have_posts() ) :
    
    while ( have_posts() ) : the_post();
    echo "<div class='row dark'>";
        echo "<div class='page-content'>";
        echo "<h1>";
        the_title();
        echo "</h1>";
        the_content();
        echo "</div>";
    echo "</div>";
        
    endwhile;   
    endif;
?>
<?php get_footer(); ?>