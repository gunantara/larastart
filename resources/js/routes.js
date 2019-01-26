import AdminHome from './components/Dashboard.vue'
import Dashboard from './components/Dashboard.vue'
import Developer from './components/Developer.vue'
import Profile from './components/Profile.vue'
import Users from './components/Users.vue'
import Topic from './components/Topics.vue'
import ListQuestions from './components/Question/ListQuestion.vue'
import EditQuestions from './components/Question/EditQuestion.vue'
import AddNewQuestions from './components/Question/AddNewQuestion.vue'
import NotFound from './components/NotFound.vue'
import ListQuiz from './components/Quiz/ListQuiz.vue'
import AttemptQuiz from './components/Quiz/TakeQuiz.vue'

export const routes = [
    {
        path: '/home', component: AdminHome
    },
    {
        path: '/dashboard', component: Dashboard
    },
    {
        path: '/developer', component: Developer
    },
    {
        path: '/profile', component: Profile
    },
    {
        path: '/users', component: Users
    },
    {
        path: '/topic', component: Topic
    },
    {
        path: '/option', name: 'option', component: ListQuestions
    },
    {
        path: '/add_question', name: 'add_question', component: AddNewQuestions
    },
    {
        path: '/edit-question:questionid', name: 'edit_question', component: EditQuestions
    },
    {
        path: '*', component: NotFound
    },
    {
        path: '/quiz', component: ListQuiz
    },
    {
        path: '/attemptquiz', component: AttemptQuiz
    }

]