
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

//files
Vue.component('drag-n-drop', require('./components/files/drag-n-drop.vue'))
Vue.component('files-display',require('./components/files/files-display.vue'))
Vue.component('file-detail',require('./components/files/file-detail.vue'))


//inputs
Vue.component('tag-input',require('./components/inputs/tag-input.vue'))
Vue.component('file-input',require('./components/inputs/file-input.vue'))


//modals
Vue.component('modal-container',require('./components/modals/modal-container.vue'))
Vue.component('profile-modal',require('./components/modals/profile-modal.vue'))
Vue.component('register-modal',require('./components/modals/register-modal.vue'))


//profiles
Vue.component('user-profile',require('./components/profiles/user-profile.vue'))

/**
 * Vuex data store implementation
*/
import Vuex from 'vuex'


Vue.use(Vuex)

const store = new Vuex.Store({
	state: {
		showModal:false,
		modalData:'',
		progress:0,
		previousProgress:0
		
	},
	actions: {

	},
	mutations: {
		openModal(state,text){
			state.showModal = true
			state.modalData = text
		},
		closeModal(state){
			state.showModal = false
		},
		resetProgress(state){
			state.progress = 0
		},
		addProgress(state,p){
			state.progress +=p
			state.previousProgress=p
		}


	},
	getters: {

	}
})

import { getQuery } from './helpers'
const app = new Vue({
    el: '#app',
    store,
    data(){
    	return {
    		allow:false
    	}	
    },
    mounted(){
    	if(getQuery('code') === 'secret')this.allow=true
    },
	methods:{
		modal(){
			this.$store.commit('openModal','')
		}
	}
});
