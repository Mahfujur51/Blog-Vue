<template>
    <div class="row mt-3">
        <div class="col-md-8 offset-2">
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Add Post</h3>
                    <router-link to="/post" class="btn btn-success float-right">Show Post</router-link>
                </div>
                <form  @submit.prevent="update" @keydown="form.onKeydown($event)">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Post Title:</label>
                            <input type="text" class="form-control" v-model="form.title"  placeholder="Enter Post Title"  :class="{'is-invalid':form.errors.has('title')}" >
                            <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" class="text-danger" />
                        </div>
                        <div class="form-group" >
                            <label>Select Category</label>
                            <select class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
                                <option disabled value="">Select One</option>
                                <option v-for="category in getallCategory" :value="category.id">{{category.name}}</option>

                            </select>

                            <div v-if="form.errors.has('category_id')" v-html="form.errors.get('category_id')" class="text-danger" />
                        </div>

                        <div class="form-group">
                            <label for="">Discription</label>
                            <ckeditor :editor="editor" v-model="form.description" :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image"  class="form-control" id="image" @change="loadImage($event)" :class="{ 'is-invalid': form.errors.has('image') }">
                            <div v-if="form.errors.has('image')" v-html="form.errors.get('image')" class="text-danger" />
                           <img :src="fileLink(form.image)" alt="" width="60">
                        </div>



                    </div>
                    <div class="card-footer">
                        <button type="submit" :disabled="form.busy" class="btn btn-success float-right">Add Post</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "edit",
    data:function (){
        return{
            form:new Form({
                title:null,
                description:null,
                image:null,
                category_id:'',
            }),
            editor: ClassicEditor,

            editorConfig: { }
        }
    },
    mounted() {

        this.$store.dispatch('allActiveCategory')
        this.allPost();
    },
    computed:{
        getallCategory(){
            return this.$store.getters.getCategory
        },
    },

    methods: {
        async update () {
            let test=this
            this.form.post('/update-post/'+this.$route.params.id)
                .then((response)=>{
                    test.title='';
                    test.category_id='';
                    test.description='';
                    test.image='';
                    this.$router.push('/post')
                    toastr.success('Post Updated Successfully!!');
                })

        },
        allPost(){

            axios.get('/edit-post/'+ this.$route.params.id).then((response)=>{
                this.form.fill(response.data.post);

            }).catch((error)=>{

            });
        }

    }
}
</script>

<style scoped>

</style>
