export default {
    state: {
        topics: [],
        questions: []
    },
    getters: {
        getTopic(state) {
            return state.topics
        },
        getQuestion(state) {
            return state.questions
        }
    },
    actions: {
        allTopic(context) {
            axios.get("api/topic").then((response) => {
                context.commit('topics', response.data.topics)
            })
        },
        allQuestion(context) {
            axios.get("api/question").then((response) => {
                console.log(response.data.questions)
                context.commit('questions', response.data.questions)
            })
        }
    },
    mutations: {
        topics(state, data) {
            return state.topics = data
        },
        questions(state, data) {
            return state.questions = data
        }
    }
}