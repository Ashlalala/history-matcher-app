<template>
  <form @submit.prevent="postFile">
    <input type="file" @change="onFileChange"/>  
    <div v-if="isFileChange && !file">Proccessing your File...</div>
    <button v-if="file" type="submit" >postFile</button>
  </form>
  <div class="bg-gray-500 m-20 p-4 rounded-md">
    {{ form.videos?.splice(0,1000) }}
  </div>
</template>

<script setup>
import { useUserStore } from '~/store/userStore';
const userStore = useUserStore();


const file = ref(null);
const form = ref({
  videos: [],
});

const isFileChange = ref(false);


function onFileChange(e){
  isFileChange.value = true;
  var reader = new FileReader();
  reader.onload = onReaderLoad;
  reader.readAsText(event.target.files[0]);

  file.value = e.target.files[0];
}


function onReaderLoad(event){
  if (JSON.parse(event.target.result)[0]?.header != 'YouTube') return console.log('Wrong file');
  console.log('passed testyyuyu')
  form.value.videos = JSON.parse(event.target.result).splice(0,7777);
  console.log(form.value);
  
  // if (form.value.videos.length > 7777) form.value.videos = form.value.videos.splice(0,7777);
}



const postFile = async () => {
  if (!userStore.user) return;

  try {
    const { $api } = useNuxtApp(); // Get the Axios instance from the Nuxt app

    // Send the file to the API
    const response = await $api.post(`/user/${userStore.user.id}/history`, form.value);

    console.log('File uploaded successfully', response.data);
  } catch (error) {
    console.error('File upload failed', error);
  }

}
</script>

<style>

</style>