<template>
  <div class="container">
    <div class="container-fluid">
      <div class="row mt-5" v-if="$gate.isAdmin()">
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{getJumlahUser}}</h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-plus"></i>
            </div>
            <router-link to="/users" class="small-box-footer">
              More info
              <i class="fa fa-arrow-circle-right"></i>
            </router-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{getJumlahTopics}}</h3>

              <p>Topics Created</p>
            </div>
            <div class="icon">
              <i class="fas fa-scroll"></i>
            </div>
            <router-link to="/topic" class="small-box-footer">
              More info
              <i class="fa fa-arrow-circle-right"></i>
            </router-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{getJumlahQuestions}}</h3>
              <p>Questions Created</p>
            </div>
            <div class="icon">
              <i class="fas fa-chart-bar"></i>
            </div>
            <router-link to="/option" class="small-box-footer">
              More info
              <i class="fa fa-arrow-circle-right"></i>
            </router-link>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch("AllJumlah_Users");
    this.$store.dispatch("AllJumlah_Topics");
    this.$store.dispatch("AllJumlah_Questions");
  },
  methods: {
    loadJumlah() {
      if (this.$gate.isAdmin()) {
        this.$store.dispatch("AllJumlah_Users");
        this.$store.dispatch("AllJumlah_Topics");
        this.$store.dispatch("AllJumlah_Questions");
      }
    }
  },
  computed: {
    getJumlahUser() {
      return this.$store.getters.getJumlahUser;
    },
    getJumlahTopics() {
      return this.$store.getters.getJumlahTopics;
    },
    getJumlahQuestions() {
      return this.$store.getters.getJumlahQuestion;
    }
  },
  created() {
    this.loadJumlah();
    Fire.$on("AfterCreated", () => {
      this.loadJumlah();
    });
  }
};
</script>
