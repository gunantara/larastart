<template>
  <div class="container">
    <div class="container-fluid">
      <div class="row mt-5" v-if="$gate.isAdmin()">
        <div class="col md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Question</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label>Select Topic</label>
                  <select
                    v-model="form.topic_id"
                    name="topic_id"
                    type="text"
                    placeholder="Choose Topic"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('topic_id') }"
                  >
                    <option value disabled selected>Select One Topic</option>
                    <option
                      :value="topics.id"
                      v-for="topics in getTopic"
                      :key="topics.id"
                    >{{topics.title}}</option>
                  </select>
                  <has-error :form="form" field="topic_id"></has-error>
                </div>
                <div class="form-group">
                  <label for="question_name">Question Text</label>
                  <input
                    v-model="form.question_text"
                    name="question_text"
                    type="text"
                    placeholder="Enter Question Text"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('question_text') }"
                  >
                  <has-error :form="form" field="question_text"></has-error>
                </div>
                <div class="form-group">
                  <label for="a">Answer A</label>
                  <input
                    v-model="form.a"
                    name="a"
                    placeholder="Answer A"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('a') }"
                  >
                  <has-error :form="form" field="a"></has-error>
                </div>
                <div class="form-group">
                  <label for="b">Answer B</label>
                  <input
                    v-model="form.b"
                    name="b"
                    placeholder="Answer B"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('b') }"
                  >
                  <has-error :form="form" field="b"></has-error>
                </div>
                <div class="form-group">
                  <label for="Option3">Answer C</label>
                  <input
                    v-model="form.c"
                    name="Option3"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('Option3') }"
                    placeholder="Answer C"
                  >
                  <has-error :form="form" field="Option3"></has-error>
                </div>
                <div class="form-group">
                  <label for="Option4">Answer D</label>
                  <input
                    v-model="form.d"
                    name="Option4"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('Option4') }"
                    placeholder="Answer D"
                  >
                  <has-error :form="form" field="Option4"></has-error>
                </div>
                <div class="form-group">
                  <label>Select Answer</label>
                  <select v-model="form.answer" class="form-control">
                    <option value disabled selected>Select Correct Answer</option>
                    <option
                      v-for="(item, index) in answer"
                      :value="item.Option"
                      :key="item.index"
                    >Option {{index+1}}</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <router-link to="/option">
                  <button type="submit" class="btn btn-primary" @click="createQuestion()">Submit</button>
                </router-link>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      answer: [
        { Option: "A" },
        { Option: "B" },
        { Option: "C" },
        { Option: "D" }
      ],
      question: {},
      form: new Form({
        topic_id: "",
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
    this.$store.dispatch("allTopic");
  },
  computed: {
    getTopic() {
      return this.$store.getters.getTopic;
    }
  },
  methods: {
    createQuestion() {
      this.$Progress.start();
      this.form
        .post("api/question")
        .then(() => {
          toast({
            type: "success",
            title: "Question created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "error",
            title: "Something wrong when create a Question"
          });
        });
    }
  }
};
</script>


