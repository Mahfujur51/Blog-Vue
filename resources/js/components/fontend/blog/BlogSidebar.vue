<template>
    <div class="span4">
        <aside class="right-sidebar">
            <div class="widget">
                <form class="form-search">
                    <input placeholder="Type something" type="text" @keyup="RealSearch" v-model="keyword" class="input-medium search-query">
                    <button type="submit" @click.prevent="RealSearch" class="btn btn-square btn-theme">Real Search</button>
                </form>
            </div>
            <div class="widget">
                <h5 class="widgetheading">Categories</h5>
                <ul class="cat">
                    <li v-for="category in getallCategory"><i class="icon-angle-right"></i><router-link :to="`/category-post/${category.id}`">{{category.name}}</router-link><span> (20)</span></li>

                </ul>
            </div>
            <div class="widget">
                <h5 class="widgetheading">Latest posts</h5>
                <ul class="recent">
                    <li v-for="(post,index) in getallPost" v-if="index<5">
                        <img :src="fileLink(post.image)" class="pull-left" alt="" height="200px" width="120px"/>
                        <h6><router-link :to="`/single-post/${post.id}`">{{post.title}}</router-link></h6>
                        <p>
                            {{post.description |subString(50,"...")|striphtml}}
                        </p>
                    </li>

                </ul>
            </div>

        </aside>
    </div>
</template>

<script>
import _ from 'lodash'
export default {
    name: "BlogSidebar",
    data(){
      return{
          keyword:null,
      }
    },
    computed:{
        getallCategory(){
            return this.$store.getters.getblogCategory
        },
        getallPost(){
            return this.$store.getters.latestPost
        },
    },
    mounted(){
        this.$store.dispatch('latestPost')
        this.$store.dispatch('allActiveBlogCategory')

    },
    methods:{
        RealSearch:_.debounce(function (){
            this.$store.dispatch('SearchPost',this.keyword);
        },1000)
    }
}
</script>

<style scoped>

</style>
