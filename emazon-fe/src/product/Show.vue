<template>
  <!-- Modal content -->
  <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
      <!-- Modal header -->
      <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
             Products Details 
          </h3>
         
      </div>
      <div>

        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <table class="w-full text-sm leading-5">
          <tbody>
            <tr>
              <td class="py-3 px-4 text-left font-medium text-gray-600">Id</td>
              <td class="py-3 px-4">{{ product.id }}</td>
            </tr>
            <tr class="bg-gray-50">
              <td class="py-3 px-4 text-left font-medium text-gray-600">Code</td>
              <td class="py-3 px-4 text-left">{{ product.code }}</td>
            </tr>
            <tr>
              <td class="py-3 px-4 text-left font-medium text-gray-600">Title</td>
              <td class="py-3 px-4 text-left">{{ product.title }}</td>
            </tr>
            <tr class="bg-gray-50">
              <td class="py-3 px-4 text-left font-medium text-gray-600">Subtitle</td>
              <td class="py-3 px-4 text-left">{{ product.subtitle }}</td>
            </tr>
            <tr>
              <td class="py-3 px-4 text-left font-medium text-gray-600">Description</td>
              <td class="py-3 px-4 text-left">{{ product.description }}</td>
            </tr>
            <tr class="bg-gray-50">
              <td class="py-3 px-4 text-left font-medium text-gray-600">Marked Price</td>
              <td class="py-3 px-4 text-left">{{ product.price_mp }}</td>
            </tr>
            <tr>
              <td class="py-3 px-4 text-left font-medium text-gray-600">Sell price</td>
              <td class="py-3 px-4 text-left">{{ product.price_sp }}</td>
            </tr>
            <tr class="bg-gray-50">
              <td class="py-3 px-4 text-left font-medium text-gray-600">Category Id</td>
              <td class="py-3 px-4 text-left">{{ product.category_id }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div>
          <h3 class="text-lg font-semibold text-gray-90 dark:text-white">
             Products Image 
          </h3>
          <img :src="product.image_url" style="width: 120px;">
      </div>


      <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

      <form @submit.prevent="onSubmitColor" action="#">

      <div>

        <div class="mb-4 font-semibold text-gray-900 dark:text-white">Select Colour : {{ checkedNames }}</div>

        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            <li v-for="c in color" class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                <div class="flex items-center ps-3">
                    <input v-model="checkedColors" id="vue-checkbox" type="checkbox" :value="c.id" name="colors" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="vue-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{c.color}}</label>
                </div>
            </li>
                  
        </ul>
            <div class="mt-4">
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
            </div>

                 
        </div>
      </form>


        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
      <form @submit.prevent="onSubmitSize" action="#">

        <div>

        <div class="mb-4 font-semibold text-gray-900 dark:text-white">Select Size: {{ checkedSize }}</div>
          <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">

            <li v-for="s in size" class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                <div class="flex items-center ps-3">
                    <input v-model="checkedSize" id="vue-checkbox-list" type="checkbox" :value="s.id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ s.size }}</label>
                </div>
            </li>
            
          
          </ul>
            <div class="mt-4">
              <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
            </div>

        </div>
      </form>


      </div>
     
  </div>


  
  </template>


<script>

import { useProductStore } from '@/stores/ProductStore.js';
import { useColorStore } from '@/stores/ColorStore';
import { useSizeStore } from '@/stores/SizeStore';
import { mapState } from 'pinia';
import { useRoute } from 'vue-router';
import { ref } from 'vue'


//const checkedNames = ref([]);

export default {
	data() {
		return {
			product: {},
      color: [],
      size: [],
      checkedColors: [],
      checkedSize: [],
      id: '',
		}
   
	},


	methods: {
		fetchProduct(id) {
      // this.product = this.productStore.getProduct(id);
			this.getProduct(id).then((data) => {
				this.product = data.data;
				console.log(data.data);
			}).catch((error) => {
				console.error(error);
			}).finally(() => {
				//
			});
		},

    fetchColor() {
      // console.log('ccccccccolor funct called')
      this.getColors().then((data) => {
        console.log(data);
        this.color = data.data;
        console.log(data.data);
      }).catch((error) => {
        console.log(error);
      }).finally(() => {

      });
    },

    fetchSize(id) {
      this.getSizes(id).then((data) => {
        this.size = data.data;
        console.log(data.data);
      }).catch((error) => {
        console.log(error);
      }).finally(() => {

      });
    },

   

    onSubmitColor() {
            console.log('function called');
            this.addColor(this.id, this.checkedColors).then((res) => {
                console.log(res);
                console.log('color added successfully');
                // this.$router.push({name: 'product.product'});
            }).catch((err) => {
                console.log(err);
            })
        },

    onSubmitSize() {
            console.log('function called');
            this.addSize(this.id, this.checkedSize).then((res) => {
                console.log(res);
                // this.$router.push({name: 'product.product'});
            }).catch((err) => {
                console.log(err);
            })
        },
	},

	mounted() {
    this.id = useRoute().params.id;
		this.fetchProduct(useRoute().params.id);
    this.fetchColor();
    this.fetchSize();
	},

	computed: {
		...mapState(useProductStore, ['getProduct']),
    ...mapState(useColorStore, ['getColors']),
    ...mapState(useSizeStore, ['getSizes']),
    ...mapState(useProductStore, ['addColor']),
    ...mapState(useProductStore, ['addSize']),
},

}

</script>