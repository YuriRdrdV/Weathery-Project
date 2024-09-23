import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/components/form.js',
                'resources/js/components/searchActions.js',
            ],
            refresh: true,
        }),
    ],
});
