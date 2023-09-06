<!-- /**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Motaphoto
 * @since Motaphoto 1.0
 */ -->

 <?php get_header(); ?>
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <?php get_template_part( 'template-parts/entry' ); ?>
 <?php endwhile; endif; ?>
 <?php get_footer(); ?>