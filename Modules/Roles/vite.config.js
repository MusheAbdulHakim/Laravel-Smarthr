import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export const paths = [
    'Modules/Roles/resources/assets/sass/app.scss',
    'Modules/Roles/resources/assets/js/app.js',
 ];

export default defineConfig({
    build: {
        outDir: '../../public/build-roles',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-roles',
            input: paths,
            refresh: true,
        }),
    ],
    // server: {
    //     watch: {
    //       usePolling: true
    //     }
    // },
});


