<template>
    <div v-if="active_module=='create-note'">
        <button class="btn btn-success mt-2" @click="saveNotes">Save</button>

        <table class="table table-sm mt-2">
          <thead>
            <tr>
              <th scope="col" style="width:15%">Title</th>
              <th scope="col" style="width:80%">Description</th>
              <th scope="col" style="width:5%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(note, key) in notes" v-bind:key="key">
              <td><input type="" class="form-control" v-model="note.title"></td>
              <td><input type="" class="form-control" v-model="note.description"></td>
              <td>
                <button type="button" class="btn btn-success" @click="addNoteInput()"><i class="fas fa-plus"></i></button> 
                <button v-if="key>0" type="button" class="btn btn-danger" @click="deleteNoteInput(note)"><i class="fas fa-minus"></i></button> 
              </td>
            </tr>
          </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['active_module'],
        data() {
            return {
                notes: [
                  {
                    'title': '',
                    'description': '',
                  }
                ],
            }
        },

        created() {
        },

        methods : {
            saveNotes : function(){
              console.log(this.notes)
                let self = this;
                let data = {
                    'title' : this.title,
                    'description' : this.description,
                  };

                axios
                  .post('api/notes/', this.notes)
                  .then(function(response){
                    
                    alert('Note has been successfully created!');

                    self.$store.dispatch('getNotes')
                    self.notes = [
                      {
                        'title': '',
                        'description': '',
                      }
                    ];
                  });
            },

            addNoteInput : function(){
              this.notes.push({
                    'title': '',
                    'description': '',
                  });
            },

            deleteNoteInput : function(input){
              let key = this.notes.indexOf(input);

              this.notes.splice(key, 1);
            }
        },
    }
</script>
