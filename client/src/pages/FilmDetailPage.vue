<template>
  <div class="container">
    <div class="row bg-light p-3 mt-4 align-items-center">
      <div class="col-md-6 p-5">
        <img :src="films.image" alt="Film Image" style="width: 75%" />
      </div>
      <div class="col-md-6">
        <h6>Rating: {{ films.rating }}</h6>
        <h3>{{ films.name }}</h3>
        <span class="badge bg-info mb-3">{{ films.genre }}</span>
        <h5>Ticket Price: {{ films.price }}</h5>
        <p>Description: {{ films.description }}</p>
        <p>Release Date: {{ films.release_date }}</p>
        <p>country: {{ films.country }}</p>
      </div>
    </div>
    <comment-section :film_id="films.id"></comment-section>
  </div>
</template>

<script>
import axios from "axios";
import CommentSection from "../components/layout/CommentSection.vue";
export default {
  name: "Home",
  data() {
    return {
      films: [],
    };
  },
  components: {
    CommentSection,
  },
  async created() {
    await this.loadData();
  },
  methods: {
    async loadData() {
      let films = await axios
        .get(`/films/${this.$route.params.id}`)
        .catch((e) => {
          console.log(e.response.data.message);
        });

      this.films = films.data.data;
    },
  },
};
</script>

<style></style>
