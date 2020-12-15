<?php
/*Template Name: Search Destination*/
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
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#"><?php echo $regionTitle ?></a>
            </li>
            <li>
                <?php echo $title ?>
            </li>
        </ol>
        <div class="search-intro__title">
            <span><?php echo $title ?> Travel</span>
            <svg>
                <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
            </svg>
        </div>
        <div class="search-intro__text" style="display: block;">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam incidunt velit laudantium atque. Doloribus saepe officia, laborum provident deserunt sed, et nisi magnam alias obcaecati reprehenderit quam cumque, vitae nostrum.
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