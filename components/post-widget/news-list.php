<ul class="news-list">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <li class="news-list-item">
    <a href="<?php echo get_permalink(); ?>">
        <?php echo get_the_title(); ?>
    </a>
  </li>
<?php endwhile;endif; ?>
</ul>
