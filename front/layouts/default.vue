<template>

  <div>
    <nav class="flex justify-between p-2">
        <NuxtLink to="/" class="bg-green-500 p-1">Linker</NuxtLink>
        <div v-if="user">
          <div>Welcome {{user.email}}</div>
          <button @click="logout">Logout</button>
        </div>    
        <div v-else class="flex gap-2">
          <NuxtLink to="/login">Login</NuxtLink>
          <NuxtLink to="/register">Register</NuxtLink>  
        </div>
    </nav>
    <div class="mx-2 py-2">

      <slot />
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from '~/store/userStore';
const userStore = useUserStore();

const user = userStore.user;

function logout(){
  userStore.clearToken();
  userStore.clearUser();
  reloadNuxtApp({path:'/', ttl: 1000}); // ?change to something better?
}
</script>
