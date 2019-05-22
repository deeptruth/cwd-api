<template>
  <div>
    <i v-if="note.status==1" class="far fa-check-circle text-success" @click="updateStatus(note)" style="cursor:pointer"></i>
    <i v-if="note.status==0" class="far fa-circle text-dark" @click="updateStatus(note)" style="cursor:pointer"></i>
  </div>
</template>

<script>

    export default {
        props: ['note'],
        data() {
            return {
            }
        },

        created() {

        },

        methods : {
          updateStatus : function(note){
            let data = {
                'status' : note.status == 1 ? 0 : 1
              };

            axios
              .put('api/notes/'+note.id, data)
              .then(function(response){
                alert('Note has been successfully updated!')
              });

            this.$store.dispatch('getNotes')
          }
        },
    }
</script>
