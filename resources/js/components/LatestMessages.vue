<template>
    <div class="list-group">
        <a v-for="latestMessage in latestMessages" @click="onClick(latestMessage.connected_user_id)" href="#" class="list-group-item list-group-item-action flex-column align-items-start connected-users" data-toggle="list">
            <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ latestMessage.connected_user }}</h5>
            <small>{{ latestMessage.created_at }}</small>
            </div>
            <p class="mb-1">{{ latestMessage.content }}</p>
        </a>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

        export default {
            name: "LatestMessages",
            created() {
                this.$store.dispatch('setUser', this.$user)
            },
            mounted() {
                this.fetchLatestMessages();
                this.timer = setInterval(this.fetchLatestMessages, 5000)
            },
            methods: {
                fetchLatestMessages() {
                    this.$store.dispatch('fetchLatestMessages')
                },
                onClick(selectedUser) {
                    this.$store.dispatch('setSelectedUser', selectedUser)
                    this.$store.dispatch('setNewMessageMode', false)
                },
                disableListItems() {
                    let children = this.$el.querySelectorAll('.connected-users')
                    children.forEach(child => {
                        child.classList.remove('active')
                    })
                }
            },
            computed: {
                ...mapGetters([
                    'user',
                    'selectedUser',
                    'latestMessages',
                    'newMessageMode'
                ])
            },
            watch: {
                'newMessageMode': 'disableListItems'
            }
        }
</script>
