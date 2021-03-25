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