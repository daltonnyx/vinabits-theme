<div class="news-card">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
  <div class="news-default-item">
    <a href="<?php echo get_permalink(); ?>">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('post-banner', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
    </div>
    </a>
  </div>
<?php endwhile;endif; ?>
</div>
