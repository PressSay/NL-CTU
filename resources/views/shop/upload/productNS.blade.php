<x-app-layout :shop="1" :shopUpload="1">
  <div class="flex flex-col">
  <div class="collapse rounded-box collapse-arrow w-full">
        <input type="checkbox" checked />
        <div class="collapse-title bg-base-200 text-sm">
          Danh Muc San Pham
        </div>
        <div class="collapse-content p-0">
          <div class="rounded-b-lg">
            <ul class="menu menu-compact bg-base-100 p-2" id="category-products">
              
            </ul>
            <div class="flex justify-around">
              <button class="btn btn-sm" id="filter-product">filter</button>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="my-4 flex flex-col" id="container-sanphams">
    <!-- row1 -->
    <div class="font-bold text-xl">Loai san pham 1</div>
    <div class="block my-5">
      <div class="flex flex-col xl:flex-row justify-center items-center xl:justify-around">
        <div class="card w-full my-3 lg:my-0 md:w-80 xl:w-48 2xl:w-64 glass">
          <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="car!" />
          </figure>
          <div class="card-body">
            <h2 class="card-title">Ten San Pham</h2>
            <p>Mo Ta, Gia Tri</p>
            <div class="card-actions justify-end">
              <button class="btn btn-xs">Remove</button>
              <button class="btn btn-xs">Edit</button>
            </div>
          </div>
        </div>
        <div class="card w-full my-3 lg:my-0 md:w-80 xl:w-48 2xl:w-64 glass">
          <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="car!" />
          </figure>
          <div class="card-body">
            <h2 class="card-title">Ten San Pham</h2>
            <p>Mo Ta, Gia Tri</p>
            <div class="card-actions justify-end">
              <button class="btn btn-xs">Remove</button>
              <button class="btn btn-xs">Edit</button>
            </div>
          </div>
        </div>
        <div class="card w-full my-3 lg:my-0 md:w-80 xl:w-48 2xl:w-64 glass">
          <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="car!" />
          </figure>
          <div class="card-body">
            <h2 class="card-title">Ten San Pham</h2>
            <p>Mo Ta, Gia Tri</p>
            <div class="card-actions justify-end">
              <button class="btn btn-xs">Remove</button>
              <button class="btn btn-xs">Edit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- row2 -->
  </div>

  <div class="block" id="category-products-upload">
    <!-- row1 -->
    <div class="flex flex-col w-full lg:flex-row mb-3">
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Ten Loai 1</p>
          <p class="mx-1 my-1">Ma Loai 1</p>
          <div class="flex">
            <button class="btn btn-xs">Remove</button>
            <button class="btn btn-xs mx-1">Edit</button>
          </div>
        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow  card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Ten Loai 1</p>
          <p class="mx-1 my-1">Ma Loai 1</p>
          <div class="flex">
            <button class="btn btn-xs">Remove</button>
            <button class="btn btn-xs mx-1">Edit</button>
          </div>
        </div>
      </div>
      <div class="divider lg:divider-horizontal"></div>
      <div class="grid flex-grow card bg-base-200 rounded-box place-items-center">
        <div class="flex flex-col justify-center items-center mb-3">
          <p class="mx-1 my-1">Ten Loai 1</p>
          <p class="mx-1 my-1">Ma Loai 1</p>
          <div class="flex">
            <button class="btn btn-xs">Remove</button>
            <button class="btn btn-xs mx-1">Edit</button>
          </div>
        </div>
      </div>
    </div>
    <!-- row2 -->
  </div>

  <div class="flex flex-col w-full lg:flex-row">
    <div class="grid flex-grow card bg-base-300 rounded-box place-items-center">
      <div class="flex flex-col w-full">
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Ten San Pham</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Mo Ta SP</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Gia Tri SP</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-24">Ma Loai</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Ten Thong So</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Chi Tiet Thong So</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
      </div>
    </div>
    <div class="divider lg:divider-horizontal"></div>
    <div class="grid flex-grow  card bg-base-300 rounded-box place-items-center">
      <div class="flex flex-col w-full items-stretch">
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">So Luong</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Khuyen Mai</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Giam Gia</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Ngay Bat Dau</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Ngay Ket Thuc</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
        <label class="flex justify-around my-2 px-1">
          <span class="label mx-1 text-sm w-20">Product_id</span>
          <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="product-info"/>
        </label>
      </div>
    </div>
  </div>

  

  <div class="mt-4">
    <textarea name="bbcode" id="bbcode-id" style="height:300px;width:100%;" class=""></textarea>
    <p><label>Image: <input id="image" type="file" /></label></p>
    <p>
      <button class="btn btn-sm" id="upload-image">
        <div class="text-xs">upload</div>
      </button>
    </p>
    <p id="success"></p>
  </div>

  <div class="flex justify-end my-3">
    <input type="submit" value="Submit" class="btn btn-xs mr-1" id="submit-product"/>
    <input type="submit" value="Edit" class="btn btn-xs" id="edit-product"/>
  </div>
</x-app-layout>