import axios from "axios"
import router from "../router"

let accessToken = JSON.parse(localStorage.getItem("pulses_dadosUsuario"))
  ? JSON.parse(localStorage.getItem("pulses_dadosUsuario")).accessToken
  : null

const api = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    Authorization: `bearer ${accessToken}`,
  },
})
api.interceptors.response.use(
  function (response) {
    return response
  },
  function (error) {
    if (error.status === 307) {
      window.location.href = error.data
    }
    if (error.response.data.status === 401) {
      router.push('/login')
    }
    return Promise.reject(error)
  }
)

export default api
