<template>
  <q-page class="flex flex-center column q-pa-md bg-blue-grey-1 min-height: 100vh">
    <div class="text-center q-mb-xl">
      <q-avatar size="120px" font-size="80px" color="blue-8" text-color="white" class="q-mb-md shadow-4">
        📚
      </q-avatar>
      <h1 class="text-h3 text-weight-bold text-blue-grey-9 q-mb-sm">Book Club Portal</h1>
      <p class="text-h6 text-blue-grey-7">Discover, Share, and Discuss Your Favorite Books</p>
    </div>

    <div class="row q-col-gutter-lg justify-center" style="max-width: 900px;">
      <!-- Feature 1 -->
      <div class="col-12 col-md-4">
        <q-card class="text-center bg-white shadow-3">
          <q-card-section class="q-pa-lg">
            <q-icon name="library_books" size="xl" color="blue-7" class="q-mb-md" />
            <div class="text-h6 text-weight-bold text-blue-grey-9">Manage Books</div>
            <p class="text-caption text-blue-grey-7">Create and organize your personal book collection</p>
          </q-card-section>
        </q-card>
      </div>

      <!-- Feature 2 -->
      <div class="col-12 col-md-4">
        <q-card class="text-center bg-white shadow-3">
          <q-card-section class="q-pa-lg">
            <q-icon name="group" size="xl" color="blue-7" class="q-mb-md" />
            <div class="text-h6 text-weight-bold text-blue-grey-9">Community</div>
            <p class="text-caption text-blue-grey-7">Connect with fellow book enthusiasts</p>
          </q-card-section>
        </q-card>
      </div>

      <!-- Feature 3 -->
      <div class="col-12 col-md-4">
        <q-card class="text-center bg-white shadow-3">
          <q-card-section class="q-pa-lg">
            <q-icon name="chat" size="xl" color="blue-7" class="q-mb-md" />
            <div class="text-h6 text-weight-bold text-blue-grey-9">Feedback</div>
            <p class="text-caption text-blue-grey-7">Receive comments and insights on your collection</p>
          </q-card-section>
        </q-card>
      </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center q-mt-xl">
      <q-btn 
        v-if="!isLoggedIn"
        label="Get Started - Join Now" 
        color="blue-8" 
        size="lg" 
        to="/register"
        class="q-px-xl q-py-sm shadow-2"
        icon-right="arrow_forward"
      />
      <q-btn 
        v-else
        :label="userRole === 'admin' ? 'Go to Admin Panel' : 'Go to My Books'" 
        color="blue-8" 
        size="lg" 
        :to="userRole === 'admin' ? '/admin' : '/dashboard'"
        class="q-px-xl q-py-sm shadow-2"
        icon-right="dashboard"
      />
    </div>
  </q-page>
</template>

<script setup>
import { computed } from 'vue'

const isLoggedIn = computed(() => {
  return !!localStorage.getItem('auth_token')
})

const userRole = computed(() => {
  return localStorage.getItem('user_role') || 'user'
})
</script>

<style scoped>
.min-height {
  min-height: 80vh;
}
</style>