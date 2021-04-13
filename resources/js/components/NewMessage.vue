<template>
    <div>
        <div class="my-2">
            <button class="btn btn-primary btn-block" data-toggle="collapse" href="#contactListCollapse" role="button" aria-expanded="false" aria-controls="contactListCollapse" id="newMessageButton" @click="onClick($event)">New Message</button>
        </div>
        <div class="collapse my-2" id="contactListCollapse">
            <div class="card card-body">
                <div class="form-group">
                    <label for="contactList">Contacts</label>
                    <select class="form-control" id="contactList" name="selectedUser" @change="onChange($event)">
                        <option hidden disabled selected value> -- select an option -- </option>
                        <option v-for="user in contacts" :value="user.id">{{ user.username }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

        export default {
            name: "NewMessage",
            mounted() {
                this.$store.dispatch('fetchContacts')
            },
            methods: {
                onClick(event) {
                    this.$store.dispatch('setNewMessageMode', true)
                    this.$store.dispatch('flushMessages')
                    this.$store.dispatch('setSelectedUser', 0)
                },
                onChange(event) {
                    this.$store.dispatch('setSelectedUser', event.target.value)
                },
                toggleCollapsible(val, oldVal) {
                    if (val == false) {
                        //
                    }
                }
            },
            computed: {
                ...mapGetters([
                    'contacts',
                    'newMessageMode'
                ])
            },
            watch: {
                'newMessageMode': 'toggleCollapsible'
            },
        }
</script>
