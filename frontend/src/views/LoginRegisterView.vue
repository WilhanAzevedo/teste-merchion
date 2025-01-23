<script setup lang="ts">
import { ref, reactive } from 'vue'
import FormLogin from '@/components/FormLogin.vue'
import FormRegister from '@/components/FormRegister.vue'

const mode = ref('login')
</script>

<template>
  <v-container class="d-flex justify-center align-center fill-height">
    <v-card class="pa-4" width="400">
      <v-card-title class="justify-center align-center d-flex flex-column">
        <div class="d-flex justify-center align-center mb-4">
          <img alt="Vue logo" class="logo" src="@/assets/icone.webp" width="125" height="125" />
        </div>

        <v-tabs v-model="mode" align-tabs="center" bg-color="primary">
          <v-tab value="login">Login</v-tab>
          <v-tab value="register">Registrar</v-tab>
        </v-tabs>
      </v-card-title>

      <v-card-text>
        <v-tabs-window v-model="mode">
          <v-tabs-window-item value="login">
            <FormLogin />
          </v-tabs-window-item>

          <v-tabs-window-item value="register">
            <FormRegister />
          </v-tabs-window-item>
        </v-tabs-window>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<style scoped>
.fill-height {
  min-height: 100vh;
}
</style>
