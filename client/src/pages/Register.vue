<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="container mt-4 p-5 bg-light">
          <div id="user_form_error" v-html="message"></div>
          <form v-on:submit.prevent="submitForm">
            <div class="mb-3 mt-3">
              <label for="" class="form-label">Name</label>
              <input
                required
                type="text"
                class="form-control"
                name="name"
                placeholder="John"
                v-model="register.name"
              />
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Email</label>
              <input
                required
                type="email"
                class="form-control"
                name="email"
                v-model="register.email"
                placeholder="abc@xyz.com"
              />
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input
                required
                type="password"
                class="form-control"
                name="password"
                placeholder="Password"
                v-model="register.password"
              />
            </div>
            <div class="mb-3">
              <router-link to="login">I have an account</router-link>
            </div>
            <div class="mb-3 text-end">
              <button type="submit" class="mt-3 btn w-25 btn-outline-success">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Register",
  data() {
    return {
      register: {
        name: null,
        email: null,
        password: null,
      },
      message: "",
    };
  },
  methods: {
    async submitForm() {
      let register = await axios.post("/register", this.register).catch((e) => {
        this.message = `<div id="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Oops! </strong> ${e.response.data.message}
                                </div>`;
        setTimeout(() => {
          this.message = null;
          this.$router.push("/home");
        }, 500);
      });

      if (register) {
        console.log(register);
        this.message = `<div id="error" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <strong>Success! </strong> ${register.data.message}
                                </div>`;

        localStorage.setItem("user", JSON.stringify(register.data.data));
        localStorage.setItem("token", register.data.data.token);
        setTimeout(() => {
          this.message = null;
        }, 2000);
      }
    },
  },
};
</script>

<style></style>
