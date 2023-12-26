import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/admin/tabs.js',
                'resources/js/app.js',
                'resources/css/client/game.css',
                'resources/js/admin/gamesCreate.js',
                'resources/js/admin/gamesEdit.js',
                'resources/js/admin/gamesDelete.js',
                'resources/js/admin/parties.js',
                'resources/css/client/game.css',
                'resources/js/client/game.js'
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true
            }
        }
    }
});
