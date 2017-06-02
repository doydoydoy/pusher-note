<template>
	<!-- <div class="input-group">
		<textarea class="form-control input-lg" id="btn-input" name="content" placeholder="Type your document..." v-model="message" @keyup="sendContent"></textarea>
		<span class="input-group-btn">
			<button class="btn btn-primary btn-sm" id="btn-chat" @click="sendContent">Save Button</button>
		</span>
	</div> -->
	<div>
		<textarea class="form-control" id="note-textarea" name="content" placeholder="Type your document..." v-model="content" @keyup="saveNote" v-if="notes.length != 0">
		</textarea>
		<div class="textarea" v-if="notes.length == 0"></div>
		<!-- <div>
			<button class="btn btn-primary btn-md pull-right" id="btn-chat" @click="saveNote">Save Button</button>
		</div> -->
	</div>
</template>

<script type="text/javascript">
	export default {
		props: {
			notes: {
				type: Array,
			},

			note: {
				type: Object,
			},
		},

		// Local scope for data () 
		// Covers Note.vue scope
		// Initialization data when first rendering page
		data() {
			return {
				content: '',
			}
		},
		
		mount() {
			this.content = this.note.content;
		},

		watch: {
			content(newVal) {
				this.$emit('noteput', newVal);
			},

			note(newVal) {
				this.content = this.note.content;
			},
		},

		methods: {
			// updateNote() {
			// 	this.$emit('noteupdate');
			// },

			saveNote() {
				this.$emit('notesave');
			},
		},
	}
</script>