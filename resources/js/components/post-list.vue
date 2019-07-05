<template>
  <div class="row">
    <div class="alert alert-danger" v-if="has_error">
      <p>Error, connot get posts list.</p>
    </div>

    <div v-for="post in posts" v-bind:key="post.id" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <div class="card card-default">
        <div class="card-header">{{post.name}}</div>
        <div class="card-body">{{post.text}}</div>
        <div class="card-footer text-muted">{{post.created_at}}</div>
      </div>
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
    }
  }
};
</script>
