<template>
    <div>
        <div class="col-lg-12 p-0 m-0">
            <a href="#" class="btn btn-primary rounded-0" @click.prevent="modalFileShow('')" data-toggle="tooltip" data-placement="top" title="Adicionar disciplinas">
                <i class=""></i> <i class="fas fa-plus"></i> Nova disciplína
            </a>
        </div>

        <div class="col-lg-12 mt-0 mb-0 p-0">
            <div class="row">
                <div class="col-lg-8 mt-0 mb-0 pt-0">
                    <div class="col-lg-12 mt-3 mb-0 pl-0 border-0">
                        <conteudo ref="conteudo"></conteudo>
                    </div>
                </div>
                <div class="col-lg-4 mt-3 mb-0 pl-0">
                    <div class="accordion" id="accordion" v-sortable="{ onEnd: onUpdate, handle: '.handle' }">
                        <div v-for="(item,index) in disciplinaLista" :key="item.id" class="card border-0">
                            <disciplina-lista ref="disciplinaLista" :index="index" :item="item"></disciplina-lista>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" data-backdrop="static" :id="'modalFile_' + _uid">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-boxes"></i> Gerenciador de disciplinas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <formulario id="formDiscipline" :action="action" :method="method" enctype="" :token="token" css="">
                            <input v-model="form.id" type="hidden" name="id">
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label>Nome da disciplina</label>
                                    <input v-model="form.name" ref="name" type="text" class="form-control" placeholder="Digite o nome da disciplina">
                                </div>
                                <div v-if="mostraPreco" class="form-group col-md-2">
                                    <label>Tempo mínimo</label>
                                    <input v-model="form.minimun_time" type="text" class="form-control" placeholder="">
                                </div>
                                <div v-if="mostraPreco" class="form-group col-md-2">
                                    <label>Valor</label>
                                    <money v-model="form.price" class="form-control" placeholder=""></money>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-3 mt-3 border-top"></div>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-link rounded-0" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success rounded-0" @click.prevent="submitForm()"><i class="fas fa-save"></i> Salvar</button>
                            </div>
                        </formulario>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Formulario from "../Formulario";
    import DisciplinaLista from "./DisciplinaLista";
    import Conteudo from "./Content";

    export default {
        components: {
            Conteudo,
            DisciplinaLista,
            Formulario
        },
        props: ['cursoId'],
        data: function () {
            return {
                form: {
                    curso_id: this.cursoId,
                    name: '',
                    minimun_time: 0,
                    price: 0
                },
                mostraPreco: false,
                token: Laravel.token,
                method: '',
                action: '',
                disciplinaLista: {},
                conteudoLista: false
            }
        },
        methods: {
            modalFileShow(disciplinaId) {
                var self = this;
                $('#modalFile_' + this._uid).modal('show');
                $('#modalFile_' + this._uid).on('shown.bs.modal', function () {
                    self.$refs.name.focus();
                });
                this.tipoVenda();
                if(disciplinaId) {
                    this.action = '/api/discipline/' + disciplinaId;
                    this.method = 'PUT';
                } else {
                    this.action = '/api/discipline';
                    this.method = 'POST';
                }
            },
            tipoVenda() {
                if(this.$parent.$parent.$parent.$parent.form.type_sale==1){
                    this.mostraPreco = false;
                } else {
                    this.mostraPreco = true;
                }
            },
            submitForm() {
                var self = this;
                axios({
                    method: this.method,
                    url: this.action,
                    data: this.form,
                })
                .then(function (response) {
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    $('#modalFile_' + self._uid).modal('hide');
                    self.getDisciplinas(self.cursoId);
                    self.form.name = '';
                    self.form.minimun_time = '';
                    self.form.price = '';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
            getDisciplinas(cursoId) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/discipline?curso_id=' + cursoId
                })
                .then(function (response) {
                    self.disciplinaLista = response.data;
                    self.conteudoLista = false;
                    Object.values(response.data).forEach(function (value) {
                        if(value.contents.length==0) {
                            self.conteudoLista = true;
                        }
                    });
                })
                .catch(function (error) {
                });
            },
            getDisciplina(id) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/discipline/' + id + '/edit',
                })
                .then(function (response) {
                    self.form.name = response.data.name;
                    self.form.minimun_time = response.data.minimun_time;
                    self.form.price =  response.data.price ? response.data.price : 0;
                    self.modalFileShow(id);
                })
                .catch(function (error) {
                });
            },
            onUpdate: function (event) {
                const movedItem = this.disciplinaLista.splice(event.oldIndex, 1)[0];
                this.disciplinaLista.splice(event.newIndex, 0, movedItem);
                this.ordenaDisciplinas();
            },
            ordenaDisciplinas() {
                var self = this;
                var data = {
                    disciplinas: this.disciplinaLista,
                    curso_id: [this.cursoId]
                };
                axios({
                    method: 'post',
                    url: '/api/discipline/ordem',
                    data: data
                })
                .then(function (response) {
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    $('#modalFile_' + self._uid).modal('hide');
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
        },
        mounted() {
            this.getDisciplinas(this.cursoId);
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        }
    }
</script>