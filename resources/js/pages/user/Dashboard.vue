<template>
  <div class="container-fluid">
    <postList v-bind:isAdmin="false"></postList>
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
