<div class="news-carousel owl-carousel">
<?php $i = 0; ?>
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="news-default-item ">
    <h3 class="news-title"><?php echo get_the_title(); ?></h3>
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('post-carousel', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
      <div class="promo">
        <span>Quà tặng</span>
        <span class="value"><?php echo get_post_meta(get_the_ID(), '_vnb_qua_tang',true); ?></span>
      </div>
    </div>
    <div class="promo-category">
        <?php $terms = wp_get_post_terms(get_the_ID(), 'promo_cat'); ?>
        <a href="<?php echo get_term_link($terms[0], 'promo_cat'); ?>" class="term-link"><?php echo $terms[0]->name; ?></a>
    </div>
    
  </div>
<?php $i += 100; ?>
<?php endwhile;endif; ?>
</div>

