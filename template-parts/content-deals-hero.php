<div class="deals-hero">
    <h1 class="deals-hero__title">
        Cruise Deals
    </h1>

    <div class="deals-hero__subtext">
        Don’t let these savings sail without you! Find onboard spending deals, limited-time sales, and more, turning your dream escape into a riveting reality.

    </div>

    <!-- Triple Row -->
    <div class="deals-hero__row">
        <?php
        $cardImage = get_field('first_item')['image'];
        $cardTitle = get_field('first_item')['title'];
        $cardLink = get_field('first_item')['link'];
        ?>

        <!-- Card 1 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_responsive_image($cardImage, 'featured-large', array('featured-large', 'featured-medium')); ?>>
            </div>
            <div class="deal-card__content">
                <div class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </div>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>

        <?php
        $cardImage = get_field('second_item')['image'];
        $cardTitle = get_field('second_item')['title'];
        $cardLink = get_field('second_item')['link'];
        ?>

        <!-- Card 2 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_responsive_image($cardImage, 'featured-large', array('featured-large', 'featured-medium')); ?>>
            </div>
            <div class="deal-card__content">
                <div class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </div>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>

        <?php
        $cardImage = get_field('third_item')['image'];
        $cardTitle = get_field('third_item')['title'];
        $cardLink = get_field('third_item')['link'];
        ?>
        <!-- Card 3 -->
        <a class="deal-card" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_responsive_image($cardImage, 'featured-large', array('featured-large', 'featured-medium')); ?>>
            </div>
            <div class="deal-card__content">
                <div class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </div>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>


    </div>
    <!-- Feature Row -->
    <div class="deals-hero__row">
        <?php
        $cardImage = get_field('feature_item')['image'];
        $cardTitle = get_field('feature_item')['title'];
        $cardLink = get_field('feature_item')['link'];
        ?>

        <!-- Feature-->
        <a class="deal-card deal-card--wide" href="<?php echo $cardLink ?>">
            <div class="deal-card__image">
                <img <?php afloat_responsive_image($cardImage, 'pill-large', array('pill-large', 'pill-small')); ?>>
            </div>
            <div class="deal-card__content">
                <div class="deal-card__content__title">
                    <?php echo $cardTitle ?>
                </div>
                <div class="deal-card__content__cta">
                    <button class="btn-cta-round btn-cta-round--white btn-cta-round--medium">
                        View Deals
                    </button>
                </div>
            </div>
        </a>
    </div>
</div>