<x-app-layout :threadComments="1" :title="'title Thread'">
  <input type="checkbox" id="my-modal-3" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box relative">
      <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
      <h3 class="text-lg font-bold mb-3">Are you sure?</h3>
      <div class="flex items-center justify-center">
        <label for="my-modal-3" class="btn btn-xs mx-1" id="sure">sure</label>
        <label for="my-modal-3" class="btn btn-xs mx-1">not sure</label>
      </div>
    </div>
  </div>
  <div class="flex flex-col">
    <div class="flex items-center ">
      @if ($thread->prefix)
      <div class="badge badge-accent text-lg">
        {{ $thread->prefix->content }}
      </div>
      @endif
      <div class="ml-2 link link-hover text-lg ">
        {{ $thread->title }}
      </div>
    </div>
    {{-- <!-- descriptions -->
    <div class="flex flex-col my-4">
      <p class="text-sm sm:text-base mb-2">
        {{ $thread->threadComment[0]->content }}
      </p>
      <div class="flex justify-center">
        <figure class="max-w-lg">
          <img class="h-auto max-w-full rounded-lg" src="./images/large-image.jpg" alt="image description">
          <figcaption class="mt-2 text-xs sm:text-sm text-center text-gray-500 dark:text-gray-400">
            <a href="./images/large-image.jpg">Click to see original photo</a>
          </figcaption>
        </figure>
      </div>
    </div> --}}
    <!-- author -->
    <div class="flex items-center font-light text-xs sm:text-sm">
      <a href="#{{-- info user --}}" class="link link-hover">Re: {{ $thread->user->name }}</a>
      <a href="#" class="ml-2 link link-hover">{{ date_format($thread->updated_at, "d-m-y") }}</a>
    </div>
    <!-- nav-links-forum -->
    <div class="block my-7  md:my-4">
      <div class="text-sm breadcrumbs hidden sm:block">
        <ul>
          <li><a href="/forum">Forum</a></li> 
          <li><a href="/categories/{{ str_replace(' ','_',$thread->category->title).'-'.$thread->category->id  }}">{{ $thread->category->category->title }}</a></li> 
          <li>{{ $thread->category->title }}</li>
        </ul>
      </div>
      <div class="flex sm:hidden">
        <a href="/categories/{{ str_replace(' ','_',$thread->category->title).'-'.$thread->category->id  }}" class="flex items-center">
          <svg class="h-5 w-5 text-base mr-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" />
            <path d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5Z" />
            <path d="M12 10l4 4m0 -4l-4 4" />
          </svg>
          <p class="font-semibold truncate w-32">{{ $thread->category->category->title }}</p>
        </a>
      </div>
    </div>

     <!-- page -->
    <div class="block">
      <div class="btn-group  mb-4">
        <button class="btn btn-xs" id="prevPage">prev</button>
        <button class="btn btn-xs" id="nextPage">next</button>
      </div>

      <button class="btn btn-xs" id="lastPage">last page</button>
    </div>

    <!-- Comments -->
    <div class="flex flex-col bg-base-200 p-2 rounded-xl mb-4">
      @if (Auth::check())
      <div class="flex justify-end border-b-4 pb-2">
        <div id="follow" class="btn btn-xs">
          @if ($isFollow)
            Unfollow
          @else
            Follow
          @endif
        </div>
      </div>
      @endif

      <!-- threads -->
      <div class="divide-y divide-stone-400 hover:divide-stone-500" id="threadComments">

        {{-- @foreach ($thread->threadComments as $comment)
        <!-- thread-1 -->
        <div class="my-4 flex flex-col md:flex-row pt-2">
          <div class="flex flex-col md:mb-0 mb-6">
            <div class="flex md:flex-col md:justify-center md:items-center">
              <div class="avatar md:mr-0 mr-2">
                <div class="w-9 rounded-full">
                  <img src="{{ Storage::url($comment->user->profile->avatar) }}" />
                </div>
              </div>
              <a href="#" class="text-xs sm:text-sm md:mr-0 mr-2 truncate w-32 text-center">
                {{ $comment->user->name }}
              </a>
              <div class="badge badge-accent text-xs font-light mb-1">
                Members
              </div>
            </div>
            <!-- detail  -->
            <div class="block md:w-32 w-full">
              <div class="collapse collapse-arrow">
                <input type="checkbox" class="h-5 min-h-0" />
                <div class="collapse-title p-0 h-5 flex justify-center items-center min-h-0 text-xs font-light ">
                  <p>Detail</p>
                </div>
                <div class="collapse-content">
                  <div class="flex items-center justify-between my-1">
                    <!-- account -->
                    <svg class="h-3.5 w-3.5 text-base" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                      <circle cx="12" cy="7" r="4" />
                    </svg>
                    <div class="text-xs">{{ (new Carbon\Carbon($comment->updated_at))->isoFormat('DD/MM/YYYY') }}</div>
                  </div>
                  <div class="flex items-center justify-between my-1">
                    <!-- comment -->
                    <svg class="h-3.5 w-3.5 text-base" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" />
                      <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" />
                    </svg>
                    <div class="text-xs">{{ $comment->user->thread->count() }}</div>
                  </div>
                  <div class="flex items-center justify-between my-1">
                    <!-- like -->
                    <svg class="h-3.5 w-3.5 text-base" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <path
                        d="M7 11v 8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
                    </svg>
                    <div class="text-xs"></div>
                  </div>

                  <div class="flex items-center justify-between my-1">
                    <!-- birthday -->
                    <svg class="h-3.5 w-3.5 text-base" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <path d="M6 14a6 6 0 0 0 12 0a12 12 0 0 0 -3 -8.5a3.7 3.7 0 0 0 -6 0a12 12 0 0 0 -3 8.5" />
                    </svg>
                    <div class="text-xs">{{ now()->diffInYears(Carbon\Carbon::parse($comment->user->birthday)) }}</div>
                  </div>
                  <div class="flex items-center justify-between my-1">
                    <!-- location -->
                    <svg class="h-3.5 w-3.5 text-base" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                      stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <circle cx="12" cy="11" r="3" />
                      <path
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1 -2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                    </svg>
                    <div class="text-xs">{{ $comment->user->profile->location }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- content -->
          <div class="grow flex flex-col ">
            <div class="flex justify-between mb-4">
              <a href="#" class="link link-hover text-xs">{{ $comment->updated_at }}</a>
              <div class="flex items-center">
                <a href="#">
                  <!-- share -->
                  <svg class="h-3.5 w-3.5 text-base" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <circle cx="12" cy="18" r="2" />
                    <circle cx="7" cy="6" r="2" />
                    <circle cx="17" cy="6" r="2" />
                    <path d="M7 8v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-2" />
                    <line x1="12" y1="12" x2="12" y2="16" />
                  </svg>
                </a>
                <p class="font-light text-xs mx-2">#4</p>
              </div>
            </div>
            <div class="block">
              <div class="text-sm sm:text-base">
                {{ htmlspecialchars_decode($comment->content) }}
              </div>
            </div>
          </div>
        </div>
        @endforeach --}}

      </div>
      
    </div>

    @auth
    <div class="flex p-2 w-full bg-base-200 rounded-xl my-4">
      <div class="avatar basis-2/12 justify-center items-start mt-5 lg:flex hidden">
        <div class="w-24 mask mask-squircle">
          <img src="{{ Storage::url(Auth::user()->profile->avatar) }}" />
        </div>
      </div>
      <div class="block md:basis-10/12 w-full">
        <textarea name="bbcode" id="bbcode-id" style="height:300px;width:100%;" class=""></textarea>
        <p><label>Image: <input id="image" type="file"/></label></p>
        <p>
          <button class="btn btn-sm" id="upload-image">
            <div class="text-xs">upload</div>
          </button>
        </p>
        <p id="success"></p>

        <div class="flex flex-row justify-end mt-2">
          <button class="btn btn-sm" id="reply">
            <svg class="h-4 w-4 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
            <div class="text-xs">Reply</div>
          </button>
        </div>
      </div>
    </div>
    @endauth

  </div>
</x-app-layout>