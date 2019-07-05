<template>
  <div class="container-fluid">
    <h1>
      Admin dashboard
      <router-link
        :to="{ name : 'admin.create-post' }"
        :key="key"
        class="btn btn-outline-success"
      >Add post</router-link>
    </h1>
    <postList v-bind:isAdmin="true"></postList>
  </div>
</template>

<script>
import postList from "../../components/post-list.vue";
export default {
  data() {
    return {
      //
    };
  },
  components: {
    postList
  }
};
</script>
