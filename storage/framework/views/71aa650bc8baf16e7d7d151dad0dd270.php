<div class="navbar bg-base-100 p-1 my-2.5">
    <div class="navbar-start">
        <!-- responsive nav -->
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden swap swap-rotate p-2">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg> -->
                <!-- this hidden checkbox controls the state -->
                <input type="checkbox" class="hidden" />

                <!-- hamburger icon -->
                <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    viewBox="0 0 512 512">
                    <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
                </svg>

                <!-- close icon -->
                <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    viewBox="0 0 512 512">
                    <polygon
                        points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                </svg>

            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="/">Home</a></li>
                <li><a href="/shop/productNS">Shop</a></li>
                <li tabindex="0">
                    <a class="justify-between" href="/forum">
                        Forum
                    </a>
                </li>
                <li><a href="/thread/new">New</a></li>
            </ul>
        </div>
        <a href="\" class="btn btn-ghost normal-case text-xl p-1">Forums NS</a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/">Home</a></li>
            <li><a href="/shop/productNS">Shop</a></li>
            <li><a href="/forum">Forum</a></li>
            <li><a href="/thread/new">News</a></li>
        </ul>
    </div>
    <div class="navbar-end">
        <?php if(Route::has('login')): ?>
        <?php if(auth()->guard()->check()): ?>
        <!-- search
        <button class="btn btn-xs sm:btn-md btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button> -->
        <!-- notifications -->
        <div class="dropdown dropdown-end  mx-1">
            <label tabindex="0" class="btn btn-xs sm:btn-md btn-ghost btn-circle flex items-center">
                <div class="indicator">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </div>
            </label>
            <ul tabindex="0"
                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a>Notifications</a>
                </li>
                <li class="bg-base-200" id="notification">
                    
                </li>
            </ul>
        </div>

        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar btn-sm sm:btn-md">
            <div class="w-6 sm:w-9 rounded-full">
                <?php if(Auth::user()->profile->avatar): ?>
                <img src="<?php echo e(asset('/storage/'.Auth::user()->profile->avatar)); ?>" alt="avatar">
                <?php else: ?>
                <img src="https://duckduckgo.com/favicon.ico" alt="duckgo"/>
                <?php endif; ?>
            </div>
            </label>
            <ul tabindex="0"
                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a class="justify-between" href="/profile/intro/<?php echo e(str_replace(' ','_',Auth::user()->name).'/'.Auth::user()->id); ?>">
                    Profile
                    <!-- <span class="badge">New</span> -->
                    </a>
                </li>
                <li><a href="<?php echo e(route('profile.edit')); ?>">Settings</a></li>
                <li><a href="/shop/cart">Cart</a></li>
                <li><a href="/shop/upload/productNS">Post Product</a></li>
                <li><a href="/shop/orders">Orders</a></li>
                <?php if(Gate::allows('admin')): ?>
                <li><a href="/shop/upload/category">Post Category Product</a></li>
                <li><a href="/shop/orders/update">Update Orders</a></li>
                <?php endif; ?>
                <li>
                    <!-- Authentication -->
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault();
                        this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault();
                        this.closest(\'form\').submit();']); ?>
                            <?php echo e(__('Log Out')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </form>
                </li>
            </ul>
        </div>
        <?php else: ?>
        <a href="<?php echo e(route('login')); ?>"
        class="text-xs sm:text-base font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Log in
        </a>
        <?php if(Route::has('register')): ?>
        <a href="<?php echo e(route('register')); ?>"
        class="text-xs sm:text-base mx-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Register
        </a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/layouts/navigation.blade.php ENDPATH**/ ?>