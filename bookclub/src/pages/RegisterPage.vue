<template>
  <q-page class="flex flex-center bg-grey-2">
    <q-card class="q-pa-lg shadow-10" style="width: 100%; max-width: 400px;">
      <q-card-section class="text-center">
        <q-avatar size="80px" font-size="52px" color="primary" text-color="white" class="q-mb-md">
          📖
        </q-avatar>
        <div class="text-h4 text-weight-bold text-primary q-mb-xs">Join Book Club</div>
        <div class="text-subtitle1 text-grey-7">Create your account to start sharing books</div>
      </q-card-section>

      <q-card-section>
        <q-form @submit="registerUser" class="q-gutter-md">
          <q-input
            v-model="name"
            label="Full Name"
            filled
            lazy-rules
            :rules="[val => !!val || 'Name is required']"
          />
          
          <q-input
            v-model="email"
            label="Email"
            type="email"
            filled
            lazy-rules
            :rules="[val => !!val || 'Email is required']"
          />

          <q-input
            v-model="password"
            label="Password"
            type="password"
            filled
            lazy-rules
            :rules="[val => val && val.length >= 6 || 'Password must be at least 6 characters']"
          />

          <q-input
            v-model="passwordConfirmation"
            label="Confirm Password"
            type="password"
            filled
            lazy-rules
            :rules="[val => val === password || 'Passwords do not match']"
          />

          <q-btn 
            label="Create Account" 
            type="submit" 
            color="primary" 
            class="full-width q-mt-lg"
            size="lg"
            :loading="loading"
          />
        </q-form>

        <div class="text-center q-mt-md">
          <span class="text-grey-7">Already have an account? </span>
          <q-btn 
            flat 
            label="Sign In" 
            color="primary" 
            to="/login" 
            no-caps
          />
        </div>
      </q-card-section>
    </q-card>

    <!-- Success Dialog -->
    <q-dialog v-model="showSuccess" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="check_circle" color="positive" text-color="white" />
          <span class="q-ml-sm">Registration successful! Redirecting to login...</span>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { api } from 'boot/axios'

const router = useRouter()

// Reactive data
const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')
const loading = ref(false)
const showSuccess = ref(false)

// Register function
async function registerUser() {
  try {
    loading.value = true
    
    await api.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value
    })

    // Show success message
    showSuccess.value = true

    // Redirect to login after delay
    setTimeout(() => {
      router.push('/login')
    }, 2000)

  } catch (error) {
    console.error('Registration error:', error)
    
    let errorMessage = 'Registration failed!'
    if (error.response?.data?.errors) {
      // Handle validation errors
      const errors = error.response.data.errors
      errorMessage = Object.values(errors).flat().join(', ')
    } else if (error.response?.data?.message) {
      errorMessage = error.response.data.message
    }
    
    alert(errorMessage)
  } finally {
    loading.value = false
  }
}
</script>