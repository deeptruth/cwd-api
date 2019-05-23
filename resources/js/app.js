/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('notes', require('./components/Notes.vue').default);
Vue.component('navbar', require('./components/NavBar.vue').default);
Vue.component('status', require('./components/Status.vue').default);
Vue.component('create-note', require('./components/CreateNotes.vue').default);
Vue.component('to-do-notes', require('./components/ToDoNotesList.vue').default);
Vue.component('App', require('./views/App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const store = {
// 	state: {
// 		notes: [],
// 	},
// 	getters: {

// 	},
// 	actions: {
// 		async getNotes(){
// 			 await res = axios
// 			 commit('setNote', res)
// 		} 
// 	},
// 	mutatations: {
// 		setNote(state, ntoes){
// 			 state.notest = ntoes
// 		}
// 	}

// }
const store = new Vuex.Store({
  	state: {
    	notes: [],
  	},
  	getters: {
	    notes: state => {
	      return state.notes.data;
	    }
	},
	actions: {
		async getNotes({ commit }){
			let res = await axios
                  .get('api/notes');

			commit('setNote', res)
		} 
	},
	mutations: {
		setNote(state, notes){
			 state.notes = notes
		}
	}
});

import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from './views/Login'
import Home from './views/Home'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
    ],
});


const app = new Vue({
	store,
    el: '#app',
    router,
});
