<template>
    <div @click.self="closeModal" class="modalwarpper">
        <div class="modal-box p-5">
            <div class="row">
                <h4 class="d-block col-9 font-weight-600">Project Details</h4>
                <div v-if="!toggleRatingState" class="d-block col-3 text-center">
                    <div v-if="!toggleEditState" @click="editState" class="editbutton text-3 cursor-pointer"><i class="fas fa-edit"></i> Edit Project</div>
                    <div v-if="toggleEditState" @click="saveEdit" class="savebutton text-3 cursor-pointer">Save</div>
                </div>
            </div>
            
            <div v-if="isSuccess" class="successmsg p-3 my-2"><i class="fas fa-check text-9 mr-2"></i> Successfully updated the project. </div>
            <div v-if="isError" class="errormsg p-3 my-2"><i class="fas fa-times text-8 mr-2"></i> {{ errortext }}</div>
            <div v-if="isEmpty" class="errormsg p-3 my-2"><i class="fas fa-exclamation text-8 mr-2"></i> Please enter all the required fields. </div>  

            <div class="row mt-5">
                <div class="box-height col-6 text-center">
                    <img :src="imagePreview" alt="" class="prodimg col-12">
                    <div v-if="toggleEditState" class="mt-2 cursor-pointer text-3" @click="selectImage"><i class="fas fa-upload"></i> Upload Image</div> 
                    <input ref="fileInput" type="file" class="d-none" @change="onFileChange">
                    <div @click="toggleRatingState =! toggleRatingState" v-if="!toggleEditState && !toggleRatingState" class="review-button cursor-pointer text-3">Segunda Vista <i class="fas fa-chevron-right"></i></div>
                    <div @click="toggleRatingState =! toggleRatingState" v-if="!toggleEditState && toggleRatingState" class="review-button cursor-pointer text-3"><i class="fas fa-chevron-left"></i> Details</div>
                </div>

                <div v-if="!toggleRatingState" class="box-height col-6 details-form">
                    <label for="editname" class="d-block text-7">Name<span v-if="toggleEditState" class="text-8">*</span></label> 
                    <input :value="project.name" ref="nameinput" type="text" name="editname" id='editname' class="form-input" placeholder="Enter your project's title*" required disabled>
                   
                    <label for="editdescription" class="d-block mt-4 text-7">Description<span v-if="toggleEditState" class="text-8">*</span></label> 
                    <textarea :value="project.description" ref="descriptioninput" type="text" name="editdescription" id='editdescription' class="form-input" style="resize: none" placeholder="Enter your project's description*" required disabled></textarea>
                </div>

                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:[
        'project',
        'seller_ratings'
    ],
    data(){
        return{
            toggleEditState: false,
            toggleRatingState: false,

            editproject:{
                image: '',
            },
            imagePreview: this.project.image,

            isSuccess: false,
            isError: false,
            isEmpty: false,
            errortext: "",
        }
    },
    methods:{
        /* RATINGS */
        openRating(){
            this.toggleRatingState = true;
        },

        /* DETAILS */
        closeModal(){
            this.$emit('closeProjectDetails');
        },
        editState(){
            this.toggleEditState = !this.toggleEditState;
            this.isSuccess= false;
            this.isError= false;
            this.isEmpty= false;
            this.$refs.nameinput.disabled = false;
            this.$refs.brandinput.disabled = false;
            this.$refs.stockinput.disabled = false;
            this.$refs.priceinput.disabled = false;
            this.$refs.descriptioninput.disabled = false;
        },
        saveState(data){
            this.toggleEditState = false;
            this.$refs.nameinput.disabled = true;
            this.$refs.brandinput.disabled = true;
            this.$refs.stockinput.disabled = true;
            this.$refs.priceinput.disabled = true;
            this.$refs.descriptioninput.disabled = true;
            this.editproject.image = '';
            this.project.name = data.name;
            this.project.description = data.description;
            this.project.image = data.image;
        },

        /* On Edit State */
        selectImage () {
            this.$refs.fileInput.click()
        },
        onFileChange(e) {
            this.editproject.image = e.target.files[0];
            this.imagePreview = URL.createObjectURL(this.editproject.image);
        },
        saveEdit(){
            if(this.$refs.nameinput.value == "" || this.$refs.descriptioninput.value == ""){
                this.isSuccess= false;
                this.isError= false;
                this.isEmpty= true;
            }
            else{
                let formData = new FormData();
                formData.append('id', this.project.id);
                formData.append('name', this.$refs.nameinput.value);
                formData.append('description', this.$refs.descriptioninput.value);
                formData.append('image', this.editproject.image);
                axios.post( '/seller/projects/update',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                )
                .then( response => {
                    console.log(response.data)
                    this.isSuccess = true;
                    this.isError = false;
                    this.isEmpty = false;
                    this.saveState(response.data);
                })
                .catch ( error => {
                    console.log(error.response.data);
                    this.isSuccess = false;
                    this.isError = true;
                    this.isEmpty = false;
                    this.errortext = Object.values(error.response.data.errors).flat().join();
                })
            }
        }
    }
}
</script>

<style scoped>
.modalwarpper{
    position: fixed;
    top: 0px;
    right: 0px;
    width: 83%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.6);

    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-box{
    width: 75%;
    max-width: 800px;
    background-color: white;
    border-radius: 15px;
}
.box-height{
    height: 355px;
}

.prodimg{
    height: 250px;
    object-fit: contain;
}
.buyer_img{
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
}

.details-form .form-input{
    background-color: transparent;
    color: #333333;
    border: 2px solid #999999;
    padding: 5px;
    border-radius: 0;
    width: 100%;
}
.details-form .form-input:focus{
    background-color: transparent;
    color: #333333;
    border: 2px solid #333333;
    padding: 5px;
    border-radius: 0;
    width: 100%;
}
.details-form .form-input:disabled{
    border: 0;
}
.details-form .form-input::placeholder{
    color: #999999;
}

.review-button{
    position: absolute;
    bottom: 0;
    left: 20px;
}

.savebutton {
    cursor: pointer;
    text-align: center;
    line-height: 45px;
    width: 100%; 
    color: #FCFAF1;
    background-color: rgba(19, 65, 83, 1);

    box-shadow: inset 0 0 20px rgba(190, 218, 250, 0);
    outline-color: rgba(19, 65, 83, .5);
    outline-offset: 0px;
    text-shadow: none;
    transition: all 1250ms cubic-bezier(0.19, 1, 0.22, 1);
}
.savebutton:hover {
    box-shadow: inset 0 0 20px rgba(190, 218, 250, .5), 0 0 20px rgba(190, 218, 250, .2);
    outline: 1px solid;
    outline-color: rgba(190, 218, 250, 0);
    outline-offset: 15px;
    text-shadow: 1px 1px 2px #2E828B; 
}

.editbutton {
    cursor: pointer;
    text-align: right;
    line-height: 45px;
    width: 100%;
}
</style>