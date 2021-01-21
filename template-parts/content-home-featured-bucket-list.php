<?php 
$featured_bucket_list_destinations = get_field('featured_second');

?>

<div class="home-featured home-featured--bucket-list">
            <div class="home-featured__header">
                <div class="home-featured__header__title page-divider">
                    Bucket List
                </div>
                <div class="home-featured__header__sub-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero aperiam nostrum eum excepturi et quas neque soluta iusto quae, eligendi cumque dicta dolore sed reprehenderit iure ex, blanditiis nesciunt eos.
                </div>
            </div>
            <div class="home-featured__content-area">
                <div class="home-featured__content-area__slider" id="featured-bucket">
                    <?php if ($featured_bucket_list_destinations) :
                        foreach ($featured_bucket_list_destinations as $b) :
                            $b_page = $b['bucket_list']; //get permalink
                            $b_snippet = $b['snippet'];
                            $b_title = $b['title'];
                            $b_image = $b['image'];
                    ?>
                            <!-- Cruise Item -->
                            <div class="home-featured-item ">
                                <div class="home-featured-item__title home-featured-item__title--inverse">
                                    <?php echo $b_title ?>
                                </div>
                                <div class="home-featured-item__content home-featured-item__content--inverse">
                                    <div class="home-featured-item__content__text">
                                        <?php echo $b_snippet ?>
                                    </div>
                                    <div class="home-featured-item__content__cta ">
                                        <a href="<?php echo $b_page ?>" class="goto-button goto-button--dark">Learn More
                                            <svg>
                                                <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="home-featured-item__image-area home-featured-item__image-area--inverse">
                                    <img src="<?php echo esc_url($b_image['url']); ?>" alt="">
                                </div>
                            </div>

                    <?php endforeach;
                    endif; ?>



                </div>

            </div>
        </div>