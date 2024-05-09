import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/AuthStore.js';

import Page from '../Page.vue'
import Dashboard from '../home/Dashbaord.vue'
import Login from '../auth/Login.vue'
import Register from '../auth/Register.vue'

import Product from '../product/Product.vue'
import Create from '../product/Create.vue'
import Edit from '../product/Edit.vue'
import Show from '../product/Show.vue'

import CategoryIndex from '../category/Index.vue'
import CategoryEdit from '../category/Edit.vue'
import CategoryShow from '../category/show.vue'
import CategoryCreate from '../category/Create.vue'

import Size from '../size/Index.vue'
import CreateSize from '../size/Create.vue'
import EditSize from '../size/Edit.vue'
import ShowSize from '../size/Show.vue'

import ColorIndex from '../color/Index.vue'
import ColorCreate from '../color/Create.vue'
import ShowColor from '../color/Show.vue'
import EditColor from '../color/Edit.vue'


import ProductImage from '../productImage/Index.vue'
import CreateProductImage from '../productImage/Create.vue'
import EditProductImage from '../productImage/Edit.vue'
import ShowProductImage from '../productImage/Show.vue'

import OrderIndex from '../order/Index.vue'
import OrderCreate from '../order/Create.vue'
import OrderEdit from '../order/Edit.vue'
import OrderShow from '../order/Show.vue'

import PaymentIndex from '../payment/Index.vue'
import PaymentCreate from '../payment/Create.vue'
import PaymentEdit from '../payment/Edit.vue'
import PaymentShow from '../payment/Show.vue'

import CouponIndex from '../coupon/Index.vue'
import CouponCreate from '../coupon/Create.vue'
import CouponEdit from '../coupon/Edit.vue'
import CouponShow from '../coupon/Show.vue'

import UserIndex from '../user/Index.vue'
import UserCreate from '../user/Create.vue'
import UserEdit from '../user/Edit.vue'
import UserShow from '../user/Show.vue'




const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: null
    },
    {
      path: '/page',
      name: 'page',
      component: Page
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      meta: { requiresAuth: true, isAdmin: true }
      
    },
    {
      path: '/auth/login',
      name: 'auth.login',
      component: Login
    },
    {
      path: '/auth/register',
      name: 'auth.register',
      component: Register
    },
    {
      path: '/product/product',
      name: 'product.product',
      component: Product,
      meta: { requiresAuth: false, isAdmin: false }
    },
    {
      path: '/product/create',
      name: 'product.create',
      component: Create
    },
    {
      path: '/product/:id/edit',
      name: 'product.edit',
      component: Edit
    },
    {
      path: '/product/:id/show',
      name: 'product.show',
      component: Show
    },
    {
      path: '/category/index',
      name: 'category.index',
      component: CategoryIndex
    },
    {
      path: '/category/:id/edit',
      name: 'category.edit',
      component: CategoryEdit
    },
    {
      path: '/category/:id/show',
      name: 'category.show',
      component: CategoryShow
    },
    {
      path: '/category/create',
      name: 'category.create',
      component: CategoryCreate
    },
    {
      path: '/size/index',
      name: 'size.index',
      component: Size
    },
    {
      path: '/size/create',
      name: 'size.create',
      component: CreateSize
    },
    {
      path: '/size/:id/edit',
      name: 'size.edit',
      component: EditSize
    },
    {
      path: '/size/:id/show',
      name: 'size.show',
      component: ShowSize
    },
    {
      path: '/color/index',
      name: 'color.index',
      component: ColorIndex
    },
    {
      path: '/color/create',
      name: 'color.create',
      component: ColorCreate
    },
    {
      path: '/color/:id/edit',
      name: 'color.edit',
      component: EditColor
    },
    {
      path: '/color/:id/show',
      name: 'color.show',
      component: ShowColor
    },
    {
      path: '/productImage/index',
      name: 'productImage.index',
      component: ProductImage
    },
    {
      path: '/productImage/create',
      name: 'productImage.create',
      component: CreateProductImage
    },
    {
      path: '/productImage/:id/edit',
      name: 'productImage.edit',
      component: EditProductImage
    },
    {
      path: '/productImage/:id/show',
      name: 'productImage.show',
      component: ShowProductImage
    },
    {
      path: '/order/index',
      name: 'order.index',
      component: OrderIndex
    },
    {
      path: '/order/create',
      name: 'order.create',
      component: OrderCreate
    },
    {
      path: '/order/:id/edit',
      name: 'order.edit',
      component: OrderEdit
    },
    {
      path: '/order/:id/show',
      name: 'order.show',
      component: OrderShow
    },
    {
      path: '/payment/index',
      name: 'payment.index',
      component: PaymentIndex
    },
    {
      path: '/payment/create',
      name: 'payment.create',
      component: PaymentCreate
    },
    {
      path: '/payment/:id/edit',
      name: 'payment.edit',
      component: PaymentEdit
    },
    {
      path: '/payment/:id/show',
      name: 'payment.show',
      component: PaymentShow
    },
    {
      path: '/coupon/index',
      name: 'coupon.index',
      component: CouponIndex
    },
    {
      path: '/coupon/create',
      name: 'coupon.create',
      component: CouponCreate
    },
    {
      path: '/coupon/:id/edit',
      name: 'coupon.edit',
      component: CouponEdit
    },
    {
      path: '/coupon/:id/show',
      name: 'coupon.show',
      component: CouponShow
    },
    {
      path: '/user/index',
      name: 'user.index',
      component: UserIndex
    },
    {
      path: '/user/create',
      name: 'user.create',
      component: UserCreate
    },
    {
      path: '/user/:id/edit',
      name: 'user.edit',
      component: UserEdit
    },
    {
      path: '/user/:id/show',
      name: 'user.show',
      component: UserShow
    },
    
  ]
})



router.beforeEach(async (to, from) => {
  const auth = useAuthStore();
  if (to.name === 'home' && ! auth.isAuthenticated()) {
    return { name: "auth.login" };
  }

  if ((to.name === 'auth.login' || to.name === 'home') && auth.isAuthenticated()) {
    return { name: "dashboard" };
  }

  if (to.meta.requiresAuth && auth.isAuthenticated()) {
    return true;

  // If `to` route does not requires to be authenticated then let the user go there.
  } else if (!to.meta.requiresAuth) {
    return true;
  }

  return { name: 'auth.login' };
});

export default router
