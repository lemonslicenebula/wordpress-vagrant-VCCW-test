<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package getwid_base
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>
<div class="footer-sidebars-wrapper">
    <div class="footer-sidebars">
        <aside class="widget-area">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside>
        <aside class="widget-area">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </aside>
        <aside class="widget-area">
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </aside>
        <aside class="widget-area">
            <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </aside>

    </div>
</div>