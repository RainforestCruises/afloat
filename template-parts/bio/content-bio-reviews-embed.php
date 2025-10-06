<?php
$reviews_embed = get_field('reviews_embed');
?>

<div class="bio-reviews">
    <h2 class="bio-reviews__title">
        What My Clients Say
    </h2>
    <div class="bio-reviews__testimonials" style="margin-top: 6rem;">
        <div data-romw-token="<?php echo $reviews_embed ?>"></div>
    </div>
</div>