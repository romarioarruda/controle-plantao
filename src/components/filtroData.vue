<template>
  <div class="q-pa-md" style="max-width: 500px">
    <q-btn color="purple" icon="search" class="btnFiltro" @click="doSearch()"/>
    <q-input filled class="cursor-pointer" v-model="date" label="Filtre por data">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date mask="YYYY-MM-DD" v-model="date" @input="() => $refs.qDateProxy.hide()"/>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
  </div>
</template>

<script>
export default {
  data () {
    return {
      date: ''
    }
  },

  methods: {
    doSearch() {
      if (this.date.length) {
        this.$router.push('/registro-plantao/'+this.date)
        this.$store.dispatch('getChamados', this.date)
      }
      
    }
  }
}
</script>

<style scoped>
  .btnFiltro {
    float: right;
    top: 0px;
    left: 3px;
    width: 60px;
    height: 55px;
  }
</style>