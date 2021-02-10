<?php
/*Template Name: Search - Destination*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$destination = get_field('destination');
$title = get_field('hero_title', $destination);
$region = get_field('region', $destination);
$regionTitle = get_field('hero_title', $region);
$breadcrumb = get_field('breadcrumb');



$args = array(
    'destination' => $destination,
    'title' => $title,
);
?>

<div class="search-page">

    <!-- Intro -->
    <div class="search-intro">
        <ol class="search-intro__breadcrumb">
            <li>
                <a href="<?php echo home_url() ?>">Home</a>
            </li>
            <?php 
            if($breadcrumb):
            foreach ($breadcrumb as $b) :
                if ($b['link'] != null) : ?>
                    <li>
                        <a href=" <?php echo $b['link']  ?>"><?php echo $b['title'] ?></a>
                    </li>
                <?php else : ?>
                    <li>
                        <?php echo $b['title'] ?>
                    </li>
            <?php endif;
            endforeach; endif;?>

        </ol>
        <div class="search-intro__title">
            <span><?php echo get_field('title_text') ?></span>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
        </div>
        <div class="search-intro__text" style="display: block;">
            <?php echo get_field('snippet') ?>
        </div>
    </div>

    <!-- Content -->
    <div class="search-page__content">
        <?php
        get_template_part('template-parts/content', 'search-sidebar-destination', $args);
        ?>
        <?php
        get_template_part('template-parts/content', 'search-results');
        ?>
    </div>

    <!-- Bottom -->
    <div class="search-page__bottom">
        bottom
    </div>
</div>



<?php get_footer(); ?>

