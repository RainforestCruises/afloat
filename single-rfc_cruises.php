<?php
wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
$templateUrl = get_template_directory_uri();
wp_localize_script(
  'page-product',
  'page_vars',
  array(
    'templateUrl' =>  $templateUrl
  )
);

get_header();
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



  $lowestPrice = lowest_property_price($cruise_data, 0, 2021);

  $args = array(
    'lowestPrice' => $lowestPrice,
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
  <main class="product-page">

    <!-- Hero -->
    <section class="product-page__section-hero" id="top">
      <?php
      get_template_part('template-parts/content', 'product-hero-nav', $args);
      ?>
    </section>


    <!-- Overview Content -->
    <section class="product-page__section-overview" id="overview">
      <?php
      get_template_part('template-parts/content', 'product-overview', $args);
      ?>
    </section>

    <!-- Itineraries Content -->
    <section class="product-page__section-itineraries" id="itineraries">
      <?php
      get_template_part('template-parts/content', 'product-itineraries', $args);
      ?>
    </section>

    <!-- Accommodations Content -->
    <section class="product-page__section-accommodation" id="accommodations">
      <h2 class="page-divider page-divider--padding u-margin-bottom-small">
        Accommodations
      </h2>
      <?php
      get_template_part('template-parts/content', 'product-explore', $args); //common areas gallery
      ?>
      <?php
      get_template_part('template-parts/content', 'product-cabins', $args);
      ?>
      <?php
      get_template_part('template-parts/content', 'product-technical', $args);
      ?>
    </section>


    <!-- Reviews -->
    <?php if (get_field('show_testimonials') == true) { ?>
      <section class="product-page__section-reviews">
        <?php
        get_template_part('template-parts/content', 'product-reviews', $args);
        ?>
      </section>
    <?php } ?>

    <!-- Related Travel -->
    <section class="product-page__section-related">
      <?php
      get_template_part('template-parts/content', 'product-related', $args);
      ?>
    </section>




  </main>

  <!-- Date Search Form -->
  <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="search-form">

    <!-- Direct to function within functions.php -->
    <input type="hidden" name="testfield" id="testfield" value="test">
    <input type="hidden" name="form-itinerary" id="form-itinerary" value="">
    <input type="hidden" name="form-year" id="form-year" value="">
    <input type="hidden" name="form-month" id="form-month" value="">

    <input type="hidden" name="action" value="productsearch">
    <input type="hidden" name="productId" value="<?php echo get_the_ID() ?>">

  </form>

  <!-- Contact Modal -->
  <?php
  get_template_part('template-parts/content', 'shared-contact-modal', $args);
  ?>

  <!-- Prices Extra -->
  <?php
  get_template_part('template-parts/content', 'product-prices-extra', $args);
  ?>


<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>