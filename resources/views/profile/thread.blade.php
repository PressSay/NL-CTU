<x-app-layout :noFooter="1" :threadUser="1">
  <input type="checkbox" id="my-modal-4" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box relative">
      <label for="my-modal-4" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
      <h3 class="text-lg font-bold mb-3">Report content</h3>
      <div class="flex items-center">
        <p class="py-4 basis-3/12">Reason</p>
        <textarea placeholder="Bio" class="textarea textarea-bordered textarea-md w-full max-w-xs basis-9/12" ></textarea>
      </div>
    </div>
  </div>

  @auth
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
  @endauth

  <div class="flex sm:flex-row flex-col w-full my-3 bg-base-200">
    <div class="avatar sm:basis-2/12 justify-center">
      <div class="sm:w-24 w-20 mask mask-hexagon my-3 mx-0.5">
        <img src="{{ Storage::url($user->profile->avatar) }}" />
      </div>
    </div>
    <div class="flex flex-col sm:basis-10/12 my-3">
      <div class="flex justify-between items-center px-2">
        <div class="flex flex-col overflow-scroll">
          <div class="text-lg truncate w-32">{{ $user->name }}</div>
          <div class="flex flex-row ">
            @foreach ($user->roles as $role)
            <div class="badge badge-accent text-xs font-light mb-1">
              {{ $role->name }}
            </div>
            @endforeach
          </div>
        </div>
        <label for="my-modal-4" class="btn btn-xs w-20">report</label>
      </div>

      <div class="flex justify-around items-center px-3 my-2">
        <div class="flex items-center justify-center flex-col">
          <div class="text-xs font-light">Thread</div>
          <div class="text-xs">{{ $threads->count() }}</div>
        </div>
        <div class="flex items-center justify-center flex-col">
          <div class="text-xs font-light">Reaction</div>
          <div class="text-xs">{{ $countReaction }}</div>
        </div>
        
      </div>
    </div>
  </div>

  

  <div class="my-4 flex flex-col">
    <div class="tabs flex-nowrap overflow-x-auto
    overflow-y-hidden w-full border-slate-500 lg:border-b">
      <a class="tab flex-nowrap whitespace-nowrap sm:tab-bordered tab-active ">Threads</a>
      <a class="tab flex-nowrap whitespace-nowrap" href="/profile/intro/{{ str_replace(' ','_',$user->name).'/'.$user->id }}">Introduce</a>
    </div>

    <!-- page -->
    <div class="block">
      <div class="btn-group  mt-2">
        <button class="btn btn-xs" id="prevPage">prev</button>
        <button class="btn btn-xs" id="nextPage">next</button>
      </div>
    </div>

    <!-- table -->
    <div class="flex flex-col bg-base-200 p-2 rounded-xl my-2.5">
      
      <!-- Threads -->
      <div id="threads" class="my-2 flex flex-col justify-center items-center ">



        {{-- @foreach ($threads as $thread)
        <div class="w-full p-1 rounded-lg bg-base-200 hover:bg-base-300 cursor-pointer my-3">
          <div class="flex w-full">
            <div class="basis-10 ">
              <a class="avatar" href="https://www.google.com">
                <div class="w-10 mask mask-hexagon">
                  <img src="{{ Storage::url($thread->user->profile->avatar) }}" />
                </div>
              </a>
            </div>
            <div class="flex flex-col basis-full">
              <div class="flex">
                <a href="/threads/{{ str_replace(' ','_',$thread->title).'-'.$thread->id }}" class="flex items-center">
                  @if ($thread->prefix)
                  <div class="badge badge-accent ml-2">
                    {{$thread->prefix}}
                  </div>
                  @endif
                  <div class="ml-2 link link-hover">{{ $thread->title }}</div>
                </a>
                <div class="h-full grow">
                  <a class="w-full h-full block" href="/threads/{{ str_replace(' ','_',$thread->title).'-'.$thread->id }}"></a>
                </div>
              </div>
              <div class="flex flex-row text-xs">
                <div class="flex items-center">
                  <a href="#" class="ml-2 link link-hover">{{ Carbon\Carbon::parse($thread->updated_at)->isoFormat('DD/MM/YYYY') }}</a>
                </div>
                <div class="grow h-full">
                  <a class="grow h-full block" href="/threads/{{ str_replace(' ','_',$thread->title).'-'.$thread->id }}">
                  </a>
                </div>
                <div class="flex items-center">
                  <!-- reply-1 -->
                  <svg class="h-5 w-5 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                  </svg>
                  <p class="text-xs font-light">{{ $thread->threadComments->count() }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        @endforeach --}}
        <!-- Thread 1 -->

      </div>
    </div>

  </div>
</x-app-layout>