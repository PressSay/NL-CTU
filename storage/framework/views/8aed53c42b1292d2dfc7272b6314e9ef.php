<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['forum' => 1,'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('Forum')]); ?>

  <div class="flex flex-col">
    <div class="drawer drawer-mobile h-full">
      <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
      <div class="drawer-content flex flex-col items-center">
  
        <!-- Page content here -->
  
        <label for="my-drawer-2" class="btn btn-sm btn-base drawer-button lg:hidden my-4">
          <svg class="mr-2 h-4 w-4 text-base" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
          sidebar
        </label>
  
        <?php if(auth()->guard()->check()): ?>
        <div class="flex w-full">
          <div class="flex flex-col items-start justify-start basis-1/2">
            <p>
              Welcome to the Agricultural Vietnam forum.
            </p>
            <p>
              Note: Don't ask in chat box, use post button ==>
            </p>
          </div>
          <div class="flex flex-col items-end justify-center basis-1/2">
            <a href="/post/category-for-thread" class="btn btn-sm">
              <!-- edit -->
              <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
              Thread
            </a>
            <?php if(Gate::allows('admin')): ?>
            <a href="/post/category-for-subcategory" class="btn btn-sm my-2">
              <!-- edit -->
              <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
              category
            </a>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
        <!-- chat -->
        <div class="bg-base-200 rounded-lg my-4 w-full">
          <div id="list-messages" class="overflow-auto p-2 h-80">
            <div class="chat chat-start">
              <div class="chat-image avatar">
                <div class="w-6 rounded-full">
                  <img src="https://duckduckgo.com/favicon.ico" />
                </div>
              </div>
              <div class="chat-header">
                ten
              </div>
              <div class="bg-base-300 rounded-md p-2">It was said that you would, destroy the Sith, not join them.</div>
            </div>
          </div>
          <?php if(auth()->guard()->check()): ?>
  
          <textarea name="bbcode" id="bbcode-id" class="w-full h-52"></textarea>
          <p><label>Image: <input id="image" type="file"/></label></p>
          <p>
            <button class="btn btn-sm" id="upload-image">
              <div class="text-xs">upload</div>
            </button>
          </p>
          <p id="success"></p>
  
          <div class="flex flex-row justify-end">
            <button class="btn btn-sm" id="forum-send">
              <!-- edit -->
              <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
              <div class="text-xs">send</div>
            </button>
          </div>
  
          <?php endif; ?>
        </div>
      
        <div class="block">
          <div class="btn-group mb-4">
            <button class="btn btn-xs" id="prevPage">prev</button>
            <button class="btn btn-xs" id="nextPage">next</button>
          </div>
        </div>
  
        <!-- category -->
        <div id="categories" class="flex flex-col justify-center items-center w-full">
          
        </div>
        
  
      </div>
      <div class="drawer-side lg:mr-4 lg:mb-4 min-h-max  lg:rounded-lg ">
        <label for="my-drawer-2" class="drawer-overlay"></label>
        <ul class="menu px-1 w-52 sm:w-64  bg-base-100 text-base-content  text-sm  cursor-default rounded-r-lg">
          <!-- Sidebar content here -->
          <!-- Status -->
          <li class="menu-title my-3">
            <div class="flex justify-items-start">
              <svg class="h-6 w-6 text-base" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
              </svg>
              <a href="#">Status</a>
            </div>
          </li>
          <li>
            <div class="bg-base-200 flex flex-col rounded-lg p-2 cursor-default">
              <div class="flex flex-col items-center">
                  <input id="forum-post-content" type="text" placeholder="Type here" class="w-full search-input input input-bordered h-9 mb-1" />
                  <div class="w-full mb-5">
                    <?php if(auth()->guard()->check()): ?>
                    <button id="forum-post-send" class="btn btn-xs">Post</button>
                    <?php endif; ?>
                  </div>
                
                
                <div id="list-posts" class="flex flex-col w-full" >
                  <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <!-- user-sidebar -->
                    <div class="flex flex-row w-full my-1">
                      <div class="basis-2/12">
                        <?php if($users->find($post->user_id)->isOnline()): ?>
                        <a href="/profile/intro/<?php echo e(str_replace(' ','_',$users->find($post->user_id)->name).'/'.$post->user_id); ?>" class="avatar online mr-2 user" id="user-<?php echo e($users->find($post->user_id)->id); ?> id="user-<?php echo e($users->find($post->user_id)->id); ?>">
                        <?php else: ?>
                        <a href="/profile/intro/<?php echo e(str_replace(' ','_',$users->find($post->user_id)->name).'/'.$post->user_id); ?>" class="avatar  mr-2 user" id="user-<?php echo e($users->find($post->user_id)->id); ?>" id="user-<?php echo e($users->find($post->user_id)->id); ?>">
                        <?php endif; ?>
                          <div class="rounded-full w-8">
                            <?php if($users->find($post->user_id)->profile->avatar): ?>
                              <img src="<?php echo e(Storage::url($users->find($post->user_id)->profile->avatar)); ?>" alt="avatar"/>
                            <?php else: ?>
                              <img src="https://duckduckgo.com/favicon.ico" alt="avatar"/>
                            <?php endif; ?>
                          </div>
                        </a>
                      </div>
                      <div class="basis-10/12">
                        <h2>
                          <a href="/profile/intro/<?php echo e(str_replace(' ','_',$users->find($post->user_id)->name).'/'.$post->user_id); ?>" class="text-cyan-700" ><?php echo e($users->find($post->user_id)->name); ?></a>
                        </h2>
                        <div>
                          <div class="truncate w-32 max-h-10">
                            <?php echo e($post->content); ?>

                          </div>
                          <div class="flex w-full justify-between">
                            <div><?php echo e($post->created_at); ?></div>
                            <a href="#">...</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
  
  
              </div>
            </div>
          </li>
          <!-- Online Member -->
          <li class="menu-title my-3">
            <div class="flex justify-items-start">
              <svg class="h-6 w-6 text-base" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
              <a href="#">Online member</a>
            </div>
          </li>
          <li>
            <div class="bg-base-200 flex flex-col rounded-lg p-1 cursor-default h-28 max-h-full">
              <div class="flex flex-row flex-wrap w-full items-start truncate">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user->isOnline()): ?>
                  <div class="ml-1">
                    <a ><?php echo e($user->name); ?></a>
                  </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <div class="ml-1">
                    <a href="member">someone</a>
                  </div>
  
              </div>
            </div>
          </li>
          <!-- Statiscal -->
          <li class="menu-title my-3">
            <div class="flex justify-items-start">
              <svg class="h-6 w-6 text-base" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <a href="#">Statistical</a>
            </div>
          </li>
          <li class="mb-4 lg:mb-0">
            <div class="p-0 flex flex-col items-center bg-base-200 cursor-default">
              <div class="stats stats-vertical shadow w-full bg-base-200 ">
                <div class="stat">
                  <div class="stat-title">Threads</div>
                  <div class="stat-value"><?php echo e($threads->count()); ?></div>
                  <div class="stat-desc">Jan 1st - <?php echo e(now()->isoFormat('MMM D')); ?></div>
                </div>
  
                <div class="stat">
                  <div class="stat-title">Users</div>
                  <div class="stat-value"><?php echo e($users->count()); ?></div>
                  
                </div>
  
                <div class="stat">
                  <div class="stat-title">New Registers</div>
                  <div class="stat-value"><?php echo e($countNewUsers); ?></div>
                  
                </div>
              </div>
            </div>
          </li>
        </ul>
  
      </div>
    </div>

  </div>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/forum.blade.php ENDPATH**/ ?>