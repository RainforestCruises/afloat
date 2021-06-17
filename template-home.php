<?php
/*Template Name: Home*/
wp_enqueue_script('page-home', get_template_directory_uri() . '/js/page-home2.js', array('jquery'), false, true);
get_header();
$newsletter_image = get_field('newsletter_image');
$newsletter_title = get_field('newsletter_title');
$newsletter_snippet = get_field('newsletter_snippet');

?>


<div class="home-page">

  <!-- Hero -->
  <section class="home-page__section-hero" id="top">
    <?php
    get_template_part('template-parts/content', 'home-hero2');
    ?>

  </section>

  <!-- Intro -->
  <section class="home-page__section-intro" id="intro">
    <?php
    get_template_part('template-parts/content', 'home-intro');
    ?>
  </section>

  <!-- Destinations -->
  <section class="home-page__section-destinations" id="destinations">
    <?php
    get_template_part('template-parts/content', 'home-destinations');
    ?>
  </section>

  <!-- Featured Cruises -->
  <section class="home-page__section-featured">
    <?php
    get_template_part('template-parts/content', 'home-featured-cruises');
    ?>
  </section>

  <!-- Featured Bucket List -->
  <section class="home-page__section-featured">
    <?php
    get_template_part('template-parts/content', 'home-featured-bucket-list');
    ?>
  </section>

  <!-- Testimonials -->
  <section class="home-page__section-testimonials">
    <?php
    get_template_part('template-parts/content', 'home-testimonials');
    ?>
  </section>

  <!-- Testimonials -->
  <section class="home-page__section-newsletter">
    <?php
    get_template_part('template-parts/content', 'shared-newsletter');
    ?>
  </section>
</div>


<!-- Full Search Mobile -->
<div class="home-full-search">

  <div class="home-full-search__input-group">
    <div class="home-full-search__input-group__input">
      Where would you like to go?
    </div>
    <div class="home-full-search__input-group__close-button" id="search-close" tabindex="0">
      Cancel
    </div>
  </div>
  <div class="home-full-search__results">
    Results
  </div>



</div>


<?php get_footer(); ?>


<script>
  var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>