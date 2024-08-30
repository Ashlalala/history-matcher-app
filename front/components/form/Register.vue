<template>
  <div class="flex min-h-screen items-center justify-center bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center text-gray-900">Register account</h2>
      <form @submit.prevent="register" class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="form.name" type="text" id="name" required class="w-full mt-1 px-3 py-2 border 
          border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="form.email" type="email" id="email" required class="w-full mt-1 px-3 py-2 border 
          border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input v-model="form.password" type="password" id="password" required class="w-full mt-1 px-3 py-2 border 
          border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md
          shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none 
          ocus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from '~/store/userStore';
const userStore = useUserStore();

const router = useRouter();

const form = ref({
  name: '', //change to username (implement backend)
  email: '',
  password: '',
})


const register = async () => {
  try {
    const { $api } = useNuxtApp();
    const { data } = await $api.post('/auth/register', form.value);
    console.log(data);
    
    userStore.setToken(data.token);
    userStore.setUser(data.user);
    
    router.push('/');
    reloadNuxtApp()
  } catch (error) {
    console.error('Login failed', error);
  }
};
</script>
