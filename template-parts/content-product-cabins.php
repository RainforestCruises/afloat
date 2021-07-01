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
                <div class="product-cabins__cabin__image-area">
                    <!-- Image from DF -->
                    <?php $cabinImages = $cabins[$cabinCount]['ImageDTOs'];      
                    foreach($cabinImages as $cabinImage) {
                        $mainImage;
                        if($cabinImage['Main'] == true){
                            $mainImage = $cabinImage;
                        }
                    }         
                    ?>
                    <img src="<?php echo esc_html($mainImage['ImageUrl']); ?>" alt="">
                </div>
                <div class="product-cabins__cabin__content">
                    <div class="product-cabins__cabin__content__title">
                        <h3><?php echo ($cabins[$cabinCount]['Name']); ?></h3>
                    </div>
                    <div class="product-cabins__cabin__content__feature-grid">
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Guests
                            </h5>
                            <span><?php echo $occupancy; ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Size
                            </h5>
                            <span><?php echo ($cabins[$cabinCount]['Size']); ?></span>
                        </div>
                        <div class="product-cabins__cabin__content__feature-item">
                            <h5 class="product-cabins__cabin__content__feature-item__title">
                                Beds
                            </h5>
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

