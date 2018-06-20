<template>
    <div>
        <div class="card mt-3 p-0 rounded-0">
            <div class="list-group list-group-flush rounded-0">
                <button v-for="(item,index) in documentos" class="list-group-item list-group-item-action border-bottom-0 rounded-0" style="position: relative; padding-left: 25px; cursor: pointer;">
                    <i class="far fa-file-pdf fa-lg"></i> {{item.document}}
                    <button @click.prevent="removeDocument({'documentId':item.id, 'index':index})" class="btn btn-light btn-xs mr-2" style="position: absolute; top: 12px; right: 2px;" data-toggle="tooltip" data-placement="top" title="Excluir conteúdo">
                        <i class="fas fa-times"></i>
                    </button>
                </button>
            </div>
            <div v-if="showStatus" class="list-group list-group-flush rounded-0">
                <div class="list-group-item border-bottom-0 rounded-0 text-center">
                    <i class="fas fa-info-circle fa-lg text-warning" aria-hidden="true"></i> Ainda não existem anexos
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['documentos'],
        data: function () {
            return {
                showStatus: false
            }
        },
        methods: {
            removeDocument(val) {
                this.documentos.splice(val.index,1);
                var self = this;
                axios({
                    method: 'DELETE',
                    url: '/api/document/' + val.documentId
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
        },
        watch: {
            documentos() {
                console.log(this.documentos.length);
                if(this.documentos.length > 0) {
                    this.showStatus = false;
                } else {
                    this.showStatus = true;
                }
            }
        },
        mounted() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        }
    }
</script>