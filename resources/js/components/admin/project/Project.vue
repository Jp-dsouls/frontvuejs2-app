<template>
  <div class="componentwarpper">
    <div class="warpper">
      <div class="px-5 d-flex justify-content-between">
        <h4 class="d-inline-block font-weight-600">
          <i class="fas fa-box-open mr-3"></i>Mis Proyectos
        </h4>
        <a :href="'/admin/projects/create'">
          <div class="d-inline-block text-3">
            Agregar Nuevos Projectos <i class="fas fa-arrow-right"></i>
          </div>
        </a>
      </div>

      <div class="px-5 mt-5">
        <form class="row">
          <div class="col-4 p-0">
            <h6 class="col-6 d-inline-block text-left pl-0">
              Buscar por Nombre de Proyecto:
            </h6>
            <input
              v-model="filter.name"
              type="text"
              name="name"
              id="name"
              class="form-input col-6 d-inline-block"
              placeholder="Ingrese busqueda"
            />
          </div>
          <div class="col-4 p-0">
            <h6 class="col-6 d-inline-block text-left pl-0">Promotor:</h6>
            <select
              v-model="filter.brand"
              name="brand"
              id="brand"
              class="form-input col-6 d-inline-block"
            >
              <option value="All">Todos</option>
              <option
                v-for="item in data.brands"
                :value="item.brand"
                :key="item - 1"
              >
                {{ item.brand }}
              </option>
            </select>
          </div>

          <div class="col-4 p-0">
            <h6 class="col-6 d-inline-block text-left pl-0">Sector:</h6>
            <select
              v-model="filter.sector"
              name="sector"
              id="sector"
              class="form-input col-6 d-inline-block"
            >
              <option value="All">Todos</option>
              <option
                v-for="item in data.sectors"
                :value="item.sector"
                :key="item - 2"
              >
                {{ item.sector }}
              </option>
            </select>
          </div>
        </form>

        <div class="mt-5">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col" width="5%">No.</th>
                <th scope="col" width="15%">Nombre</th>
                <th scope="col" width="20">Descripcion</th>
                <th scope="col" width="10%" class="text-center">Accion</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(item, index) in projects"
                :key="item.id"
                class="cursor-pointer"
              >
                <th scope="row" @click.self="showDetails(item.id)">
                  {{ index + 1 }}.
                </th>
                <td @click.self="showDetails(item)">{{ item.name }}</td>
                <td @click.self="showDetails(item)">{{ item.description }}</td>
                <td class="text-center">
                  <i
                    @click="openConfirmDeleteModal(item)"
                    class="fas fa-trash-alt text-5 cursor-pointer"
                  ></i>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-if="projects == ''" class="text-7 w-100 text-center">
            <img
              :src="'../img/illustrator/emptyview.png'"
              class="pointer-events-none empty-img"
              alt=""
            />
            <p>No projects found.</p>
          </div>
        </div>
      </div>
    </div>

    <confirm-modal
      v-if="toggleConfirmModal"
      @confirmed="deleteProject"
      @closeConfirmModal="closeConfirmModal"
      :title="confirmModalTitle"
    ></confirm-modal>
    <project-details
      v-if="toggleProjectDetails"
      :project="selectedProject"
      :seller_ratings="selected_seller_ratings"
      @closeProjectDetails="closeDetails"
    ></project-details>
  </div>
</template>

<script>
import ConfirmModal from "../../template/ConfirmModal.vue";
import ProjectDetails from "./subcomponents/Details.vue";

export default {
  components: {
    ConfirmModal,
    ProjectDetails,
  },
  props: ["data"],
  data() {
    return {
      projects: this.data.projects,

      filter: {
        name: "",
        brand: "All",
        category: "All",
      },

      selected_project_id: "",

      toggleProjectDetails: false,
      selectedProject: "",
      selected_seller_ratings: "",

      toggleConfirmModal: false,
      confirmModalTitle: "",
    };
  },
  methods: {
    /* PROJECT DETAILS */
    showDetails(project) {
      this.selectedProject = project;

      /*var arr= [];
            for(var i in this.data.seller_ratings){
                if(this.data.seller_ratings[i].product_id == this.selectedProduct.id){
                    arr.push(this.data.seller_ratings[i]);
                }
            }
            this.selected_seller_ratings = arr;*/

      this.toggleProjectDetails = true;
      document.body.style.overflow = "hidden";
    },
    closeDetails() {
      this.selectedProject = "";
      this.toggleProjectDetails = false;
      document.body.style.overflow = "auto";
    },

    /* DELETE PROJECT */
    openConfirmDeleteModal(project) {
      this.selected_project_id = project.id;
      this.confirmModalTitle =
        "Are you sure you want to delete " + project.name + "?";
      this.toggleConfirmModal = true;
      document.body.style.overflow = "hidden";
    },
    closeConfirmModal() {
      this.toggleConfirmModal = false;
      document.body.style.overflow = "auto";
    },
    deleteProject() {
      axios
        .delete("/admin/projects", {
          data: {
            project_id: this.selected_project_id,
          },
        })
        .then((response) => {
          console.log(response.data);
          this.closeConfirmModal();
          window.location.href = "/admin/projects";
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    /* FILTER PROJECT */
    filterProject() {
      var filteredproj = [];
      if (this.filter.brand == "All" && this.filter.category == "All") {
        for (var project in this.data.projects) {
          if (
            this.data.projects[project].name
              .toLowerCase()
              .includes(this.filter.name.toLowerCase())
          ) {
            filteredproj.push(this.data.projects[project]);
          }
        }
        this.projects = filteredproj;
      } else if (this.filter.brand != "All" && this.filter.category == "All") {
        for (var project in this.data.projects) {
          if (
            this.data.projects[project].name
              .toLowerCase()
              .includes(this.filter.name.toLowerCase()) &&
            this.data.projects[project].brand.toLowerCase() ==
              this.filter.brand.toLowerCase()
          ) {
            filteredproj.push(this.data.projects[project]);
          }
        }
        this.projects = filteredproj;
      } else if (this.filter.brand == "All" && this.filter.category != "All") {
        for (var project in this.data.projects) {
          if (
            this.data.projects[project].name
              .toLowerCase()
              .includes(this.filter.name.toLowerCase()) &&
            this.data.projects[project].subcategory2.toLowerCase() ==
              this.filter.category.toLowerCase()
          ) {
            filteredproj.push(this.data.projects[project]);
          }
        }
        this.projects = filteredproj;
      } else if (this.filter.brand != "All" && this.filter.category != "All") {
        for (var project in this.data.projects) {
          if (
            this.data.projects[project].name
              .toLowerCase()
              .includes(this.filter.name.toLowerCase()) &&
            this.data.projects[project].brand.toLowerCase() ==
              this.filter.brand.toLowerCase() &&
            this.data.projects[project].subcategory2.toLowerCase() ==
              this.filter.category.toLowerCase()
          ) {
            filteredproj.push(this.data.projects[project]);
          }
        }
        this.projects = filteredprod;
      }
    },
  },
  watch: {
    "filter.name": function (newVal, oldVal) {
      this.filterProject();
    },
    "filter.brand": function (newVal, oldVal) {
      this.filterProject();
    },
    "filter.category": function (newVal, oldVal) {
      this.filterProject();
    },
  },
  mounted() {
    console.log(this.data);
  },
};
</script>

<style>
.form-input {
  background-color: transparent;
  color: #333333;
  border: 2px solid #999999;
  padding: 5px;
  border-radius: 0;
  width: 100%;
}
.form-input:focus {
  background-color: transparent;
  color: #333333;
  border: 2px solid #333333;
  padding: 5px;
  border-radius: 0;
  width: 100%;
}
.form-input::placeholder {
  color: #999999;
}

.empty-img {
  opacity: 0.8;
}
</style>
