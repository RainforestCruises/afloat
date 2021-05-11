<?php
/*Template Name: Test*/
?>

<?php
get_header();
?>



<!-- Generic Page Container -->
<div class="generic-page">

    <section class="generic-page__content">
      
        <?php
        the_content();
        ?>


       
    </section>


</div>




<?php get_footer(); ?>

<script>
    var templateUrl = "<?php echo bloginfo('template_url') ?>";
</script>