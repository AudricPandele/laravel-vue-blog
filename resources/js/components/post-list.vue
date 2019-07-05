<template>
  <div class="row">
    <div class="alert alert-danger" v-if="has_error">
      <p>Error, connot get posts list.</p>
    </div>

    <div v-for="post in posts" v-bind:key="post.id" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <postItem v-bind:key="post._id" v-bind:post="post" v-bind:isAdmin="isAdmin"></postItem>
      <br />
    </div>
  </div>
</template>

<script>
import postItem from "./post-item";
export default {
  props: ["isAdmin"],
  data() {
    return {
      has_error: false,
      posts: null
    };
  },
  mounted() {
    this.getPosts();
  },
  components: {
    postItem
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
