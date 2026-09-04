<template>
  <div style="text-align:center;padding:50px;font-family:Arial">
    <h1>🚀 Vue.js + Laravel</h1>
    
    <div style="background:#f0f0f0;padding:20px;border-radius:10px;margin:20px 0">
      <h3>Статус API:</h3>
      <p v-if="loading">Загрузка...</p>
      <p v-else-if="apiData" style="color:green">
        ✅ {{ apiData.message }}
        <br>
        <small>Время: {{ apiData.time }}</small>
      </p>
      <p v-else style="color:red">❌ Ошибка подключения к API</p>
    </div>

    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
      <button @click="fetchApi">🔄 Проверить API</button>
      <button @click="fetchUsers">👥 Получить пользователей</button>
    </div>

    <div v-if="users.length > 0" style="margin-top:20px;text-align:left">
      <h4>Пользователи:</h4>
      <ul>
        <li v-for="user in users" :key="user.id">
          {{ user.id }} - {{ user.name }}
        </li>
      </ul>
    </div>

    <div style="margin-top:20px">
      <button @click="count++">Нажато: {{ count }}</button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const count = ref(0)
const loading = ref(false)
const apiData = ref(null)
const users = ref([])

// Функция для запроса к API
const fetchApi = async () => {
  loading.value = true
  try {
    const response = await fetch('http://localhost/api/test')
    const data = await response.json()
    apiData.value = data
  } catch (error) {
    console.error('Ошибка:', error)
    apiData.value = null
  } finally {
    loading.value = false
  }
}

const fetchUsers = async () => {
  try {
    const response = await fetch('http://localhost/api/users')
    users.value = await response.json()
  } catch (error) {
    console.error('Ошибка:', error)
  }
}

// Загружаем данные при старте
onMounted(() => {
  fetchApi()
})
</script>