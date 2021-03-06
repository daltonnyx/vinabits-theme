<div class="testimonals">
  <?php if($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
    <div class="testimonial-item">
        <div class="thumb">
            <div class="frame">
              <?php the_post_thumbnail('testimonial-avatar',  array(
                'alt' => get_the_title(),
                'class' => 'img-responsive testimonial-thumb'
            ) ); ?>
            </div>
        </div>
        <div class="author">
          <div class="text">
            <h5><?php echo get_the_title(); ?><span class="job-title"> (<?php echo get_post_meta(get_the_ID(), 'testimonials-widget-title', true); ?>)</span></h5>
            <blockquote>
              <?php echo get_the_excerpt(); ?>
            </blockquote>
          </div>
        </div>
    </div>
  <?php endwhile;endif; ?>
</div>

    <script type="text/javascript">
    jQuery(document).ready(function($){
        $(".testimonals").slick({
            autoplay: true,
            autoplaySpeed: 750,
            swipeToSlide: true,
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            vertical: true,
            infinite: true
        });
    });
    </script>
