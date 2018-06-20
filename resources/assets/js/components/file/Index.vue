<template>
    <div>
        <div class="col-lg-12 p-0 m-0">
            <a href="#" class="btn btn-primary rounded-0" @click.prevent="modalFileShow">
                <i :class="iconeBtnArquivo"></i> {{nomeBtnArquivo}}
            </a>
        </div>

        <!--video-->

        <span v-if="videoacao=='edit'">
            <div v-show="videoEdit" class="row">
                <div class="col-lg-6 mt-3 p-2 ml-3 border" ref="baseRef">
                    <video ref="videoRef" src="" width="100%" controls controlsList="nodownload"></video>
                    <p class="mb-0"><small><strong><i class="fas fa-caret-right"></i> Posicione o ponteiro do vídeo para salvar como capa do curso.</strong></small></p>
                </div>
                <div class="col-lg-5 mt-3">
                    <canvas ref="canvasRef" style="width: 100%; display: none"></canvas>
                </div>
            </div>
        </span>
        <span v-if="videoacao=='input'">
            <div v-show="videoEdit" class="row">
                <div class="col-lg-12 mt-3">
                    <video ref="videoRef" src="" width="100%" controls controlsList="nodownload"></video>
                    <input ref="videoRefUrl" type="hidden" />
                </div>
            </div>
        </span>

        <!--documento-->
        <file-lista-anexo-documento ref="listaDocumentos"></file-lista-anexo-documento>

        <div class="modal fade" data-backdrop="static" :id="'modalFile_' + _uid">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-boxes"></i> Gerenciador de arquivos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 mt-2">
                        <ul class="nav nav-tabs pl-3 pr-3" id="myTab" role="tablist">
                            <li v-if="fileTypeShowVideo" class="nav-item">
                                <a @click.prevent="getFiles('video')" :class="'nav-link' + videoActiveClass" id="home-tab" data-toggle="tab" href="#video" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-file-video fa-sm text-secondary"></i> Vídeos</a>
                            </li>
                            <li v-if="fileTypeShowImagem" class="nav-item">
                                <a @click.prevent="getFiles('imagem')" :class="'nav-link' + imagemActiveClass" id="profile-tab" data-toggle="tab" href="#imagem" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-file-image fa-sm text-secondary"></i> Imagens</a>
                            </li>
                            <li v-if="fileTypeShowDocumento" class="nav-item">
                                <a @click.prevent="getFiles('documento')" :class="'nav-link' + documentoActiveClass" id="contact-tab" data-toggle="tab" href="#documento" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-file-pdf fa-sm text-secondary"></i> Documento</a>
                            </li>
                        </ul>
                        <div class="tab-content pt-3" id="myTabContent">
                            <div v-if="fileTypeShowVideo" :class="'tab-pane fade' + videoActiveClass" id="video" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-lg-12">
                                    <label>Anexe vídeos <small><strong>(.mp4)</strong></small></label>
                                    <div class="custom-file">
                                        <input ref="video" type="file" accept="video/mp4" @change="sendUpload('video')" class="custom-file-input" style="cursor: pointer;">
                                        <label class="custom-file-label" for="validatedCustomFile">adicionar vídeo</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-top mt-4 mb-0 p-0" style="height: 350px; overflow: auto">
                                    <ul class="list-group rounded-0">
                                        <li v-for="(item,index) in video" class="list-group-item list-group-item-action rounded-0 border-left-0 border-right-0 pb-1 pt-1 " :class="index==0 ? 'border-top-0' : '' ">
                                            <FileListaVideo ref="videoLista" :item="item" icone="fas fa-file-video fa-sm text-primary"></FileListaVideo>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div  v-if="fileTypeShowImagem" :class="'tab-pane fade' + imagemActiveClass" id="imagem" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col-lg-12">
                                    <label>Anexe imagens <small><strong>(.jpg .jpeg .png)</strong></small></label>
                                    <div class="custom-file">
                                        <input ref="imagem" type="file" accept="image/jpeg,image/jpg,image/png" @change="sendUpload('imagem')" class="custom-file-input" style="cursor: pointer;">
                                        <label class="custom-file-label" for="validatedCustomFile">adicionar imagem</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-top mt-4 mb-0 pt-3" style="height: 350px; overflow: auto">
                                    <div class="row">
                                        <div class="col-6 col-sm-4 col-lg-2 d-flex align-items-center mb-2 mt-2" style="height: 103px;" v-for="item in imagem">
                                            <figure class="figure">
                                                <img class="card-img-top" :src="'/storage/imagem/p_' + item.file " alt="Card image cap">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div  v-if="fileTypeShowDocumento" :class="'tab-pane fade' + documentoActiveClass" id="documento" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="col-lg-12">
                                    <label>Anexe arquivos <small><strong>(.pdf)</strong></small></label>
                                    <div class="custom-file">
                                        <input ref="documento" type="file" accept="application/pdf" @change="sendUpload('documento')" class="custom-file-input" style="cursor: pointer;">
                                        <label class="custom-file-label" for="validatedCustomFile">adicionar documento</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 border-top mt-4 mb-0 p-0" style="height: 350px; overflow: auto">
                                    <ul class="list-group rounded-0">
                                        <li v-for="(item,index) in documento" class="list-group-item list-group-item-action rounded-0 border-left-0 border-right-0 pb-1 pt-1 " :class="index==0 ? 'border-top-0' : '' ">
                                            <FileListaDocumento :item="item" icone="fas fa-file-pdf fa-sm text-danger"></FileListaDocumento>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import FileListaVideo from "./FileListaVideo";
    import FileListaDocumento from "./FileListaDocumento";
    import FileListaAnexoDocumento from "./FileListaAnexoDocumento";

    export default {
        components: {
            FileListaAnexoDocumento,
            FileListaVideo,
            FileListaDocumento
        },
        props: ['filetypes','nomeBtnArquivo','iconeBtnArquivo','videoacao'],
        data: function () {
            return {
                file: '',
                src: '',
                show: true,
                video: '',
                imagem: '',
                documento: '',
                fileTypeShowVideo: false,
                fileTypeShowImagem: false,
                fileTypeShowDocumento: false,
                videoActiveClass: '',
                imagemActiveClass: '',
                documentoActiveClass: '',
                videoEdit: false
            }
        },
        methods: {
            sendUpload(file_type) {
                var self = this;
                let formData = new FormData();
                formData.append('file_type', file_type);
                formData.append(file_type, this.$refs[file_type].files[0]);
                axios({
                    method: 'POST',
                    url: '/api/file',
                    data: formData
                })
                .then(function (response) {
                    self.src = '/storage/' + response.data;
                    self.msgError = '<div class="alert alert-success" style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p><i class="fa fa-check" aria-hidden="true"></i> Arquivo enviado com sucessos.!</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                    self.getFiles(file_type);
                })
                .catch(function (error) {
                });
            },
            modalFileShow() {
                $('#modalFile_' + this._uid).modal('show');
                this.fileTypeShow();
            },
            getFiles(file_type) {
                var self = this;
                axios({
                    method: 'get',
                    url: '/api/file?file_type=' + file_type
                })
                .then(function (response) {
                    self[file_type] = response.data;
                })
                .catch(function (error) {
                });
            },
            capture() {
                var canvas = this.$refs.canvasRef;
                var video = this.$refs.videoRef;
                canvas.width = '528';
                canvas.height = '297';
                canvas.getContext('2d').drawImage(video, 0, 0, '528', '297');
            },
            fileTypeShow() {
                var self = this;
                this.filetypes.forEach(function (value,index) {
                    if(value=='video') {
                        self.fileTypeShowVideo = true;
                    }
                    if(value=='imagem') {
                        self.fileTypeShowImagem = true;
                    }
                    if(value=='documento') {
                        self.fileTypeShowDocumento = true;
                    }
                    if(index==0) {
                        self.getFiles(value);

                        if(value=='video') {
                            self.videoActiveClass = ' show active';
                        }
                        if(value=='imagem') {
                            self.imagemActiveClass = ' show active';
                        }
                        if(value=='documento') {
                            self.documentoActiveClass = ' show active';
                        }
                    }
                });
            }
        },
        mounted() {
            $( document ).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        }
    }
</script>