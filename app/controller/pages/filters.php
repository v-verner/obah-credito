<?php defined('ABSPATH') || exit;

add_filter('display_post_states', function($states) {
   global $post;
   if (!$post) return $states;
   if ($post->post_type !== 'page') return $states;

   if (isObahPage()) :
      $states[]   = '🔥 Página Obah Crédito';
   endif;

   return $states;
});
