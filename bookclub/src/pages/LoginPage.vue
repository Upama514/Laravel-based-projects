<template>
  <q-page class="flex flex-center bg-blue-grey-1">
    <div class="full-width" style="max-width: 400px;">
      <q-card class="shadow-5">
        <!-- Header -->
        <q-card-section class="bg-blue-8 text-white text-center q-pb-lg">
          <q-avatar size="80px" font-size="50px" color="white" text-color="blue-8" class="q-mb-sm">
            📚
          </q-avatar>
          <div class="text-h5 text-weight-bold">Welcome Back</div>
          <div class="text-caption">Sign in to your account</div>
        </q-card-section>

        <!-- Login Form -->
        <q-card-section class="q-px-lg q-pt-lg q-pb-none">
          <q-form @submit="loginUser" class="q-gutter-md">
            <q-input
              v-model="email"
              label="Email Address"
              type="email"
              filled
              class="q-mb-sm"
              :rules="[val => !!val || 'Email is required']"
            />
            
            <q-input
              v-model="password"
              label="Password"
              type="password"
              filled
              class="q-mb-sm"
              :rules="[val => !!val || 'Password is required']"
            />

            <q-btn 
              label="Sign In" 
              type="submit" 
              color="blue-8" 
              class="full-width q-mt-lg"
              size="lg"
              :loading="loading"
            />
          </q-form>
        </q-card-section>

        <!-- Footer Links -->
        <q-card-section class="text-center q-pt-none q-pb-lg">
          <div class="text-caption text-blue-grey-7 q-mb-sm">
            Don't have an account? 
            <q-btn flat label="Sign Up" color="blue-7" to="/register" class="q-px-xs" />
          </div>
        </q-card-section>
      </q-card>
    </div>
  </q-page>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { api } from 'boot/axios'

const router = useRouter()
const email = ref('')
const password = ref('')
const loading = ref(false)

async function loginUser() {
  try {
    loading.value = true
    
    const response = await api.post('/login', {
      email: email.value,
      password: password.value
    })

    localStorage.setItem('auth_token', response.data.token)
    localStorage.setItem('user_name', response.data.user.name)
    localStorage.setItem('user_email', response.data.user.email)
    localStorage.setItem('user_role', response.data.user.role)

    if (response.data.user.role === 'admin') {
      router.push('/admin')
    } else {
      router.push('/dashboard')
    }

  } catch (error) {
    let errorMessage = 'Login failed!'
    if (error.response?.data?.message) {
      errorMessage = error.response.data.message
    }
    alert(errorMessage)
  } finally {
    loading.value = false
  }
}
</script>