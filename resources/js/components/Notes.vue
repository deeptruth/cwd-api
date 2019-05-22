<template>
    <div>
        <button class="btn btn-primary" @click="toggleModule">Switch to {{ this.reverseModuleName }} Module</button>

        <to-do-notes :active_module="active_module"></to-do-notes>
        <create-note :active_module="active_module"></create-note>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                active_module : 'to-do-list',
                reverseModuleName : 'Note Taking',
            }
        },

        created() {
        },

        methods : {
            toggleModule : function(){
                if(this.active_module == 'to-do-list'){
                    this.reverseModuleName = 'To do list';
                    this.active_module = 'create-note';
                }else{
                    this.reverseModuleName = 'Note Taking';
                    this.active_module = 'to-do-list';
                }
            }
        },
    }
</script>
    