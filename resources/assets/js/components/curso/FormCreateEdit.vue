<template>
    <div>
        <formulario id="formCurso" :action="action" :method="method" enctype="" :token="token" css="">
            <input v-model="form.id" type="hidden" name="id">
            <tabs>
                <tab title="Informações do curso" active class="pt-3 p-2">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nome do curso</label>
                            <input v-model="form.name" ref="name" type="text" class="form-control form-control-lg" placeholder="ex. curso de tecnologia">
                        </div>
                    </div>
                    <span v-if="mostraFormularioCompleto">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCity">Categoria</label>
                                <select v-model="form.category" class="form-control" id="category">
                                    <option :value="item.id" v-for="(item,index) in categoriesSelect">{{item.name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Nível</label>
                                <select v-model="form.level" class="form-control" id="level">
                                    <option :value="item.id" v-for="(item,index) in levelsSelect">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Descrição</label>
                                <textarea v-model="form.description" class="form-control" rows="3" id="description" placeholder="texto descrvendo o curso"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="inputAddress">Objetivo</label>
                                <textarea v-model="form.objective" class="form-control" id="objective" placeholder="objetivo"></textarea>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputAddress2">Requisitos</label>
                                <textarea v-model="form.requisites" class="form-control" id="requisites" placeholder="requisitos"></textarea>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="inputAddress2">Público alvo</label>
                                <textarea v-model="form.audience" class="form-control" id="audience" placeholder="público alvo"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">Tipo venda</label>
                                <select v-model="form.type_sale" class="form-control" id="type_sale">
                                    <option value="1">Curso</option>
                                    <option value="2">Disciplina</option>
                                </select>
                            </div>
                            <div v-if="form.type_sale==1" class="form-group col-md-2">
                                <label for="inputZip">Valor do curso</label>
                                <money v-model="form.price" class="form-control" placeholder=""></money>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Emite certificado?</label>
                               <select v-model="form.certificate" class="form-control" id="type_sale">
                                   <option value="">...</option>
                                    <option value="1">Sim</option>
                                    <option value="2">Não</option>
                                </select>
                            </div>
                        </div>
                    </span>
                </tab>
                <tab v-if="mostraFormularioCompleto" title="Apresentação" class="pt-3 p-2">
                    <h4>Apresentação</h4>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-12">
                            <label>Anexe vídeos ao curso</label>
                            <FilesCourse ref="fileVideo" :filetypes="['video']" videoacao="edit" nomeBtnArquivo="Anexar vídeo de apresentação" iconeBtnArquivo="fas fa-file-image fa-sm"></FilesCourse>
                        </div>
                    </div>
                </tab>
                <tab v-if="mostraFormularioCompleto" title="Conteúdo do curso" class="pt-3 p-2">
                    <h4>Conteúdo do curso</h4>
                    <div class="form-row mt-3">
                        <div class="form-group col-md-12">
                            <disciplina-content ref="discipliaContent" :cursoId="form.id"></disciplina-content>
                        </div>
                    </div>
                </tab>
            </tabs>
            <hr class="mb-3">
            <div class="form-group text-right mb-0">
                <router-link :to="{ name: 'painel.cursos.index' }" class="btn btn-link rounded-0">Cancelar</router-link>
                <button v-if="mostraFormularioCompleto" type="button" class="btn btn-primary rounded-0" @click.prevent="submitForm('2')"><i class="fas fa-share"></i> Publicar</button>
                <button type="submit" class="btn btn-success rounded-0" @click.prevent="submitForm('1')"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </formulario>
    </div>
</template>

<script>

    import Breadcrumb from "bootstrap-vue/src/components/breadcrumb/breadcrumb";
    import Tabs from "bootstrap-vue/src/components/tabs/tabs";
    import Tab from "bootstrap-vue/es/components/tabs/tab";
    import Formulario from "../Formulario";
    import FilesCourse from "../file/Index";
    import DisciplinaContent from "./DisciplinaContent";

    export default {
        components: {
            DisciplinaContent,
            FilesCourse,
            Formulario,
            Tab,
            Tabs,
            Breadcrumb
        },
        props: ['id','action','method'],
        data: function() {
            return {
                form: {
                    id: '',
                    name: '',
                    category: '',
                    level: '',
                    description: '',
                    objective: '',
                    requisites: '',
                    audience: '',
                    type_sale: 1,
                    price: 0,
                    certificate: '',
                    status: '',
                    video: '',
                    image: '',
                    current_time: 0
                },
                breadcrumb: {
                    items: [{
                        text: 'Dashboard',
                        href: '/dashboard'
                    }, {
                        text: 'Lista curso',
                        href: '/curso'
                    }, {
                        text: 'Novo curso',
                        active: true
                    }]
                },
                msgError: '',
                categoriesSelect: '',
                levelsSelect: '',
                token: Laravel.token,
                mostraPrecoCurso: true,
                mostraFormularioCompleto: false
            }
        },
        methods: {
            submitForm(status) {
                var self = this;
                if(this.id) {
                   this.$refs.fileVideo.capture();
                    this.form.image = this.$refs.fileVideo.$refs.canvasRef.toDataURL();
                    this.form.video = this.$refs.fileVideo.videoSrc;
                    this.form.current_time = this.$refs.fileVideo.$refs.videoRef.currentTime;
                }
                this.form.status = status;
                axios({
                    method: this.method,
                    url: this.action,
                    data: this.form,
                })
                .then(function (response) {
                    if(!self.id) {
                        self.$router.push('/painel/cursos/edit/' + response.data.id);
                    }
                    self.msgError = '<div class="alert alert-success" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
            getCurso(event) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/curso/' + this.id + '/edit',
                })
                .then(function (response) {
                    self.form.name = response.data.name;
                    self.form.category = response.data.category_id;
                    self.form.level = response.data.level_id;
                    self.form.description = response.data.description;
                    self.form.objective = response.data.objective;
                    self.form.requisites = response.data.requisites;
                    self.form.audience = response.data.audience;
                    self.form.type_sale = response.data.type_sale;
                    self.form.price = response.data.price ? response.data.price : 0;
                    self.form.certificate = response.data.certificate;
                    self.form.status = response.data.status;
                    self.form.video = response.data.video_presentation;
                    self.form.current_time = response.data.video_current_time;
                    self.form.image = response.data.image_presentation;
                    if(response.data.video_presentation) {
                        self.$refs.fileVideo.videoEdit = true;
                        self.$refs.fileVideo.$refs.videoRef.src = '/storage/video/' + response.data.video_presentation;
                        self.$refs.fileVideo.videoSrc = response.data.video_presentation;
                        self.$refs.fileVideo.$refs.videoRef.currentTime = response.data.video_current_time;
                    }
                })
                .catch(function (error) {
                });
            },
            getCategorias(event) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/category'
                })
                .then(function (response) {
                    self.categoriesSelect = response.data;
                })
                .catch(function (error) {
                });
            },
            getNiveis(event) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/level'
                })
                .then(function (response) {
                    self.levelsSelect = response.data;
                })
                .catch(function (error) {
                });
            },
        },
        mounted() {
            if(this.id) {
                this.getCurso();
                this.getCategorias();
                this.getNiveis();
                this.mostraFormularioCompleto = true;
                this.form.id = this.id;
            }
            Vue.nextTick(() => this.$refs.name.focus());
        },
    }
</script>