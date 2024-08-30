export default defineNuxtConfig({
  runtimeConfig: {
    public: {
      apiBaseURL: process.env.API_BASE_URL || 'http://localhost:8000/api',
    },
  },
  modules: [
    "@nuxtjs/tailwindcss",
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
  ],
})