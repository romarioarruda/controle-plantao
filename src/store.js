import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    registros: [],
    carregandoRegistros: false,
    addNewRegister: false,
    failNewRegister: false,
    mostrarLista: false
  },

  mutations: {
    getChamados(state, payload) {
      state.registros = payload
    },

    newRegister(state) {
      state.mostrarLista = false
    },

    chamadosRegistrados(state){
      state.mostrarLista = true
    }
    
  },

  actions: {
    getChamados({commit}, payload) {
      this.state.carregandoRegistros = true
      axios.get('http://localhost:8081/curso-vue/controle-plantao/api/lista-chamados/'+payload)
      .then((res) => {
        commit('getChamados', res.data)
        this.state.carregandoRegistros = false
      })
    },

    addRegistro({commit}, payload) {
      axios.post('http://localhost:8081/curso-vue/controle-plantao/api/add-chamados', {
        payload
      })
      .then((response) => {
        if (response.data == 'addFail') {
          this.state.failNewRegister = true
        } else {
          this.state.addNewRegister = true
        }
      })
    },

    updateChamado({commit}, payload) {
      axios.post('http://localhost:8081/curso-vue/controle-plantao/api/update-chamado', {
        payload
      })
    },

    deleteChamado({commit}, payload) {
      axios.post('http://localhost:8081/curso-vue/controle-plantao/api/delete-chamado', {
        payload
      })
      .then(() =>{
        this.dispatch('getChamados')
      })
    },

  },

  getters: {

  }
})
