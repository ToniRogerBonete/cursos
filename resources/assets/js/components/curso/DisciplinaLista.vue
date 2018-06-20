<template>
    <div>
        <span class="align-middle">
            <div class="card-header pl-2 pb-3 border-top border-right border-left border-bottom-0 rounded-0" :id="'heading' + index" style="padding-top: 15px !important; padding-bottom: 14px !important;">
                <div class="float-left mr-2 handle" style="cursor:move" data-toggle="tooltip" data-placement="top" title="Mover disciplina">
                    <i class="fas fa-arrows-alt-v"></i>
                </div>
                <div data-toggle="collapse" style="cursor: pointer; margin-left: 17px; padding-right: 30px;" :data-target="'#collapse' + index" aria-expanded="true" :aria-controls="'collapse' + index">
                    <strong>{{item.name}}</strong>
                </div>
                <div class="dropdown show" style="position: absolute; right: 10px; top: 14px;">
                    <a class="btn btn-light border btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" @click.prevent="modalFileShow(item.id)" data-toggle="tooltip" data-placement="top" title="Editar disciplina">Editar disciplína</a>
                        <a class="dropdown-item" href="#" @click.prevent="contentShow({'disciplineId':item.id, 'type':1, 'index':index})" data-toggle="tooltip" data-placement="top" title="Adicionar um vídeo">Adicionar vídeo</a>
                        <a class="dropdown-item" href="#" @click.prevent="contentShow({'disciplineId':item.id, 'type':2, 'index':index})" data-toggle="tooltip" data-placement="top" title="Adicionar um texto">Adicionar texto</a>
                        <a class="dropdown-item" href="#" @click.prevent="contentShow({'disciplineId':item.id, 'type':4, 'index':index})" data-toggle="tooltip" data-placement="top" title="Adicionar anexos">Adicionar anexos</a>
                        <a v-if="menuAvaliacao" class="dropdown-item" href="#" @click.prevent="contentShow({'disciplineId':item.id, 'type':3, 'index':index})" data-toggle="tooltip" data-placement="top" title="Adicionar avaliações">Adiconar avaliação</a>
                    </div>
                </div>
            </div>
            <div :id="'collapse' + index" class="collapse" :aria-labelledby="'heading' + index" data-parent="#accordion">
                <div class="card-body border-right border-left border-top border-bottom p-0" v-sortable="{ onEnd: onUpdate, handle: '.handle' }">
                    <div v-sortable="{ onEnd: onUpdate, handle: '.handle' }">
                        <div v-for="(itemc,indexc) in item.contents" :key="itemc.id" class="list-group list-group-flush;">
                            <button v-if="itemc.type!=3" href="#" @click.prevent="contentShow({'disciplineId':item.id, 'contentId':itemc.id, 'type':itemc.type, 'index':index})" class="list-group-item list-group-item-action rounded-0 border-top-0 border-right-0 border-left-0 " :class="itemc.id == active ? 'active' : ''" style="position: relative; padding-left: 25px; cursor: pointer;">
                                <div class="float-left mr-2 handle" style="cursor:move; position: absolute; top: 12px; left: 10px;" data-toggle="tooltip" data-placement="top" title="Mover disciplina">
                                    <i class="fas fa-arrows-alt-v"></i>
                                </div>
                                <button @click.prevent="removeContent({'contentId':itemc.id})" class="btn btn-light btn-xs mr-2" style="position: absolute; top: 12px; right: 2px;" data-toggle="tooltip" data-placement="top" title="Excluir conteúdo">
                                    <i class="fas fa-times"></i>
                                </button>
                                <i v-if="itemc.type==1" class="fas fa-play-circle"></i>
                                <i v-if="itemc.type==2" class="fas fa-font"></i>
                                <i v-if="itemc.type==3" class="fas fa-list-ul"></i>
                                <i v-if="itemc.type==4" class="fas fa-paperclip"></i>
                                {{itemc.name}}
                            </button>
                        </div>
                    </div>
                    <div v-for="(itemc,indexc) in item.contents" class="list-group list-group-flush;">
                        <a v-if="itemc.type==3" href="#" @click.prevent="contentShow({'disciplineId':item.id, 'contentId':itemc.id, 'type':itemc.type, 'index':index})" class="list-group-item list-group-item-action rounded-0 border-right-0 border-left-0 " :class="itemc.id == active ? 'active' : ''" style="position: relative; padding-left: 25px;">
                            <i v-if="itemc.type==3" class="fas fa-list-ul"></i>
                            {{itemc.name}}
                        </a>
                    </div>
                    <div v-if="item.contents.length==0" class="list-group list-group-flush;">
                        <div href="#" class="list-group-item rounded-0 border-right-0 border-left-0 text-info">
                            <i class="fas fa-exclamation-circle"></i> Nem um conteúdo cadastrado!
                        </div>
                    </div>
                </div>
            </div>
        </span>
    </div>
</template>

<script>

    import FilesCourse from "../file/Index";

    export default {
        components: {
          FilesCourse,
        },
        props: ['item','icone','index'],
        data: function () {
            return {
                expanded: true,
                active: '',
                menuAvaliacao: true
            }
        },
        methods: {
            modalFileShow(disciplinaId) {
                this.$parent.getDisciplina(disciplinaId);
            },
            contentShow(val) {
                this.$parent.$refs.conteudo.contentShow(val);
            },
            onUpdate: function (event) {
                const movedItem = this.item.contents.splice(event.oldIndex, 1)[0];
                this.item.contents.splice(event.newIndex, 0, movedItem);
                this.ordenaContents();
            },
            ordenaContents() {
                var self = this;
                var data = {
                    contents: this.item.contents,
                    discipline_id: [this.item.id]
                };
                axios({
                    method: 'post',
                    url: '/api/content/ordem',
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
            abre(el) {
                $('.collapse').removeClass('show');
                $('#collapse' + el).addClass('show');
            },
            removeContent(val) {
                var self = this;
                axios({
                    method: 'DELETE',
                    url: '/api/content/' + val.contentId
                })
                .then(function (response) {
                    self.$parent.getDisciplinas(self.$parent.cursoId);
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
            self = this;
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
            this.abre(0);
            if(this.index==0) {
                this.contentShow({'disciplineId':this.item.id, 'contentId':this.item.contents[0].id, 'type':this.item.contents[0].type, 'index':this.index});
            }
            Object.values(this.item.contents).forEach(function (value) {
                if(value['type']==3) {
                    self.menuAvaliacao = false;
                }
            });
        }
    }
</script>