import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export const paths = [
    'Modules/Project/resources/assets/sass/app.scss',
    'Modules/Project/resources/assets/js/app.js',
 ];
 
export default defineConfig({
    build: {
        outDir: '../../public/build-project',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-project',
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


