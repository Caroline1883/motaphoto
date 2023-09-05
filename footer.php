<?php wp_footer(); ?>
<footer>
    <div>
        <?php echo get_template_part('template-parts/contact'); ?>
    </div>
    <nav>
        <?php
            wp_nav_menu([
                'theme_location' => 'footer-menu',
                'container'      => false, // without WP container   
                ]);
            ?>
    </nav>
</footer>
</body>
</html>