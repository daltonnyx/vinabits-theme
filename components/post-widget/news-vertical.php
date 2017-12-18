<div class="news-vertical-list">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
  <div class="news-vertical-item mb-4">
    <a href="<?php echo get_permalink(); ?>" class="flex-wrap flex-lg-nowrap d-flex">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('news-vertical', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container pl-2 pt-2">
      <h4 class="news-title"><?php echo get_the_title(); ?></h4>
      <?php if($has_excerpt) { ?>
        <p><?php echo get_my_excerpt(22); ?></p>
      <?php } ?>
    </div>
    </a>
  </div>
<?php endwhile;endif; ?>
</div>
