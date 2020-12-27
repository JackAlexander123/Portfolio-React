<?php $__env->startSection('content'); ?>
  <section id="homepage-banner">
    <div class="background">
      <div class="wp-expert"></div>
      <div class="full-stack"></div>
      <div class="wrestler"></div>
    </div>
    <div class="inner">
      <div class="container">
        <h1>Howdy, I'm Jack, Web Dev.</h1>
        <h2><span class="wp-expert">Wordpress Expert</span> <br><span class="full-stack">Full Stack Developer</span>  <br><span class="wrestler">Wrestler</span></h2>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>