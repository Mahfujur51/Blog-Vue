<template>
    <div class="row mt-3">
        <div class="col-md-8 offset-2">
            <div class="card card-primary">
                <div class="card-header bg-info">

                    <h3 class="card-title">Update Category </h3>
                    <router-link to="/category" class="btn btn-success float-right">Categories</router-link>
                </div>
                <form  @submit.prevent="update" @keydown="form.onKeydown($event)">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Category Name:</label>
                            <input type="text" class="form-control" v-model="form.name" name="name" placeholder="Enter Category Name">
                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" class="text-danger" />
                        </div>

                        <div class="form-group">
                            <label for="">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" v-model="form.status" value="1" >
                                <label class="form-check-label" for="exampleRadios1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" v-model="form.status" value="0">
                                <label class="form-check-label" for="exampleRadios2">
                                    Inactive
                                </label>
                            </div>

                        </div>
                        <div v-if="form.errors.has('status')" v-html="form.errors.get('status')" class="text-danger" />

                    </div>
                    <div class="card-footer">
                        <button type="submit" :disabled="form.busy" class="btn btn-success float-right">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "edit",
    mounted() {
        this.allCategory()
    },
    data: () => ({
        form: new Form({
            name: '',
            status:'',

        })
    }),

    methods: {
        async update () {
            let test=this
            this.form.post('/update-category/'+this.$route.params.id)
                .then((response)=>{
                    this.$router.push('/category')
                    toastr.success('Category Updated Successfully!!');
                      test.form.name=null;
                      test.form.status=null;
                })

        },
        allCategory(){
           let test=this;
            axios.get('/edit-category/'+this.$route.params.id).then((response)=>{
                  test.form.fill(response.data.category);

            }).catch((error)=>{

            })
        }

    }
}
</script>

<style scoped>

</style>
