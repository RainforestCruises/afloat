<?php
get_header();
wp_enqueue_script('page-product', get_template_directory_uri() . '/js/page-product.js', array('jquery'), false, true);
?>
<?php
while (have_posts()) :
  the_post();

  //Time Variables
  $currentYear = date("Y");
  $currentMonth = date("m");
  $years = array($currentYear, ($currentYear + 1), ($currentYear + 2));
  $months = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
  $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");




  $price_packages = get_field('price_packages');
  $lowestPrice = lowest_tour_price($price_packages, $currentYear);



  $args = array(
    'lowestPrice' => $lowestPrice,
    'propertyType' => 'Tour',
    'currentYear' => $currentYear,
    'currentMonth' => $currentMonth,
    'years' => $years,
    'months' => $months,
    'monthNames' => $monthNames,
  );


?>

  <!-- Product Page Container -->
  <div class="product-page">
    <?php
    get_template_part('template-parts/content', 'product-hero-nav');
    ?>
    <section class="product-content">

      <!-- 1. Overview Content -->
      <?php if (get_field('show_overview')) : ?>
        <div class="product-content__page tab-content current" id="overview">
          <?php
          get_template_part('template-parts/content', 'product-overview', $args);
          ?>
        </div>
      <?php endif; ?>
      <!-- 2. Itineraries Content -->
      <div class="product-content__page tab-content <?php echo (get_field('show_overview') ? '' : 'current') ?> " id="itineraries">
        <?php
        get_template_part('template-parts/content', 'product-itineraries-tour', $args);
        ?>
      </div>

      <!-- 3. Cabins Content -->
      <div class="product-content__page tab-content " id="cabins">
        <?php
        get_template_part('template-parts/content', 'product-cabins-tour', $args);
        ?>
      </div>

      <!-- 4. Prices Content -->
      <div class="product-content__page tab-content " id="prices">
        <?php
        get_template_part('template-parts/content', 'product-prices-tour', $args);
        ?>
      </div>

    </section>


    <?php
    $show_areas = get_field('show_areas');
    if ($show_areas) :
    ?>
      <!-- Areas -->
      <div class="page-divider">
        Explore
      </div>
      <section class="product-areas">
        <?php
        get_template_part('template-parts/content', 'product-explore', $args);
        ?>
      </section>
    <?php endif; ?>

    
    <!-- Reviews -->
    <?php if (get_field('show_testimonials')) : ?>
      <div class="page-divider">
        Guest Reviews
      </div>
      <section class="product-reviews">
        <?php
        get_template_part('template-parts/content', 'product-reviews', $args);
        ?>
      </section>
    <?php endif; ?>

    <!-- Related Travel -->

    <div class="page-divider">
      Related Tours
    </div>
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