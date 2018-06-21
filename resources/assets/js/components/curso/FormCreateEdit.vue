<template>
    <div>
        <formulario id="formCurso" :action="action" :method="method" enctype="" :token="token" css="">
            <input v-model="form.id" type="hidden" name="id">
            <tabs>
                <tab title="Informações do curso" active class="pt-3 p-2">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Nome do curso</label>
                            <input v-model="form.name" ref="name" type="text" class="form-control form-control-lg" id="name" placeholder="ex. curso de tecnologia">
                        </div>
                    </div>
                    <span v-if="mostraFormularioCompleto">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Categoria</label>
                                <select v-model="form.category" class="form-control" id="category">
                                    <option :value="item.id" v-for="(item,index) in categoriesSelect">{{item.name}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Nível</label>
                                <select v-model="form.level" class="form-control" id="level">
                                    <option :value="item.id" v-for="(item,index) in levelsSelect">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Descrição</label>
                                <textarea v-model="form.description" class="form-control" rows="3" id="description" placeholder="texto descrvendo o curso"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label>Objetivo</label>
                                <textarea v-model="form.objective" ref="objective" class="form-control" id="objective" placeholder="objetivo"></textarea>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Requisitos</label>
                                <textarea v-model="form.requisites" ref="requisites" class="form-control" id="requisites" placeholder="requisitos"></textarea>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Público alvo</label>
                                <textarea v-model="form.audience" ref="audience" class="form-control" id="audience" placeholder="público alvo"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label>Tipo venda</label>
                                <select v-model="form.type_sale" class="form-control" id="type_sale">
                                    <option value="1">Curso</option>
                                    <option value="2">Disciplina</option>
                                </select>
                            </div>
                            <div v-if="form.type_sale==1" class="form-group col-md-2">
                                <label>Valor do curso</label>
                                <money v-model="form.price" class="form-control" id="price" placeholder=""></money>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Emite certificado?</label>
                               <select v-model="form.certificate" class="form-control" id="certificate">
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
                            <disciplina-content ref="discipliaContent" videoacao="conteudo" :cursoId="form.id"></disciplina-content>
                        </div>
                    </div>
                </tab>
            </tabs>
            <hr class="mb-3">
            <div class="form-group text-right mb-0">
                <router-link  v-if="status!=2" :to="{ name: 'painel.cursos.index' }" class="btn btn-link rounded-0">Cancelar</router-link>
                <button v-if="mostraFormularioCompleto && status!=2" type="button" class="btn btn-primary rounded-0" @click.prevent="submitForm('2')"><i class="fas fa-share"></i> Publicar</button>
                <button v-if="status!=2" type="submit" class="btn btn-success rounded-0" @click.prevent="submitForm('1')"><i class="fas fa-save"></i> Salvar</button>

                <button v-if="mostraFormularioCompleto && status==2" type="button" class="btn btn-outline-secondary rounded-0"><i class="fas fa-check"></i> Curso Publicado</button>
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
                    video_presentation: '',
                    image_presentation: '',
                    current_time: 0,
                    discipline: '',
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
                mostraFormularioCompleto: false,
                status: ''
            }
        },
        methods: {
            submitForm(status) {
                var self = this;
                if (this.id) {
                    this.$refs.fileVideo.capture();
                    this.form.image_presentation = this.$refs.fileVideo.$refs.canvasRef.toDataURL();
                    this.form.video_presentation = this.$refs.fileVideo.videoSrc;
                    this.form.current_time = this.$refs.fileVideo.$refs.videoRef.currentTime;
                    if(this.$refs.discipliaContent.disciplinaLista.length===0) {
                        this.form.discipline = '';
                    } else {
                        this.form.discipline = this.$refs.discipliaContent.disciplinaLista.length;
                    }

                    if(this.$refs.discipliaContent.conteudoLista) {
                        this.form.content = '';
                    } else {
                        this.form.content = 'content';
                    }
                }
                this.form.status = status;
                if (this.form.type_sale == 2) {
                    this.form.price = '';
                }
                if (this.form.price == '0.00') {
                    this.form.price = '';
                }
                axios({
                    method: this.method,
                    url: this.action,
                    data: this.form,
                })
                .then(function (response) {
                    if(!self.id) {
                        self.$router.push('/painel/cursos/edit/' + response.data.id);
                    }
                    self.msgError = '<div class="alert alert-success " style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p class="mb-0"><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    if(self.form.status==2) {
                        self.getCurso();
                    }
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                    self.classErrorSuccess(error);
                });
            },
            getCurso() {
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
                    self.form.video_presentation = response.data.video_presentation;
                    self.form.current_time = response.data.video_current_time;
                    self.form.image_presentation = response.data.image_presentation;
                    self.status = response.data.status;
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