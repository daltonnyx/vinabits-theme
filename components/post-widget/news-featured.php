<div class="news-featured-list">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
  <div class="news-featured-item">
    <a href="<?php echo get_permalink(); ?>">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('news-featured', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive'
        )); ?>
      <?php } ?>
    </div>
    <div class="news-container">
      <h3 class="news-title"><?php echo get_the_title(); ?></h3>
      <?php if($has_excerpt) { ?>
        <p><?php echo get_my_excerpt(30); ?></p>
      <?php } ?>
    </div>
    </a>
  </div>
<?php endwhile;endif; ?>
</div>
