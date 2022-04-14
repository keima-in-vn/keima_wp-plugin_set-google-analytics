<?php

add_action( 'wp_head', function ( ){
  $ga_id = get_option('ksga_ga_id');
  $ga_user_id_available = get_option('ksga_ga_user_id_available');

  $user = wp_get_current_user();
  $user_id = ($user) ? $user->ID : null;
  $user_email = ($user) ? $user->user_email : null;

  if ( $ga_id != '' ) :
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_id; ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      <?php if ( $ga_user_id_available === '1' && $user_email ) : ?>
        gtag('config', '<?php echo $ga_id; ?>', {
          'user_id' : '<?php echo $user_id; ?>'
        });
        gtag('set', 'user_properties', {
          'wp_user_id' : '<?php echo $user_id; ?>'
        });
      <?php else : ?>
        gtag('config', '<?php echo $ga_id; ?>');
      <?php endif; ?>
    </script>
    <?php
  endif;
}, 1 );