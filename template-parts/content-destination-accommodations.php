<?php

$cruises_image = get_field('cruises_image');
$lodges_image = get_field('lodges_image');
$cruises_snippet = get_field('cruises_snippet');
$lodges_snippet = get_field('lodges_snippet');


?>
<div class="destination-accommodations">
    <div class="destination-accommodations__header">
        <div class="destination-accommodations__header__title page-divider">
            Accommodations
        </div>
        <div class="destination-accommodations__header__sub-text">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi earum illum ratione vero. Ipsam, quia tempora iusto officia obcaecati dolore exercitationem necessitatibus fugiat doloribus quibusdam et inventore eos, illo perspiciatis?
        </div>
    </div>
    <div class="destination-accommodations__group">
        <!-- Card -->
        <div class="accommodations-card">
            <div class="accommodations-card__image">
                <img src="<?php echo esc_url($lodges_image['url']); ?>" alt="">
            </div>
            <div class="accommodations-card__bottom">
                <div class="accommodations-card__bottom__title">
                    Lodges in Peru
                </div>
                <div class="accommodations-card__bottom__text">
                    <?php echo $lodges_snippet; ?>
                </div>
            </div>
        </div>
        <!-- Card -->
        <div class="accommodations-card">
            <div class="accommodations-card__image">
                <img src="<?php echo esc_url($cruises_image['url']); ?>" alt="">
            </div>
            <div class="accommodations-card__bottom">
                <div class="accommodations-card__bottom__title">
                    Cruises in Peru
                </div>
                <div class="accommodations-card__bottom__text">
                    <?php echo $cruises_snippet; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="destination-accommodations__btn ">
        <button class="btn-outline  " href="#">View All Accommodations</button>
    </div>

</div>