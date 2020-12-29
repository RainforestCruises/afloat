<?php
get_header();

?>
<?php
while (have_posts()) :
  the_post();


  $destination = get_field('destination');
  $featured_image = get_field('featured_image');
?>

  <!-- Product Page Container -->
  <div class="travel-guide-page">
    <div class="travel-guide">
      <div class="travel-guide__category">
        Travel Inspiration
      </div>
      <div class="travel-guide__title">
        <?php echo get_the_title(); ?>
      </div>
      <div class="travel-guide__image">
        <img src="<?php echo esc_url($featured_image['url']); ?>" alt="">
      </div>
      <div class="travel-guide__disclaimer">
        <div class="disclaimer-box">
          <svg>
            <use xlink:href="<?php echo bloginfo('template_url') ?>/css/img/sprite.svg#icon-compass"></use>
          </svg>
          <div class="disclaimer-box__warning">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui quis perferendis
            <button>
              Please read our disclaimer
              <svg>
                <use xlink:href="http://localhost/rfcwp/wp-content/themes/afloat/css/img/sprite.svg#icon-arrow-right"></use>
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div class="travel-guide__content drop-cap-1a">
        <?php echo the_content(); ?>
      </div>
    </div>


  </div>


<?php
endwhile;
?>
<!-- #site-wrapper end-->
<?php get_footer() ?>