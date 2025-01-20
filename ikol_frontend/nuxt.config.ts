// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  devServer: {
    port: 3001
  },
  
  // CSS configuration
  css: ['~/assets/css/main.css'],
  
  // PostCSS and Tailwind configuration
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },

  // Modules configuration
  modules: [
    '@nuxtjs/tailwindcss',
  ],

  // Runtime config for API
  runtimeConfig: {
    public: {
      apiBase: 'http://127.0.0.1:8000/api'
    }
  },

  // App configuration
  app: {
    head: {
      title: 'Distance Calculator',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: 'Distance Calculator Application' }
      ]
    }
  }
})