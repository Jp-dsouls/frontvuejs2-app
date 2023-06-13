<template>
  <div class="categories__wrapper">
    <table class="table w-100 d-inline-flex mb-0">
      <thead>
        <tr>
          <th
            id="categories"
            :rowspan="hasColumns ? '2' : '1'"
            :style="{
              width: sizeCols.categories,
              maxWidth: sizeCols.categories,
              minWidth: sizeCols.categories,
            }"
          >
            {{ "Categorias" }}
          </th>
          <template v-if="hasColumns">
            <th
              v-if="hasStakeholders"
              :colspan="stakeHolders.length"
              class="text-center"
            >
              {{ "Stakeholders" }}
            </th>
            <th
              v-if="hasBeneficiaries"
              :colspan="beneficiaries.length"
              class="text-center"
            >
              {{ "Beneficiarios" }}
            </th>
          </template>
          <th v-else></th>
        </tr>
        <tr v-if="hasColumns">
          <th
            v-for="(stakeholder, idx) in stakeHolders"
            :key="stakeholder.actorSocial + idx"
            class="text-center"
            colspan="1"
            :id="stakeholder.actorSocial + idx"
            :style="{
              maxWidth: sizeCols.others,
              width: sizeCols.others,
              minWidth: sizeCols.others,
              padding: '5px 2px',
              fontSize: '10px',
            }"
          >
            {{ stakeholder.actorSocial }}
          </th>
          <th
            v-for="(beneficiary, idx) in beneficiaries"
            :key="beneficiary.actor + idx"
            class="text-center"
            colspan="1"
            :id="beneficiary.actor + idx"
            :style="{
              maxWidth: sizeCols.others,
              width: sizeCols.others,
              minWidth: sizeCols.others,
              padding: '5px 2px',
              fontSize: '10px',
            }"
          >
            {{ beneficiary.actor }}
          </th>
        </tr>
      </thead>
    </table>
    <div
      v-for="(category, idx) in matrixData"
      :key="category.name + idx"
      class="category__row"
    >
      <MatrixItem
        :key="baseIndex"
        :categoryEdited="category"
        :stakeHolders="stakeHolders"
        :beneficiaries="beneficiaries"
        @updateComponent="updateComponent"
      />
    </div>
  </div>
</template>

<script>
import {
  defaultStakeholders,
  defaultBeneficiaries,
  sizeCols,
} from "./defaultData";
import MatrixItem from "./MatrixItem.vue";

export default {
  components: {
    MatrixItem,
  },
  emits: ["update:value"],
  props: {
    stakeHolders: {
      type: Array,
      default: () => defaultStakeholders,
    },
    beneficiaries: {
      type: Array,
      default: () => defaultBeneficiaries,
    },
    value: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      sizeCols: sizeCols,
      baseIndex: 55656232,
      matrixData: this.$props.value
    };
  },
  created() {
    // console.log(this.$props);
  },
  computed: {
    hasStakeholders() {
      return this.$props.stakeHolders && this.$props.stakeHolders.length > 0;
    },
    hasBeneficiaries() {
      return this.$props.beneficiaries && this.$props.beneficiaries.length > 0;
    },
    hasColumns() {
      return this.hasStakeholders || this.hasBeneficiaries;
    },
  },
  methods: {
    updateComponent($event) {
      console.log("DATA A GUARDAR", this.matrixData);
      this.$emit("update:value", this.matrixData)
      this.baseIndex += 5
    }
  },
};
</script>

<style>
.categories__wrapper {
  border: 1px solid rgba(0,0,0,.1);
  overflow-x: auto;
  width: auto;
  background: white;
}
.categories__wrapper table,
.categories__wrapper .category__row {
  background: white;
  white-space: nowrap;
  width: 100%;
}
.categories__wrapper > .category__row {
  padding: 5px;
  padding-left: 15px;
  padding-top: 10px;
  display: flex;
}

.categories__wrapper > .category__row > .category > .category__title {
  font-size: 14px;
  font-weight: 800;
  margin-bottom: 4px;
}

.category .category__title,
.category__title .category__title {
  padding-left: 6px;
}
</style>
