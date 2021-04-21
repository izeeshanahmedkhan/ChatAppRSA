<template>
    <form v-show="showForm" class="form-row my-2" action="" @submit="createMessage(message)" enctype="multipart/form-data">
        <div class="form-group col-md-10">
            <label class="sr-only" for="messageContent">Message Content</label>
            <input type="text" v-model="message.content" class="form-control" id="messageContent" placeholder="Type here...">
<!--            <input type="file" class="form-control" id="imageContent" v-on:change="onImageChange">-->
<!--            <a href="">Upload Image</a>-->
        </div>
        <div class="form-group col-md-2">
            <button type="submit" :disabled="!isValid" class="btn btn-primary btn-block" @click.prevent="createMessage(message)">Send</button>
        </div>
    </form>
</template>

<script>
    import {mapGetters} from 'vuex'

        export default {
            name: "CreateMessage",
            data() {
                return {
                    message: {
                        content: '',
                        image: 'asd',
                    },
                }
            },
            methods: {
                // onImageChange(e){
                //     console.log(e.target.files[0]);
                //     this.image = e.target.files[0];
                // },

                createMessage(message) {
                    this.$store.dispatch('createMessage', message).then( () => (
                        this.$store.dispatch('fetchLatestMessages'),
                        message.content = '',
                        message.image = ''
                    ))
                }
            },
            computed: {
                isValid() {
                    return this.message.content !== ''
                },
                ...mapGetters([
                    'messages',
                    'user',
                    'selectedUser',
                    'showForm'
                ])
            },
        }
</script>
