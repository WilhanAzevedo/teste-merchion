<script setup lang="ts">
import { ref, reactive } from 'vue'
import { authStore } from '@/stores/auth'
import type { InterfaceUser } from '@/model/InterfaceUser'
import type { Ref } from 'vue'
import router from '@/router'

const sAuthStore = authStore()

const logout = () => {
  sAuthStore.setUser(null)
  sessionStorage.setItem('logged', 'false')
  router.push({ name: 'login' })
}

const user: Ref<InterfaceUser | null> = ref(sAuthStore.user)
</script>
<template>
  <v-container class="fill-height d-flex align-center justify-center">
    <v-card class="text-center py-8 px-6" elevation="3" max-width="500">
      <v-card-title class="text-h4 text-success font-weight-bold">
        🎉 Parabéns! {{ user?.nome }} 🎉
      </v-card-title>
      <v-card-text class="my-4">
        <p>Voce ja esta logado!</p>
      </v-card-text>
      <v-card-actions class="justify-center">
        <v-btn color="success" dark variant="elevated" @click="logout()"> Deslogar </v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>
<style scoped>
.fill-height {
  min-height: 100vh;
}

.success-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f9f9f9;
  font-family: Arial, sans-serif;
}

.message-container {
  text-align: center;
  background-color: #ffffff;
  padding: 20px 40px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 2.5rem;
  color: #4caf50;
  margin-bottom: 10px;
}

p {
  font-size: 1.2rem;
  margin-bottom: 20px;
}
</style>
