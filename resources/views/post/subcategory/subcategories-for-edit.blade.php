<x-app-layout :title="'Select category for post thread'" >
  <!-- nav-links-forum -->
  <div class="block my-7  md:my-4">
    <div class="text-sm breadcrumbs hidden sm:block">
      <ul>
        <li><a>Forum</a></li>
        <li><a href="/post/category-for-subcategory">Categories parent</a></li>
        <li>{{ $category->title }}</li>

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
        <li class="truncate w-32"><a href="/post/category-for-subcategory" >{{ $category->title }}</a></li>
      </a>
    </div>
  </div>



  {{-- create category --}}
  <div class="flex justify-end">
    <a href="/post/subcategory/{{ str_replace(' ','_',$category->title).'-'.$category->id }}" class="btn btn-xs mx-1">
      <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
      </svg>
      Create
    </a>
  </div>

  <div class="rounded-lg bg-base-200 divide-y divide-dashed p-2 my-5">
    <!-- parent Category -->

    @foreach ($category->children as $category)
    
    <a href="/post/edit-category/{{ str_replace(' ','_',$category->title).'-'.$category->id }}" class="sm:flex-row flex-col p-2 hover:bg-base-300 flex items-center justify-between">
      <div class="flex flex-col items-start justify-center">
        <div class="font-semibold link link-hover">{{ $category->title }}</div>
        @if ($category->description)
          <div class="text-sm">{{ $category->description }}</div>
        @endif
      </div>
      <div class="flex flex-col items-center justify-center">
        <div class="text-sm font-light">Threads</div>
        <div class="text-sm sm:text-base">{{ $category->threads->count() }}</div>
      </div>
      <div class="flex items-center justify-end">
        {{-- edit --}}
        <a href="/post/edit-category/{{ str_replace(' ','_',$category->title).'-'.$category->id }}" class="btn btn-xs mx-1">
          <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
          </svg>
        </a>
        {{-- delete --}}
        <form action="/post/delete-category/{{ str_replace(' ','_',$category->title).'-'.$category->id }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-xs">
            <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </form>
      </div>
    </a>
    
    @endforeach

  </div>

</x-app-layout>