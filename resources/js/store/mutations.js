let mutations = {
    SET_USER(state, user) {
        state.user = user
    },
    SET_SELECTED_USER(state, selectedUser) {
        state.selectedUser = selectedUser
    },
    SET_SHOW_FORM(state, showForm) {
        state.showForm = showForm
    },
    SET_NEW_MESSAGE_MODE(state, newMessageMode) {
        state.newMessageMode = newMessageMode
    },
    FETCH_LATEST_MESSAGES(state, latestMessages) {
        return state.latestMessages = latestMessages
    },
    FETCH_MESSAGES(state, messages) {
        return state.messages = messages
    },
    FLUSH_MESSAGES(state) {
        return state.messages = []
    },
    CREATE_MESSAGE(state, message) {
        state.messages.push(message)
    },
    FETCH_CONTACTS(state, contacts) {
        return state.contacts = contacts
    },
    DELETE_MESSAGE(state, message) {
        let index = state.messages.findIndex(item => item.id === message.id)
        state.messages.splice(index, 1)
    }
}
export default mutations