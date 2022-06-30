<?php defined('ABSPATH') || exit;


function getObahPageId(string $pageName): int
{
    global $wpdb;
    $key = sanitize_title($pageName);
    $q = "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_obah-page' AND meta_value = %s";
    $q = $wpdb->prepare($q, $key);
    return (int) $wpdb->get_var($q);
}

function isObahPage(int $pageId = 0): bool
{
    $pageId = $pageId > 0 ? $pageId : get_the_ID();
    $meta = get_post_meta($pageId, '_obah-page', true);
    return $meta ? true : false;
}

function loadObahPageView(): void
{
    $page = get_post_meta(get_the_ID(), '_obah-page', true);
    VVerner\Views::getInstance()->getView('page/' . $page);
}

