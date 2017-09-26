<div class="news-lead-list">
<?php $i = 0; ?>
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <?php if($i == 0)  : ?>
    <div class="news-lead-item">
      <a href="<?php echo get_permalink(); ?>">
      <h4 class="news-title"><?php echo get_the_title(); ?></h4>
        <?php the_post_thumbnail('vinabits-small', array(
        'alt' => get_the_title(),
        'class' => 'img-responsive horizonal-thumb'
      )); ?>
        <p><?php echo get_my_excerpt(25); ?></p>
      </a>
    </div>
    <ul class="post-list">
    <?php else : ?>
      <li class="post-item"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></li>
  <?php endif; ?>
  <?php $i += 1; ?>
<?php endwhile;endif; ?>
  </ul>
</div>
