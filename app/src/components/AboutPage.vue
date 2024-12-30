<template>
  <div>
    <router-link to="/HelloWorld">HelloWorld</router-link>
    <span v-for="(item, index) in a" :key="index" class="flex flex-col">
      {{ item.name }}</span
    >
  </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const a = ref("");
const fetchData = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/vehicle");
    a.value = response.data;
    // console.log(response);
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

onMounted(() => {
  fetchData();
});
</script>

<style scoped></style>
