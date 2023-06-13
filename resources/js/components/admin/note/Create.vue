<template>
  <div class="componentwarpper">
    <div class="warpper min-vh-100">
      <div class="content-warpper d-flex justify-content-between">
        <h4 class="d-inline-block font-weight-600">
          Agregar nueva nota
        </h4>

        <a :href="'/admin/notes'">
          <div class="d-inline-block text-3">
            Mis notas <i class="fas fa-arrow-right"></i>
          </div>
        </a>
      </div>

      <div class="step2 mt-5">
        <h6>Ingrese los detalles de la nota:</h6>

        <div class="row">
          <div
            class="d-inline-flex flex-column col-6 justify-content-center align-items-center"
          >
            <img
              id="note-image"
              :src="preview_note_img"
              alt="note image"
              class="cursor-pointer"
              @click="selectImage"
            />
            <p class="mt-2 cursor-pointer" @click="selectImage">
              Carga de adjunto
            </p>
            <input
              ref="fileInput"
              type="file"
              class="d-none"
              @change="onFileChange"
            />
          </div>
          <form class="col-6">
            <div v-if="isSuccess" class="successmsg p-3 my-4">
              <i class="fas fa-check text-9 mr-2"></i> Successfully listed the
              project.
            </div>
            <div v-if="isError" class="errormsg p-3 my-4">
              <i class="fas fa-times text-8 mr-2"></i> {{ errortext }}
            </div>
            <div v-if="isEmpty" class="errormsg p-3 my-4">
              <i class="fas fa-exclamation text-8 mr-2"></i> Please enter all
              the required fields and upload your project's image.
            </div>


            <div class="row">

              <div class="col-6">

                    <label for="projects" class="d-block mt-4 text-7"
                    >Seleccione un proyecto</label
                    >
                    <select
                        name="project-name"
                        id="projects"
                        class="form-control form-control-sm"
                        v-model="note.selectedProject" ref="select"
                        v-on:change="setProject(note.selectedProject)"
                    >
                        <option selected disabled value="">Seleccion</option>
                        <option
                            v-for="project in projects"
                            :value="project.id"
                            :key="project.id"
                        >
                            {{ project.name }}
                        </option>
                    </select>
                </div>

              <div class="col-12">
                <label for="description" class="d-block mt-4 text-7"
                  >Descripcion<span class="text-8">*</span></label
                >
                <input
                  v-model="note.description"
                  type="text"
                  name="description"
                  id="description"
                  class="form-input"
                  placeholder="Ingrese descripcion de la nota*"
                  required
                />
              </div>

            </div>

            <div
              @click="submitRequest"
              class="submit-button d-inline-block w-50"
            >
              Registrar
            </div>
            <div @click="clearFields" class="clear-button d-inline-block w-50">
              Limpiar
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["categories"],
  data() {
    return {
      selectedValue: null,
      step: 1,
      chosen_project: "",
      preview_note_img: "../../img/illustrator/uploadimage.png",
      note: {
        description: "",
        image: "",
        chosen_project: "",
        selectedProject: "",
      },
      isSuccess: false,
      isError: false,
      isEmpty: false,
      errortext: "",
      projects: [],
    };
  },
  methods: {
    getProjects() {
      axios
        .get("/admin/projects/get")
        .then((response) => {
          const projects = response.data;
          this.projects = projects;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    setProject(project) {
      this.note.chosen_project = project;
    },
    selectImage() {
      this.$refs.fileInput.click();
    },
    onFileChange(e) {
      this.note.image = e.target.files[0];
      this.preview_note_img = URL.createObjectURL(this.note.image);
    },
    submitRequest() {
      if (
        this.note.description == "" ||
        this.note.chosen_project == "" ||
        this.note.image == ""
      ) {
        this.isSuccess = false;
        this.isError = false;
        this.isEmpty = true;
      } else {
        let formData = new FormData();
        formData.append("description", this.note.description);
        formData.append("project_id", this.note.chosen_project);
        formData.append("image", this.note.image);
        axios
          .post("/admin/notes/create", formData, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((response) => {
            this.note.description = "";
            this.note.image = "";
            this.preview_note_img = "../../img/illustrator/uploadimage.png";
            this.isSuccess = true;
            this.isError = false;
            this.isEmpty = false;
          })
          .catch((error) => {
            console.log(error.response.data);
            this.isSuccess = false;
            this.isError = true;
            this.isEmpty = false;
            this.errortext = Object.values(error.response.data.errors)
              .flat()
              .join();
          });
      }
    },

    clearFields() {
      this.note.description = "";
    },
  },
  computed: {
    /*filteredCountries() {
      return this.project.countries[this.project.selectedContinent] || [];
    },
    getCountries() {
      return new Set(this.countries.map((x) => x.country));
    },*/
  },
  mounted() {
    this.getProjects();
  },
};
</script>

<style scoped>
.content-warpper {
  width: 90%;
  margin: 0 auto;
}
/* PAGE ! */
.step1 {
  width: 90%;
  margin: 0 auto;
}
#category-box {
  height: 50vh;
}

.single-list {
  cursor: pointer;
}
.single-list:hover,
.single-list.active,
.single-list.focus {
  color: #fcfaf1;
  background-color: #134153;
}

.next-disable-button {
  float: right;
  cursor: not-allowed;
  text-align: center;
  line-height: 45px;
  margin-top: 25px;
  max-width: 160px;
  width: 100%;
  color: #fcfaf1;
  background-color: #999999;
}
.next-button,
.submit-button {
  cursor: pointer;
  text-align: center;
  line-height: 45px;
  width: 100%;
  color: #fcfaf1;
  background-color: rgba(19, 65, 83, 1);

  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0);
  outline-color: rgba(19, 65, 83, 0.5);
  outline-offset: 0px;
  text-shadow: none;
  transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
}
.next-button {
  float: right;
  max-width: 160px;
  margin-top: 25px;
}
.next-button:hover,
.submit-button:hover {
  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0.5),
    0 0 20px rgba(190, 218, 250, 0.2);
  outline: 1px solid;
  outline-color: rgba(190, 218, 250, 0);
  outline-offset: 15px;
  text-shadow: 1px 1px 2px #2e828b;
}

/* PAGE 2 */
.step2 {
  width: 90%;
  margin: 0 auto;
}
#note-image {
  width: 350px;
  height: 250px;
  object-fit: contain;
}

.form-input {
  background-color: transparent;
  color: #333333;
  border: 2px solid #999999;
  padding: 5px;
  border-radius: 0;
  width: 100%;
}
.form-input:focus {
  color: #333333;
  border: 2px solid #333333;
}
.form-input:focus {
  color: #333333;
  border: 2px solid #333333;
}

.form-input::placeholder {
  color: #999999;
}

.submit-button {
  float: left;
  margin-top: 35px;
}

.clear-button {
  float: right;
  cursor: pointer;
  text-align: center;
  line-height: 45px;
  margin-top: 35px;
  width: 100%;
  color: #e40041;
  background-color: transparent;

  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0);
  outline-color: rgba(19, 65, 83, 0.5);
  outline-offset: 0px;
  text-shadow: none;
  transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
}
.clear-button:hover {
  box-shadow: inset 0 0 20px rgba(190, 218, 250, 0.5),
    0 0 20px rgba(190, 218, 250, 0.2);
  outline: 1px solid;
  outline-color: rgba(190, 218, 250, 0);
  outline-offset: 15px;
  text-shadow: 1px 1px 2px #2e828b;
}

.back-button {
  margin-top: -30px;
  cursor: pointer;
}
</style>
