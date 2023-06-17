<x-app-layout >

@vite(['resources/js/newThread.js'])

<div class="flex flex-col">
      <div class="text-base lg:text-lg my-5">
        What's new?
      </div>
      <div class="my-4 flex flex-col">

        <div class="tabs flex-nowrap overflow-x-auto
        overflow-y-hidden w-full border-slate-500 lg:border-b">
          <a class="tab flex-nowrap whitespace-nowrap sm:tab-bordered tab-active ">What's new?</a>
          <a class="tab flex-nowrap whitespace-nowrap" href="/threadComment/recent">Recent Activity</a>
        </div>

        <!-- table -->
        <div class="flex flex-col bg-base-200 p-2 rounded-xl my-2.5">
          <!-- title here -->
          <div class="flex justify-start items-center border-b-2 pb-2">
            <svg class="h-5 w-5 text-base mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <div>Lastest</div>
          </div>
          <!-- Threads -->
          <div id="threads" class="my-2 flex flex-col justify-center items-center ">
            <!-- Thread 1 -->
            <div class="w-full p-1 rounded-lg bg-base-200 hover:bg-base-300 cursor-pointer my-3">
              <div class="flex w-full">
                <div class="basis-10 ">
                  <a class="avatar" href="https://www.google.com">
                    <div class="w-10 mask mask-hexagon">
                      <img src="https://duckduckgo.com/favicon.ico" />
                    </div>
                  </a>
                </div>
                <div class="flex flex-col basis-full">
                  <div class="flex">
                    <a href="./thread.html" class="flex items-center">
                      <div class="badge badge-accent ml-2">
                        accent
                      </div>
                      <div class="ml-2 link link-hover">Thread</div>
                    </a>
                    <div class="h-full grow">
                      <a class="w-full h-full block" href="./thread.html"></a>
                    </div>
                  </div>
                  <div class="flex flex-row text-xs">
                    <div class="flex items-center">
                      <!-- reply -->
                      <svg class="h-3.5 w-3.5 text-base ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                      </svg>
                      <a href="#" class="ml-1 link link-hover">Re: Thread</a>
                      <a href="#" class="ml-2 link link-hover">Date</a>
                    </div>
                    <div class="grow h-full">
                      <a class="grow h-full block" href="./thread.html">
                      </a>
                    </div>
                    <div class="flex items-center">
                      <!-- reply-1 -->
                      <svg class="h-5 w-5 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                      </svg>
                      <p class="text-xs font-light">2</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          
        </div>

        <div class="block">
          <div class="btn-group  mt-2">
            <button class="btn btn-xs" id="prevPage">prev</button>
            <button class="btn btn-xs" id="nextPage">next</button>
          </div>
        </div>

      </div>
    </div>

</x-app-layout>