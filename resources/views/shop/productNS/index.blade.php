<x-app-layout :shop="1">
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
</x-app-layout>