import { createRouter, createWebHistory } from 'vue-router'
import LoginRegisterView from '../views/LoginRegisterView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginRegisterView,
    },
    {
      path: '/success-register',
      name: 'success-register',
      component: () => import('../views/SuccessRegisterView.vue'),
    },
    {
      path: '/home',
      name: 'home',
      component: () => import('../views/LogedView.vue'),
      beforeEnter: (to, from, next) => {
        if (sessionStorage.getItem('logged') === 'true') {
          next()
        } else {
          next({ name: 'login' })
        }
      },
    },
  ],
})

export default router
