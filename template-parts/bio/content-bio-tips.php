<?php
$tips = get_field('tips');

?>


<div class="bio-tips">
    <div class="bio-tips__content">

        <h2 class="bio-tips__content__title">
            My Top Tips
        </h2>
        <div class="bio-tips__content__tips">
            <?php if ($tips) :
                foreach ($tips as $tip) :
                    $description = $tip['description'];
                    $icon = $tip['icon'];
            ?>

                    <!-- favorite -->
                    <div class="bio-tip">
                        <div class="bio-tip__icon">
                            <?php echo $icon; ?>
                        </div>
                        <div class="bio-tip__description">
                            <?php echo $description; ?>
                        </div>
                    </div>
            <?php
                endforeach;
            endif; ?>
        </div>




    </div>

</div>