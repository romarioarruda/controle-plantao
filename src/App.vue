<template>
  <q-layout view="lHh Lpr lFf" class="bg-white text-white">
    <q-header elevated class="bg-grey-6">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          @click="leftDrawerOpen = !leftDrawerOpen"
          aria-label="Menu"
          icon="menu"
        />

        <q-toolbar-title>
          Plantão
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      content-class="bg-grey-8"
    >
      <q-list dark>
        <q-item-label header>Menu de navegação</q-item-label>
        <q-item clickable>
          <q-item-section avatar>
            <q-icon name="dashboard" />
          </q-item-section>
          <q-item-section>
            <router-link to="/" tag="div">
              <q-item-label>Home</q-item-label>
            </router-link>
          </q-item-section>
        </q-item>
        <q-item clickable>
          <q-item-section avatar>
            <q-icon name="today" />
          </q-item-section>
          <q-item-section>
            <router-link :to="'/registro-plantao/'+data" tag="div">
              <q-item-label>Registrar Plantão</q-item-label>
            </router-link>
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: 'MyLayout',
  data () {
    return {
      leftDrawerOpen: false
    }
  },

  computed: {
    data() {
      let data = new Date()

      let mes = data.getMonth() + 1
      let dia = data.getDate()
      let ano = data.getFullYear()

      return ano + '-' + mes + '-' + dia
    }
  }
}
</script>

<style>
    .centralizado {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .largura {
        width: 30%
    }
</style>