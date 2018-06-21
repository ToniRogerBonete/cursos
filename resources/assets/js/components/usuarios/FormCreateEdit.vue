<template>
    <div>
        <formulario id="formCurso" :action="action" :method="method" enctype="" :token="token" css="">
            <input v-model="form.id" type="hidden" name="id">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Nome do curso</label>
                    <input v-model="form.name" ref="name" type="text" class="form-control form-control-lg" id="name" placeholder="ex. curso de tecnologia">
                </div>
            </div>
            <hr class="mb-3">
            <div class="form-group text-right mb-0">
                <router-link :to="{ name: 'painel.usuarios.index' }" class="btn btn-link rounded-0">Cancelar</router-link>
                <button type="submit" class="btn btn-success rounded-0" @click.prevent="submitForm('1')"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </formulario>
    </div>
</template>

<script>

    import Breadcrumb from "bootstrap-vue/src/components/breadcrumb/breadcrumb";
    import Formulario from "../Formulario";

    export default {
        components: {
            Formulario,
            Breadcrumb
        },
        props: ['id','action','method'],
        data: function() {
            return {
                form: {
                },
                breadcrumb: {
                    items: [{
                        text: 'Dashboard',
                        href: '/dashboard'
                    }, {
                        text: 'Lista usuário',
                        href: '/usuarios'
                    }, {
                        text: 'Nova usuário',
                        active: true
                    }]
                },
                token: Laravel.token,
            }
        },
        methods: {
            submitForm() {
                var self = this;
                axios({
                    method: this.method,
                    url: this.action,
                    data: this.form,
                })
                .then(function (response) {
                    self.msgError = '<div class="alert alert-success " style="margin-bottom: 0;">\
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
                        <p class="mb-0"><i class="fa fa-check" aria-hidden="true"></i> ' + response.data.data + '</p>\
                    </div>';
                    self.msgErrorSuccess(true, self.msgError);
                })
                .catch(function (error) {
                    self.classErrorSuccess(error);
                });
            }
        },
        mounted() {
            if(this.id) {
            }
            Vue.nextTick(() => this.$refs.name.focus());
        },
    }
</script>