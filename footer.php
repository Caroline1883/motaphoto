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
<div id='loader'>
    <img src="<?= get_template_directory_uri().'/assets/img/loader.gif'; ?>">
</div>
<?php 
    echo get_template_part('template-parts/contact'); 
    echo get_template_part('template-parts/lightbox');
    wp_footer(); 
?>
</body>
</html>