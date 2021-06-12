<template>
  <div>
    <Layout>
      <div class="flex justify-center w-full">
        <div class="bg-white flex flex-col w-1/3 mt-20 p-6">
          <h2 class="text-lg">Stock Form</h2>
          <form id="stock-form" name="stock-form" v-on:submit.prevent="submit">
            <div class="flex flex-col pt-6">
              <label for="type">Category</label>
              <select name="type" id="type" v-model="form.stock_category_id">
                <option
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.description }}
                </option>
              </select>

              <div class="text-red-700 text-sm">
                {{ errors.stock_category_id }}
              </div>
            </div>
            <div class="flex flex-col pt-6">
              <label for="description">Description</label>
              <input
                type="text"
                id="description"
                name="description"
                v-model="form.description"
                autocomplete="off"
              />
              <div class="text-red-700 text-sm">
                {{ errors.description }}
              </div>
            </div>
            <div class="flex flex-col pt-6">
              <label for="uom">UOM</label>
              <select name="type" id="type" v-model="form.uom">
                <option
                  v-for="uom in uoms"
                  :key="uom.id"
                  :value="uom.id"
                >
                  {{ uom.description }}
                </option>
              </select>
              <div class="text-red-700 text-sm">
                {{ errors.uom }}
              </div>
            </div>
            <div class="flex flex-col pt-6">
              <label for="barcode">Barcode</label>
              <input
                type="text"
                id="barcode"
                name="barcode"
                v-model="form.barcode"
                autocomplete="off"
              />
              <div class="text-red-700 text-sm">
                {{ errors.barcode }}
              </div>
            </div>
            <div class="flex flex-col pt-6">
              <label>
                <input
                  v-model="form.discontinued"
                  name="discontinued"
                  type="checkbox"
                  class="form-checkbox h-5 w-5 text-gray-600"
                />
                <span class="ml-2 text-gray-700">Discontinued</span>
              </label>

              <div class="text-red-700 text-sm">
                {{ errors.discontinued }}
              </div>
            </div>
            <div class="flex flex-col pt-6">
              <button type="submit" class="bg-indigo-800 text-white p-2">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </Layout>
  </div>
</template>

<script>
import { ref, reactive } from "vue";
import Layout from "@/Layouts/Authenticated";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Layout,
  },

  props: ["errors", "categories", "uoms"],

  setup(props, context) {
    const form = reactive({
      stock_category_id: null,
      description: "",
      uom: null,
      barcode: "",
      discontinued: false,
    });

    const submit = () => {
      Inertia.post(route("stock.store"), form, {
        onSuccess: () => {
          // Handle success event
          form.stock_category_id = null;
          form.description = "";
          form.uom = null;
          form.barcode = "";
          form.discontinued = false;
          //   this.reset();
        },
      });
    };

    return {
      form,
      submit,
    };
  },
};
</script>
