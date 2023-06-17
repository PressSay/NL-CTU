<x-app-layout :title="'Select category for post thread'">

  <div class="rounded-lg bg-base-200 divide-y divide-dashed p-2 my-5">
    @foreach ($categories as $category)
    @if ($category->parent_id == 0)
    <!-- parent Category -->
    <div class="flex justify-center items-start flex-col p-2 mb-5">
      <div class="font-light ">{{ $category->title }}</div>
      @if ($category->description)
        <div class="font-thin text-sm">{{ $category->description }}</div>
      @endif
    </div>
    
    @foreach ($categories as $subcategory)
      @if ($subcategory->parent_id == $category->id)
        <!-- sub Category -->
        <a href="/post/{{ str_replace(' ', '_', $subcategory->title).'-'.$subcategory->id }}/create-thread" class="p-2 hover:bg-base-300 flex items-center justify-between">
          <div class="flex flex-col items-start justify-center">
            <div class="font-semibold link link-hover">{{ $subcategory->title }}</div>
            <div class="text-sm">{{ $subcategory->description }}</div>
          </div>
          <div class="flex flex-col items-center justify-center">
            <div class="text-sm font-light">Threads</div>
            <div class="text-sm sm:text-base">{{ $subcategory->threads->count() }}</div>
          </div>
        </a>
      @endif
    @endforeach
    @endif
    @endforeach

  </div>

</x-app-layout>