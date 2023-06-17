<x-app-layout :shop="1">
  <div class="block my-5" id="category-products-upload">
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
  </div>

  <div class="block">
    <div class="btn-group  mb-4">
      <button class="btn btn-xs" id="prevPage1">prev</button>
      <button class="btn btn-xs" id="nextPage1">next</button>
    </div>

    <button class="btn btn-xs" id="lastPage">last page</button>
  </div>

  <div class="flex flex-col justify-center items-center w-full my-4">
    <label class="flex justify-center flex-col my-3">
      <span>Ten Loai</span>
      <input name="category-product-info" type="text" placeholder="Type here" class="input input-bordered input-md" />
    </label>
    <label class="flex justify-center mb-3 flex-col">
      <span>Ma Loai</span>
      <input name="category-product-info" type="text" 
        placeholder="Can Null for submit" class="input input-bordered input-md" />
    </label>
    <div class="flex justify-center mb-3">
      <buton id="edit-category-product" class="btn btn-xs mr-1">Edit</buton>
      <buton id="submit-category-product" class="btn btn-xs mr-1">Submit</buton>
    </div>
  </div>
</x-app-layout>