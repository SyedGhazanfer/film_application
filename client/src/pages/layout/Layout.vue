<template>
  <div class="main">
    <Navbar></Navbar>
    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from "@/components/layout/Navbar.vue";
export default {
  name: "layout",
  components: {
    Navbar,
  },
};
</script>

<style></style>
