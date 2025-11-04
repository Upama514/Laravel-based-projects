<template>
  <q-layout view="lHh Lpr lFf" class="bg-blue-grey-1">
    <!-- Header with Hamburger Menu -->
    <q-header elevated class="bg-blue-8 text-white">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
          class="q-mr-sm"
        />
        <q-toolbar-title class="text-weight-bold">
          <q-icon name="menu_book" class="q-mr-sm" />
          Book Club Portal
        </q-toolbar-title>
        <div v-if="isLoggedIn" class="row items-center">
          <q-icon name="person" class="q-mr-xs" />
          <span class="q-mr-md">{{ userName }}</span>
          <q-btn flat icon="logout" @click="logout" />
        </div>
      </q-toolbar>
    </q-header>

    <!-- Sidebar Drawer -->
    <q-drawer
      v-model="leftDrawerOpen"
      bordered
      :width="250"
      class="bg-blue-grey-2"
    >
      <q-list padding class="text-blue-grey-9">
        <q-item-label header class="text-blue-grey-8 text-weight-bold">
          Navigation
        </q-item-label>

        <q-item clickable v-ripple to="/" exact class="q-mb-sm">
          <q-item-section avatar>
            <q-icon name="home" color="blue-7" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Home</q-item-label>
          </q-item-section>
        </q-item>

        <q-item clickable v-ripple to="/about" class="q-mb-sm">
          <q-item-section avatar>
            <q-icon name="info" color="blue-7" />
          </q-item-section>
          <q-item-section>
            <q-item-label>About</q-item-label>
          </q-item-section>
        </q-item>

        <template v-if="!isLoggedIn">
          <q-item clickable v-ripple to="/login" class="q-mb-sm">
            <q-item-section avatar>
              <q-icon name="login" color="blue-7" />
            </q-item-section>
            <q-item-section>
              <q-item-label>Login</q-item-label>
            </q-item-section>
          </q-item>

          <q-item clickable v-ripple to="/register" class="q-mb-sm">
            <q-item-section avatar>
              <q-icon name="person_add" color="blue-7" />
            </q-item-section>
            <q-item-section>
              <q-item-label>Register</q-item-label>
            </q-item-section>
          </q-item>
        </template>

        <template v-else>
          <q-item clickable v-ripple to="/dashboard" v-if="userRole !== 'admin'" class="q-mb-sm">
            <q-item-section avatar>
              <q-icon name="dashboard" color="blue-7" />
            </q-item-section>
            <q-item-section>
              <q-item-label>My Books</q-item-label>
            </q-item-section>
          </q-item>

          <q-item clickable v-ripple to="/admin" v-if="userRole === 'admin'" class="q-mb-sm">
            <q-item-section avatar>
              <q-icon name="admin_panel_settings" color="blue-7" />
            </q-item-section>
            <q-item-section>
              <q-item-label>Admin Panel</q-item-label>
            </q-item-section>
          </q-item>
        </template>
      </q-list>
    </q-drawer>

    <!-- Page Content -->
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import { api } from 'boot/axios'

const router = useRouter()
const leftDrawerOpen = ref(false)
const userName = ref('')
const userRole = ref('')

const isLoggedIn = computed(() => {
  return !!localStorage.getItem('auth_token')
})

onMounted(() => {
  checkAuth()
})

function checkAuth() {
  const token = localStorage.getItem('auth_token')
  if (token) {
    userName.value = localStorage.getItem('user_name') || 'User'
    userRole.value = localStorage.getItem('user_role') || 'user'
  }
}

async function logout() {
  const token = localStorage.getItem('auth_token')
  
  if (token) {
    try {
      await api.post('/logout')
    } catch (error) {
      console.log(error)
      console.log('Logout completed')
    }
  }

  localStorage.clear()
  router.push('/')
  
  setTimeout(() => {
    window.location.reload()
  }, 100)
}
</script>