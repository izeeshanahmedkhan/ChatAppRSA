let getters = {
    user: state => {
        return state.user
    },
    selectedUser: state => {
        return state.selectedUser
    },
    messages: state => {
        return state.messages
    },
    latestMessages: state => {
        return state.latestMessages
    },
    contacts: state => {
        return state.contacts
    },
    showForm: state => {
        return state.showForm
    },
    newMessageMode: state => {
        return state.newMessageMode
    },
    image: state => { return state.image},
}

export default  getters