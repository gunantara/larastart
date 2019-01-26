<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isUser()">
      <div class="col md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Topic Quiz</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Question</label>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit Quiz</button>
            </div>
          </form>
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
    console.log("Component mounted.");
  }
};
</script>


