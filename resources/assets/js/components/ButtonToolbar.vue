<template>
	<div>
		<div class="btn-toolbar" role="toolbar" aria-label="">
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" :class="'btn btn-default ' + (notefor.id == note.id ? 'activate' : '')" v-for="(notefor, index) in notes" @click="openNote(notefor)">{{ index + 1 }}</button>
			</div>
		</div>
		<input type="button" id="add-btn" class="btn btn-success" value="Add New Note" @click="newNote">
		<input type="button" id="delete-btn" class="btn btn-danger pull-right" value="Delete This Note" @click="deleteNote" v-if="notes.length != 0">
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

		methods: {
			openNote(notefor) {
				this.$emit('noteget', notefor);
			},

			newNote() {
				this.$emit('notenew');
			},

			deleteNote() {
				this.$emit('notedelete');
			}
		},
	}
</script>