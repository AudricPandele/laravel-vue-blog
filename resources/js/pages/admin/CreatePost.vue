<template>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form autocomplete="off" @submit.prevent="createPost" v-if="!success" method="post">
          <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
            <label for="name">Title</label>
            <input type="text" id="name" class="form-control" v-model="name" />
            <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
          </div>
          <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
            <label for="text">Text</label>
            <textarea name id="text" cols="30" rows="10" class="form-control" v-model="text"></textarea>
            <span class="help-block" v-if="has_error && errors.text">{{ errors.text }}</span>
          </div>
          <button type="submit" class="btn btn-outline-success">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      text: "",
      has_error: false,
      error: "",
      errors: {},
      success: false
    };
  },
  methods: {
    createPost: function() {
      let post = { name: this.name, text: this.text };
      this.$http
        .post("posts", post)
        .then(res => {
          this.$router.push({
            name: "admin.dashboard",
            params: { successRegistrationRedirect: true }
          });
        })
        .catch(error => console.log(error));
    }
  }
};
</script>
