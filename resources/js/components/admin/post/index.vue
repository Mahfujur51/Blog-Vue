<template>

    <!-- /.row -->
    <div class="row mt-3">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Show All Post</h3>

                    <div class="card-tools">
                        <router-link to="/add-post" class="btn btn-success">Add Post</router-link>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>Category</th>
                            <th>Post Title</th>
                            <th>Content</th>
                            <th>Author</th>
                            <th>Image</th>
                            <th>Create</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="(post,index) in getallPost">

                            <td>{{index+1}}</td>
                            <td>{{post.category.name}}</td>
                            <td>{{post.title | subString(12,'...')}}</td>
                            <td>{{post.description |subString(25,'...')}}</td>
                            <td>{{post.user.name}}</td>
                            <td><img :src="post.image" alt="" width="60"></td>
                            <td>{{post.created_at | time}}</td>
                            <td>
                                <button class="btn btn-success btn-sm">Edit</button>
                                <button  class="btn btn-danger btn-sm" @click="removePost(post.id)">Delete</button>
                            </td>
                        </tr>
                        <tr v-if="emptyData()">
                            <td colspan="9">
                                <h5 class="text-center text-danger">Data Not Found!!</h5>

                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</template>

<script>


export default {
    name: "index",
    mounted() {
        this.$store.dispatch('allPost')
    },
    computed:{
        getallPost(){
            return this.$store.getters.getPost
        },
    },
    methods:{
        // statusName(status){
        //     let data={
        //         0: "inactive",
        //         1: "active",
        //     }
        //     return data[status];
        //
        // },
        // colorStatus(status){
        //     let data={
        //         0: "bg-danger",
        //         1: "bg-success",
        //
        //     }
        //     return data[status]
        // },
        removePost(id){

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/remove-post/'+id).then((response)=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        this.$store.dispatch('allPost');

                    }).catch((error)=>{

                    })
                }
            })

        },
        emptyData(){
            return(this.getallPost.length<1)
        }
    }
}
</script>

<style scoped>

</style>
