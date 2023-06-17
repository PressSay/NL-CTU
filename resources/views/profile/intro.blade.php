<x-app-layout :noFooter="1">
  <input type="checkbox" id="my-modal-3" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box relative">
      <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
      <h3 class="text-lg font-bold mb-3">Report content</h3>
      <div class="flex items-center">
        <p class="py-4 basis-3/12">Reason</p>
        <textarea placeholder="Bio" class="textarea textarea-bordered textarea-md w-full max-w-xs basis-9/12" ></textarea>
      </div>
    </div>
  </div>

  <div class="flex sm:flex-row flex-col w-full my-3 bg-base-200">
    <div class="avatar sm:basis-2/12 justify-center">
      <div class="sm:w-24 w-20 mask mask-hexagon my-3 mx-0.5">
        <img src="{{ Storage::url($user->profile->avatar) }}" />
      </div>
    </div>
    <div class="flex flex-col sm:basis-10/12 my-3">
      <div class="flex justify-between px-2">
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
        <label for="my-modal-3" class="btn btn-xs w-20">report</label>
      </div>

      <div class="flex justify-around items-center px-3 my-2">
        <div class="flex items-center justify-center flex-col">
          <div class="text-xs font-light">Thread</div>
          <div class="text-xs">{{ $user->thread->count() }}</div>
        </div>
        <div class="flex items-center justify-center flex-col">
          <div class="text-xs font-light">Reaction</div>
          <div class="text-xs"> {{ $countReaction }}</div>
        </div>
        
      </div>
    </div>
  </div>
  <div class="my-4 flex flex-col">
    <div class="tabs flex-nowrap overflow-x-auto
    overflow-y-hidden w-full border-slate-500 lg:border-b">
      <a class="tab flex-nowrap whitespace-nowrap " href="/profile/threads/{{ str_replace(' ','_',$user->name).'/'.$user->id }}" >Threads</a>
      <a class="tab flex-nowrap whitespace-nowrap sm:tab-bordered tab-active">Introduce</a>
    </div>

    <!-- table -->
    <div class="flex flex-col bg-base-200 p-2 rounded-xl my-2.5">

      
      <div class="my-2 flex flex-col justify-center items-center ">
        <div class="flex justify-around w-full px-3">
          <div class="flex flex-col basis-2/12">
            <div class="font-light">Birthday:</div>
            <div class="font-light">Location:</div>
            <div class="font-light">Gender:</div>
            <div class="font-light">signature:</div>
          </div>
          <div class="flex flex-col basis-10/12">
            <div class="font-light">{{ $user->profile->birthday.' ('.now()->diffInYears(Carbon\Carbon::parse($user->birthday)).')' }}</div>
            <div class="font-light">{{ $user->profile->location }}</div>
            <div class="font-light">{{ $user->profile->gender ? 'male' : 'female' }}</div>
            <div class="font-light">{{ $user->profile->signature }}</div>
          </div>
        </div>
      </div>
    </div>

  </div>
</x-app-layout>