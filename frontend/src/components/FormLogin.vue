<script setup lang="ts">
import { ref, reactive } from 'vue'
import api from '@/services/api'
import type { InterfaceLogin } from '@/model/InterfaceLogin'
import type { Ref } from 'vue'
import router from '@/router'
import { authStore } from '@/stores/auth'
import type { InterfaceUser } from '@/model/InterfaceUser'

const valid: Ref<boolean> = ref(false)
const sAuthStore = authStore()

const mensagemErro: Ref<string> = ref('')
const alert: Ref<boolean> = ref(false)

const loginForm: InterfaceLogin = reactive({
  email: '',
  senha: '',
})

const rules = {
  required: (value: string) => !!value || 'Campo obrigatório',
  email: (value: string) => /.+@.+\..+/.test(value) || 'Email inválido',
}

const submit = () => {
  api
    .login(loginForm)
    .then((response) => {
      sAuthStore.setUser(response as InterfaceUser)
      sessionStorage.setItem('logged', 'true')
      router.push({ name: 'home' })
    })
    .catch((error) => {
      sessionStorage.setItem('logged', 'false')
      mensagemErro.value = error.errors
      alert.value = true
    })
}
</script>

<template>
  <v-form class="mt-3" v-model="valid">
    <v-text-field
      v-model="loginForm.email"
      label="Email"
      type="email"
      :rules="[rules.required, rules.email]"
    ></v-text-field>
    <v-text-field
      v-model="loginForm.senha"
      label="Senha"
      type="password"
      :rules="[rules.required]"
    ></v-text-field>

    <v-btn class="mt-5" block :disabled="!valid" @click="submit" color="primary" variant="elevated">
      Entrar
    </v-btn>
    <v-snackbar v-model="alert" :timeout="4000" color="red" elevation="24">
      <strong>{{ mensagemErro }}</strong
      >.
    </v-snackbar>
  </v-form>
</template>

<style scoped></style>
