<?php
/*Template Name: Cruises*/
get_header();

query_posts(array(
    'post_type' => 'rfc_cruises'
)); 
?>
<img class="img-fluid" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />

<div class="content-area">
    <main>
    
        <section class="middle-area">
            <div class="container">
                <div class="general-template">
                <h3>Cruises Template</h3>
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                    ?>
                            <article>
                            <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><?php the_content(); ?></p>
                                <p></p>
                            </article>
                        <?php
                        endwhile;
                    else :
                        ?>
                        <p>There's nothing yet to be displayed</p>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>

    </main>
</div>
<?php get_footer(); ?>
