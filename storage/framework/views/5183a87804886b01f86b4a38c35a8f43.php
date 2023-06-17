<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->title),'threads' => 1]); ?>
  <?php if(auth()->guard()->check()): ?>
  <input type="checkbox" id="my-modal-3" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box relative">
      <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
      <h3 class="text-lg font-bold mb-3">Are you sure?</h3>
      <div class="flex items-center justify-center">
        <label for="my-modal-3" class="btn btn-xs mx-1" id="sure">sure</label>
        <label for="my-modal-3" class="btn btn-xs mx-1">not sure</label>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="flex">
    <div class="flex flex-col mb-4 basis-1/2">
      <div class="font-bold text-2xl mb-1">
        <?php echo e($category->title); ?>

      </div>
      <div class="font-light text-sm">
        <?php echo e($category->description); ?>

      </div>
    </div>
    <div class="flex flex-col justify-center items-center basis-1/2">
      <a href="/post/<?php echo e(str_replace(' ','_',$category->title).'-'.$category->id); ?>/create-thread" class="btn btn-xs">
        <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
        Thread
      </a>
    </div>
  </div>

  <!-- nav-link-forum -->
  <div class="my-7  md:my-4">
    <div class="text-sm breadcrumbs hidden sm:block">
      <ul>
        <li><a href="/forum">Forum</a></li>
        <li><?php echo e($category->category->title); ?></li>
      </ul>
    </div>
    <div class="flex sm:hidden">
      <a href="/forum" class="flex items-center">
        <svg class="h-5 w-5 text-base mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
          stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" />
          <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5Z" />
          <path d="M12 10l4 4m0 -4l-4 4" />
        </svg>
        <p class="font-semibold">Forums</p>
      </a>
    </div>

  </div>

  <!-- page -->
  <div class="block">
    <div class="btn-group  mb-4">
      <button class="btn btn-xs" id="prevPage">prev</button>
      <button class="btn btn-xs" id="nextPage">next</button>
    </div>
  </div>


  <!-- table Threads -->
  <div class="flex flex-col bg-base-200 p-2 rounded-xl  mb-5">
    <!-- title here -->
    <div class="flex justify-end border-b-4 pb-2">
      <div class="dropdown dropdown-end ">
        <label tabindex="0" class="btn btn-xs">search</label>
        <ul tabindex="0" class="dropdown-content text-sm  p-2 bg-base-200
        rounded-box w-screen sm:w-72 divide-y divide-solid shadow-md shadow-neutral-100">
          <li class="my-2 mx-1"><a>Show only</a></li>
          <li class="my-3 mx-1">
            <div class="font-light my-2"><a>prefix</a></div>
            <select id="prefix" class="select select-bordered select-xs w-full max-w-xs">
              <option selected>All</option>
              <?php $__currentLoopData = $prefixes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prefix): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option><?php echo e($prefix->content); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </li>
          <li class="my-3 mx-1">
            <div class="font-light my-2">
              Started by:
            </div>
            <input id="writed-by" type="text" placeholder="Type here" class="input input-bordered input-xs w-full max-w-xs" />
          </li>
          <li class="my-3 mx-1">
            <div class="font-light my-2"><a>Last updated:</a></div>
            <select id="last-updated" class="select select-bordered select-xs w-full max-w-xs">
              <option selected>Any time</option>
              <option>7 days</option>
              <option>14 days</option>
              <option>30 days</option>
            </select>
          </li>
          <li class="py-2 mx-1">
            <button class="btn btn-xs" id="search-submit" >Tiny</button>
          </li>
        </ul>
      </div>
    </div>
    
    <!-- threads -->
    <div class="my-2 flex flex-col justify-center items-center" id="threads">
    </div>
  </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/threads.blade.php ENDPATH**/ ?>