<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdmin()">
      <div class="col md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fab fa-pied-piper"></i>
              Topics Data
            </h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal()">
                Add New
                <i class="fab fa-pied-piper"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>Topic</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Modify</th>
                </tr>
                <tr v-for="topic in getTopic" :key="topic.id">
                  <td>{{topic.title}}</td>
                  <td>{{topic.created_at | myDate}}</td>
                  <td>{{topic.updated_at | myDate}}</td>
                  <td>
                    <button type="button" class="btn btn-primary btn-sm" @click="editModal(topic)">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button
                      type="button"
                      class="btn btn-danger btn-sm"
                      @click="deleteTopic(topic.id)"
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

    <!-- Modal tambah topic -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New Topic</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewLabel">Edit Topic Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateTopic() :createTopics()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.title"
                  type="text"
                  name="title"
                  placeholder="Title"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('title') }"
                >
                <has-error :form="form" field="title"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
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
  mounted() {
    this.$store.dispatch("allTopic");
  },
  computed: {
    getTopic() {
      return this.$store.getters.getTopic;
    }
  },
  methods: {
    loadTopic() {
      if (this.$gate.isAdmin()) {
        this.$store.dispatch("allTopic");
      }
    },
    createTopics() {
      this.$Progress.start();
      this.form
        .post("api/topic")
        .then(() => {
          Fire.$emit("AfterCreated");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "Topic created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          toast({
            type: "error",
            title: "Something wrong when create a topic"
          });
        });
    },
    updateTopic() {
      //console.log("Editing Data");
      this.$Progress.start();
      this.form
        .put("api/topic/" + this.form.id)
        .then(() => {
          $("#addNew").modal("hide");
          swal("Updated!", "Your file has been Updated.", "success");
          Fire.$emit("AfterCreated");
          this.$Progress.finish();
        })
        .catch(() => {
          swal("Fail!", "Something Wrong", "warning");
          this.$Progress.fail();
        });
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    editModal(topic) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(topic);
    },
    newModalQuestion() {
      //this.editmode = false;
      //this.form.reset();
      $("#addNewQuestion").modal("show");
    },
    deleteTopic(id) {
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
            .delete("api/topic/" + id)
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
    this.loadTopic();
    Fire.$on("AfterCreated", () => {
      this.loadTopic();
    });
    //console.log("Component mounted.");
  }
};
</script>
