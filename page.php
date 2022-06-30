<?php get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div id="content" role="main" class="content-area">

    <?php if(isObahPage()) :?>
		
        <?php loadObahPageView() ?>

    <?php else :?>

        <?php the_content(); ?>
        
    <?php endif; ?>
    
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
