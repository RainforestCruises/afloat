<?php

wp_enqueue_script('page-nav', get_template_directory_uri() . '/js/page-nav.js', array('jquery'), false, true);
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);

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

  console_log($cruise_data);

  $args = array(
    'lowestPrice' => $cruise_data['LowestPrice'],
    'cruiseData' => $cruise_data,
    'propertyType' => 'Lodge',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
  );

?>

  <!-- Product Page Container -->
  <div class="product-page">

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
      <?php
      get_template_part('template-parts/content', 'product-explore', $args); //common areas gallery
      ?>
      <?php
      get_template_part('template-parts/content', 'product-cabins', $args);
      ?>
    </section>

    <!-- Prices Content -->
    <section class="product-page__section-prices" id="prices" style="display: none;">
      <?php
      get_template_part('template-parts/content', 'product-prices', $args);
      ?>
    </section>


    <!-- Reviews -->

    <section class="product-page__section-reviews">
      <?php
      get_template_part('template-parts/content', 'product-reviews', $args);
      ?>
    </section>

    <!-- Related Travel -->

    <section class="product-page__section-related" >
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

 <!-- Contact Modal -->
 <?php
  get_template_part('template-parts/content', 'shared-contact-modal', $args);
  ?>
<!-- #site-wrapper end-->
<?php get_footer() ?>