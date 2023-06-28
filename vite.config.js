import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/selvah.css',
                'resources/js/selvah.js',
            ],
            refresh: true,
        }),
    ],
});
