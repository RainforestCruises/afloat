<?php
/*Template Name: Search - Region*/
wp_enqueue_script('page-search', get_template_directory_uri() . '/js/page-search.js', array('jquery'), false, true);
?>

<?php
get_header();
?>

<?php
$region = get_field('region');
$title = get_field('hero_title', $region);
$breadcrumb = get_field('breadcrumb');


$args = array(
    'region' => $region,
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
            if ($breadcrumb) :
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
                endforeach;
            endif; ?>
        </ol>
        <div class="search-intro__title">
            <span><?php echo get_field('title_text') ?></span>
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
        get_template_part('template-parts/content', 'search-sidebar-region', $args);
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