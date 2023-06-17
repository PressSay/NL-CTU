<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['shop' => 1]); ?>
  <h1 class="font-bold text-xl my-4">Ca Nhan Mua</h1>
  <div class="block">
    <div class="btn-group  mb-4">
      <button class="btn btn-xs" id="prevPage">prev</button>
      <button class="btn btn-xs" id="nextPage">next</button>
    </div>

    <button class="btn btn-xs" id="lastPage">last page</button>
  </div>
  <div class="block" id="order-person">
    <!-- row1 -->
    <div class="flex flex-col w-full lg:flex-row mb-3">
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow  card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Ma So</p>
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
        </div>
      </div>
    </div>
    <!-- row2 -->
  </div>

  <h1 class="font-bold text-xl my-4">Ca Nhan Ban</h1>
  <div class="block">
    <div class="btn-group  mb-4">
      <button class="btn btn-xs" id="prevPage1">prev</button>
      <button class="btn btn-xs" id="nextPage1">next</button>
    </div>

    <button class="btn btn-xs" id="lastPage">last page</button>
  </div>
  <div class="block mb-4" id="order-seller">
    <!-- row1 -->
    <div class="flex flex-col w-full lg:flex-row mb-3">
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow  card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>

        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
        </div>
      </div>
    </div>
    <!-- row2 -->
  </div>
  <div class="flex flex-col justify-center items-center w-full my-4">
    <label class="flex justify-center flex-col my-3">
      <span>Ma So</span>
      <input name="order-product-info" type="text" placeholder="Type here" class="input input-bordered input-md" />
    </label>
    <label class="flex justify-center mb-3 flex-col">
      <span>Trang Thai</span>
      <input name="order-product-info" type="text" placeholder="Đã giao hàng" class="input input-bordered input-md" />
    </label>
    <div class="flex justify-center mb-3">
      <button id="update-order-submit" class="btn btn-xs">submit</button>
    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/shop/orders/index.blade.php ENDPATH**/ ?>