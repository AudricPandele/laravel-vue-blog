<template>
  <div class="card card-default">
    <div class="card-header">
      <div class="row">
        <div v-if="!isEditing" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{{post.name}}</div>
        <div v-if="isEditing" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
          <input class="form-control" type="text" v-model="post.name" />
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
          <button
            v-if="!isEditing && isAdmin"
            v-on:click="edit()"
            class="btn btn-outline-primary"
          >Edit</button>
          <button
            v-if="isEditing"
            v-on:click="update(post._id)"
            class="btn btn-outline-success"
          >Save changes</button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div v-if="!isEditing" class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{{post.text}}</div>
        <div v-if="isEditing" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <textarea v-model="post.text" class="form-control" rows="8"></textarea>
        </div>
      </div>
    </div>
    <div class="card-footer text-muted">
      <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">Last update : {{post.updated_at}}</div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
          <button
            v-if="isAdmin"
            v-on:click="deletePost(post._id)"
            class="btn btn-outline-danger"
          >Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["post", "isAdmin"],
  data() {
    return {
      has_error: false,
      posts: null,
      isEditing: false
    };
  },
  methods: {
    deletePost: function(id) {
      this.$http({
        url: `posts/` + id,
        method: "DELETE"
      }).then(
        res => {
          this.posts = res.data.posts;
          this.$parent.getPosts();
        },
        () => {
          this.has_error = true;
        }
      );
    },

    edit: function() {
      this.isEditing = true;
    },

    update: function(id) {
      this.$http
        .put("posts/" + id, this.post)
        .then(res => {
          this.$router.push({
            name: "admin.dashboard",
            params: { successRegistrationRedirect: true }
          });
        })
        .catch(error => console.log(error));
      this.isEditing = false;
    }
  }
};
</script>
