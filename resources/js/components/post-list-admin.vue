<template>
  <div class="row">
    <div class="alert alert-danger" v-if="has_error">
      <p>Error, connot get posts list.</p>
    </div>

    <div v-for="post in posts" v-bind:key="post.id" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="card card-default">
        <div class="card-header">
          <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{{post.name}}</div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
              <button class="btn btn-outline-primary">Edit</button>
            </div>
          </div>
        </div>
        <div class="card-body">{{post.text}}</div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{{post.created_at}}</div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
              <button v-on:click="deletePost(post._id)" class="btn btn-outline-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <br />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      has_error: false,
      posts: null
    };
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      this.$http({
        url: `posts`,
        method: "GET"
      }).then(
        res => {
          this.posts = res.data.posts;
        },
        () => {
          this.has_error = true;
        }
      );
    },

    deletePost: function(id) {
      this.$http({
        url: `posts/` + id,
        method: "DELETE"
      }).then(
        res => {
          this.posts = res.data.posts;
          this.getPosts();
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>
