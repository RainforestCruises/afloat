<?php get_header(); ?>
<div class="content-area">
    <main>
        <section class="slide">
            <div class="container">
                <div class="row"><?php add_revslider('home-slider'); ?></div>
            </div>
        </section>
        <section class="services">
            <div class="container">
                <h1>Our Services</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="services-item">
                            <?php
                            if (is_active_sidebar('services-1')) {
                                dynamic_sidebar('services-1');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services-item">
                            <?php
                            if (is_active_sidebar('services-2')) {
                                dynamic_sidebar('services-2');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services-item">
                            <?php
                            if (is_active_sidebar('services-3')) {
                                dynamic_sidebar('services-3');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="middle-area">
            <div class="container">
                <div class="row">
                    <aside class="sidebar col-md-3"><?php get_sidebar('home') ?></aside>
                    <div class="news col-md-9">
                        <div class="container">
                            <div class="row">
                                <?php
                                //first loop
                                $featured = new WP_Query('post_type=post&posts_per_page=1&cat=1,11');
                                if ($featured->have_posts()) :
                                    while ($featured->have_posts()) : $featured->the_post();
                                ?>
                                        <div class="col-12">
                                            <?php get_template_part('template-parts/content', 'featured') ?>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata(); //very important to rest after custom query
                                endif;

                                //second loop
                                $args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 2,
                                    'category__not_in' => array(11),
                                    'category__in' => array(1, 9),
                                    'offset' => array(1),
                                );
                                $secondary = new WP_Query($args);
                                if ($secondary->have_posts()) :
                                    while ($secondary->have_posts()) : $secondary->the_post();
                                    ?>
                                        <div class="col-6">
                                            <?php get_template_part('template-parts/content', 'secondary') ?>
                                        </div>
                                <?php
                                    endwhile;
                                    wp_reset_postdata(); //very important to rest after custom query
                                endif;
                                ?>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- #section 02start -->
    <section id="section-02" class="pb-8 feature-destination pt-85">
        <div class="container">
            <div class="mb-8">
                <h2 class="mb-0">
                    <span>Featured </span>
                    <span class="font-weight-light">Destinations</span>
                </h2>
            </div>
            <div class="slick-slider arrow-center" data-slick-options='{"slidesToShow": 3, "autoplay":false,"dots":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow": 3,"arrows":false,"dots":true,"autoplay":true}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":true,"autoplay":true}},{"breakpoint": 400,"settings": {"slidesToShow": 1,"arrows":false,"dots":true,"autoplay":true}}]}'>
                <?php
                //Destinations Loop
                $featured = new WP_Query('post_type=destinations');
                if ($featured->have_posts()) :
                    while ($featured->have_posts()) : $featured->the_post();
                ?>
                        <div class="col-12">
                            <?php get_template_part('template-parts/content', 'destinations') ?>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata(); //very important to rest after custom query
                endif;
                ?>

            </div>
        </div>
    </section>
    <!-- /#section-02 end -->
        <section class="map">
            
        </section>
    </main>
</div>
<?php get_footer(); ?>