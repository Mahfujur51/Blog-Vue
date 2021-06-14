import AdminHome from "../components/admin/AdminHome";
import category from "../components/admin/category/index";
import addCategory from  "../components/admin/category/add";
import editCategory from "../components/admin/category/edit";
import postIndex from "../components/admin/post/index";
import addPost from  "../components/admin/post/add";
import editPost from "../components/admin/post/edit";



export const routes = [
    { path: '/home', component: AdminHome },
    { path: '/category', component: category },
    { path: '/add-category', component: addCategory },
    { path: '/edit-category/:id', component: editCategory },
    { path: '/post', component: postIndex },
    { path: '/add-post', component: addPost },
    { path: '/edit-post/:id', component: editPost },


]
