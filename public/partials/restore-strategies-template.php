<?php
    get_header();

    echo do_shortcode($post->post_content);

    get_footer();
