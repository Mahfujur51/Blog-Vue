export default{
   state:{
       category:[],
       post:[],
       blogposts:[],
       singlePost:[],
       blogCategory:[],
       latestPost:[],

   },
    getters:{
           getCategory(state){
               return state.category
           },
            getPost(state){
                   return state.post
            },
                getBlogPost(state){
                    return state.blogposts
                },
        getSinglePost(state){
               return state.singlePost
        },
        getblogCategory(state){
               return state.blogCategory
        },
        latestPost(state){
               return state.latestPost;
        }


    },
    actions:{
        allCategory(context){
              axios.get('/category').then((response)=>{

                  context.commit('categories', response.data.categories)
              })
          },
        allActiveCategory:function (contex){
            axios.get(/active-category/).then((response)=>{
                contex.commit('categories',response.data.categories)
            })
        },
        allPost(contex){
            axios.get('/post').then((response)=>{
                contex.commit('posts',response.data.posts)
            })
        },
        allBlogPost(contex){
            axios.get('/blogPost').then((response)=>{
                contex.commit('blogposts',response.data.posts);
            })
        },
        getPostById(contex,payload){

            axios.get('/single-blogpost/' + payload).then((response)=>{

                contex.commit('blogSinglePost',response.data.post);

            })
        },
        allActiveBlogCategory(contex){
            axios.get('/active-category/').then((response)=>{
              contex.commit('activeBlogCategroy',response.data.categories);
            })
        },
        getPostByCategory(contex,payload){
            axios.get('/category-post/'+payload).then((response)=>{

                contex.commit('getPostByCategoryId',response.data.posts)
            })
        },
        SearchPost(contex,payload){
            axios.get('/search?s='+payload).then((response)=>{
                contex.commit('searchPost',response.data.posts)

            })
        },
        latestPost(contex){
            axios.get('/latestpost/').then((response)=>{
                console.log(response.data.posts)
                contex.commit('latestPost',response.data.posts);
            })
        }

    },
    mutations:{
          categories(state,payload){
              return state.category=payload;
          },
            posts(state,payload){
                  return state.post=payload;
            },
        blogposts(state,payload){
              return state.blogposts=payload;
        },
        blogSinglePost(state,payload){
              return state.singlePost=payload;
        },
        activeBlogCategroy(state,payload){
              return state.blogCategory=payload
        },
        getPostByCategoryId(state,payload){
              return state.blogposts=payload;
        },
        searchPost(state,payload){
              return state.blogposts=payload;
        },
        latestPost(state,payload){
              return state.latestPost=payload;
        }


    }
}
