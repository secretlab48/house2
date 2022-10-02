<?php
/**
 * Template Name: Regular Page Template
 * The template for display About Page
 *
 */

global $post;
$top_bg = get_the_post_thumbnail_url( $post, 'full' );
if ( $top_bg ) {
    $top_bg_style = ' style="background-image:url(' . $top_bg . ');"';
}
else {
    $top_bg_style = ' style="background-image:url(' . get_stylesheet_directory_uri() . '/img/slide1-regular.jpg);"';
}
get_header();

?>

<main>

    <section class="top-section">
        <div class="top-bg"<?php echo $top_bg_style; ?>></div>
        <div class="top-header">
            <div class="regular-title bold"><?php echo get_the_title( $post ); ?></div>
            <h1 class="bold"><?php echo get_the_excerpt( $post ); ?></h1>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <?php
                if (have_posts()): while (have_posts()) : the_post();
                    the_content();
                endwhile;
                else:
                    _e( 'Sorry, nothing to display.', 'tpl' );
                endif;
            ?>
        </div>
    </section>



</main>


<?php
    get_footer( 'main' );
?>