<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Organizations
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full space-y-6">
          <!-- <div class="max-w-md w-full">
            <input
              class="py-3 px-4 bg-white rounded-lg placeholder-gray-400 text-gray-900 appearance-none inline-block w-full shadow focus:outline-none focus:ring-2 focus:ring-blue-600"
              placeholder="Search..."
              v-model="form.search"
            />
          </div> -->

          <!-- Searche -->
          <div class="max-w-md w-full">
            <jet-input
              id="search"
              type="text"
              placeholder="Search..."
              class="mt-1 block w-full"
              v-model="form.search"
            />
          </div>

          <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <app-table :class="{ 'animate-pulse': loading }">
              <template #head>
                <table-row>
                  <table-heading
                    fieldName="name"
                    :sortable="true"
                    @sorted="onSort"
                  >
                    Name
                  </table-heading>
                  <table-heading
                    fieldName="email"
                    :sortable="true"
                    @sorted="onSort"
                  >
                    City
                  </table-heading>
                  <table-heading
                    fieldName="role"
                    :sortable="true"
                    @sorted="onSort"
                  >
                    Phone
                  </table-heading>
                </table-row>
              </template>

              <template #body>
                <table-row v-if="organizations.data.length <= 0">
                  <table-cell class="opacity-75">No data.</table-cell>
                </table-row>

                <table-row
                  v-else
                  v-for="organization in organizations.data"
                  :key="organization.id"
                >
                  <table-cell>{{ organization.name }}</table-cell>
                  <table-cell>{{ organization.city }}</table-cell>
                  <table-cell>{{ organization.phone }}</table-cell>
                </table-row>
              </template>
            </app-table>
          </div>

          <pagination :links="organizations.links" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import AppTable from "@/Components/table/Table";
import TableRow from "@/Components/table/Row";
import TableHeading from "@/Components/table/Heading";
import TableCell from "@/Components/table/Cell";
import Pagination from "@/Components/Pagination.vue";

export default {
  name: "OrganizationIndex",

  components: {
    AppLayout,
    JetButton,
    JetInput,
    AppTable,
    TableRow,
    TableHeading,
    TableCell,
    Pagination
  },

  props: ["filters", "organizations"],

  data() {
    return {
      loading: false,
      form: {
        search: this.filters.search,
        sort: {
          sortField: this.filters.sortField,
          sortOrder: this.filters.sortOrder
        }
      }
    };
  },

  watch: {
    form: {
      handler: "handleSortSearch",
      deep: true
    }
  },

  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },

    onSort(data) {
      this.form.sort = data;

      this.handleSortSearch();
    },

    handleSortSearch() {
      const data = this.form.sort;

      const options = {
        replace: true,
        preserveState: true,
        preserveScroll: true,
        onStart: visit => {
          this.loading = true;
        },
        onFinish: () => {
          this.loading = false;
        }
      };

      if (this.form.search != "") {
        data.search = this.form.search;
      }

      this.$inertia.get(route("organizations.index"), data, options);
    }
  }
};
</script>

<style scoped></style>
