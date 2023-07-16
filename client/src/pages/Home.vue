<template>
  <div class="container">
    <div
      class="row bg-light p-3 mt-4 align-items-center"
      v-for="items in films.data"
      :key="items.id"
    >
      <div class="col-md-6 p-5">
        <img :src="items.image" alt="Film Image" style="width: 75%" />
      </div>
      <div class="col-md-6">
        <h3>{{ items.name }}</h3>
        <span class="badge bg-info mb-3">{{ items.genre.toUpperCase() }}</span>
        <h5>Ticket Price: {{ items.price }}</h5>
        <p>Description: {{ items.description }}</p>
        <router-link class="btn btn-success mt-4" :to="'/films/' + items.id"
          >Show More</router-link
        >
      </div>
    </div>

    <div class="footer mt-3">
      <Pagination :data="films" @changePage="changePage" />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Pagination from "@/components/layout/Pagination.vue";
export default {
  name: "Home",
  components: {
    Pagination,
  },
  data() {
    return {
      films: [],
    };
  },
  async created() {
    await this.loadData();
  },
  methods: {
    async changePage(page) {
      await this.loadData(page);
    },
    async loadData(page = 1) {
      let films = await axios.get(`/films?page=${page}`).catch((e) => {
        console.log(e.response.data.message);
      });

      this.films = films.data.data;
    },
  },
};
</script>

<style></style>
