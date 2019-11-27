import Vue from 'vue'
import Router from 'vue-router'
import registroPlantao from './components/registroPlantao'

Vue.use(Router)

export default new Router({
  // mode: 'history',
  routes: [
    {
      path: '/registro-plantao/:data',
      component: registroPlantao,
      props: true
    }
  ]
})
