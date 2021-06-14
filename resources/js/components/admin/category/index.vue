<template>

    <!-- /.row -->
    <div class="row mt-3">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Show All Category</h3>

                    <div class="card-tools">
                        <router-link to="/add-category" class="btn btn-success">Add Category</router-link>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>
                                <input :disabled="emptyData()" type="checkbox" v-model="selectedAll" @click="selectAll" >
                            </th>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Status</th>
                            <th>Create</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="(category,index) in getallCategory" >
                            <td width="2%">
                                <input type="checkbox" :value="category.id" v-model="selected">
                            </td>
                            <td width="2%">{{index+1}}</td>
                            <td>{{category.name}}</td>
                            <td> <span class="badge" :class="colorStatus(category.status)">{{statusName(category.status)}}</span></td>
                            <td>{{category.created_at | time}}</td>
                            <td>
                                <router-link :to="`/edit-category/${category.id}`" class="btn btn-success btn-sm">Edit</router-link>
                                <button  class="btn btn-danger btn-sm" @click="removeCategory(category.id)">Delete</button>
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
                                        <button class="dropdown-item"  @click="changeStatus(selected,1)" type="button">Active</button>
                                        <button class="dropdown-item" @click="changeStatus(selected,0)" type="button">Deactive</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                      <tr v-if="emptyData()">
                          <td colspan="6">
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

        this.$store.dispatch('allCategory')
   },
    computed:{
        getallCategory(){
            return this.$store.getters.getCategory
        },
    },
    watch:{
      selected:function (selected){
          this.selectedAll=(selected.length===this.getallCategory.length);
          this.isSelected=(selected.length<1);
      },

    },
    methods:{
     statusName(status){
         let data={
             0: "inactive",
             1: "active",
         }
         return data[status];

     },
        colorStatus(status){
         let data={
             0: "bg-danger",
             1: "bg-success",

         }
         return data[status]
        },
        removeCategory(id){
         this.confirm(()=>{

                 let test =this;
                 axios.get('/remove-category/'+id).then((response)=>{

                     Swal.fire(
                         'Deleted!',
                         'Your file has been deleted.',
                         'success'
                     )
                     this.$store.dispatch('allCategory');


                 }).catch((error)=>{

                 })

         });



        },
        emptyData(){
        return(this.getallCategory.length<1);
        },
        selectAll(event){
         if (event.target.checked===false){
             this.selected=[];
         }else{
             this.getallCategory.forEach((category)=>{
                 if(this.selected.indexOf(category.id)===-1){
                     this.selected.push(category.id);
                 }


             })
         }


        },
        removeItems:function (selected){
         this.confirm(()=>{
             let test=this;
             axios.post("/categories-remove",{data:selected}).then((response)=>{

                 Swal.fire(
                     'Deleted!',
                     'Your file has been deleted.',
                     'success'
                 )
                 toastr.success(response.data.total+'  '+'    Selected Category Deleted Successfully!!!');
                 test.selected=[];
                 test.isSelected=true;
                 test.selectedAll=false;
                 this.$store.dispatch('allCategory');


             }).catch((error)=>{

             })
         })

        },
        changeStatus:function (selected,status){
            let msg=status=== 1?"active":"Inactive";

             this.confirm(()=>{
                 let test=this;
                 axios.post("/categories-change-status",{data:selected,status:status}).then((response)=>{

                     Swal.fire(
                         'Deleted!',
                         'Your selected Item is   '+msg,
                         'success'
                     )
                     toastr.success(response.data.total+'  '+'    Selected Category  Successfully!!!   '+'   '+msg);
                     test.selected=[];
                     test.isSelected=true;
                     test.selectedAll=false;
                     this.$store.dispatch('allCategory');


                 }).catch((error)=>{

                 })
             })

        }
    }
}
</script>

<style scoped>

</style>
