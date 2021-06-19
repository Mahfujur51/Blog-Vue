<template>
    <div class="row mt-3">
        <div class="col-md-8 offset-2">
            <div class="card card-primary">
                <div class="card-header bg-info">
                    <h3 class="card-title">Add Post</h3>
                    <router-link to="/post" class="btn btn-success float-right">Show Post</router-link>
                </div>
                <form  @submit.prevent="addPost" @keydown="form.onKeydown($event)">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Post Title:</label>
                            <input type="text" class="form-control" v-model="form.title"  placeholder="Enter Post Title"  :class="{'is-invalid':form.errors.has('title')}" >
                            <div v-if="form.errors.has('title')" v-html="form.errors.get('title')" class="text-danger" />
                        </div>

                        <div class="form-group">
                            <label for="">Category:</label>
                            <select class="form-control" v-model="form.category_id" :class="{'is-invalid':form.errors.has('category_id')}"  >
                                <option  value="" > Select Category </option>
                                <option :value="category.id" v-for="category in getallCategory">{{category.name}} </option>
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
                            <img :src="form.image" alt="" width="150" >
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    name: "add",
    data:function (){
      return{
          form:new Form({
              title:null,
              category_id:'',
              description:null,
              image:null,
          }),
          editor: ClassicEditor,

          editorConfig: { }
      }
    },



    mounted() {

        this.$store.dispatch('allActiveCategory')
    },
    computed:{
        getallCategory(){
            return this.$store.getters.getCategory
        },
    },

    methods: {
        async addPost () {
          let test =this;
            this.form.post('/store-post')
                .then((response)=>{
                    test.title='';
                    test.category_id='';
                    test.description='';
                    test.image='';
                    this.$router.push('/post')
                    toastr.success('Post Inserted Successfully!!');
                })

        },

    }
}
</script>

<style scoped>

</style>
