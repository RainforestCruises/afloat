<?php if ($searchType == 'region') : ?>
  <label class="search-control" for="destination-select">
    <span class="search-control__label-text">Destination</span>
    <select class="search-control__select" id="destination-select" name="destination-select">
      <option></option>
      <option value="0">Any</option>
      <?php foreach ($destinations as $destination) : ?>
        <option value="<?php echo $destination->ID ?>"><?php echo get_the_title($destination) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
<?php endif; ?>

<?php if ($searchType == 'destination' && $isBucketList == false) : ?>
  <label class="search-control" for="location-select">
    <span class="search-control__label-text">Location</span>
    <select class="search-control__select" id="location-select" name="location-select">
      <option></option>
      <option value="0">Any</option>
      <?php foreach ($locations as $location) : ?>
        <option value="<?php echo $location->ID ?>"><?php echo get_field('navigation_title', $location) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
<?php endif; ?>