import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
const host = 'admin-skill.test';
export default defineConfig({
    server:{
        host,
        hmr: { host }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/null.js',
            ],
            refresh:true
        }),
    ],
});
