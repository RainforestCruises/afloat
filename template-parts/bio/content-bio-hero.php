<?php
$agent_avatar = get_field('agent_avatar');
$agent_name = get_field('agent_name');
$agent_position = get_field('agent_position');
$agent_video = get_field('agent_video');

$agent_introduction = get_field('agent_introduction');
$agent_location = get_field('agent_location');
$agent_email = get_field('agent_email');
$top_level_about_page = get_field('top_level_about_page', 'options');


?>


<div class="bio-hero">
    <div class="bio-hero__content">

        <!-- Breadcrumb -->
        <ol class="destination-hero__content__breadcrumb">
            <li>
                <a href="<?php echo get_home_url(); ?>">Home</a>
            </li>
            <li>
                <a href="<?php echo $top_level_about_page ?>">About</a>
            </li>
            <li>
                <?php echo $agent_name ?>
            </li>
        </ol>
        <div style="display: flex; flex-direction: column; justify-content: center;">
            <div class="bio-hero__content__title-group">
                <div class="bio-hero__content__title-group__avatar">
                    <img <?php afloat_image_markup($agent_avatar['id'], 'portrait-small'); ?>>
                </div>
                <h1 class="bio-hero__content__title-group__text">
                    <div class="bio-hero__content__title-group__text__name">
                        <?php echo $agent_name ?>
                    </div>
                    <div class="bio-hero__content__title-group__text__position">
                        <?php echo $agent_position ?>
                    </div>
                </h1>
            </div>
            <div class="bio-hero__content__introduction">
                <?php echo $agent_introduction ?>
            </div>
            <div class="bio-hero__content__attribute">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-location-pin"></use>
                </svg>
                <?php echo $agent_location ?>
            </div>
            <div class="bio-hero__content__attribute" style="margin-bottom: 4rem;">
                <svg>
                    <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-envelope-o"></use>
                </svg>
                <a href="mailto:<?php echo $agent_email ?>"><?php echo $agent_email ?></a>

            </div>

        </div>

    </div>
    <div class="bio-hero__image">
        <div style="padding:177.78% 0 0 0;position:relative;"><iframe src="<?php echo esc_url($agent_video); ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share" referrerpolicy="strict-origin-when-cross-origin" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Meet Juan Pablo"></iframe></div>
        <script src="https://player.vimeo.com/api/player.js"></script>
    </div>
</div>