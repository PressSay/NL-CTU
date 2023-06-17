<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['shop' => 1]); ?>
  <div class="flex flex-col mt-4">
    <h1 class="font-bold text-xl mb-4">Hinh Thuc Thanh Toan:</h1>
    <label class="flex mb-2">
      <span class="italic mr-2">Chuyen Khoang</span>
      <input type="radio" name="radio-thanhtoan" class="radio" checked value="Chuyen Khoang" />
    </label>
    <label class="flex mb-4">
      <span class="italic mr-2">tin dung</span>
      <input type="radio" name="radio-thanhtoan" class="radio" checked value="Credit card" />
    </label>
    <h1 class="font-bold text-xl mb-4">Note:</h1>
    <textarea class="textarea mb-4" placeholder="Bio" id='Note'></textarea>
  </div>

  <div class="flex flex-col" id="carts-detail">
    <h1 class="font-bold text-xl mb-4">Order Summary of Cart 2:</h1>
    <div class="flex flex-col bg-base-200 rounded-lg mb-4 py-2">
      <div class="flex flex-row justify-center items-center">
        <div class="w-28 m-4">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="" srcset="">
        </div>
        <div class="flex flex-row justify-between items-center w-full">
          <div class="flex flex-col">
            <h1 class="text-sm font-bont">Ten San Pham</h1>
            <p class="text-xs font-light">Ten Loai</p>
            <h1 class="text-xs font-bont">12$</h1>
          </div>
          <div class="flex justify-center items-center mr-4">
            <button class="btn btn-xs">+</button>
            <div class="mx-1">12</div>
            <button class="btn btn-xs">-</button>
          </div>
        </div>
  
      </div>
      <div class="flex flex-col mt-5">
        <div class="flex flex-row justify-between mx-4 mb-2">
          <p>Subtotal</p>
          <p>30$</p>
        </div>
        <div class="flex flex-row justify-between mx-4 mb-2">
          <p>Shipping</p>
          <p>30$</p>
        </div>
        <button class="btn btn-sm">Comfirm Order</button>
      </div>
    </div>
  
    <h1 class="font-bold text-xl mb-4">Order Summary of Cart 1:</h1>
    <div class="flex flex-col bg-base-200 rounded-lg mb-4 py-2">
      <div class="flex flex-row justify-center items-center">
        <div class="w-28 m-4">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="" srcset="">
        </div>
        <div class="flex flex-row justify-between items-center w-full">
          <div class="flex flex-col">
            <h1 class="text-sm font-bont">Ten San Pham</h1>
            <p class="text-xs font-light">Ten Loai</p>
            <h1 class="text-xs font-bont">12$</h1>
          </div>
          <div class="flex justify-center items-center mr-4">
            <button class="btn btn-xs">+</button>
            <div class="mx-1">12</div>
            <button class="btn btn-xs">-</button>
          </div>
        </div>
  
      </div>
      <div class="flex flex-col mt-5">
        <div class="flex flex-row justify-between mx-4 mb-2">
          <p>Subtotal</p>
          <p>30$</p>
        </div>
        <div class="flex flex-row justify-between mx-4 mb-2">
          <p>Shipping</p>
          <p>30$</p>
        </div>
        <button class="btn btn-sm">Comfirm Order</button>
      </div>
    </div>
  </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/shop/cart.blade.php ENDPATH**/ ?>