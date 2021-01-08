<!-- experiences -->
<div class="destination-main__experiences">
        <?php
        if ($tour_experiences) {
            foreach ($tour_experiences as $e) {
                $experience = $e['tour_experience'];
                $background_image = $e['background_image'];
        ?>
                <div class="category-card">
                    <div class="category-card__image">
                        <img src="<?php echo esc_url($background_image['url']); ?>" alt="">
                    </div>

                    <div class="category-card__content">
                        <div class="category-card__content__title">
                            <?php echo get_the_title($experience); ?> Tours
                        </div>
                        <div class="category-card__content__availability">
                            <?php echo tours_available($destination, $experience) . ' Tours Available'; ?>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>