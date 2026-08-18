import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/sass/app.scss"], // Use 'css' if 'sass' is missing
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
        manifest: true,
    },
});
