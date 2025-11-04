import { route } from 'quasar/wrappers'
import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes'

export default route(function (/* { store, ssrContext } */) {
  const Router = createRouter({
    scrollBehavior: () => ({ left: 0, top: 0 }),
    routes,
    history: createWebHistory(process.env.VUE_ROUTER_BASE),
  })

  // Navigation Guards
  Router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('auth_token')
    const userRole = localStorage.getItem('user_role')
    
    // Check if route requires authentication
    if (to.meta.requiresAuth && !isAuthenticated) {
      next('/login')
      return
    }

    // Check if route should be hidden when authenticated (like login/register)
    if (to.meta.hideWhenAuth && isAuthenticated) {
      // Redirect to appropriate dashboard
      if (userRole === 'admin') {
        next('/admin')
      } else {
        next('/dashboard')
      }
      return
    }

    // Check admin routes
    if (to.meta.requiresAdmin && userRole !== 'admin') {
      alert('Access denied! Admin privileges required.')
      next('/dashboard')
      return
    }

    next()
  })

  return Router
})