<template>
    <div>
      <template v-if="this.$store.state.carregandoRegistros">
        <q-spinner-cube
          color="orange"
          size="5.5em"
          class="centralizado"
        />
      </template>
      
      <template v-else>
        <template>
          <div class="filterInput">
            <filtroData />
          </div>
        </template>
        <q-table
            title="Registros cadastrados"
            :data="registros"
            :columns="columns"
            row-key="id_registro"
        >
            <template v-slot:body="props">
              <q-dialog v-model="confirm" persistent>
                <q-card>
                  <q-card-section class="row items-center">
                    <q-avatar icon="delete" color="red" text-color="white" />
                    <span class="q-ml-sm">Esse chamado será deletado dos registros</span>
                  </q-card-section>

                  <q-card-actions align="right">
                    <q-btn flat label="Cancelar" color="primary" @click="confirm = false"/>
                    <q-btn flat label="Confirmar" color="primary" @click="deletar(props.row.id_registro)"/>
                  </q-card-actions>
                </q-card>
            </q-dialog>
              <q-tr :props="props">
                <q-td key="id_registro" :props="props">
                  {{ props.row.id_registro }}
                </q-td>
                <q-td key="data" :props="props">
                  {{ props.row.data }}
                  <q-popup-edit v-model="props.row.data">
                    <q-input v-model="props.row.data" 
                             @keydown.enter="update(props.row.id_registro, props.row.data, 'data')" 
                             dense autofocus counter />
                  </q-popup-edit>
                </q-td>
                <q-td key="hora" :props="props">
                  {{ props.row.hora }}
                  <q-popup-edit v-model="props.row.hora">
                    <q-input v-model="props.row.hora" 
                             @keydown.enter="update(props.row.id_registro, props.row.hora, 'hora')" 
                             dense autofocus counter />
                  </q-popup-edit>
                </q-td>
                <q-td key="plantonista" :props="props">
                  {{ props.row.plantonista }}
                  <q-popup-edit v-model="props.row.plantonista">
                    <q-input v-model="props.row.plantonista" 
                             @keydown.enter="update(props.row.id_registro, props.row.plantonista, 'plantonista')"
                             dense autofocus counter />
                  </q-popup-edit>
                </q-td>
                <q-td key="tipo" :props="props">
                  {{ props.row.tipo }}
                  <q-popup-edit v-model="props.row.tipo">
                    <q-input v-model="props.row.tipo" 
                             @keydown.enter="update(props.row.id_registro, props.row.tipo, 'tipo')" 
                             dense autofocus counter />
                  </q-popup-edit>
                </q-td>
                <q-td key="ticket" :props="props">
                  {{ props.row.ticket }}
                  <q-popup-edit v-model="props.row.ticket">
                    <q-input v-model="props.row.ticket" 
                             @keydown.enter="update(props.row.id_registro, props.row.ticket, 'ticket')" 
                             dense autofocus counter />
                  </q-popup-edit>
                </q-td>
                <q-td key="descricao" :props="props">
                  {{ props.row.descricao }}
                  <q-popup-edit v-model="props.row.descricao">
                    <q-input v-model="props.row.descricao" 
                             @keydown.enter="update(props.row.id_registro, props.row.descricao, 'descricao')" 
                             dense autofocus counter />
                  </q-popup-edit>
                </q-td>
                <q-td key="delete">
                  <q-btn push color="white" style="left:15px" text-color="red" icon="delete" @click="confirm = true">
                    <q-tooltip anchor="center left" content-class="bg-gray" :offset="[10, 10]">
                      <strong>Deletar</strong>
                    </q-tooltip>
                  </q-btn>
                </q-td>
              </q-tr>
            </template>
        </q-table>
      </template>
    </div>
</template>

<script>
import filtroData from './filtroData'
export default {
  components: {filtroData},
  data () {
    return {
      carregando: false,
      confirm: false,
      columns: [
        { name: 'id_registro', align: 'center', label: 'ID', field: 'id_registro', sortable: true },
        {
          name: 'data',
          required: true,
          label: 'Data',
          align: 'left',
          field: 'data',
          sortable: true
        },
        { name: 'hora', align: 'center', label: 'Hora', field: 'hora', sortable: true },
        { name: 'plantonista', label: 'Plantonista', field: 'plantonista', sortable: true },
        { name: 'tipo', label: 'Ocorrência', field: 'tipo', sortable: true },
        { name: 'ticket', label: 'Ticket', field: 'ticket', sortable: true },
        { name: 'descricao', align: 'center', label: 'Descrição', field: 'descricao', sortable: true },
        { name: 'acao', align: 'center', label: 'Ação', field: 'acao', sortable: true },
      ],
      
    }
  },

  mounted(){
    this.getChamados()
  },

  methods: {
    getChamados() {
      this.$store.dispatch('getChamados', this.$route.params.data)
    },

    update(id, dado, name) {
      this.$store.dispatch('updateChamado', {
        id: id,
        campo: {
          value: dado,
          name: name
        }
      })
    },

    deletar(id) {
      this.$store.dispatch('deleteChamado', id)
      this.confirm = false
    }
  },

  computed: {
      registros() {
          return this.$store.state.registros
      }
  }
}
</script>

<style scoped>
  .filterInput{
    display: flex;
    justify-content: end;
    margin-top: -70px;
  }
</style>