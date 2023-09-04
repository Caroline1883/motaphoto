<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathalie Mota Photographe Event</title>
</head>
<body>

<nav>
<?php
wp_nav_menu([
    'theme_location' => 'main-menu',
    'container'      => false, // without WP container
    'walker'         => new Mota_Walker_Nav_Menu()
]);
?>
</nav>
