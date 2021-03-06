import Vue from 'vue';
import Router from 'vue-router';
import Dashboard from '../components/dashboard/Index.vue';

//CURSOS
import Curso from '../components/curso/Index.vue';
import CursoEdit from '../components/curso/Edit.vue';
import CursoCreate from '../components/curso/Create.vue';

//PERMISSÕES
import Usuario from '../components/usuarios/Index.vue';
import UsuarioEdit from '../components/usuarios/Edit.vue';
import UsuarioCreate from '../components/usuarios/Create.vue';

//PAPÉIS
import Papel from '../components/papeis/Index.vue';
import PapelEdit from '../components/papeis/Edit.vue';
import PapelCreate from '../components/papeis/Create.vue';

Vue.use(Router);

export default new Router({
   routes: [
		{
			path: '*',
			redirect: '/painel/dashboard',
		},
		{//dashboard
			path: '/painel/dashboard',
			name: 'painel.dashboard.index',
			component: Dashboard,
		},

		{//curso
			path: '/painel/cursos',
			name: 'painel.cursos.index',
			component: Curso,
		},
		{
			path: '/painel/cursos/edit/:id',
			name: 'painel.cursos.edit',
			component: CursoEdit,
			props: true,
		},
		{
			path: '/painel/cursos/create',
			name: 'painel.cursos.create',
			component: CursoCreate,
			props: true,
		},

		{//usuários
		   path: '/painel/usuarios',
		   name: 'painel.usuarios.index',
		   component: Usuario,
		},
		{
		   path: '/painel/usuarios/edit/:id',
		   name: 'painel.usuarios.edit',
		   component: UsuarioEdit,
		   props: true,
		},
		{
		   path: '/painel/usuarios/create',
		   name: 'painel.usuarios.create',
		   component: UsuarioCreate,
		   props: true,
		},

		{//papéis
		   path: '/painel/papeis',
		   name: 'painel.papeis.index',
		   component: Papel,
		},
		{
		   path: '/painel/papeis/edit/:id',
		   name: 'painel.papeis.edit',
		   component: PapelEdit,
		   props: true,
		},
		{
		   path: '/painel/papeis/create',
		   name: 'painel.papeis.create',
		   component: PapelCreate,
		   props: true,
		}
   ],
   mode: 'history',
   linkActiveClass: 'active-page',
   linkExactActiveClass: 'current-page'
});
