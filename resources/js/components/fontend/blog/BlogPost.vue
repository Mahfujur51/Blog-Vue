<template>
    <div>
        <section id="inner-headline">
            <div class="container">
                <div class="row">
                    <div class="span4">
                        <div class="inner-heading">
                            <h2>Blog  {{this.$route.params.id}}</h2>
                        </div>
                    </div>
                    <div class="span8">
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                            <li><a href="#" class="active">Blog</a><i class="icon-angle-right"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="span8">
                        <article v-for="(post,index) in getallPost">
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            <h3><router-link :to="`/single-post/${post.id}`">{{post.title}}</router-link></h3>
                                        </div>
                                        <img :src="fileLink(post.image)" alt="" />
                                    </div>
                                    <p>
                                        {{post.description | subString(500,"...")| striphtml }}
                                    </p>
                                    <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li><i class="icon-calendar"></i><a href="#"> Mar 23, 2013</a></li>
                                            <li><i class="icon-user"></i><a href="#">{{post.user.name}}}</a></li>
                                            <li><i class="icon-folder-open"></i><a href="#">{{post.category.name}}</a></li>
                                         </ul>
                                        <router-link :to="`single-post/${post.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <div id="pagination">
                            <span class="all">Page 1 of 3</span>
                            <span class="current">1</span>
                            <a href="#" class="inactive">2</a>
                            <a href="#" class="inactive">3</a>
                        </div>
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
    name: "BlogPost",
    data(){
     return{
         title:null,

     }
    },
    components:{
        blogSiderbar
    },
    mounted() {
        this.$store.dispatch('allBlogPost')
    },
    computed:{
        getallPost(){
            return this.$store.getters.getBlogPost
        },
    },
    methods:{
            getCategoryPost(){
                if(this.$route.params.id !=null){
                    this.$store.dispatch('getPostByCategory',this.$route.params.id);
                }else{
                    this.$store.dispatch('allBlogPost')
                }


            }
    },
    watch:{
        $route(to,from){
            this.getCategoryPost();
        }
    }
}
</script>

<style scoped>

</style>
