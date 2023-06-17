<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Post Thread'),'threadPost' => 1,'noFooter' => 1]); ?>

  <div class="font-bold text-xl my-4">Post topic</div>

  <!-- nav-links-forum -->
  <div class="block my-7  md:my-4">
    <div class="text-sm breadcrumbs hidden sm:block">
      <ul>
        <li><a href="/forum">Forums</a></li>
        
        <li><a href="/post/category-for-thread"><?php echo e($category->category->title); ?></a></li>
        <li><?php echo e($category->title); ?></li>
      </ul>
    </div>
    <div class="flex sm:hidden">
      <a href="/post/category-for-thread" class="flex items-center">
        <svg class="h-5 w-5 text-base mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" />
          <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5Z" />
          <path d="M12 10l4 4m0 -4l-4 4" />
        </svg>
        <p class="font-semibold w-32 truncate"><?php echo e($category->title); ?></p>
      </a>
    </div>
  </div>

  <!-- table -->
  <div class="flex flex-col rounded-md bg-base-200 mb-5">
    <div class="flex sm:flex-row flex-col bg-base-100 m-2 mb-3 rounded-md">

      <select id="prefix" class="select select-bordered select-sm  sm:max-w-xs sm:rounded-r-none sm:mr-1">
        <option disabled selected>Prefix</option>
        <?php $__currentLoopData = $prefixes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prefix): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($prefix->content); ?>"><?php echo e($prefix->content); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <input id="title" type="text" placeholder="Thread Title" class="input input-bordered input-sm sm:w-full sm:rounded-l-none" />
    </div>
    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-red-500 text-sm">
      <?php echo e($message); ?>

    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php $__errorArgs = ['prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-red-500 text-sm">
      <?php echo e($message); ?>

    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div class="block m-2.5">
      <textarea name="bbcode" id="bbcode-id" class="w-full h-80 sm:h-64">
      </textarea>
    </div>
    <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-red-500 text-sm">
      <?php echo e($message); ?>

    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <p><label>Image: <input id="image" type="file" /></label></p>
    <p>
      <button class="btn btn-sm" id="upload-image">
        <div class="text-xs">upload</div>
      </button>
    </p>
    <p id="success"></p>

    <div class="flex sm:flex-row flex-col m-2.5">
      <div class="font-light mr-3">Option</div>
      <div class="form-control">
        <label class="label cursor-pointer">
          <span class="label-text mr-2">Follow this thread</span>
          <input id="follow" type="checkbox" checked="checked" class="checkbox checkbox-sm" />
        </label>
        <label class="label cursor-pointer">
          <span class="label-text mr-2">Receive email notifications about this article</span>
          <input id="receive" type="checkbox" checked="checked" class="checkbox checkbox-sm" />
        </label>
      </div>
    </div>

    <div class="flex justify-start items-center m-4">
      <button class="btn btn-sm" id="thread-sent">
        <!-- edit -->
        <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
        post
      </button>
    </div>

  </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/post/thread/create-thread.blade.php ENDPATH**/ ?>