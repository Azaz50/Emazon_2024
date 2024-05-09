import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  server: {
    proxy: {
      '^/admin/login$': {
        target: "http://127.0.0.1:8000",
        changeOrigin: true,
      },
      '^/admin/logout$': {
        target: "http://127.0.0.1:8000",
        changeOrigin: true,
      },
      '^/api': {
        target: "http://127.0.0.1:8000",
        changeOrigin: true,
      },
      '^/sanctum/csrf-cookie': {
        target: "http://127.0.0.1:8000",
        changeOrigin: true,
      },
    }
  }
})
