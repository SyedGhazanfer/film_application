<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="container mt-4 p-5 bg-light">
          <h3 class="mb-4">Create Film</h3>
          <div id="user_form_error" v-html="message"></div>
          <form v-on:submit.prevent="submitForm">
            <div class="mb-3 mt-3">
              <label for="" class="form-label">Name</label>
              <input
                required
                type="text"
                class="form-control"
                v-model="films.name"
              />
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Description</label>
              <textarea
                v-model="films.description"
                cols="30"
                class="form-control"
                rows="10"
              ></textarea>
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Release Date</label>
              <input
                required
                type="date"
                class="form-control"
                v-model="films.release_date"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Rating</label>
              <input
                required
                type="text"
                class="form-control"
                v-model="films.rating"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Price</label>
              <input
                required
                type="text"
                class="form-control"
                v-model="films.price"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Country</label>
              <input
                required
                type="text"
                class="form-control"
                v-model="films.country"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Genre</label>
              <input
                required
                type="text"
                class="form-control"
                v-model="films.genre"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Image</label>
              <input
                required
                type="file"
                class="form-control"
                accept="image/*"
                @change="handleImageUpload"
              />
            </div>

            <div class="mb-3 text-end">
              <button type="submit" class="mt-3 btn w-25 btn-outline-success">
                Create Film
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "CreateFilm",
  data() {
    return {
      message: null,
      films: {
        name: null,
        description: null,
        release_date: null,
        rating: null,
        price: null,
        country: null,
        genre: null,
        image: null,
      },
    };
  },
  methods: {
    handleImageUpload(event) {
      const file = event.target.files[0];
      this.films.image = file;
    },
    async submitForm() {
      let films = await axios
        .post("/films", this.films, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .catch((e) => {
          this.message = `<div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Oops! </strong> ${e.response.data.message}
                                </div>`;
          setTimeout(() => {
            this.message = null;
            this.$router.push("/home");
          }, 500);
        });

      if (films) {
        console.log(films);
        this.message = `<div id="error" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Success! </strong> ${films.data.message}
                                </div>`;
        setTimeout(() => {
          this.message = null;
          this.$router.push("/");
        }, 2000);
      }
    },
  },
};
</script>

<style></style>
