<!-- Technical Info -->


<?php
$deck_plan = get_field('deck_plan');
$features = get_field('features');
$show_equipment = get_field('show_equipment');
$equipment = get_field('equipment');

?>

<div class="product-technical">
    <div class="xsub-divider">
        Technical Information
    </div>
    <div class="product-technical__content">
        <div class="product-technical__content__image-area <?php echo ($show_equipment) ? "" : "half-width" ?>">
            <div class="product-technical__content__image-area__title">
                Deck Plan
            </div>
            <a class="product-technical__content__image-area" id="deckplan-image" href="<?php echo esc_url($deck_plan['url']); ?>" title="Deckplan">

                <img src="<?php echo esc_url($deck_plan['url']); ?>" alt="">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
                </svg>
            </a>
        </div>

        <div class="product-technical__content__columns">
 <!-- Features -->
 <div class="product-technical__content__columns__info">

<!-- Features -->
<div class="product-technical__content__columns__info__title">
    Features
</div>
<ul class="product-technical__content__columns__info__list">

    <!-- Connecting Cabins -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['connecting_cabins']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Connecting cabins
        </span>
    </li>

    <!-- Cabins with Balconies -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['cabins_with_balconies']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Cabins with balconies
        </span>
    </li>

    <!-- Air conditioning -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['air_conditioning']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Air conditioning
        </span>
    </li>

    <!-- Pool / Jacuzzi -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['pool_jacuzzi']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Pool / Jacuzzi
        </span>
    </li>
    <!-- Excercise room -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['excercise_room']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Excercise room
        </span>
    </li>
    <!-- Massage room -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['massage_room']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Massage room
        </span>
    </li>
    <!-- Lecture room -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['lecture_room']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Lecture room
        </span>
    </li>
    <!-- Wheelchair access -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['wheelchair_access']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Wheelchair access
        </span>
    </li>
    <!-- Camera Room -->
    <li class="product-technical__content__columns__info__list__item">
        <?php if ($features['camera_room']) : ?>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
            </svg>
        <?php else : ?>
            <svg class="no-feature">
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
            </svg>
        <?php endif; ?>
        <span>
            Camera room
        </span>
    </li>
</ul>
<!-- End Features -->

</div>

<!-- Equipment -->
<?php if ($show_equipment) : ?>
<div class="product-technical__content__columns__info">

    <div class="product-technical__content__columns__info__title">
        Equipment
    </div>

    <ul class="product-technical__content__columns__info__list">
        <!-- Diving gear -->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['diving_gear']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Diving gear
            </span>
        </li>

        <!-- Nitrox -->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['nitrox']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Nitrox
            </span>
        </li>

        <!-- Snorkeling gear -->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['snorkeling_gear']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Snorkeling gear
            </span>
        </li>

        <!-- Stand up paddle board -->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['stand_up_paddle_board']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Stand up paddleboard
            </span>
        </li>


        <!-- Kayaks / Canoes -->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['kayaks_canoes']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Kayaks / Canoes
            </span>
        </li>

        <!-- Wakeboard / Water Ski -->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['wakeboard_water_ski']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Wakeboard / Water Ski
            </span>
        </li>
        <!-- Surf Boards-->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['surf_boards']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Surf boards
            </span>
        </li>
        <!-- Jet Skis-->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['jet_skis']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Jet skis
            </span>
        </li>
        <!-- Fishing Equipment-->
        <li class="product-technical__content__columns__info__list__item">
            <?php if ($equipment['fishing_equipment']) : ?>
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-check-circle"></use>
                </svg>
            <?php else : ?>
                <svg class="no-feature">
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-x"></use>
                </svg>
            <?php endif; ?>
            <span>
                Fishing equipment
            </span>
        </li>

    </ul>

</div>
<?php endif; ?>
<!-- End Equipment -->
        </div>
       
    </div>


</div>