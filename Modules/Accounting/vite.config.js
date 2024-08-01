import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: '../../public/build-accounting',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-accounting',
            input: [
                __dirname + '/resources/assets/sass/app.scss',
                __dirname + '/resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
    // server: {
    //     watch: {
    //       usePolling: true
    //     }
    // },
});

//export const paths = [
//    'Modules/Accounting/resources/assets/sass/app.scss',
//    'Modules/Accounting/resources/assets/js/app.js',
//];
