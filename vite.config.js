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
                'resources/scss/app.scss',
                'resources/css/app.css',
                'resources/js/null.js',
                'resources/js/kelas.js',
                'resources/js/user.js',
                'resources/js/artikel.js',
                'resources/js/event.js',
                'resources/js/app.js',
            ],
            refresh:true
        }),
    ],
});
