<?php
get_header();
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product-nav.js', array('jquery'), false, true);

?>
<?php
while (have_posts()) :
  the_post();


  $cruise_data = get_field('cruise_data');

  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");


  $charter_only = get_field('charter_only');
  $charter_available = get_field('charter_available');


  $charter_daily_price = get_field('charter_daily_price');
  $vessel_capacity = get_field('vessel_capacity');
  $charter_min_days = get_field('charter_min_days');


  //check URL for charter flag
  $charter_view = false;
  if (isset($_GET['charter'])) {
    if ($_GET['charter'] == "true" && $charter_available == true) {
      $charter_view = true;
    }
  }

  if ($charter_only == true) {
    $charter_view = true;
  }

  console_log($charter_view);

  $args = array(
    'lowestPrice' => $cruise_data['LowestPrice'],
    'cruiseData' => $cruise_data,
    'propertyType' => 'Cruise',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
    'charter_view' => $charter_view,
    'charter_available' => $charter_available,
    'charter_daily_price' => $charter_daily_price,
    'vessel_capacity' => $vessel_capacity,
    'charter_min_days' => $charter_min_days,
    'charter_only' => $charter_only,

  );

?>

  <!-- Product Page Container -->
  <div class="product-page">
    <?php
    get_template_part('template-parts/content', 'product-hero-nav', $args);
    ?>
    <section class="product-content">

      <!-- 1. Overview Content -->
      <div class="product-content__page tab-content current" id="overview">
        <?php
        get_template_part('template-parts/content', 'product-overview', $args);
        ?>
      </div>

      <!-- 2. Itineraries Content -->
      <div class="product-content__page tab-content " id="itineraries">
        <?php
        get_template_part('template-parts/content', 'product-itineraries', $args);
        ?>
      </div>

      <!-- 3. Cabins Content -->
      <div class="product-content__page tab-content " id="cabins">
        <?php
        get_template_part('template-parts/content', 'product-cabins', $args);
        ?>
      </div>

      <!-- 4. Prices Content -->
      <div class="product-content__page tab-content " id="prices">
        <?php
        get_template_part('template-parts/content', 'product-prices', $args);
        ?>
      </div>

      <?php if (!$charter_view) : ?>
        <!-- 5. Dates Content -->
        <div class="product-content__page tab-content " id="dates">
          <?php
          get_template_part('template-parts/content', 'product-dates', $args);
          ?>
        </div>
      <?php endif; ?>

    </section>

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

  </div>





  <script>
    var currentYear = '<?php echo $currentYear = date("Y"); ?>';
    var templateUrl = '<?php echo bloginfo('template_url') ?>';
  </script>

<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>