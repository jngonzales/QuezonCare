<?php
/**
 * Sidebar Template
 *
 * @package Quezon_Care
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area service-sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
