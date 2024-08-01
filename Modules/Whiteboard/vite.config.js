import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'

export const paths = [
   'Modules/Whiteboard/resources/assets/sass/app.scss',
   'Modules/Whiteboard/resources/assets/js/app.jsx',
   'Modules/Whiteboard/resources/apps/TlDraw/css/index.css',
   'Modules/Whiteboard/resources/apps/TlDraw/main.jsx',
];

export default defineConfig({
    build: {
        outDir: '../../public/build-whiteboard',
        emptyOutDir: true,
        manifest: true,
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-whiteboard',
            input: paths,
            refresh: true,
        }),
        react()
    ],
    server: {
        watch: {
          usePolling: true
        }
    },
});

