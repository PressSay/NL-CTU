<x-app-layout :shop="1">
  <h1 class="font-bold text-xl my-4">Admin Orders</h1>
  <div class="block">
    <div class="btn-group  mb-4">
      <button class="btn btn-xs" id="prevPage1">prev</button>
      <button class="btn btn-xs" id="nextPage1">next</button>
    </div>

    <button class="btn btn-xs" id="lastPage">last page</button>
  </div>
  <div class="block" id="order-admin">
    <!-- row1 -->
    <div class="flex flex-col w-full lg:flex-row mb-3">
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Ma So</p>
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
          <div class="card-actions justify-end">
            <button class="btn btn-xs">Remove</button>
          </div>
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
          <div class="card-actions justify-end">
            <button class="btn btn-xs">Remove</button>
          </div>
        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Ma So</p>
          <p class="mx-1 my-1">Trang Thai</p>
          <p class="mx-1 my-1">Tong Tien</p>
          <p class="mx-1 my-1">Ngay Lap</p>
          <p class="mx-1 my-1">Ghi Chu</p>
          <p class="mx-1 my-1">Phi Ship</p>
          <p class="mx-1 my-1">Nguoi Mua</p>
          <div class="card-actions justify-end">
            <button class="btn btn-xs">Remove</button>
          </div>
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
</x-app-layout>