<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package vodi
 */
 

 /* Template Name: Prueba */ 


get_header();




 ?>



    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">

            <div class="error-404 not-found">
                <div class="page-content">
                    <?php 
                            $args = array(
                            'post_type' => 'movie',
                            'post_status' => 'publish',
                            'posts_per_page' => -1
                        );
                        $posts = new WP_Query( $args );
                        print_r($posts);
                        print_r("Epa");
                        wp_reset_query();
                     ?>

                    <h2 class="page-title">Hola papu</h2>
                    <p class="page-subtitle">Epale el miooo :v</p>
                    <div class="sub-form-row">
                        <?php get_search_form(); ?>
                    </div>
                    <div class="home-button">
                        <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Back to Homepage', 'vodi' ); ?></a>
                    </div>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer();
