import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'


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
            input: [
                __dirname + '/resources/assets/sass/app.scss',
                __dirname + '/resources/assets/js/app.jsx'
            ],
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

export const paths = [
   'Modules/Whiteboard/resources/assets/sass/app.scss',
   'Modules/Whiteboard/resources/assets/js/app.jsx',
   'Modules/Whiteboard/resources/apps/TlDraw/main.tsx',
];
