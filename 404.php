<?php get_header(); ?>

<section class="error-404 not-found">
  <div class="container text-center" style="padding: 80px 0;">
    <h1 class="error-title" style="font-size: 64px; font-weight: 700; color: var(--primary-color); margin-bottom: 20px;">
      <?php _e('404', 'bettingtips'); ?>
    </h1>

    <h2 style="font-size: 28px; margin-bottom: 15px;">
      <?php _e("Oops! Page not found.", 'bettingtips'); ?>
    </h2>

    <p style="color: var(--gray-color); font-size: 16px; margin-bottom: 30px;">
      <?php _e("The page you’re looking for doesn’t exist or has been moved.", 'bettingtips'); ?>
    </p>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
      <?php _e("Back to Homepage", 'bettingtips'); ?>
    </a>
  </div>
</section>

<?php get_footer(); ?>
