import { defineStore } from 'pinia'
import type { InterfaceUser } from '@/model/InterfaceUser'

export const authStore = defineStore('auth', {
  state: () => ({
    user: null as InterfaceUser | null,
  }),
  actions: {
    setUser(user: InterfaceUser | null) {
      localStorage.setItem('user', JSON.stringify(user))
      this.user = user
    },
    logout() {
      this.user = null
    },
    chekAuth() {
      return !!this.user
    },
  },
})
