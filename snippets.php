<div class="destination-hero__content__location-slider__nav" id="destination-hero__nav">
                        <?php foreach ($locations as $s) : ?>
                            <div class="destination-hero__content__location-slider__nav__item"><?php echo ($s->post_title); ?></div>
                        <?php endforeach; ?>
                    </div>