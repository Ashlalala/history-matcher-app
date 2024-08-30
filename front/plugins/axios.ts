import axios from 'axios';
import { useUserStore } from '~/store/userStore';

export default defineNuxtPlugin((nuxtApp) => {
  const runtimeConfig = useRuntimeConfig();
  const userStore = useUserStore();

  const api = axios.create({
    baseURL: runtimeConfig.public.apiBaseURL, 
  });

  // Add a request interceptor
  api.interceptors.request.use(
    (config) => {
      const token = userStore.token;
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
      return config;
    },
    (error) => {
      return Promise.reject(error);
    }
  );

  // Add a response interceptor
  api.interceptors.response.use(
    (response) => response,
    (error) => {
      // Handle errors globally
      return Promise.reject(error);
    }
  );

  // Make Axios available globally
  nuxtApp.provide('api', api);
});


