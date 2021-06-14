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
                            <th width="2%">
                                <input :disabled="emptyData()" type="checkbox" v-model="selectedAll" @click="selectAll" >
                            </th>
                            <th  width="2%">ID</th>
                            <th width="10%">Category</th>
                            <th>Post Title</th>

                            <th>Author</th>
                            <th>Image</th>
                            <th>Create</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="(post,index) in getallPost">
                            <td width="2%">
                                <input type="checkbox" :value="post.id" v-model="selected">
                            </td>
                            <td width="2%">{{index+1}}</td>
                            <td width="10%">{{post.category.name}}</td>
                            <td>{{post.title | subString(12,'...')}}</td>
                            <td>{{post.user.name}}</td>
                            <td><img :src="post.image" alt="" width="60"></td>
                            <td>{{post.created_at | time}}</td>
                            <td>
                                <button class="btn btn-success btn-sm">Edit</button>
                                <button  class="btn btn-danger btn-sm" @click="removePost(post.id)">Delete</button>
                            </td>
                        </tr>
                        <tr v-if="!emptyData()">
                            <td colspan="6" class="float-left">
                                <div class="dropdown">
                                    <button class="btn btn-success btn-sm dropdown-toggle"  type="button" :disabled="isSelected" id="dropdownMenu2" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" @click="removeItems(selected)" type="button">Delete Seleted</button>
<!--                                        <button class="dropdown-item"  @click="changeStatus(selected,1)" type="button">Active</button>-->
<!--                                        <button class="dropdown-item" @click="changeStatus(selected,0)" type="button">Deactive</button>-->
                                    </div>
                                </div>
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


import toastr from "toastr";

export default {
    name: "index",
    data:function (){
        return{
            selected:[],
            isSelected:true,
            selectedAll:false
        }
    },
    mounted() {
        this.$store.dispatch('allPost')
    },
    computed:{
        getallPost(){
            return this.$store.getters.getPost
        },
    },
    watch:{
        selected:function (selected){
            this.selectedAll=(selected.length===this.getallPost.length);
            this.isSelected=(selected.length<1);
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
        selectAll(event){
            if (event.target.checked===false){
                this.selected=[];
            }else{
                this.getallPost.forEach((post)=>{
                    if(this.selected.indexOf(post.id)===-1){
                        this.selected.push(post.id);
                    }


                })
            }


        },
        removePost(id){
            this.confirm(()=>{
                axios.get('/remove-post/'+id).then((response)=>{
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    this.$store.dispatch('allPost');

                }).catch((error)=>{

                })
            })

        },
        emptyData(){
            return(this.getallPost.length<1)
        },
        removeItems(selected){
           this.confirm(()=>{
               let test=this;
               axios.post('/remove-selected-posts/',{data:selected}).then((response)=>{
                   Swal.fire(
                       'Deleted!',
                       'Your file has been deleted.',
                       'success'
                   )
                   toastr.success(response.data.total+'  '+'    Selected Category Deleted Successfully!!!');
                   test.selected=[];
                   test.isSelected=true;
                   test.selectedAll=false;
                   this.$store.dispatch('allPost')

               }).catch((errror)=>{

               })
           } )

        },
        // changeStatus(selected,status){
        //     let msg=status=== 1?"active":"Inactive";
        //
        //     this.confirm(()=>{
        //         let test=this;
        //         axios.post("/post-change-status",{data:selected,status:status}).then((response)=>{
        //
        //             Swal.fire(
        //                 'Deleted!',
        //                 'Your selected Item is   '+msg,
        //                 'success'
        //             )
        //             toastr.success(response.data.total+'  '+'    Selected Category  Successfully!!!   '+'   '+msg);
        //             test.selected=[];
        //             test.isSelected=true;
        //             test.selectedAll=false;
        //             this.$store.dispatch('allCategory');
        //
        //
        //         }).catch((error)=>{
        //
        //         })
        //     })
        // }

    }
}
</script>

<style scoped>

</style>
