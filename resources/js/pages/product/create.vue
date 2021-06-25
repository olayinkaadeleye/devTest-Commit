<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div
            class="
              card-header
              d-flex
              justify-content-between
              align-items-center
            "
          >
            <h5>Create Products Page</h5>
            <router-link :to="{ name: 'product-list' }" class="btn btn-primary"
              >Product List</router-link
            >
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 offset-3">
                <form @submit.prevent="createProduct">
                  <div class="form-group">
                    <label for="">Product name</label>
                    <input
                      id="name"
                      v-model="productForm.name"
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="product name"
                    />
                    <HasError :form="productForm" field="name" />
                  </div>

                  <div class="form-group">
                    <label for="">Select Product Category</label>
                    <select
                      name="category_id"
                      class="form-control"
                      v-model="productForm.category_id"
                    >
                      <option style="display: none" value="" selected>
                        Select Category
                      </option>
                      <option
                        :value="category.id"
                        v-for="category in categories"
                        :key="category.id"
                      >
                        {{category.name}}
                      </option>
                    </select>
                    <HasError :form="productForm" field="category_id" />
                  </div>
                  <div class="form-group">
                    <label for="">Product Price</label>
                    <input
                      type="text"
                      v-model="productForm.price"
                      class="form-control"
                      name="price"
                      placeholder="product price"
                    />
                    <HasError :form="productForm" field="price" />
                  </div>

                  <div class="form-group">
                    <label for="">Product Image</label>
                    <input
                      type="file"
                      class="form-control-file"
                      @change="onImageChange"
                    />
                    <HasError :form="productForm" field="image" />
                  </div>
                  <div class="form-group">
                    <label for="">Product Description</label>
                    <textarea
                      v-model="productForm.description"
                      class="form-control"
                      name="description"
                      placeholder="product description"
                      rows="3"
                    ></textarea>
                    <HasError :form="productForm" field="description" />
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">
                      Create Product
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { Form } from "vform"
import { HasError, AlertError } from "vform/src/components/bootstrap5"
import {objectToFormData}  from "object-to-formdata"
export default {
  components: {
    HasError,
    AlertError,
  },

  data() {
    return {
      productForm: new Form({
        name: "",
        price: "",
        category_id: "",
        image: "",
        description: "",
      }),

      categories: [],
    };
  },
  created() {
    axios.get("http://127.0.0.1:8000/api/categories").then((response) => {
     this.categories = response.data;
     console.log(response.data);
    });
  },

  methods: {
    createProduct() {
      this.productForm
        .post('http://127.0.0.1:8000/api/product/create', {
          transformRequest: [function (data, headers) {
              return objectToFormData(data)}],
          onUploadProgress: (e) => {
            // Do whatever you want with the progress event
            console.log(e);
          },
        })
        .then(({ data }) => {
          console.log(data);
          this.productForm.name = "";
          this.productForm.price = "";
          this.productForm.category_id = "",
          this.productForm.image = "";
          this.productForm.description = "";

          this.$toast.success({
            title: "Success!",
            message: "Product created successfully.",
          });
        });
    },
    onImageChange(e) {
      const file = e.target.files[0];
      // Do some client side validation...
      this.productForm.image = file;
    },
  },
};
</script>