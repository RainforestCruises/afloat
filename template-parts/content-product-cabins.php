<?php
$cruise_data = $args['cruiseData'];
?>


<!-- Cabins -->
<div class="product-cabins">

    <h3 class="xsub-divider xsub-divider--dark u-margin-bottom-small">
        Suites & Cabins
    </h3>
    <!-- Cabins -->
    <?php
    $cabins = $cruise_data['CabinDTOs'];

    //Need to SORT cabin images, put main image first
    //new array- $cabinImage['Main'] == true
    

    $cabinCount = 0;
    if ($cabins) : ?>

        <?php foreach ($cabins as $cabin) : ?>
            <?php
            $occupancy = $cabins[$cabinCount]['PrimaryOccupancy'];
            if ($cabins[$cabinCount]['SecondaryEnabled'] == true) {
                $occupancy = $occupancy + $cabins[$cabinCount]['SecondaryOccupancy'];
            }


            ?>
            <div class="product-cabins__cabin ">
                <div class="product-cabins__cabin__image-area dfproperty">
                    <!-- Image from DF -->
                    <?php $cabinImages = $cabins[$cabinCount]['ImageDTOs'];      
                    foreach($cabinImages as $cabinImage) :

                        ?> 
                            <img data-flickity-lazyload-src="<?php echo afloat_dfcloud_image($cabinImage['ImageUrl']); ?>" alt="<?php echo esc_html($cabinImage['AltText']); ?>">
                        <?php
                        endforeach;       
                    ?>
                    
                </div>
                <div class="product-cabins__cabin__content">
                    <div class="product-cabins__cabin__content__title">
                        <h4><?php echo ($cabins[$cabinCount]['Name']); ?></h4>
                    </div>
                    <div class="product-cabins__cabin__content__feature-grid">
                        <div class="product-cabins__cabin__content__feature-item">
                            <div class="product-cabins__cabin__content__feature-item__title">
                                Guests
                            </div>
                            <span><?php echo $occupancy; ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <div class="product-cabins__cabin__content__feature-item__title">
                                Size
                            </div>
                            <span><?php echo ($cabins[$cabinCount]['Size']); ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <div class="product-cabins__cabin__content__feature-item__title">
                                Beds
                            </div>
                            <span><?php echo ($cabins[$cabinCount]['Beds']); ?></span>
                        </div>
                    </div>
                    <?php echo ($cabins[$cabinCount]['Features']); ?>

                </div>
            </div>
            <?php
            $cabinCount++;
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

