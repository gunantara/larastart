export default {
    state: {
        topics: [],
        questions: [],
        jumlah_users: [],
        jumlah_questions: [],
        jumlah_topics: [],
        quiz: []
    },
    getters: {
        getTopic(state) {
            return state.topics
        },
        getQuestion(state) {
            return state.questions
        },
        getJumlahUser(state) {
            return state.jumlah_users
        },
        getJumlahQuestion(state) {
            return state.jumlah_questions
        },
        getJumlahTopics(state) {
            return state.jumlah_topics
        },
        getListQuiz(state) {
            return state.quiz
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
                context.commit('questions', response.data.questions)
            })
        },
        AllJumlah_Users(context) {
            axios.get("api/banyak_users").then((response) => {
                context.commit('jumlah_users', response.data.jumlah_users)
            })
        },
        AllJumlah_Questions(context) {
            axios.get("api/banyak_question").then((response) => {
                context.commit('jumlah_questions', response.data.jumlah_questions)
            })
        },
        AllJumlah_Topics(context) {
            axios.get("api/banyak_topics").then((response) => {
                context.commit('jumlah_topics', response.data.jumlah_topics)
            })
        },
        AllQuizzes(context) {
            axios.get("api/take_quiz").then((response) => {
                context.commit('quiz', response.data.quiz)
            })
        }
    },
    mutations: {
        topics(state, data) {
            return state.topics = data
        },
        questions(state, data) {
            return state.questions = data
        },
        jumlah_users(state, data) {
            return state.jumlah_users = data
        },
        jumlah_questions(state, data) {
            return state.jumlah_questions = data
        },
        jumlah_topics(state, data) {
            return state.jumlah_topics = data
        },
        quiz(state, data) {
            return state.quiz = data
        }

    }
}