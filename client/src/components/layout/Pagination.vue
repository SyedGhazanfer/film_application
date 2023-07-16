<template>
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li
        class="page-item"
        style="cursor: pointer"
        v-for="items in films"
        :key="items.id"
        :class="items.current_page == items.page ? 'active' : ''"
        aria-current="page"
        @click="changePage(items.page)"
      >
        <a class="page-link">{{ items.page }}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Pagination",
  props: ["data"],
  emits: ["changePage"],
  data() {
    return {
      films: null,
    };
  },
  methods: {
    changePage(value) {
      this.$emit("changePage", value);
    },
  },

  beforeUpdate() {
    let value = this.$props.data;
    let data = [];
    for (let i = 1; i <= value.last_page; i++) {
      let values = {
        page: i,
        current_page: value.current_page,
        last_page: value.last_page,
      };
      data.push(values);
    }
    this.films = data;
  },
};
</script>
