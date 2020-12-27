<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php if(!have_posts()): ?>
    <div class="alert alert-warning">
      <?php echo e(__('Sorry, no results were found.', 'sage')); ?>

    </div>
    <?php echo get_search_form(false); ?>

  <?php endif; ?>

  <form action="">
    <div class="container">
      <div class="row">
        <?php $__currentLoopData = $search_terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col">
            <h4><?php echo esc_html($term['title']); ?></h4>
            <select name="term_<?php echo e($term['tax']); ?>" id="<?php echo e($term['tax']); ?>" onchange="this.form.submit()">
              <option value="*">All</option>
              <?php $__currentLoopData = $term['terms']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($single_term->term_id); ?>" <?php echo e($_GET['term_'.$term['tax']] == $single_term->term_id ? ' selected' : ''); ?>><?php echo esc_html($single_term->name); ?> (<?php echo e($single_term->count); ?>)</option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </form>

  <div class="container">
    <div class="row">
      <?php while(have_posts()): ?> <?php the_post() ?>
      <?php echo $__env->make('partials.content-'.get_post_type(), \App\Controllers\ArchiveProject::getProjectData(get_the_ID()), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endwhile; ?>
    </div>
  </div>

  <?php echo get_the_posts_navigation(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>