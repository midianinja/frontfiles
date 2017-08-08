
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('drag-n-drop', require('./components/drag-n-drop.vue'))
Vue.component('files-display',require('./components/files-display.vue'))
Vue.component('tag-input',require('./components/tag-input.vue'))
Vue.component('modal-container',require('./components/modal-container.vue'))

/**
 * Vuex data store implementation
*/
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
	state: {
		showModal:false,
		
	},
	actions: {

	},
	mutations: {
		openModal(state){
			state.showModal = true
		},
		closeModal(state){
			state.showModal = false
		}


	},
	getters: {

	}
})

const app = new Vue({
    el: '#app',
    store
});
