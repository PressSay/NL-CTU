<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['shop' => 1]); ?>
  <div class="flex sm:flex-row flex-col">
    <div class="basis-1/4 flex flex-col items-left">
      <div class="collapse rounded-box collapse-arrow sm:w-56 w-full">
        <input type="checkbox" checked />
        <div class="collapse-title bg-base-200 text-sm">
          Danh Muc San Pham
        </div>
        <div class="collapse-content p-0">
          <div class="rounded-b-lg">
            <ul class="menu menu-compact bg-base-100 p-2" id="category-products">
              <!--  <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1 text-sm">loai san pham 1</p>
                </label>
              </li>
              <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1">loai san pham 2</p>
                </label>
              </li>
              <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1">loai san pham 3</p>
                </label>
              </li>
              <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1">loai san pham 4</p>
                </label>
              </li>
              <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1">loai san pham 5</p>
                </label>
              </li> -->
            </ul>
            <div class="flex justify-around">
              <button class="btn btn-sm" id="filter-product">filter</button>
            </div>
          </div>
        </div>
      </div>
      <div class="collapse rounded-box collapse-arrow sm:w-56 w-full">
        <input type="checkbox" checked />
        <div class="collapse-title bg-base-200 text-sm">
          Gio Hang
        </div>
        <div class="collapse-content p-0">
          <div class="rounded-b-lg">
            <ul class="menu menu-compact bg-base-100 p-2" id="carts">
              <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1 text-sm">Gio Hang 1</p>
                </label>
              </li>
              <li>
                <label class="flex items-center">
                  <input type="checkbox" checked="checked" class="checkbox checkbox-xs" />
                  <p class="mx-1 my-1">Gio Hang 2</p>
                </label>
              </li>
            </ul>
            <div class="flex justify-around">
              <button class="btn btn-sm" id="create-cart">create</button>
              <button class="btn btn-sm" id="remove-cart">remove</button>
            </div>
          </div>
        </div>
      </div>

      <!-- <input type="range" min="0" max="100" value="40" class="range range-xs" />
        <p class="text-center">8000$</p> -->
    </div>
    <div class="basis-3/4 flex flex-col mx-1 mb-4" >
      <div class="block">
        <div class="btn-group  mb-4">
          <button class="btn btn-xs" id="prevPage1">prev</button>
          <button class="btn btn-xs" id="nextPage1">next</button>
        </div>

        <button class="btn btn-xs" id="lastPage">last page</button>
      </div>
      <div class="flex flex-col" id="container-sanphams">
        
      </div>
    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/shop/productNS/index.blade.php ENDPATH**/ ?>