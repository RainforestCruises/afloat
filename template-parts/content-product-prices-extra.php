<?php
$currentYear = $args['currentYear'];


?>

<?php if (get_post_type() != 'rfc_tours' ) : 
    if(!$args['charter_only']) :
    ?>
<!-- Note Top-->
<div class="product-prices__note">
    <div class="attention-box">
        <p>All prices listed are per person in double occupancy unless otherwise specified </p>
    </div>
</div>
<?php  endif;  endif; ?>

<!-- Note Bot-->
<?php if (get_field('display_special_note') == true) { ?>
    <div class="product-prices__note">
        <div class="attention-box">
            <?php echo get_field('special_note_content') ?>
        </div>
    </div>
<?php } ?>
<!-- Policies -->
<div class="product-prices__policies-divider">
    <h2 class="page-divider">
        Policies
    </h2>
</div>
<?php
$policies = get_field('policies');
$overall_policies = $policies['overall_policies'];
$display_yearly = $policies['display_yearly'];
//console_log($policies);
?>
<div class="product-prices__policies <?php echo ($display_yearly == false) ? ('product-prices__policies--single-layout') : ('false'); ?>">
    <div class="product-prices__policies__list-group product-prices__policies__list-group--overall">
        <h3 class="product-prices__policies__list-group__title heading-3 heading-3--underline">
            Pricing Policies
        </h3>
        <ul class="list-svg">

            <?php if ($overall_policies != false) :
                foreach ($overall_policies as $p) { ?>
                    <li>
                        <svg>
                            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                        </svg>
                        <span><?php echo $p['policy']; ?></span>
                    </li>
            <?php
                }
            endif;
            ?>
        </ul>
    </div>
    <?php if ($display_yearly == true) { ?>
        <div class="product-prices__policies__list-group product-prices__policies__list-group--first">
            <h3 class="product-prices__policies__list-group__title-overall heading-3 heading-3--underline">
                <?php echo $currentYear; ?>
            </h3>
            <ul class="list-svg">
                <?php
                $current_year_policies = $policies['current_year_policies'];
                if ($current_year_policies != false) :
                    foreach ($current_year_policies as $p) { ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                            <span><?php echo $p['policy']; ?></span>
                        </li>
                <?php
                    }
                endif;
                ?>
            </ul>
        </div>
        <div class="product-prices__policies__list-group product-prices__policies__list-group--second">
            <h3 class="product-prices__policies__list-group__title heading-3 heading-3--underline">
                <?php echo ($currentYear + 1); ?>
            </h3>
            <ul class="list-svg">
                <?php
                $next_year_policies = $policies['next_year_policies'];
                if ($next_year_policies != false) :
                    foreach ($next_year_policies as $p) { ?>
                        <li>
                            <svg>
                                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-chevron-right"></use>
                            </svg>
                            <span><?php echo $p['policy']; ?></span>
                        </li>
                <?php
                    }
                endif;
                ?>
            </ul>
        </div>

    <?php } ?>


</div>