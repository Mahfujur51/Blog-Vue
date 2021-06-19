<template>
    <div>
        <!-- end header -->
        <section id="inner-headline">
            <div class="container">
                <div class="row">
                    <div class="span4">
                        <div class="inner-heading">
                            <h2>Post right sidebar</h2>
                        </div>
                    </div>
                    <div class="span8">
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                            <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
                            <li class="active">Blog post right sidebar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="span8">
                        <article >
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            <h3><a href="#">{{getPost.title}}</a></h3>
                                        </div>
                                        <img :src="`assets/fontend/post/${getPost.image}`" alt="" />
                                    </div>
                                    <p>
                                        {{getPost.description | striphtml }}
                                    </p>

                                    <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li><i class="icon-user"></i><a href="#" v-if="getPost.user">{{getPost.user.name }}</a></li>
                                            <li><i class="icon-folder-open"></i><a href="#" v-if="getPost.category" >{{getPost.category.name}}</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <blogSiderbar></blogSiderbar>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
import blogSiderbar from "./BlogSidebar"
export default {
    name: "SignlePost",
    data(){
        return{
              id:null,
            image:null,
            name:'',

        }
    },
    components:{
        blogSiderbar
    },
    mounted() {
        this.singlePost();

    },
    watch:{
      $route(to,from) {
          this.singlePost();
      }
    },
    methods:{
       singlePost(){
           this.$store.dispatch('getPostById',this.$route.params.id);
       }
    },
    computed:{
         getPost(){
             return this.$store.getters.getSinglePost
         }
    },

}
</script>

<style scoped>

</style>
