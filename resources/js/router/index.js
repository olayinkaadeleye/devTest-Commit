import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
import Home from '../pages/Home.vue';
import CategoryList from '../pages/category/index.vue';
import CreateCategory from '../pages/category/create.vue';
import EditCategory from '../pages/category/edit.vue';
import ProductList from '../pages/product/index.vue';
import CreateProduct from '../pages/product/create.vue';
import EditProduct from '../pages/product/edit.vue';



const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            component: Home, 
            name :'home',
        },
        {
            path: '/categories',
            component: CategoryList, 
            name :'category-list',
        },
        {
            path: '/create',
            component: CreateCategory, 
            name :'create-category',
        },
        {

            path: '/edit/:id',
            component: EditCategory,
            name:'edit-category'
        } ,
        {
            path: '/products',
            component: ProductList, 
            name :'product-list',
        },
        {
            path: '/add',
            component: CreateProduct, 
            name :'create-product',
        },
        {

            path: '/edit/:id',
            component: EditProduct,
            name:'edit-product'
        } ,
    
    
    ]
});
 export default routes;