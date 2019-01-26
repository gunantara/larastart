<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isUser()">
      <div v-for="question in getListQuiz" :key="question.id" class="col-md-4">
        <div class="card card-info card-outline">
          <div class="card-header">
            <h3 class="card-title">{{question.title}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div
            class="card-body"
            style="display: block;"
          >Point Setiap Pertanyaan : {{question.per_q_mark}}</div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="card-tools">
              <router-link to="/attemptquiz">
                <button class="btn btn-success">
                  <i class="fas fa-scroll"></i>
                  Take Quiz
                </button>
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="!$gate.isUser()">
      <not-found></not-found>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch("AllQuizzes");
  },
  computed: {
    getListQuiz() {
      return this.$store.getters.getListQuiz;
    }
  },
  methods: {
    loadQuiz() {
      if (this.$gate.isUser()) {
        this.$store.dispatch("AllQuizzes");
      }
    }
  },
  created() {
    this.loadQuiz();
    Fire.$on("AfterCreated", () => {
      this.loadQuiz();
    });
  }
};
</script>


