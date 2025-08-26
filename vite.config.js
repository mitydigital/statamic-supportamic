import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/support.js',
                'resources/css/support.css'
            ],
            publicDirectory: 'resources/dist',
        }),
    ],
});
