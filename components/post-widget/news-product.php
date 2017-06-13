<div class="news-products">
<?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <?php render_product(); ?>
<?php endwhile;endif; ?>
</div>
