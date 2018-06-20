<template>
    <div>
        <div class="card mt-3 p-0 rounded-0">
            <div class="list-group list-group-flush rounded-0">
                <button v-for="(item,index) in documentos" class="list-group-item list-group-item-action border-bottom-0 rounded-0" style="position: relative; padding-left: 25px; cursor: pointer;">
                    <i class="far fa-file-pdf fa-lg"></i> {{item.file}}
                    <button @click.prevent="removeDocument({'documentId':item.id})" class="btn btn-light btn-xs mr-2" style="position: absolute; top: 12px; right: 2px;" data-toggle="tooltip" data-placement="top" title="Excluir conteúdo">
                        <i class="fas fa-times"></i>
                    </button>
                </button>
            </div>
            <div v-if="!documentos.length" class="list-group list-group-flush rounded-0">
                <div class="list-group-item list-group-item-action border-bottom-0 rounded-0 text-center">
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
            }
        },
        methods: {
            removeDocument(val) {
                console(this.$parent.$parent.form.id);
                console.log(val);
            },
        },
        mounted() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        }
    }
</script>

<style scoped>

</style>