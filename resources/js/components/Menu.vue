<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <router-link class="nav-link" :to="{name: 'home'}">Figured Test</router-link>
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarText"
      aria-controls="navbarText"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <!--UNLOGGED-->
        <li
          class="nav-item active"
          v-if="!$auth.check()"
          v-for="(route, key) in routes.unlogged"
          v-bind:key="route.path"
        >
          <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </li>
        <!--LOGGED USER-->
        <li
          class="nav-item active"
          v-if="$auth.check(1)"
          v-for="(route, key) in routes.user"
          v-bind:key="route.path"
        >
          <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </li>
        <!--LOGGED ADMIN-->
        <li
          class="nav-item active"
          v-if="$auth.check(2)"
          v-for="(route, key) in routes.admin"
          v-bind:key="route.path"
        >
          <router-link class="nav-link" :to="{ name : route.path }" :key="key">{{route.name}}</router-link>
        </li>
        <!--LOGOUT-->
        <li class="nav-item active" v-if="$auth.check()">
          <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</template>
<script>
export default {
  data() {
    return {
      routes: {
        // UNLOGGED

        unlogged: [
          {
            name: "Register",
            path: "register"
          },
          {
            name: "Login",
            path: "login"
          }
        ],

        // LOGGED USER

        user: [
          {
            name: "Dashboard",
            path: "dashboard"
          }
        ],

        // LOGGED ADMIN

        admin: [
          {
            name: "Dashboard",
            path: "admin.dashboard"
          }
        ]
      }
    };
  },
  mounted() {
    //
  }
};
</script>
