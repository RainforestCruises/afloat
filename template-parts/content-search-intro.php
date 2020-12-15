<div class="search-intro">
    <ol class="search-intro__breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <!-- If Region dont show -->
        <?php if (is_page_template('templates/search-destination.php')) { ?>
            <li>
                <a href="#">Latin America</a>
            </li>
        <?php } ?>

        <li>
            Peru
        </li>
    </ol>
    <div class="search-intro__title">
        <span>Peru Travel</span>
        <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-ic_chevron_right_36px"></use>
        </svg>
    </div>
    <div class="search-intro__text" style="display: block;">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam incidunt velit laudantium atque. Doloribus saepe officia, laborum provident deserunt sed, et nisi magnam alias obcaecati reprehenderit quam cumque, vitae nostrum.
    </div>
</div>