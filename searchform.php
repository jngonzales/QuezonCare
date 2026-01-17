<?php
/**
 * Search Form Template
 *
 * @package Quezon_Care
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label style="width: 100%; display: block; position: relative;">
        <span class="sr-only"><?php echo esc_html_x('Search for:', 'label', 'quezon-care'); ?></span>
        <input type="search" 
               class="wpcf7-form-control" 
               placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'quezon-care'); ?>" 
               value="<?php echo get_search_query(); ?>" 
               name="s" 
               style="width: 100%; padding-right: 50px;">
        <button type="submit" 
                style="position: absolute; right: 0; top: 0; bottom: 0; width: 50px; background: var(--primary-color); border: none; border-radius: 0 var(--radius-md) var(--radius-md) 0; color: white; cursor: pointer;">
            <i class="fas fa-search"></i>
        </button>
    </label>
</form>
