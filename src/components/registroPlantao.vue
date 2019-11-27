<template>
    <q-layout class="row">
        <template v-if="this.$store.state.mostrarLista">
            <div class="q-pa-md col-xs-12 col-md-12 col-sm-12">
                <q-btn color="purple" class="q-mt-md q-mb-md" label="Novo registro" @click="newRegister()"/>
                <lista-chamados />
            </div>
        </template>
        <div class="col-xs-12 col-md-12 col-sm-12" v-else>
            <template v-if="this.$store.state.addNewRegister">
                <q-dialog v-model="modal" persistent transition-show="scale" transition-hide="scale">
                    <q-card class="bg-teal text-white" style="width: 300px">
                        <q-card-section>
                            <div class="text-h6">Bom trabalho!</div>
                        </q-card-section>

                        <q-card-section>
                            O plantão foi registrado.
                        </q-card-section>

                        <q-card-actions align="right" class="bg-white text-teal">
                            <q-btn flat label="OK" @click="closeModal()"/>
                        </q-card-actions>
                    </q-card>
                </q-dialog>
            </template>
            <template v-if="this.$store.state.failNewRegister">
                <q-dialog v-model="modal" persistent transition-show="scale" transition-hide="scale">
                    <q-card class="bg-orange text-white" style="width: 300px">
                        <q-card-section>
                            <div class="text-h6">Atenção!</div>
                        </q-card-section>

                        <q-card-section>
                            Preencha os campos obrigatórios.
                        </q-card-section>

                        <q-card-actions align="right" class="bg-white text-teal">
                            <q-btn flat label="OK" @click="closeModal()"/>
                        </q-card-actions>
                    </q-card>
                </q-dialog>
            </template>
            <q-btn color="purple" class="q-mt-md q-ml-md" 
                   label="Chamados registrados" 
                   @click="chamadosRegistrados()"/>

            <q-page-container class="centralizado">
                <q-page class="q-pa-md largura">
                    <div class="q-gutter-y-md">
                        <q-card>
                            <q-card-section>
                                <q-card-section>
                                    <div class="text-h4 text-center text-purple">Inserir registro</div>
                                </q-card-section>
                                <q-input color="purple-12" v-model="dateChamada" hint="Data" type="date"
                                         :rules="[val => !!val || 'Informe a data']"></q-input>
                                <q-select v-model="modelPlantonista" :options="optionsPlantonista" hint="Plantonista" 
                                          :rules="[val => !!val || 'Informe o plantonista']"/>
                                <q-select v-model="modelTipo" :options="optionsTipo" hint="Tipo de registro" 
                                          :rules="[val => !!val || 'Informe o tipo de registro']"/>
                                <q-input color="purple-12" v-model="horaInicio" type="time" hint="Hora Inicial"
                                         :rules="[val => !!val || 'Informe a hora que começou']"></q-input>
                                <q-input color="purple-12" v-model="horaFim" type="time" hint="Hora Final"
                                         :rules="[val => !!val || 'Informe a hora que finalizou']"></q-input>
                                <q-input color="purple-12" v-model="ticket" hint="Ticket"></q-input>
                                <q-input color="purple-12" v-model="descricao" type="textarea" hint="Descrição"></q-input>
                                <q-btn color="purple" class="q-mt-md" label="Registrar" @click="registrar" />
                            </q-card-section>
                        </q-card>
                    </div>
                </q-page>
            </q-page-container>
        </div>
    </q-layout>
</template>
<script>
import listaChamados from './listaChamados'

export default {
    components: { listaChamados },
    props: ['data'],
    data () {
        return {
            carregando: false,
            modal: '',
            ticket: '',
            horaInicio: '',
            horaFim: '',
            modelPlantonista: null,
            modelTipo: null,
            descricao: '',
            optionsPlantonista: [
                'Paulo Henrique', 'Simonarde Lima', 'Thiago Silva', 'Romário Arruda'
            ],
            optionsTipo: [
                'Sobreaviso', 'Chamado', 'Trabalho presencial (Sábado)'
            ]
        }
    },

    computed: {
        dateChamada() {
            return this.data
        }
    },

    methods: {
        registrar() {
            const dados = {
                data: this.dateChamada,
                plantonista: this.modelPlantonista,
                ocorrencia: this.modelTipo,
                horaInicio: this.horaInicio,
                horaFim: this.horaFim,
                ticket: this.ticket,
                desc: this.descricao
            }

            this.$store.dispatch('addRegistro', dados)
            this.limparCampos()

        },

        closeModal() {
            this.$store.state.addNewRegister = false
            this.$store.state.failNewRegister = false
            this.modal = ''
        },

        limparCampos() {
            this.modelPlantonista = ''
            this.modelTipo = ''
            this.horaInicio = ''
            this.horaFim = ''
            this.ticket = ''
            this.descricao = ''
        },

        newRegister() {
            this.$store.commit('newRegister')
        },

        chamadosRegistrados() {
            this.$store.commit('chamadosRegistrados')
        }
    }
}
</script>
