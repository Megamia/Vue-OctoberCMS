<template>
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img
        class="mx-auto h-10 w-auto"
        src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      />
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
        Sign in to your account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST" @submit.prevent="handleLogin">
        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900 text-left"
            >Email address</label
          >
          <div class="mt-2">
            <input
              v-model="dataForm.email"
              type="email"
              name="email"
              id="email"
              autocomplete="email"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900"
              >Password</label
            >
            <div class="text-sm">
              <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500"
                >Forgot password?</a
              >
            </div>
          </div>
          <div class="mt-2">
            <input
              v-model="dataForm.password"
              type="password"
              name="password"
              id="password"
              autocomplete="current-password"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
            />
          </div>
        </div>

        <div class="flex gap-[10px]">
          <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Sign in
          </button>
          <button
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            <RouterLink to="TestPage"> Return Home page </RouterLink>
          </button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm/6 text-gray-500 cursor-pointer" @click="test">
        Not a member?
        {{ " " }}
        <a href="/Register" class="font-semibold text-indigo-600 hover:text-indigo-500"
          >Register an account</a
        >
      </p>
    </div>
  </div>
</template>
<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const dataForm = ref({
  email: "",
  password: "",
});
const handleLogin = async () => {
  try {
    const response = await axios.post(
      "http://127.0.0.1:8000/api/login",
      {
        email: dataForm.value.email,
        password: dataForm.value.password,
      },
      {
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
    if (response.data.status === 1) {
      router.push("/TestPage");
      return;
    } else {
      console.error("Login failed: ", response.message);
      return;
    }
  } catch (e) {
    console.error("Error: ", e);
  }
};

const test = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/api/data");
    console.log("Data fetched:", response.data);
  } catch (error) {
    console.error("Failed to fetch data:", error.response.data);
  }
};
</script>
