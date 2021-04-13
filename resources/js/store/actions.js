let actions = {
    setUser({commit}, user) {
        commit('SET_USER', user)
    },
    setUsername({commit}, username) {
        commit('SET_USERNAME', username)
    },
    setSelectedUser({commit}, selectedUser) {
        commit('SET_SELECTED_USER', selectedUser)
    },
    setNewMessageMode({commit}, newMessageMode) {
        commit('SET_NEW_MESSAGE_MODE', newMessageMode)
    },
    fetchLatestMessages({commit}) {
        const user = this.state.user
        axios.get(`/api/messages/${user}`)
            .then(res => {
                commit('FETCH_LATEST_MESSAGES', res.data)
            })
            .catch(err => {
                console.log(err)
            })
    },
    createMessage({commit}, message) {
        message.author = this.state.user
        message.recipient = this.state.selectedUser
        return axios.post('/api/messages', message)
            .then(res => {
                commit('CREATE_MESSAGE', res.data)
            }).catch(err => {
            console.log(err)
        })
    },
    fetchMessages({commit}) {
        const user = this.state.user
        const selectedUser = this.state.selectedUser
        if (selectedUser != 0) {
            axios.get(`/api/messages/${user}/${selectedUser}`)
                .then(res => {
                    commit('FETCH_MESSAGES', res.data)
                    commit('SET_SHOW_FORM', true)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    },
    flushMessages({commit}) {
        commit('FLUSH_MESSAGES')
    },
    fetchContacts({commit}) {
        const user = this.state.user
        axios.get(`/api/users/${user}/contacts/`)
            .then(res => {
                commit('FETCH_CONTACTS', res.data)
            })
            .catch(err => {
                console.log(err)
            })
    },
}

export default actions