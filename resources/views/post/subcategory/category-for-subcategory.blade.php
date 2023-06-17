<x-app-layout :title="'Select category for post thread'" >

  

  {{-- create category --}}
  <div class="flex justify-end">
    <a href="/post/category" class="btn btn-xs mx-1">
      <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
      </svg>
      Create
    </a>
  </div>

  <div class="rounded-lg bg-base-200 divide-y divide-dashed p-2 my-5">
    <!-- parent Category -->

    @foreach ($categories as $category)
    @if ($category->parent_id == 0)
    <a href="/post/category-for-subcategory/{{ str_replace(' ','_',$category->title).'-'.$category->id }}/" class="sm:flex-row flex-col p-2 hover:bg-base-300 flex items-center justify-between">
      <div class="flex flex-col items-start justify-center">
        <div class="font-semibold link link-hover">{{ $category->title }}</div>
        @if ($category->description)
          <div class="text-sm">{{ $category->description }}</div>
        @endif
      </div>
      <div class="flex flex-col items-center justify-center">
        <div class="text-sm font-light">subCategory</div>
          <div class="text-sm sm:text-base">{{ $category->children->count() }}</div>
      </div>
      <div class="flex">
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
    @endif
    @endforeach

  </div>

</x-app-layout>