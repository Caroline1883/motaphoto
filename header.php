<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title>Nathalie Mota Photographe Event</title>
</head>
<body>
    <header>
        <div>
            <?php if(has_custom_logo()) { ?>
                <?php echo get_custom_logo(); ?>
            <?php } else { ?>
                <a href="<?php echo home_url() ?>"><img class="logo" src="<?php echo get_stylesheet_directory_uri() . 'assets/img/logo.png'; ?>" alt="Logo" id="logo"></a>
            <?php } ?>
        </div>
        <div class="menu">
            <nav>
                <?php
                wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'container'      => false, // without WP container
                    'walker'         => new Mota_Walker_Nav_Menu(),
                    'menu_class'     => 'desktop-menu',    
                ]);
                ?>
            </nav>
        </div>
        <div class="mobile-menu">
           <div class="hamburger">☰</div>
           <div class="cross">&#10006</div>
        </div>
    </header>

    <nav class="fullscreen">
        <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
                'container'      => false, // without WP container
                'walker'         => new Mota_Walker_Nav_Menu(),
                'menu_class'     => 'fullscreen-menu',    
                ]);
            ?>
    </nav>
       