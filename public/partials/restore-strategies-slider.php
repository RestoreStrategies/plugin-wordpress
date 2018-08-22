<section style='width: <?php echo $width ?>;' class='restore-strategies-slider-container' id='slider-container-<?php echo $ele_id; ?>'>
    <section class='restore-strategies-slider' id="<?php echo $ele_id; ?>">
        <?php echo $slider_content; ?>
    </section>
    <section class='arrows'></section>
</section>

<script>
(function($) {
    'use strict';
    $(document).ready(function(){
        $('#<?php echo $ele_id; ?>').slick({
            autoplay: <?php echo $auto ?>,
            appendArrows: '#slider-container-<?php echo $ele_id; ?> .arrows',
            autoplaySpeed: <?php echo $speed; ?>
        });
    });
})(jQuery);
</script>
