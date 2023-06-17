<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo app('Illuminate\Foundation\Vite')(['resources/js/recentThread.js']); ?>

<div class="flex flex-col">
      <div class="text-base lg:text-lg my-5">
        Recent Activity
      </div>
      <div class="my-4 flex flex-col">
        <div class="tabs flex-nowrap overflow-x-auto
        overflow-y-hidden w-full border-slate-500 lg:border-b">
          <a class="tab flex-nowrap whitespace-nowrap" href="/thread/new">What's new?</a>
          <a class="tab flex-nowrap whitespace-nowrap sm:tab-bordered tab-active">Recent Activity</a>
        </div>
        <!-- table -->
        <div class="flex flex-col bg-base-200 p-2 rounded-xl my-2.5">
          <!-- title here -->
          <div class="flex justify-start items-center border-b-2 pb-2">
            <svg class="h-5 w-5 text-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <div>Lastest</div>
          </div>
          <!-- threads-detail -->
          <div id="newThreadComments" class="divide-y divide-stone-400 hover:divide-stone-500">
            <!-- thread-detail-1 -->
            <div class="my-4 flex pt-2">
              <!-- avatar -->
              <div class="flex flex-col md:mb-0 mb-2.5">
                <div class="avatar mx-2">
                  <div class="w-9 rounded-full">
                    <img src="https://duckduckgo.com/favicon.ico" />
                  </div>
                </div>
              </div>
              <!-- content -->
              <div class="grow flex flex-col">
                <div class="flex flex-col mb-2.5">
                  <!-- users -->
                  <div class="flex sm:flex-row flex-col text-sm sm:text-base font-semibold my-2">
                    <a href="#" class="link link-hover mx-1">ten</a>
                    <div class="flex sm:flex-row flex-col">
                      <div class="mx-1 font-light">replied to</div>
                      <a href="#" class="mx-1 link link-hover">thread</a>
                    </div>
                  </div>
                  <!-- paragraph -->
                  <div class="text-sm sm:text-base">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius in
                    laudantium quia impedit iure, voluptas vero sint ullam hic ad ipsam quam, tenetur sit expedita, enim
                    voluptates aperiam sapiente eligendi!
                  </div>
                </div>
                <!-- date -->
                <div class="flex justify-start ">
                  <a href="#" class="link link-hover text-xs">Date</a>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="block">
          <div class="btn-group  mt-2">
            <button class="btn btn-xs" id="prevPage">prev</button>
            <button class="btn btn-xs" id="nextPage">next</button>
          </div>
        </div>
      </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/recent.blade.php ENDPATH**/ ?>