<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
    <?php wp_body_open();?>
    <header>
        <div>
            <?php if(has_custom_logo()) { ?>
                <?php echo get_custom_logo(); ?>
            <?php } else { ?>
                <a href="<?php echo home_url() ?>"><img class="logo" src="<?php echo get_template_directory_uri() . 'assets/img/logo.png'; ?>" alt="Logo" id="logo"></a>
            <?php } ?>
        </div>
        <div class="menu">
            <nav>
                <?php
                wp_nav_menu([
                    'theme_location' => 'main-menu',
                    'container'      => false, // without WordPress container
                    'walker'         => new Mota_Walker_Nav_Menu(),
                    // 'menu_class'     => 'desktop-menu',    
                ]);
                ?>
            </nav>
            <div class="hamburger">☰</div>
            <div class="cross">&#10006</div>
        </div>
    </header>
       