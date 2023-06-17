import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/forum.js',
                'resources/js/threadPost.js',
                'resources/js/threadComment.js',
                'resources/js/categoryPost.js',
                'resources/js/threads.js',
                'resources/js/threadUser.js',
                'resources/js/notification.js',
                'resources/js/newThread.js',
                'resources/js/recentThread.js',
                'resources/js/shop.js',
            ],
            refresh: true,
        }),
    ],
});
