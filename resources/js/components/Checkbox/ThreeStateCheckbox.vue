<template>
  <div class="row__tree_state">
    <span
      class="checkbox"
      :class="{
        neutral: status == 0,
        positive: status == 1,
        negative: status == 2,
      }"
      @click="changeStatus()"
    >
      <svg
        id="i-close"
        viewBox="0 0 32 32"
        width="15"
        height="15"
        fill="none"
        stroke="currentcolor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="10.9375%"
      >
        <path v-if="status == 2" d="M2 20 L12 28 30 4" />
        <path v-if="status == 1" d="M2 30 L30 2 M30 30 L2 2" />
      </svg>
    </span>
    <span class="label">{{ statusText }}</span>
  </div>
</template>

<script>
export default {
  name: "Three-state-checkbox",
  emits: ["update:value"],
  props: {
    value: {
      type: [Number, String, Boolean],
      default: 0,
    },
  },
  data() {
    return {
      status: this.$props.value,
    };
  },
  computed: {
    statusText() {
      if (this.status == 0) return "Indeterminado";
      if (this.status == 1) return "Positivo";
      return "Negativo";
    },
  },
  methods: {
    changeStatus() {
      this.status = parseInt(this.status);
      if (this.status == 2) {
        this.status = 0;
        this.$emit("update:value", this.status)
        return;
      }
      this.status += 1;
      console.log(this.status);
      this.$emit("update:value", this.status)
    },
  },
};
</script>
<style lang="scss">
.row__tree_state {
  display: inline-flex;
  align-items: center;
  user-select: none;
  .label {
    font-size: 10px !important;
    font-weight: 400;
    opacity: 0.8;
    min-width: 77px;
    user-select: none;
    text-align: left;
  }
}
.checkbox {
  background-color: #fff;
  border: solid 1px #d7d7d7;
  border-radius: 4px;
  cursor: pointer;
  display: inline-block;
  height: 25px;
  margin-right: 0.5rem;
  text-align: center;
  width: 25px;
  vertical-align: middle;

  svg {
    margin-top: 6px;
    stroke: #fff;
  }
}

.positive {
  background-color: #4aca65;
  border-color: #43b45b;
}

.negative {
  background-color: #dc4e4e;
  border-color: #c74545;
}
input.input__three_state[type="checkbox"] {
  font-size: 25px;
  cursor: pointer;
}
</style>
