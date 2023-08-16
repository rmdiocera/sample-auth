<template>
    <form @submit.prevent="login">
        <div class="block w-full h-screen mx-auto flex justify-center items-center">
            <div>
                <div>
                    <label for="username" class="block mb-1 text-gray-600 font-medium">Username</label>
                    <input id="username" type="text" v-model="form.username" class="block w-full p-2 rounded-md shadow-md border border-gray-300 text-gray-500" />
                    <strong v-if="form.errors.username" class="block text-sm text-red-500">{{ form.errors.username }}</strong>
                </div>
                <div class="mt-4">
                    <label for="password" class="block mb-1 text-gray-600 font-medium">Password</label>
                    <input id="password" type="password" v-model="form.password" class="block w-full p-2 rounded-md shadow-md border border-gray-300 text-gray-500" />
                    <strong v-if="form.errors.password" class="block text-sm text-red-500">{{ form.errors.password }}</strong>
                </div>
                <div class="mt-4">
                    <button class="bg-cyan-600 hover:bg-cyan-500 text-white font-medium p-2 rounded-md w-full" type="submit">Login</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
const form = useForm({
    username: null,
    password: null
})

const login = () => form.post(route('login'))
</script>