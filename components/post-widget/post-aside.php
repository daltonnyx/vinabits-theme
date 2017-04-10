<ul class="news-aside-list">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
  <li class="news-aside-item">
    <a href="<?php echo get_permalink(); ?>">
    <div class="thumb-container">
      <?php if($has_thumbnail) { ?>
        <?php the_post_thumbnail('testimonial-avatar', array(
          'alt' => get_the_title(),
          'class' => 'img-responsive horizonal-thumb'
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
  </li>
<?php endwhile;endif; ?>
</ul>
