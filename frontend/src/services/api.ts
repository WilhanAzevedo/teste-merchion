import type { InterfaceLogin } from '@/model/InterfaceLogin'
import type { InterfaceRegister } from '@/model/InterfaceRegister'
import axios from 'axios'

const axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
})

axiosInstance.interceptors.response.use(
  (response) => response.data,
  (error) => {
    if (error.response) {
      return Promise.reject(error.response.data)
    }
    return Promise.reject(error)
  },
)

const api = {
  register: async (data: InterfaceRegister) => axiosInstance.post('/user/register', data),

  login: async (data: InterfaceLogin) => axiosInstance.post('/user/login', data),
}

export default api
