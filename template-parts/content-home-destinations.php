<?php 
$destinations = get_field('destinations');

?>

<div class="home-destinations">
            <div class="home-destinations__header">
                <div class="home-destinations__header__title page-divider">
                    Exotic Destinations
                </div>
                <div class="home-destinations__header__sub-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero aperiam nostrum eum excepturi et quas neque soluta iusto quae, eligendi cumque dicta dolore sed reprehenderit iure ex, blanditiis nesciunt eos.
                </div>
            </div>

            <div class="home-destinations__destinations-area">

                <div class="home-destinations__destinations-area__slider" id="destinations-slider">
                    <?php if ($destinations) : ?>
                        <?php foreach ($destinations as $d) :
                            $destinationPost = $d['destination'];
                            $image = $d['image'];
                        ?>
                            <a href="<?php echo $d['page_link'] ?>" class="home-destination-card">
                                <img src="<?php echo esc_url($image['url']); ?>">
                                <div class="home-destination-card__title-area">
                                    <div class="home-destination-card__title-area__title">
                                        <?php echo get_field('navigation_title', $destinationPost) ?>
                                    </div>
                                    <div class="home-destination-card__title-area__subtitle">
                                        <?php echo $d['sub_title'] ?>
                                    </div>
                                </div>
                            </a>

                    <?php endforeach;
                    endif; ?>

                


                </div>
            </div>

        </div>