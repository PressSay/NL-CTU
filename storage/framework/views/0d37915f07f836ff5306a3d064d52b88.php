<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
'forum',
'threadComments',
'threadPost',
'categoryPost',
'title',
'profile',
'noFooter',
'categories',
'threads',
'threadUser',
'shop',
'shopUpload',]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
'forum',
'threadComments',
'threadPost',
'categoryPost',
'title',
'profile',
'noFooter',
'categories',
'threads',
'threadUser',
'shop',
'shopUpload',]); ?>
<?php foreach (array_filter(([
'forum',
'threadComments',
'threadPost',
'categoryPost',
'title',
'profile',
'noFooter',
'categories',
'threads',
'threadUser',
'shop',
'shopUpload',]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-theme="garden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="viewport" content="width=device-width">
    <?php if(isset($title)): ?>
    <title><?php echo e($title); ?></title>
    <?php else: ?>
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('css/output.css')); ?>">
    <!-- Scripts -->

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/notification.js']); ?>


    <?php if(isset($threadComments)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/threadComment.js']); ?>

    <?php elseif(isset($categories)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/categories.js']); ?>

    <?php elseif(isset($threads)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/threads.js']); ?>

    <?php elseif(isset($threadUser)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/threadUser.js']); ?>

    <?php elseif(isset($shop)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/shop.js']); ?>
    <?php endif; ?>

    <?php if(isset($forum) or isset($threadPost) or isset($categoryPost) or isset($threadComments) or isset($shopUpload)): ?>
    <?php if(auth()->guard()->check()): ?>
    <script src="<?php echo e(asset('minified/sceditor.min.js')); ?>"></script>
    <script src="<?php echo e(asset('minified/plugins/dragdrop.js')); ?>"></script>
    <script src="<?php echo e(asset('minified/formats/bbcode.js')); ?>"></script>
    <script src="<?php echo e(asset('minified/icons/monocons.js')); ?>"></script>
    <!-- <link rel="stylesheet" href="<?php echo e(asset('minified/themes/modern.min.css')); ?>"> -->
    <link rel="stylesheet" href="<?php echo e(asset('minified/themes/defaultdark.min.css')); ?>">
    <?php endif; ?>

    <?php if(isset($forum)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/forum.js']); ?>

    <?php elseif(isset($threadPost)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/threadPost.js']); ?>

    <?php elseif(isset($categoryPost)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/categoryPost.js']); ?>

    <?php endif; ?>

    <?php endif; ?>

    <?php if(isset($profile)): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    
    <?php endif; ?>

</head>

<body>

    <div class="container mx-auto flex flex-col justify-between h-screen relative" id="app">
        <div class="alert alert-success shadow-lg  z-50 hidden fixed container">
            <div class="flex justify-between w-full">
                <div id="icon-alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span id="message-alert">Your purchase has been confirmed!</span>
                <button id="close-alert" class="btn btn-xs">X</button>
            </div>
        </div>

        

    <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Page Content -->
    <?php echo e($slot); ?>



    <?php if (! (isset($noFooter))): ?>
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    </div>
</body>

</html><?php /**PATH /home/lpq/DoAn/NenLuanCoSo/laravel/Forum/resources/views/layouts/app.blade.php ENDPATH**/ ?>