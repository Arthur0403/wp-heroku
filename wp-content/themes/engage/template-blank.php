<?php

/* Template Name: Blank Page */

$post = $wp_query->post;
get_header();

$layout = engage_page_layout();
$general_layout = engage_general_layout( $layout );
$sidebar_width = engage_sidebar_width();
$page_width = engage_page_width();
$container_class = engage_container_class( $page_width );

?>

    <section class="section-page <?php echo esc_attr( $general_layout ); ?> page-layout-<?php echo esc_attr( $layout ); ?> sidebar-width-<?php echo esc_attr( $sidebar_width ); ?> page-width-<?php echo esc_attr( $page_width ); ?>"<?php engage_page_content_styles(); ?>>

        <div class="container<?php echo esc_attr( $container_class ); ?>">

            <div class="row main-row">

                <div id="page-content" class="page-content">

                    <?php

                    // Page Content Loop

                    if ( have_posts() ) : while ( have_posts() ) : the_post();

                        the_content();

                    endwhile; endif;

                    ?>

                </div>

                <?php

                // Page Sidebar

                if ( $layout != "no_sidebar" ) {
                    get_sidebar();
                }

                ?>

            </div>

        </div>

    </section>

<?php get_footer(); ?>