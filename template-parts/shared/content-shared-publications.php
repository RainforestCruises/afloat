<?php 
$publications = get_field('publications', 'options');
?>
<section>
    <div class="publications">
        <div class="publications__title">
            As Featured In
        </div>
        <div class="publications__list">
            <?php if ($publications) :
                foreach ($publications as $p) :
                    $p_image = $p['image'];
            ?>
                    <div class="publications__list__logo-area">
                        <img src="<?php echo esc_url($p_image['url']); ?>" alt="<?php echo get_post_meta($p_image['id'], '_wp_attachment_image_alt', TRUE) ?>">
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>