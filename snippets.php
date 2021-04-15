<?php
$hasSeasons = false;
if ($rateYears[$count]['HasHighSeason'] == true || $rateYears[$count]['HasLowSeason'] == true) :
  $hasSeasons = true;
endif; ?>

<?php if ($hasSeasons) : ?>
  <select class="season-select" data-tab="<?php echo $count; ?>">
    <option value="regular">Regular</option>
    <?php if ($rateYear['HasHighSeason'] == true) : ?>
      <option value="high">High</option>
    <?php endif; ?>
    <?php if ($rateYear['HasLowSeason'] == true) : ?>
      <option value="low">Low</option>
    <?php endif; ?>
  </select>
<?php endif; ?>




<!-- Lodges Select -->

<?php if (get_post_type() == 'rfc_lodges') : ?>
  <?php $yearCount = 0; ?>
  <!-- Select-Box -->
  <div class="itinerary-year-select-group">
    <select class="itinerary-year-select" data-tab="<?php echo $count; ?>">
      <?php while ($yearCount <= 1) { ?>
        <option><?php echo ($currentYear + $yearCount) ?></option>
      <?php $yearCount++;
      } ?>
    </select>
  </div>
<?php endif; ?>




<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

  <input type="hidden" name="form-itinerary" id="form-itinerary" value="">
  <input type="hidden" name="form-year" id="form-year" value="">
  <input type="hidden" name="form-month" id="form-month" value="">

  <input type="hidden" name="action" value="productsearch">
  <input type="hidden" name="productId" value="<?php echo get_the_ID() ?>">
</form>


<?php if (!$charter_view) : ?>
      <!-- Dates Content -->
      <section class="product-page__section-dates" id="dates" style="display: none;">
        <?php
        get_template_part('template-parts/content', 'product-dates', $args);
        ?>
      </section>
    <?php endif; ?>


    <label class="product-dates__search-area__controls__control" for="dates-month-select">
                <span class="product-dates__search-area__controls__control__label-text">Month</span>

                <select id="dates-month-select" name="dates-month-select" data-tab="<?php echo $count; ?>">
                    <option></option>
                    <?php
                    $monthCount = 1;
                    foreach ($monthNames as $monthName) { ?>
                        <option value="<?php echo $monthCount ?>"><?php echo $monthName ?></option>
                    <?php $monthCount++;
                    } ?>
                </select>

            </label>
            <label class="product-dates__search-area__controls__control" for="dates-year-select">
                <span class="product-dates__search-area__controls__control__label-text">Year</span>
                <select id="dates-year-select" name="dates-year-select" data-tab="<?php echo $count; ?>">
                    <option></option>
                    <?php foreach ($years as $year) { ?>
                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                    <?php } ?>
                </select>
            </label>
            <label class="product-dates__search-area__controls__control" for="dates-itinerary-select">
                <span class="product-dates__search-area__controls__control__label-text">Itinerary</span>
                <select id="dates-itinerary-select" name="dates-itinerary-select" data-tab="<?php echo $count; ?>">
                    <option></option>
                    <option value="0">Any</option>
                    <?php foreach ($cruise_data['Itineraries'] as $itinerary) { ?>
                        <option value="<?php echo $itinerary['Id'] ?>"><?php echo $itinerary['Name'] . ' - ' . $itinerary['ShortName'] ?></option>
                    <?php } ?>
                </select>
            </label>