<template>
  <div class="continer mt-4">
    <h3>Comments</h3>
    <div class="comment-form">
      <div id="user_form_error" v-html="message"></div>
      <form @submit.prevent="submitForm">
        <div id="review_form_error"></div>
        <div class="mb-3">
          <textarea
            rows="5"
            class="form-control"
            name="review"
            id=""
            v-model="data.comments"
          ></textarea>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-info">Give Review</button>
        </div>
      </form>
    </div>

    <div class="card mb-3" v-for="items in comments" :key="items.id">
      <div class="card-header fw-bold">{{ items.users.name }}</div>
      <div class="card-body">
        <p class="card-text">{{ items.comments }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "CommentSection",
  props: ["film_id"],
  data() {
    return {
      data: {
        comments: null,
        film_id: null,
      },
      comments: null,
      message: null,
    };
  },
  async updated() {
    await this.loadData(this.$props.film_id);
    this.data.film_id = this.$props.film_id;
  },
  methods: {
    async submitForm() {
      let comments = await axios.post(`/comments/`, this.data).catch((e) => {
        console.log(e.response.data.message);
      });
      this.data.comments = null;
      this.message = `<div id="error" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Success! </strong> ${comments.data.message}
                                </div>`;
      setTimeout(() => {
        this.message = null;
      }, 2000);
      await this.loadData(this.data.film_id);
    },
    async loadData(id) {
      let comments = await axios.get(`/comments/${id}`).catch((e) => {
        console.log(e.response.data.message);
      });
      this.comments = comments.data.data;
    },
  },
};
</script>

<style></style>
