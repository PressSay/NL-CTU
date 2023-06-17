<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['threadComments' => 1,'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('title Thread')]); ?>
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
  <div class="flex flex-col">
    <div class="flex items-center ">
      <?php if($thread->prefix): ?>
      <div class="badge badge-accent text-lg">
        <?php echo e($thread->prefix->content); ?>

      </div>
      <?php endif; ?>
      <div class="ml-2 link link-hover text-lg ">
        <?php echo e($thread->title); ?>

      </div>
    </div>
    
    <!-- author -->
    <div class="flex items-center font-light text-xs sm:text-sm">
      <a href="#" class="link link-hover">Re: <?php echo e($thread->user->name); ?></a>
      <a href="#" class="ml-2 link link-hover"><?php echo e(date_format($thread->updated_at, "d-m-y")); ?></a>
    </div>
    <!-- nav-links-forum -->
    <div class="block my-7  md:my-4">
      <div class="text-sm breadcrumbs hidden sm:block">
        <ul>
          <li><a href="/forum">Forum</a></li> 
          <li><a href="/categories/<?php echo e(str_replace(' ','_',$thread->category->title).'-'.$thread->category->id); ?>"><?php echo e($thread->category->category->title); ?></a></li> 
          <li><?php echo e($thread->category->title); ?></li>
        </ul>
      </div>
      <div class="flex sm:hidden">
        <a href="/categories/<?php echo e(str_replace(' ','_',$thread->category->title).'-'.$thread->category->id); ?>" class="flex items-center">
          <svg class="h-5 w-5 text-base mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5Z" />
            <path d="M12 10l4 4m0 -4l-4 4" />
          </svg>
          <p class="font-semibold truncate w-32"><?php echo e($thread->category->category->title); ?></p>
        </a>
      </div>
    </div>

     <!-- page -->
    <div class="block">
      <div class="btn-group  mb-4">
        <button class="btn btn-xs" id="prevPage">prev</button>
        <button class="btn btn-xs" id="nextPage">next</button>
      </div>

      <button class="btn btn-xs" id="lastPage">last page</button>
    </div>

    <!-- Comments -->
    <div class="flex flex-col bg-base-200 p-2 rounded-xl mb-4">
      <?php if(Auth::check()): ?>
      <div class="flex justify-end border-b-4 pb-2">
        <div id="follow" class="btn btn-xs">
          <?php if($isFollow): ?>
            Unfollow
          <?php else: ?>
            Follow
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- threads -->
      <div class="divide-y divide-stone-400 hover:divide-stone-500" id="threadComments">

        

      </div>
      
    </div>

    <?php if(auth()->guard()->check()): ?>
    <div class="flex p-2 w-full bg-base-200 rounded-xl my-4">
      <div class="avatar basis-2/12 justify-center items-start mt-5 lg:flex hidden">
        <div class="w-24 mask mask-squircle">
          <img src="<?php echo e(Storage::url(Auth::user()->profile->avatar)); ?>" />
        </div>
      </div>
      <div class="block md:basis-10/12 w-full">
        <textarea name="bbcode" id="bbcode-id" style="height:300px;width:100%;" class=""></textarea>
        <p><label>Image: <input id="image" type="file"/></label></p>
        <p>
          <button class="btn btn-sm" id="upload-image">
            <div class="text-xs">upload</div>
          </button>
        </p>
        <p id="success"></p>

        <div class="flex flex-row justify-end mt-2">
          <button class="btn btn-sm" id="reply">
            <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            <div class="text-xs">Reply</div>
          </button>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/thread-comments.blade.php ENDPATH**/ ?>