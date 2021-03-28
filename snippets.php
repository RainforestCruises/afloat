<!-- 1. Overview Content -->
<section class="product-page__section-overview" id="overview">
  <?php
  get_template_part('template-parts/content', 'product-overview', $args);
  ?>
</section>

<!-- 2. Itineraries Content -->
<div class="product-page__section-itineraries" id="itineraries">
  <?php
  get_template_part('template-parts/content', 'product-itineraries', $args);
  ?>
</div>

<!-- 3. Cabins Content -->
<div class="product-page__section-accommodation" id="accommodation">
  <?php
  get_template_part('template-parts/content', 'product-cabins', $args);
  ?>
</div>

<!-- 4. Prices Content -->
<div class="product-page__section-prices" id="prices">
  <?php
  get_template_part('template-parts/content', 'product-prices', $args);
  ?>
</div>

<?php if (!$charter_view) : ?>
  <!-- 5. Dates Content -->
  <div class="product-page__section-dates" id="dates">
    <?php
    get_template_part('template-parts/content', 'product-dates', $args);
    ?>
  </div>
<?php endif; ?>





<!-- Areas -->
<h2 class="page-divider">
  Explore
</h2>
<section class="product-areas">
  <?php
  get_template_part('template-parts/content', 'product-explore', $args);
  ?>
</section>

<!-- Reviews -->
<h2 class="page-divider">
  Guest Reviews
</h2>
<section class="product-reviews">
  <?php
  get_template_part('template-parts/content', 'product-reviews', $args);
  ?>
</section>

<!-- Related Travel -->
<h2 class="page-divider">
  Related Cruises
</h2>
<section class="product-related">
  <?php
  get_template_part('template-parts/content', 'product-related', $args);
  ?>
</section>













<div class="product-nav__slick" id="product-nav__slick">
  <?php
  $images = get_field('highlight_gallery');
  if ($images) : ?>
    <?php foreach ($images as $image) : ?>
      <div class="product-nav__slick__item">
        <img src="<?php echo esc_url($image['url']); ?>" alt="">
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>









<?php if ($itinerary['HasSummary'] == true) { ?>
  <!-- Intro -->
  <div class="product-itineraries__itinerary__intro drop-cap-1">
    <?php echo $itinerary['Summary'] ?>
  </div>

  <!-- Map -->
  <?php $itineraryImages = $itinerary['MapImageDTOs']; ?>
  <a class="product-itineraries__itinerary__map" id="map-lightbox" href="<?php echo $itineraryImages[0]['ImageUrl']; ?>" title="<?php echo $itinerary['LengthInDays'] ?> Day / <?php echo $itinerary['LengthInNights'] ?> Night - <?php echo $itinerary['Name'] ?>">
    <?php if ($itineraryImages) : ?>
      <img src="<?php echo $itineraryImages[0]['ImageUrl']; ?>" alt="">
      <svg>
        <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-enlarge"></use>
      </svg>
    <?php endif ?>
  </a>
  <div class="product-itineraries__itinerary__divider"></div>

<?php } ?>











    <!-- H2 Title -->
    <h2 class="page-divider">
        Accommodations
    </h2>
    <div class="xsub-divider u-margin-bottom-small">
        Ship Ammenities
    </div>

    <div class="product-areas">
        <div class="areas-slider">
            <div class="areas-slider__slider-nav" id="areas-slider__slider-nav">
                <?php
                $areaImages = get_field('areas_gallery');
                if ($areaImages) : ?>
                    <?php foreach ($areaImages as $areaImage) : ?>
                        <div class="areas-slider__slider-nav__item">
                            <?php echo esc_html($areaImage['title']); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="areas-slider__slider-for">
                <?php
                if ($areaImages) : ?>
                    <?php foreach ($areaImages as $areaImage) : ?>
                        <div class="areas-slider__slider-for__item" id="areas-slider__slider-for">
                            <img class="areas-slider__slider-for__item__img" src="<?php echo esc_html($areaImage['url']); ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>