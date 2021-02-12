<div class="product-prices__price-group__card-group ">
                <?php $yearCount = 0; ?>
                <?php while ($yearCount <= 1) { ?>
                    <?php $hasRate = false; ?>
                    <!-- Card 2020 -->
                    <div class="product-prices__price-group__card-group__card">
                        <!-- Reg Season -->
                        <h4 class="product-prices__price-group__card-group__card__year ">
                            <?php echo ($currentYear + $yearCount) ?>
                        </h4>
                        <h5 class="product-prices__price-group__card-group__card__season">
                            All Year
                        </h5>
                        <div class="product-prices__price-group__card-group__card__cabin-list">
                            <?php $pricePackages = get_field('price_packages'); ?>
                            <?php foreach ($pricePackages as $pricePackage) : ?>
                                <?php if ($pricePackage['year'] == ($currentYear + $yearCount)) { ?>
                                    <?php $hasRate = true; ?>
                                    <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                        <div class="product-prices__price-group__card-group__card__cabin-list__item__cabin">
                                            <?php echo  $pricePackage['name']; ?>
                                        </div>
                                        <div class="product-prices__price-group__card-group__card__cabin-list__item__prices">
                                            <?php echo "$ " . number_format($pricePackage['price'], 0);  ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>
                        <?php if ($hasRate == false) { ?>
                            <div class="product-prices__price-group__card-group__card__cabin-list__item">
                                Call for Prices
                            </div>
                        <?php } ?>
                    </div>
                <?php $yearCount++;
                } ?>

            </div>