<!-- Contact Modal -->
<?php
$dealPosts = $args['dealPosts'];
?>
<div class="popup" id="dealsModal">
    <div class="modal-content modal-content--wide">
        <div class="modal-content__wrapper transparent">
            <div class="deals-slider" id="deals-slider">
                <?php
                foreach ($dealPosts as $p) :
                    $featured_image = get_field('featured_image', $p);
                    $applicable_to = get_field('applicable_to', $p);

                    $imageID = '';
                    if ($featured_image) {
                        $imageID = $featured_image['ID'];
                    }



                ?>
                    <div class="deal-item">
                        <div class="deal-item__image-area">
                            <img <?php afloat_image_markup($imageID, 'featured-medium'); ?>>
                        </div>
                        <div class="deal-item__bottom">

                            <div class="deal-item__bottom__title">
                                <h2>
                                    <?php echo get_field('navigation_title', $p); ?>
                                </h2>

                            </div>
                            <div class="deal-item__bottom__snippet">
                                <?php echo get_field('description', $p); ?>
                            </div>

                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

        </div>
    </div>
</div>
<!-- End Contact Modal -->