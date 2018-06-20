<template>
    <div>
        <span v-if="form.type==1">
            <div class="card rounded-0">
                <formulario id="formContent" :action="action" :method="method" enctype="" :token="token" css="">
                    <div class="card-header rounded-0">
                        <div class="row">
                            <div class="col-lg-8 text-left pt-1">
                                <i class="fas fa-play-circle"></i> Conteúdo de vídeo
                            </div>
                            <div class="col-lg-4 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <input v-model="form.id" type="hidden" name="id">
                        <input v-model="form.type" type="hidden" name="type">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nome do conteúdo</label>
                                <input v-model="form.name" ref="name" type="text" class="form-control" placeholder="Digite o nome do conteúdo">
                            </div>
                        </div>
                        <FilesModal ref="fileVideoContent" :filetypes="['video']" videoacao="input" nomeBtnArquivo="Anexar vídeo" iconeBtnArquivo="fas fa-file-image fa-sm"></FilesModal>
                    </div>
                    <div class="card-footer rounded-0">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </formulario>
            </div>
        </span>

        <span v-if="form.type==2">
            <div class="card rounded-0">
                <formulario id="formContent" :action="action" :method="method" enctype="" :token="token" css="">
                    <div class="card-header rounded-0">
                        <div class="row">
                            <div class="col-lg-8 text-left pt-1">
                                <i class="fas fa-font"></i> Conteúdo de texto
                            </div>
                            <div class="col-lg-4 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <input v-model="form.id" type="hidden" name="id">
                        <input v-model="form.type" type="hidden" name="type">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nome do conteúdo</label>
                                <input v-model="form.name" ref="name" type="text" class="form-control" placeholder="Digite o nome do conteúdo">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Digite um texto</label>
                                <textarea v-model="form.text" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer rounded-0">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </formulario>
            </div>
        </span>

        <span v-if="form.type==3">
            <div class="card rounded-0">
                <formulario id="formContent" :action="action" :method="method" enctype="" :token="token" css="">
                    <div class="card-header rounded-0">
                        <div class="row">
                            <div class="col-lg-8 text-left pt-1">
                                <i class="fas fa-list-ul"></i> Conteúdo de avaliação
                            </div>
                            <div class="col-lg-4 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <input v-model="form.id" type="hidden" name="id">
                        <input v-model="form.type" type="hidden" name="type">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nome do conteúdo</label>
                                <input v-model="form.name" ref="name" type="text" class="form-control" placeholder="Digite o nome do conteúdo">
                            </div>
                        </div>
                    </div>
                </formulario>
            </div>
            <div class="card rounded-0 mt-2">
                <div v-if="form.id" class="card-body rounded-0">
                    <div class="row">
                        <div class="col-lg-8 text-left pt-1">
                            <i class="fas fa-question"></i> Questionários
                        </div>
                        <div class="col-lg-4 text-right">
                            <button type="submit" class="btn btn-success btn-sm" @click.prevent="addQuestion({'contentId':form.id})" data-toggle="tooltip" data-placement="top" title="Adicionar questionário">
                                <i class="fas fa-plus"></i> Novo questionário
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="form.id" class="card rounded-0 mt-0 border-0">
                <div class="card-body pt-0 pb-3 pl-0 pr-0">
                    <div v-for="(item,index) in questions">
                        <div class="card mb-20 mt-2 rounded-0">
                            <div class="card-header bg-transparent text-right border-bottom-0">
                                <div class="dropdown show">
                                    <a class="btn btn-light border btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a @click.prevent="removeQuestion({'contentId':item.content_id, 'questionId':item.id})" class="dropdown-item" href="#">
                                            Excluir
                                        </a>
                                        <a @click.prevent="addResponse({'contentId':item.content_id, 'questionId':item.id})" class="dropdown-item" href="#">
                                            Nova resposta
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0" style="position: relative;">
                                <div class="form-row mt-0">
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <input ref="pergunta" v-model="item.question" @keyup="setTimeQuestion({'question':$event.target.value,'questionId':item.id})" type="text" class="form-control form-control-lg" placeholder="digite uma pergunta">
                                        </div>
                                    </div>
                                </div>
                                <div v-for="(itemr,indexr) in item.responses" class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="input-group">
                                            <input :ref="'resposta' + item.id" v-model="itemr.response" @keyup="setTimeResponse({'response':$event.target.value,'responseId':itemr.id})" type="text" class="form-control" placeholder="digite uma resposta">
                                            <div class="input-group-append">
                                                <label @mouseup="setTimeResponse({'correct':1,'responseId':itemr.id,'questionId':item.id})" class="input-group-text bg-light" style="cursor: pointer">
                                                    <input :name="item.id" :checked="itemr.correct" type="radio">
                                                </label>
                                                <div @click.prevent="removeResponse({'contentId':item.content_id, 'responseId':itemr.id})" class="input-group-text bg-light" style="cursor: pointer">
                                                    <i class="fas fa-times text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </span>

        <span v-if="form.type==4">
            <div class="card rounded-0">
                <formulario id="formContent" :action="action" :method="method" enctype="" :token="token" css="">
                    <div class="card-header rounded-0">
                        <div class="row">
                            <div class="col-lg-8 text-left pt-1">
                                <i class="fas fa-play-circle"></i> Conteúdo de anexos
                            </div>
                            <div class="col-lg-4 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        <input v-model="form.id" type="hidden" name="id">
                        <input v-model="form.type" type="hidden" name="type">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Nome do conteúdo</label>
                                <input v-model="form.name" ref="name" type="text" class="form-control" placeholder="Digite o nome do conteúdo">
                            </div>
                        </div>
                        <span v-if="form.id">
                            <FilesModal ref="fileAnexoContent" :filetypes="['documento']" nomeBtnArquivo="Anexar pdf" iconeBtnArquivo="fas fa-paperclip fa-sm"></FilesModal>
                            <file-lista-anexo-documento :documentos="documentos"></file-lista-anexo-documento>
                        </span>
                    </div>
                    <div class="card-footer rounded-0">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-success btn-sm" @click.prevent="submitForm()" data-toggle="tooltip" data-placement="top" title="Salvar">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </formulario>
            </div>
        </span>

    </div>
</template>

<script>

    import Formulario from "../Formulario";
    import FilesModal from "../file/Index";
    import FileListaAnexoDocumento from "../file/FileListaAnexoDocumento";

    export default {
        components: {
            FileListaAnexoDocumento,
            Formulario,
            FilesModal,
        },
        data: function () {
            return {
                form: {
                    discipline_id: '',
                    id: '',
                    name: '',
                    text: '',
                    url: '',
                    type: ''
                },
                question: {
                    content_id: '',
                    question: ''
                },
                response: {
                    question_id: '',
                    response: '',
                    correct: ''
                },
                doc: {
                    content_id: '',
                    documentos: []
                },
                documentos: [],
                token: Laravel.token,
                method: '',
                action: '',
                ind: '',
                questions: {},
                responses: {},
                timeoutId: '',
                counter: 0,
                thisCounter: ''
            }
        },
        methods: {
            contentShow(val) {
                this.form.discipline_id = val.disciplineId;
                this.form.contentId = val.contentId;
                this.form.type = val.type;
                this.ind = val.index;
                $('#modalContent_' + this._uid).modal('show');
                if(val.contentId) {
                    this.action = '/api/content/' + val.contentId;
                    this.method = 'PUT';
                    this.getContent(val.contentId);
                    if(this.form.type==3) {
                        this.$parent.$refs.disciplinaLista[val.index].menuAvaliacao = false;
                    }
                    this.$parent.$refs.disciplinaLista[val.index].active = val.contentId;
                } else {
                    this.resetForm();
                    this.action = '/api/content';
                    this.method = 'POST';
                }
                if(val.index) {
                    this.$parent.$refs.disciplinaLista[val.index].abre(val.index);
                }
                Vue.nextTick(() => this.$refs.name.focus());
            },
            submitForm() {
                var self = this;
                if(this.form.type==1) {
                    this.form.url = this.$refs.fileVideoContent.videoSrc;
                }
                axios({
                    method: this.method,
                    url: this.action,
                    data: this.form,
                })
                .then(function (response) {
                    self.contentShow({'disciplineId':self.form.discipline_id, 'contentId':response.data.id, 'type':self.form.type, 'index':self.ind});
                    self.$parent.getDisciplinas(self.$parent.cursoId);
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
            getContent(id) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/content/' + id + '/edit',
                })
                .then(function (response) {
                    self.form.name = response.data.name;
                    self.form.id = response.data.id;
                    self.form.discipline_id = response.data.discipline_id;
                    self.form.text = response.data.text;
                    self.form.url = response.data.url;
                    self.form.type = response.data.type;
                    if(response.data.url) {
                        self.$refs.fileVideoContent.videoEdit = true;
                        self.$refs.fileVideoContent.$refs.videoRef.src = '/storage/video/' + response.data.url;
                        self.$refs.fileVideoContent.videoSrc = response.data.url;
                        self.$refs.fileVideoContent.$refs.videoRef.currentTime = 1;
                    }
                    if(response.data.questions) {
                        self.questions = response.data.questions;
                    }
                    if(response.data.documents) {
                        if(response.data.documents.length == 0) {

                            console.log('teste...');

                            Vue.nextTick(() => self.documentos = []);
                        } else {
                            self.documentos = response.data.documents;
                        }
                    }
                })
                .catch(function (error) {
                });
            },
            resetForm() {
                if(typeof(this.$refs.fileVideoContent)!='undefined') {
                    this.$refs.fileVideoContent.videoEdit = false;
                    this.$refs.fileVideoContent.$refs.videoRef.src = '';
                    this.$refs.fileVideoContent.videoSrc = '';
                }
                this.form.id = '';
                this.form.name = '';
                this.form.text = '';
                this.form.url = '';
            },
            addQuestion(val) {
                var self = this;
                this.question.content_id = val.contentId;
                this.question.question = '';
                axios({
                    method: 'POST',
                    url: '/api/question',
                    data: this.question,
                })
                .then(function (response) {
                    self.getContent(val.contentId);
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                    <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                </div>';
                    self.msgErrorSuccess(true, self.msgError);
                    Vue.nextTick(() => self.$refs.pergunta[0].focus());
                    self.addResponse({'questionId':response.data.id,'q':1,'contentId':val.contentId});
                })
                .catch(function (error) {
                });
            },
            updateQuestion(val) {
                var self = this;
                this.question.question = val.question;
                axios({
                    method: 'PUT',
                    url: '/api/question/' + val.questionId,
                    data: this.question
                })
                .then(function (response) {
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
            removeQuestion(val) {
                var self = this;
                axios({
                    method: 'DELETE',
                    url: '/api/question/' + val.questionId
                })
                .then(function (response) {
                    self.getContent(val.contentId);
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
            addResponse(val) {
                var self = this;
                this.response.question_id = val.questionId;
                this.response.response = '';
                axios({
                    method: 'POST',
                    url: '/api/response',
                    data: this.response,
                })
                .then(function (response) {
                    self.getContent(val.contentId);
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                    if(!val.q) {
                        Vue.nextTick(() => self.$refs['resposta' + val.questionId][0].focus());
                    }
                })
                .catch(function (error) {
                });
            },
            updateResponse(val) {
                var self = this;
                this.response.question_id = val.questionId;
                this.response.response = val.response;
                this.response.correct = val.correct;
                axios({
                    method: 'PUT',
                    url: '/api/response/' + val.responseId,
                    data: this.response
                })
                .then(function (response) {
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                    <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            },
            setTimeQuestion(val) {
                var self = this;
                this.counter++;
                this.thisCounter = this.counter;
                clearTimeout(this.timeoutId);
                this.timeoutId = setTimeout(function () {
                    self.updateQuestion(val);
                }, 1000);
            },
            setTimeResponse(val) {
                var self = this;
                this.counter++;
                this.thisCounter = this.counter;
                clearTimeout(this.timeoutId);
                this.timeoutId = setTimeout(function () {
                    self.updateResponse(val);
                }, 1000);
            },
            removeResponse(val) {
                var self = this;
                axios({
                    method: 'DELETE',
                    url: '/api/response/' + val.responseId
                })
                .then(function (response) {
                    self.getContent(val.contentId);
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                    <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            }
        },
        watch: {
            documentos() {
                var self = this;
                this.doc.content_id = this.form.id;
                this.doc.documentos = this.documentos;
                axios({
                    method: 'POST',
                    url: '/api/document',
                    data: this.doc,
                })
                .then(function (response) {
                    self.msgError = '<div class="alert alert-success pb-0" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                });
            }
        },
        mounted() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        }
    }
</script>