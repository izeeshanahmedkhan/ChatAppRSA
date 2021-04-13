<template>
    <div v-if="messages.length != 0" class="card card-body overflow-auto" id="message-box">
        <p class="mb-0" v-for="message in messages"><b>{{ message.username }}</b>: {{ message.content }}</p>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

        export default {
            name: "Messages",
            created() {
                this.fetchMessages();
                this.timer = setInterval(this.fetchMessages, 5000)
            },
            methods: {
                fetchMessages() {
                    this.$store.dispatch('fetchMessages')
                }
            },
            computed: {
                ...mapGetters([
                    'messages',
                    'selectedUser'
                ])
            },
            watch: {
                'selectedUser': 'fetchMessages'
            },
        }
</script>
