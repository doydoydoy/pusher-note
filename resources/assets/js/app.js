
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
Vue.component('note', require('./components/Note.vue'));
Vue.component('button-toolbar', require('./components/ButtonToolbar.vue'));

const app = new Vue({
    el: '#app',

    data: {
    	notes: [],
    	note: {},
    	debouncedSaveNote: null,
    },

    created() {
    	this.fetchNotes();
    	// this.retrieveNote(this.notes[0]); 
        console.log(this.notes);
        console.log('this.notes');
		Echo.private('chat').listen('MessageSent', (e) => {
            this.notes = e.notes;
			if(this.note.id === e.note.id) {
	    		this.note = e.note;
			}
    		console.log('echo chat');
    	});
    },

    methods: {
    	fetchNotes(callback) {
    		axios.get('/note').then(response => {
    			this.notes = response.data;
    			console.log(response.data);
                if(this.notes.length != 0) {
                    this.retrieveNote(this.notes[0]);
                    console.log('callback');
                }
    		});
    	},


    	retrieveNote(note) {
    		console.log('retrieve note :'+note.id);
			axios.get('/note/'+note.id).then(response => {
				this.note = response.data;
				console.log(response.data);
			});    		
    	},

        createNote() {
            axios.post('/notes').then(response => {
                this.notes = response.data;
                this.note = this.notes[this.notes.length - 1];
            });
        },

    	// updateNote() {

    	// 	console.log('updateNote');

    	// 	// if(this.note.content) {
		   //  // 		axios.post('/note', {
		   //  // 			note: this.note
		   //  // 		}).then(response => {
	    // 	// 		console.log(response.data);
	    // 	// 	});
    	// 	// }
    	// },

    	saveNote() {
    		if (typeof this.debouncedSaveNote != 'function') {
    			this.debouncedSaveNote = _.debounce(() => {
    				console.log(this.note);
    				// if(this.note.content) {
						axios.post('/note', this.note).then(response => {
							console.log(response.data);
						});
		    		// }
    			}, 500);
    		}
    		
    		this.debouncedSaveNote();
    	},

    	putNote(val) {
    		this.note.content = val;
    	},

        deleteNote() {
            axios.delete('/note/'+this.note.id).then(response => {
                console.log(response.data);
                this.fetchNotes();
            });
        },
    },


});
