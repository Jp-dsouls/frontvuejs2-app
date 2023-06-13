<template>
  <div class="category">
    <h4 class="category__title">
      <span class="py-1">
        <span
          class="d-flex justify-content-between align-items-center"
          :style="{
            maxWidth: `calc(${sizeCols.categories} - 15px)`,
          }"
        >
          <span>
            {{ category.name }}
          </span>
          <Button
            :title="`Agregar nueva categoría a '${category.name}'`"
            class="p-button-sm p-button-info p-button-text"
            @click="openAddCategory()"
          >
            <i class="pi pi-plus mr-2"></i>
            Agregar
          </Button>
        </span>
      </span>
    </h4>
    <ul class="category__list">
      <!-- Si tiene categorias hijas -->
      <template v-if="category.categories && category.categories.length > 0">
        <li
          v-for="(subcat, idx) in category.categories"
          :key="'cat' + category.name + idx + subcat.name"
          class="category__item"
        >
          <MatrixItem
            :categoryEdited="subcat"
            :stakeHolders="stakeHolders"
            :beneficiaries="beneficiaries"
            @updateComponent="$emit('updateComponent', $event)"
          ></MatrixItem>
        </li>
      </template>
      <!-- Si tiene items -->
      <template v-if="category.items && category.items.length > 0">
        <li
          v-for="(item, idx) in category.items"
          :key="'cat' + category.name + idx + item.name"
          class="category__item category__selectable"
        >
          <div
            class="row__matrix"
            :style="{
              gridTemplateColumns: `calc(${sizeCols.categories} - 15px) 1fr`,
            }"
          >
            <div class="row__left" :style="{ maxWidth: sizeCols.categories }">
              {{ item.name }}
            </div>
            <div class="row__right selectable__cols">
              <tr>
                <!-- Stakeholders -->
                <template v-if="item.stakeholders">
                  <td
                    v-for="(stakeholder, stakeIdx) in item.stakeholders"
                    :key="
                      category.name + stakeholder.actorSocial + idx + stakeIdx
                    "
                    class="text-center"
                    :style="{
                      verticalAlign: 'middle',
                      maxWidth: sizeCols.others,
                      width: sizeCols.others,
                      minWidth: sizeCols.others,
                    }"
                  >
                    <Three-state-checkbox
                      v-model="stakeholder.statusChecked"
                      @update:value="
                        ($event) => (stakeholder.statusChecked = $event)
                      "
                    />
                  </td>
                </template>
                <!-- Beneficiarios -->
                <template v-if="item.beneficiaries">
                  <td
                    v-for="(beneficiary, beneIdx) in item.beneficiaries"
                    :key="category.name + beneficiary.actor + idx + beneIdx"
                    class="text-center"
                    :style="{
                      verticalAlign: 'middle',
                      maxWidth: sizeCols.others,
                      width: sizeCols.others,
                      minWidth: sizeCols.others,
                    }"
                  >
                    <Three-state-checkbox
                      v-model="beneficiary.statusChecked"
                      @update:value="
                        ($event) => (beneficiary.statusChecked = $event)
                      "
                    />
                  </td>
                </template>
              </tr>
            </div>
          </div>
        </li>
      </template>
      <li class="category__item category__selectable row__left">
        <div class="d-flex align-items-center" :style="{ gap: '5px' }">
          <Button
            :title="`Agregar item a '${category.name}'`"
            class="p-button-sm p-button-info"
            @click="openAddItem"
          >
            <i class="pi pi-plus mr-2"></i>
            Agregar item
          </Button>
          ... <span :style="{ fontSize: '10px' }">{{ category.name }}</span>
        </div>
      </li>
    </ul>

    <Dialog :visible.sync="dialog" :modal="true">
      <template #header>
        <strong>{{ titleDialog }}</strong>
      </template>
      <form
        ref="compromiso"
        @submit.stop.prevent="isCategory ? saveCategory() : saveItem()"
      >
        <b-container class="p-2">
          <span class="d-flex">
            <TextArea
              class="p-inputtext-sm w-100"
              type="text"
              v-model="name"
              placeholder="Título"
            />
          </span>
        </b-container>
      </form>
      <template #footer>
        <Button class="p-button-text p-button-info" label="Cancelar" />
        <Button
          label="Guardar"
          class="p-button-info"
          @click="isCategory ? saveCategory() : saveItem()"
          autofocus
        />
      </template>
    </Dialog>
  </div>
</template>

<script>
import PrimeVue from 'primevue/config';
import ThreeStateCheckbox from "./../../components/Checkbox/ThreeStateCheckbox.vue";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import TextArea from "primevue/textarea";
import { sizeCols, nuevoItem, nuevoCategoria } from "./defaultData";
import { BContainer } from "bootstrap-vue";

export default {
  name: "MatrixItem",
  components: { ThreeStateCheckbox, Dialog, Button, TextArea, BContainer,PrimeVue },
  emits: ["updateComponent"],
  props: {
    categoryEdited: {
      type: Object,
      default: () => {
        return {};
      },
    },
    stakeHolders: {
      type: Array,
      default: () => [],
    },
    beneficiaries: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      category: this.$props.categoryEdited,
      sizeCols: sizeCols,
      dialog: false,
      name: "",
      isCategory: false,
    };
  },
  computed: {
    titleDialog() {
      return this.isCategory ? "Agregar nueva categoría" : "Agregar nuevo Item";
    },
  },
  created() {
    this.formatItems();
  },
  methods: {
    formatItems() {
      if (!this.category || !this.category.items) return;
      this.category.items = this.category.items.map((cat) => {
        return {
          ...cat,
          beneficiaries: this.$props.beneficiaries.map((bene) => {
            const oldBeneficiario = cat.beneficiaries
              ? cat.beneficiaries.find((old) => old.actor == bene.actor)
              : null;
            return {
              ...bene,
              statusChecked: oldBeneficiario
                ? oldBeneficiario.statusChecked
                : 0,
            };
          }),
          stakeholders: this.$props.stakeHolders.map((sholder) => {
            const oldBeneficiario = cat.stakeholders
              ? cat.stakeholders.find(
                  (old) => old.actorSocial == sholder.actorSocial
                )
              : null;
            return {
              ...sholder,
              statusChecked: oldBeneficiario
                ? oldBeneficiario.statusChecked
                : 0,
            };
          }),
        };
      });
    },
    openAddCategory() {
      this.isCategory = true;
      this.dialog = true;
    },
    openAddItem() {
      this.isCategory = false;
      this.dialog = true;
    },
    saveItem() {
      if (!this.category.items) this.category.items = [];
      this.category.items.push({ ...nuevoItem, name: this.name });
      this.formatItems();
      this.dialog = false;
      this.isCategory = false;
      console.log(this.category);
      this.name = "";
    },
    saveCategory() {
      if (!this.category.categories) this.category.categories = [];
      this.category.categories.push({ ...nuevoCategoria, name: this.name });
      this.formatItems();
      this.dialog = false;
      this.isCategory = false;
      this.name = "";
      console.log("category", this.category);
      this.$emit("updateComponent", this.category);
    },
    onChecked($event) {
      console.log($event);
    },
  },
};
</script>

<style>
.category__title {
  font-size: 12px;
  margin-bottom: 0;
  padding-top: 3px;
  padding-bottom: 3px;
}

.category__item {
  font-size: 12px;
}

.category__selectable {
  box-sizing: border-box;
}

.category__list {
  margin-left: 0;
  padding-left: 0;
  list-style: none;
}

.row__matrix {
  display: grid;
}

.category__title,
.row__matrix {
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.row__left {
  padding-top: 5px;
  padding-bottom: 5px;
  padding-left: 10px;
}
.selectable__cols tr {
  height: 100%;
  display: flex;
}
.selectable__cols tr td {
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

.p-button-sm {
  padding: 3px 6px !important;
  font-size: 12px !important;
}
.p-button-sm i {
  font-size: 11px;
}
</style>
