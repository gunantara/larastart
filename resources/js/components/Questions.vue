<template>
  <div class="container">
    <div class="row mt-4" v-if="$gate.isAdmin()">
      <div v-for="topic in topics" :key="topic.id" class="col-md-4">
        <div class="card card-info card-outline">
          <div class="card-header">
            <h3 class="card-title">{{topic.title}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
            <p>Example</p>
            <div class="card-tools">
              <button class="btn btn-success">
                Add Question
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      topics: {},
      form: new Form({
        id: "",
        title: ""
      })
    };
  },
  methods: {
    loadTopic() {
      if (this.$gate.isAdmin()) {
        axios.get("api/topic").then(({ data }) => (this.topics = data));
      }
    }
  },
  created() {
    this.loadTopic();
    console.log("Component mounted.");
  }
};
</script>
