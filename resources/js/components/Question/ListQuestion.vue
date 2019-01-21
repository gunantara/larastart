<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdmin()">
      <div class="col md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fab fa-pied-piper"></i>
              Question Data
            </h3>

            <div class="card-tools">
              <router-link to="/add_question">
                <button class="btn btn-success">
                  <i class="fas fa-scroll"></i>
                  Add New
                </button>
              </router-link>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>Topic</th>
                  <th>Question</th>
                  <th>A</th>
                  <th>B</th>
                  <th>C</th>
                  <th>D</th>
                  <th>Correct Answer</th>
                  <th>Modify</th>
                </tr>
                <tr v-for="question in getQuestion" :key="question.id">
                  <td>{{question.title}}</td>
                  <td>{{question.question_text}}</td>
                  <td>{{question.a}}</td>
                  <td>{{question.b}}</td>
                  <td>{{question.c}}</td>
                  <td>{{question.d}}</td>
                  <td>{{question.answer}}</td>
                  <td>
                    <router-link to="/edit_question">
                      <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                      </button>
                    </router-link>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="deleteQuestion(question.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>
    <!-- Modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      questions: {},
      form: new Form({
        title: "",
        id: "",
        question_text: "",
        a: "",
        b: "",
        c: "",
        d: "",
        answer: ""
      })
    };
  },
  mounted() {
    this.$store.dispatch("allQuestion");
  },
  computed: {
    getQuestion() {
      return this.$store.getters.getQuestion;
    }
  },
  methods: {
    loadQuestion() {
      if (this.$gate.isAdmin()) {
        this.$store.dispatch("allQuestion");
      }
    },
    deleteQuestion(id) {
      swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        //send request to the server
        if (result.value) {
          this.form
            .delete("api/question/" + id)
            .then(() => {
              swal("Deleted!", "Your file has been deleted.", "success");
              Fire.$emit("AfterCreated");
            })
            .catch(() => {
              swal("Fail!", "Something Wrong", "warning");
            });
        }
      });
    }
  },
  created() {
    this.loadQuestion();
    Fire.$on("AfterCreated", () => {
      this.loadQuestion();
    });
  }
};
</script>


