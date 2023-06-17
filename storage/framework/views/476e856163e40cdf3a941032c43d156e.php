<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Select category for post thread')]); ?>

  <div class="rounded-lg bg-base-200 divide-y divide-dashed p-2 my-5">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($category->parent_id == 0): ?>
    <!-- parent Category -->
    <div class="flex justify-center items-start flex-col p-2 mb-5">
      <div class="font-light "><?php echo e($category->title); ?></div>
      <?php if($category->description): ?>
        <div class="font-thin text-sm"><?php echo e($category->description); ?></div>
      <?php endif; ?>
    </div>
    
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($subcategory->parent_id == $category->id): ?>
        <!-- sub Category -->
        <a href="/post/<?php echo e(str_replace(' ', '_', $subcategory->title).'-'.$subcategory->id); ?>/create-thread" class="p-2 hover:bg-base-300 flex items-center justify-between">
          <div class="flex flex-col items-start justify-center">
            <div class="font-semibold link link-hover"><?php echo e($subcategory->title); ?></div>
            <div class="text-sm"><?php echo e($subcategory->description); ?></div>
          </div>
          <div class="flex flex-col items-center justify-center">
            <div class="text-sm font-light">Threads</div>
            <div class="text-sm sm:text-base"><?php echo e($subcategory->threads->count()); ?></div>
          </div>
        </a>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/post/thread/category-for-thread.blade.php ENDPATH**/ ?>