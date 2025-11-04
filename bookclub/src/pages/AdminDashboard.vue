<template>
  <q-page class="q-pa-md">
    <div class="row justify-between items-center">
      <h4>Admin Dashboard</h4>
      <q-btn label="Logout" color="negative" @click="logout" />
    </div>

    <!-- Stats -->
    <q-card class="q-mt-md">
      <q-card-section>
        <div class="row q-col-gutter-md">
          <div class="col-4 text-center">
            <div class="text-h6 text-primary">{{ stats.total_users || 0 }}</div>
            <div class="text-caption">Total Users</div>
          </div>
          <div class="col-4 text-center">
            <div class="text-h6 text-green">{{ stats.total_books || 0 }}</div>
            <div class="text-caption">Total Books</div>
          </div>
          <div class="col-4 text-center">
            <div class="text-h6 text-orange">{{ stats.total_comments || 0 }}</div>
            <div class="text-caption">Total Comments</div>
          </div>
        </div>
      </q-card-section>
    </q-card>

    <!-- Users List with Books -->
    <q-card class="q-mt-md">
      <q-card-section>
        <div class="text-h6">Registered Users & Their Books</div>
        
        <div v-if="users.length === 0" class="text-center q-pa-lg text-grey-6">
          No registered users found
        </div>
        
        <div v-else class="q-gutter-y-md">
          <div v-for="user in users" :key="user.id" class="user-section">
            <!-- User Info -->
            <div class="row items-center q-mb-sm">
              <q-avatar color="primary" text-color="white" class="q-mr-sm">
                {{ user.name.charAt(0) }}
              </q-avatar>
              <div>
                <div class="text-weight-bold">{{ user.name }}</div>
                <div class="text-caption text-grey-7">
                  {{ user.email }} • {{ user.role }} • 
                  {{ user.books ? user.books.length : 0 }} books
                </div>
              </div>
            </div>

            <!-- User's Books -->
            <div v-if="user.books && user.books.length" class="q-ml-xl">
              <div v-for="book in user.books" :key="book.id" class="book-item q-mb-md">
                <q-card flat bordered>
                  <q-card-section class="q-pa-sm">
                    <div class="row items-center justify-between">
                      <div class="col">
                        <div class="text-weight-medium">📖 {{ book.title }}</div>
                        <div class="text-caption text-grey-7">
                          by {{ book.author }}
                          <span v-if="book.description"> • {{ book.description }}</span>
                        </div>
                        <div class="text-caption text-grey-5">
                          Added: {{ formatDate(book.created_at) }}
                        </div>
                      </div>
                      <q-btn 
                        icon="delete" 
                        size="sm" 
                        color="negative" 
                        flat 
                        @click="deleteBook(book.id)"
                        title="Delete this book"
                      />
                    </div>

                    <!-- Comments Section -->
                    <div class="q-mt-sm">
                      <div class="text-caption text-weight-medium">Comments:</div>
                      
                      <!-- Existing Comments -->
                      <div v-if="book.comments && book.comments.length" class="q-mt-xs">
                        <div v-for="comment in book.comments" :key="comment.id" 
                             class="comment-item q-pa-xs q-mb-xs rounded-borders bg-blue-1">
                          <div class="text-caption">
                            <strong>{{ comment.user?.name }}:</strong> {{ comment.content }}
                          </div>
                          <div class="text-caption text-grey-6">
                            {{ formatDate(comment.created_at) }}
                            <q-btn 
                              icon="delete" 
                              size="xs" 
                              color="negative" 
                              flat 
                              @click="deleteComment(comment.id)"
                              class="q-ml-xs"
                            />
                          </div>
                        </div>
                      </div>
                      <div v-else class="text-grey-6 text-caption">
                        No comments yet
                      </div>

                      <!-- Add Comment Form -->
                      <div class="row items-center q-mt-sm q-gutter-xs">
                        <q-input
                          v-model="commentText[book.id]"
                          placeholder="Add a comment..."
                          dense
                          class="col-grow"
                          @keyup.enter="addComment(book.id)"
                        />
                        <q-btn 
                          icon="add_comment" 
                          size="sm" 
                          color="primary" 
                          flat 
                          @click="addComment(book.id)"
                        />
                      </div>
                    </div>
                  </q-card-section>
                </q-card>
              </div>
            </div>
            
            <div v-else class="q-ml-xl text-grey-6 text-caption">
              No books added yet
            </div>
          </div>
        </div>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { api } from 'boot/axios'

const router = useRouter()
const users = ref([])
const stats = ref({})
const commentText = ref({})

onMounted(() => {
  loadAdminData()
})

async function loadAdminData() {
  try {
    const res = await api.get('/admin/dashboard')
    users.value = res.data.users
    stats.value = res.data.stats
    
    // Load comments for each book
    for (let user of users.value) {
      if (user.books) {
        for (let book of user.books) {
          await loadComments(book.id)
        }
      }
    }
  } catch (error) {
    console.error('Admin dashboard error:', error)
    alert('Failed to load admin data.')
  }
}

async function loadComments(bookId) {
  try {
    const response = await api.get(`/books/${bookId}/comments`)
    // Find the book and update comments
    users.value.forEach(user => {
      if (user.books) {
        user.books.forEach(book => {
          if (book.id === bookId) {
            book.comments = response.data
          }
        })
      }
    })
  } catch (error) {
    console.error('Failed to load comments:', error)
  }
}

async function addComment(bookId) {
  const content = commentText.value[bookId]
  if (!content || content.trim() === '') {
    alert('Please enter a comment')
    return
  }

  try {
    await api.post(`/books/${bookId}/comments`, {
      content: content.trim()
    })
    
    // Clear comment input
    commentText.value[bookId] = ''
    
    // Reload comments
    await loadComments(bookId)
    alert('Comment added successfully!')
  } catch (error) {
    console.error('Failed to add comment:', error)
    alert('Failed to add comment.')
  }
}

async function deleteComment(commentId) {
  if (!confirm('Are you sure you want to delete this comment?')) return

  try {
    await api.delete(`/comments/${commentId}`)
    
    // Reload all data to refresh comments
    await loadAdminData()
    alert('Comment deleted successfully!')
  } catch (error) {
    console.error('Failed to delete comment:', error)
    alert('Failed to delete comment.')
  }
}

async function deleteBook(bookId) {
  if (!confirm('Are you sure you want to delete this book?')) return
  
  try {
    await api.delete(`/admin/books/${bookId}`)
    await loadAdminData()
    alert('Book deleted successfully!')
  } catch (error) {
    console.error('Delete book error:', error)
    alert('Failed to delete book.')
  }
}

function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString()
}

async function logout() {
  const token = localStorage.getItem('auth_token')
  
  if (token) {
    try {
      await api.post('/logout')
    } catch (error) {
      console.log(error)
    }
  }
  
  localStorage.removeItem('auth_token')
  localStorage.removeItem('user_name') 
  localStorage.removeItem('user_role')
  
  router.push('/login')
  
  setTimeout(() => {
    window.location.reload()
  }, 100)
}
</script>

<style scoped>
.user-section {
  border-bottom: 1px solid #e0e0e0;
  padding-bottom: 16px;
}
.user-section:last-child {
  border-bottom: none;
}
.book-item {
  border-bottom: 1px solid #f0f0f0;
}
.book-item:last-child {
  border-bottom: none;
}
.comment-item {
  border-left: 3px solid #2196f3;
}
</style>