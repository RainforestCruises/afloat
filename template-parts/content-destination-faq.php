<?php
$rows = get_field('faqs');
?>

<div class="destination-faq">
    <div class="destination-faq__header page-divider">
        FAQ
    </div>
    <div class="destination-faq__grid-container">
        <?php
        if ($rows) {
            foreach ($rows as $row) {
                $question = $row['question'];
                $answer = $row['answer'];
        ?>
                <!-- FAQ -->
                <div class="destination-faq__grid-container__faq">
                    <div class="destination-faq__grid-container__faq__question">
                        <span><?php echo $question; ?></span>
                        <div class="plus-minus-toggle plus-collapsed"></div>
                    </div>
                    <div class="destination-faq__grid-container__faq__answer" style="display: none;">
                    <?php echo $answer; ?>
                    </div>
                </div>

        <?php
            }
        } ?>
    </div>
</div>