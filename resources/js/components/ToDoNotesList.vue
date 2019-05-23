<template>
    <table class="table table-sm mt-2" v-if="active_module=='to-do-list'">
      <thead>
        <tr>
          <th scope="col" style="width:4%"></th>
          <th scope="col" style="width:20%">Title</th>
          <th scope="col" style="width:45%">Description</th>
          <th scope="col" style="width:10%">Date Created</th>
          <th scope="col" style="width:10%">Date Updated</th>
          <th style="width:16%">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="note in notes">
          <td style="text-align: center"><status :note="note"></status></td>
          <td>
            <div v-if="checkIfEditable(note)">{{ note.title }}</div>
            <div v-if="!checkIfEditable(note)">
              <input type="" class="form-control" v-model="active_note_title"></div>
          </td>
          <td>
            <div v-if="checkIfEditable(note)">{{ note.description }}</div>
            <div v-if="!checkIfEditable(note)">
              <input type="" class="form-control" v-model="active_note_description">
            </div>
          </td>
          <td>
            <div>{{ note.created_at }}</div>
          </td>
          <td>
            <div>{{ note.updated_at }}</div>
          </td>
          <td>
            <button v-if="checkIfEditable(note)" type="button" class="btn btn-secondary" @click="editNote(note)"><i class="fas fa-edit"></i></button> 
            <button v-if="!checkIfEditable(note)" type="button" class="btn btn-success" @click="saveNote(note)"><i class="fas fa-check"></i></button> 
            <button type="button" class="btn btn-danger" @click="deleteNote(note)"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        props: ['active_module'],

        data() {
            return {
                // notes: [],
                noteIconStatus: '',
                active_note: '',
                active_note_title: '',
                active_note_description: '',
            }
        },

        created() {
            this.getNotes();
        },

        methods : {
            getNotes() {
                this.$store.dispatch('getNotes')

                // console.log('store.getters.getNotes', this.$store.getters.getNotes)
                // axios
                //   .get('api/notes')
                //   .then(response => (this.notes = response.data))
            },

            deleteNote(note) {
              let self = this;

              if(confirm('Are you sure you want to delete this note?')){
                axios
                .delete('api/notes/'+note.id)
                .then(function(response){
                    self.$store.dispatch('getNotes')
                });
              }
            },

            checkIfEditable(note) {
              if(this.active_note == note.id){
                return false;
              }

              return true;
            },

            editNote(note) {
              this.active_note = note.id;
              this.active_note_title = note.title;
              this.active_note_description = note.description;
            },

            saveNote(note) {
              //reset active note
              let self = this;
              let data = {
                  'title' : this.active_note_title,
                  'description' : this.active_note_description,
                };
              
              axios
                  .put('api/notes/'+note.id, data)
                  .then(function(response){
                    self.$store.dispatch('getNotes')
                    alert('Note has been successfully updated');
                  });

              this.active_note = '';

            }
        },

        computed: {
          ...mapGetters([
            'notes',
          ])
        }
    }
</script>
