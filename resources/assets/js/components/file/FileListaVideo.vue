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
                this.$parent.videoEdit = true;
                this.$parent.$refs.videoRef.src = '/storage/video/' + link;
                this.$parent.videoSrc = link;
                this.$parent.$refs.videoRef.play();
            },
        },
        mounted() {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        }
    }
</script>