<?php
$currentYear = $args['currentYear'];
?>
<div class="product-prices">
    <!-- Intro -->
    <div class="product-intro">

        <!-- Info -->
        <div class="product-intro__info">
            <div class="product-intro__info__starting-price">Starting at: <span><?php echo "$" . number_format($args['lowestPrice'], 0); ?></span></div>
            <div class="product-intro__info__cta">
                <button class="btn-cta-round">Book Now</button>
            </div>
        </div>
        <!-- Caption -->
        <div class="product-intro__caption">
            <?php echo get_field('prices_intro'); ?>

        </div>

    </div>

    <div id="sentinal-prices"></div>
    <h2 class="page-divider ">
        Tour Pricing
    </h2>



    <?php $pricePackages = get_field('price_packages'); ?>

    <div class="product-prices__tour-prices">
        <?php for ($y = 0; $y < 2; $y++) : ?>

            <!-- Price Group -->
            <div class="product-prices__tour-prices__tour-price-group">
                <div class="product-prices__tour-prices__tour-price-group__year">
                    <?php echo ($currentYear + $y) ?>
                </div>
                <div class="product-prices__tour-prices__tour-price-group__blocks">

                    <?php foreach ($pricePackages as $pricePackage) : ?>
                        <?php if ($pricePackage['year'] == ($currentYear + $y)) :
                            $price = ($pricePackage['price'] != "") ? $pricePackage['price'] : 0;
                            $single_supplement = ($pricePackage['single_supplement'] != "") ? $pricePackage['single_supplement'] : 0;
                            $single_price = intval($price) + intval($single_supplement);
                            $price_level = $pricePackage['price_level'];
                            
                        ?>

                            <div class="product-prices__tour-prices__tour-price-group__blocks__block">

                                <div class="product-prices__tour-prices__tour-price-group__blocks__block__title">
                                    <?php echo get_the_title($price_level); ?><br>

                                </div>
                                <div class="product-prices__tour-prices__tour-price-group__blocks__block__sub">
                                    Double
                                </div>
                                <div class="product-prices__tour-prices__tour-price-group__blocks__block__price">
                                    <?php echo "$ " . number_format($price, 0);  ?>
                                </div>
                                <?php if ($single_supplement != 0) : ?>
                                    <div class="product-prices__tour-prices__tour-price-group__blocks__block__sub product-prices__tour-prices__tour-price-group__blocks__block__sub--single">
                                        Single
                                    </div>
                                    <div class="product-prices__tour-prices__tour-price-group__blocks__block__price product-prices__tour-prices__tour-price-group__blocks__block__price--single">
                                        <?php echo "$ " . number_format($single_price, 0);  ?>
                                    </div>
                                <?php endif; ?>
                            </div>



                        <?php endif; ?>
                    <?php endforeach ?>

                </div>




            </div>
        <?php endfor; ?>
    </div>






    <?php
    get_template_part('template-parts/content', 'product-prices-extra', $args);
    ?>
</div>