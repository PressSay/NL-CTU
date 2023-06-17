<x-app-layout :shop="1">
  <div class="flex flex-col my-5">
    <div class="flex flex-col basis-1/3 justify-center items-center p-2">
      <!-- <div class="w-full md:w-80">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="hinhanhsanpham">
        </div> -->
      <div class="carousel w-full md:w-96" id="product-images">
        <div id="item1" class="carousel-item w-full">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" class="w-full" />
        </div>
        <div id="item2" class="carousel-item w-full">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" class="w-full" />
        </div>
        <div id="item3" class="carousel-item w-full">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" class="w-full" />
        </div>
        <div id="item4" class="carousel-item w-full">
          <img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" class="w-full" />
        </div>
      </div>
      <div class="flex justify-center w-full py-2 gap-2" id="product-images-button">
        <a href="#item1" class="btn btn-xs">1</a>
        <a href="#item2" class="btn btn-xs">2</a>
        <a href="#item3" class="btn btn-xs">3</a>
        <a href="#item4" class="btn btn-xs">4</a>
      </div>

    </div>
    <div class="flex flex-col md:flex-row basis-2/3 justify-between items-start p-2">
      <div class="flex flex-col" id='show-product'>
        <div class="rating rating-lg md:rating-md rating-half my-1 ">
          <input type="radio" name="rating-0" class="rating-hidden hidden" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" checked />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-1" />
          <input type="radio" name="rating-0" class="bg-green-500 mask mask-star-2 mask-half-2" />
        </div>
        <h1 class="font-bold sm:text-xl my-1">Củ nghệ tươi</h1>
        <p class="text-sm my-1">5,500 ₫ /kg</p>
        <p class="text-sm my-1 font-bold">Mabel Weissnat</p>
        <p class="text-sm">Delectus sapiente repudiandae dolore quae. Incidunt ipsa eum asperiores eos qui ut. Magni est
          sunt sit odio. Modi vero et necessitatibus incidunt delectus hic est.</p>
        <button class="btn btn-sm my-3 w-32" id="btn-add-to-cart">Add To Cart</button>
      </div>
      <div class="flex justify-center items-start w-full">
        <div class="collapse rounded-box collapse-arrow sm:w-56 w-full my-4 md:my-0">
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
                    <p class="mx-1 my-1">Gio Hang 3</p>
                  </label>
                </li>

              </ul>
            </div>
            <div class="flex justify-around">
              <button class="btn btn-sm" id="create-cart">create</button>
              <button class="btn btn-sm" id="remove-cart">remove</button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <div class="flex flex-col p-2 w-full">
    <h1 class="font-bold sm:text-xl mb-3" >Product reviews</h1>
    <div class="flex flex-col mb-5 w-full">
      <div class="rating rating-md md:rating-sm rating-half mb-3 ">
        <input type="radio" name="rating-1" class="rating-hidden" value="0"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-1" value="1"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-2" value="2"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-1" value="3" checked=true />
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-2" value="4"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-1" value="5"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-2" value="6"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-1" value="7"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-2" value="8"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-1" value="9"/>
        <input type="radio" name="rating-1" class="bg-green-500 mask mask-star-2 mask-half-2" value="10"/>
      </div>
      <!-- neu co them don hang da xac nhan thi co the sua danh gia -->
      <textarea id="ratting-content" placeholder="Bio" class="textarea textarea-bordered textarea-md w-full mb-3"></textarea>
      <button class="btn btn-sm w-24" id="ratting-submit">rating</button>
    </div>

    <div class="flex flex-col mb-4" id="rating-comments">
    </div>

  </div>
</x-app-layout>