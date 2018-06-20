<template>
    <div>
        <span class="align-middle">
            <i :class="icone"></i> {{item.file}}
            <a href="#" @click.prevent="anexaArquivo(item.file)" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Clique para anexar arquivo">
                <i class="fas fa-paperclip"></i>
            </a>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['item','icone'],
        data: function () {
            return {

            }
        },
        methods: {
            anexaArquivo(link) {
                var documento = {'file':link};
                if(this.verifyObject(link, this.$parent.$parent.$parent.documentos)==false) {
                    this.$parent.$parent.$parent.documentos.push(documento);
                }
            },
            verifyObject(item, object) {
                var arr = [];
                var i;
                for (i = 0; i < object.length; i++) {
                    if(object[i].file != '') {
                        arr[i] = object[i].file;
                    }
                }
                if(arr.indexOf(item) > -1) {
                    return true;
                } else {
                    return false;
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