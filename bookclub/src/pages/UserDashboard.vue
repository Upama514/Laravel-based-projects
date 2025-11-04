<template>
  <q-page class="q-pa-md bg-blue-grey-1">
    <!-- Header -->
    <div class="row items-center q-mb-lg">
      <q-avatar color="blue-8" text-color="white" class="q-mr-md shadow-2">
        {{ userName.charAt(0) }}
      </q-avatar>
      <div>
        <h4 class="text-weight-bold text-blue-grey-9 q-ma-none">Welcome, {{ userName }}</h4>
        <p class="text-blue-grey-7 q-ma-none">Manage your book collection</p>
      </div>
    </div>

    <!-- Add Book Card -->
    <q-card class="q-mb-md shadow-3">
      <q-card-section class="bg-blue-8 text-white">
        <div class="text-h6">
          <q-icon name="add_circle" class="q-mr-sm" />
          {{ isEditing ? 'Edit Book' : 'Add New Book' }}
        </div>
      </q-card-section>

      <q-card-section class="q-pa-lg">
        <q-input v-model="bookForm.title" label="Book Title *" class="q-mb-md" filled />
        <q-input v-model="bookForm.author" label="Author *" class="q-mb-md" filled />
        <q-input v-model="bookForm.description" label="Description" type="textarea" rows="2" filled />
        
        <div class="row q-gutter-sm q-mt-lg">
          <q-btn 
            :label="isEditing ? 'Update Book' : 'Add Book'" 
            :color="isEditing ? 'blue-7' : 'blue-8'" 
            @click="isEditing ? updateBook() : addBook()" 
            class="q-px-xl"
          />
          <q-btn v-if="isEditing" label="Cancel" flat color="grey" @click="cancelEdit" />
        </div>
      </q-card-section>
    </q-card>

    <!-- Books List -->
    <q-card class="shadow-3">
      <q-card-section class="bg-blue-8 text-white">
        <div class="text-h6">
          <q-icon name="menu_book" class="q-mr-sm" />
          My Books ({{ books.length }})
        </div>
      </q-card-section>

      <q-card-section class="q-pa-lg">
        <div v-if="books.length === 0" class="text-center q-pa-xl text-blue-grey-6">
          <q-icon name="menu_book" size="xl" class="q-mb-sm" />
          <div class="text-h6 q-mt-md">No books yet</div>
          <p>Add your first book to get started!</p>
        </div>

        <div v-else class="q-gutter-y-md">
          <q-card v-for="book in books" :key="book.id" class="bg-blue-grey-2">
            <q-card-section>
              <div class="row items-start justify-between">
                <div class="col">
                  <div class="text-h6 text-weight-bold text-blue-grey-9">{{ book.title }}</div>
                  <div class="text-subtitle1 text-blue-grey-7">by {{ book.author }}</div>
                  <p v-if="book.description" class="text-caption text-blue-grey-7 q-mt-sm">
                    {{ book.description }}
                  </p>

                  <!-- Comments Section -->
                  <div v-if="book.comments && book.comments.length" class="q-mt-md">
                    <div class="text-caption text-weight-medium text-blue-grey-8">Admin Comments:</div>
                    <div v-for="comment in book.comments" :key="comment.id" 
                         class="q-pa-xs q-mt-xs bg-white rounded-borders shadow-1">
                      <div class="text-caption">
                        <strong class="text-blue-8">{{ comment.user?.name }}:</strong> 
                        <span class="text-blue-grey-8">{{ comment.content }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="q-gutter-xs">
                  <q-btn icon="edit" size="sm" color="blue-7" flat @click="startEdit(book)" />
                  <q-btn icon="delete" size="sm" color="red" flat @click="deleteBook(book.id)" />
                </div>
              </div>
            </q-card-section>
          </q-card>
        </div>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { api } from 'boot/axios'

const books = ref([])
const userName = ref('')
const isEditing = ref(false)
const editingBookId = ref(null)
const bookForm = ref({ title: '', author: '', description: '' })

onMounted(() => {
  loadUserInfo()
  loadBooks()
})

async function loadUserInfo() {
  try {
    const res = await api.get('/user')
    userName.value = res.data.user.name
  } catch (error) {
    console.error('User info error:', error)
  }
}

async function loadBooks() {
  try {
    const res = await api.get('/books')
    books.value = res.data
    
    for (let book of books.value) {
      await loadComments(book.id)
    }
  } catch (error) {
    console.error('Load books error:', error)
  }
}

async function loadComments(bookId) {
  try {
    const response = await api.get(`/books/${bookId}/comments`)
    const book = books.value.find(b => b.id === bookId)
    if (book) book.comments = response.data
  } catch (error) {
    console.error('Failed to load comments:', error)
  }
}

async function addBook() {
  if (!bookForm.value.title || !bookForm.value.author) {
    alert('Please fill title and author')
    return
  }
  
  try {
    await api.post('/books', bookForm.value)
    resetForm()
    loadBooks()
  } catch (error) {
    console.error('Add book error:', error)
  }
}

function startEdit(book) {
  isEditing.value = true
  editingBookId.value = book.id
  bookForm.value = { 
    title: book.title, 
    author: book.author, 
    description: book.description || '' 
  }
}

async function updateBook() {
  if (!bookForm.value.title || !bookForm.value.author) {
    alert('Please fill title and author')
    return
  }
  
  try {
    await api.put(`/books/${editingBookId.value}`, bookForm.value)
    resetForm()
    loadBooks()
  } catch (error) {
    console.error('Update book error:', error)
  }
}

function cancelEdit() {
  resetForm()
}

function resetForm() {
  isEditing.value = false
  editingBookId.value = null
  bookForm.value = { title: '', author: '', description: '' }
}

async function deleteBook(bookId) {
  if (!confirm('Delete this book?')) return
  try {
    await api.delete(`/books/${bookId}`)
    loadBooks()
  } catch (error) {
    console.error('Delete book error:', error)
  }
}
</script>