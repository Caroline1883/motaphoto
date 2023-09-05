<?php wp_footer(); ?>
<footer>
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