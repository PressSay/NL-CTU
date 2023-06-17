<x-app-layout :categoryPost="1" :title="'Parent Category Post'" :noFooter="1">
    <!-- nav-links-forum -->
    <div class="block my-7  md:my-4">
      <div class="text-sm breadcrumbs hidden sm:block">
        <ul>
          <li><a href="/forum">Forum</a></li>
          <li>new category</li>
        </ul>
      </div>
      <div class="flex sm:hidden">
        <a href="./category.html" class="flex items-center">
          <svg class="h-5 w-5 text-base mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5Z" />
            <path d="M12 10l4 4m0 -4l-4 4" />
          </svg>
          <p class="font-semibold">Forum</p>
        </a>
      </div>
    </div>

    <!-- table -->
    <div class="flex flex-col rounded-md bg-base-200">
      <div class="flex sm:flex-row flex-col bg-base-100 m-2 mb-3 rounded-md">

        <select id="prefix" class="select select-bordered select-sm  sm:max-w-xs sm:rounded-r-none sm:mr-1">
          <option disabled selected>Prefix</option>
          @foreach ($prefixes as $prefix)
          <option value="{{ $prefix->content }}">{{ $prefix->content }}</option>
          @endforeach
        </select>
        <input id="title"  type="text" placeholder="Title Parent Category" class="input input-bordered input-sm sm:w-full sm:rounded-l-none" />
      </div>

      <div class="block m-2.5">
        <textarea name="bbcode" id="bbcode-id" class="w-full h-80 sm:h-64"></textarea>
      </div>

      <div class="flex justify-start items-center m-4">
        <button class="btn btn-sm" id="category-sent">
          <!-- edit -->
          <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
          post
        </button>
      </div>

    </div>
</x-app-layout>