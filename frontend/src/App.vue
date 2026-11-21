<script setup>
import Navbarcomponent from '@/components/navbarcomponent.vue';
import { RouterView } from 'vue-router';

</script>
<template>
    <div class="main d-flex min-vh-100 bg-light">

        <!-- Sidebar -->
        <Navbarcomponent />

        <!-- Konten Utama -->
        <main class="flex-grow-1 p-4">
            <RouterView></RouterView>
        </main>

    </div>
</template>