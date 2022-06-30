<?php defined('ABSPATH') || exit;

add_action('init', function(){
    
    foreach (OBAH_PAGES as $page) {
        
        $pageId = getObahPageId($page);
        if(!$pageId) {
            wp_insert_post([
                'post_title' => $page,
                'post_type' => 'page',
                'post_status' => 'publish',
                'meta_input' => [
                    OBAH_PAGE_META_KEY => sanitize_title($page)
                ]
            ]);
        }
    }

});
