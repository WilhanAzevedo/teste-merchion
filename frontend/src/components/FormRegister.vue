<script setup lang="ts">
import type { InterfaceRegister } from '@/model/InterfaceRegister'
import { ref, reactive } from 'vue'
import type { Ref } from 'vue'
import api from '@/services/api'
import router from '@/router'

const valid: Ref<boolean> = ref(false)

const registerForm: InterfaceRegister = reactive({
  nome: '',
  email: '',
  senha: '',
})

const confirmPassword: Ref<string> = ref('')
const mensagemErro: Ref<string> = ref('')
const alert: Ref<boolean> = ref(false)

const rules = {
  required: (value: string) => !!value || 'Campo obrigatório',
  email: (value: string) => /.+@.+\..+/.test(value) || 'Email inválido',
  matchPassword: (value: string) => value === registerForm.senha || 'As senhas não coincidem',
  minLength: (value: string) => value.length >= 3 || 'A senha deve ter no mínimo 3 caracteres',
}

const submit = () => {
  api
    .register(registerForm)
    .then((response) => {
      router.push({ name: 'success-register' })
    })
    .catch((error) => {
      mensagemErro.value = error.errors
      alert.value = true
    })
}
</script>

<template>
  <v-form class="mt-3" v-model="valid">
    <v-text-field
      v-model="registerForm.nome"
      label="Nome"
      :rules="[rules.required, rules.minLength]"
    ></v-text-field>
    <v-text-field
      v-model="registerForm.email"
      label="Email"
      type="email"
      :rules="[rules.required, rules.email]"
    ></v-text-field>
    <v-text-field
      v-model="registerForm.senha"
      label="Senha"
      type="password"
      :rules="[rules.required]"
    ></v-text-field>
    <v-text-field
      v-model="confirmPassword"
      label="Confirme a senha"
      type="password"
      :rules="[rules.required, rules.matchPassword]"
    ></v-text-field>
    <v-btn class="mt-5" block :disabled="!valid" @click="submit" color="primary" variant="elevated">
      Registrar
    </v-btn>
    <v-snackbar v-model="alert" :timeout="4000" color="red" elevation="24">
      <strong>{{ mensagemErro }}</strong
      >.
    </v-snackbar>
  </v-form>
</template>

<style scoped></style>
