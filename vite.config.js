import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import collectModuleAssetsPaths from "./vite-module-loader.js";

async function getConfig() {
    const paths = [
        "resources/css/app.scss",
        "resources/assets/scss/main.scss",
        "resources/js/app.js",
        "resources/js/datatables.js",
        "resources/js/ckeditor.js",
    ];
    const allPaths = await collectModuleAssetsPaths(paths, "Modules");

    return defineConfig({
        plugins: [
            laravel({
                input: allPaths,
                refresh: true,
            }),
        ],
        define: {
            "process.env.IS_PREACT": JSON.stringify("true"),
        },
        optimizeDeps: {
            exclude: ["js-big-decimal"],
        },
        assetsInlineLimit: 0
    });
}

export default getConfig();
