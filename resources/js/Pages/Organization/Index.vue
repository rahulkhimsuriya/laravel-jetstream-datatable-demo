<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Organizations
      </h2>
    </template>

    <div class="py-12 px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full space-y-6">
          <alert-message
            v-if="$page.props.flash.error"
            type="error"
            :message="$page.props.flash.error"
            @closed="$page.props.flash.error = ''"
          />

          <alert-message
            v-if="$page.props.flash.success"
            type="success"
            :message="$page.props.flash.success"
            @closed="$page.props.flash.success = ''"
          />

          <div
            class="w-full flex flex-col md:flex-row md:justify-between space-y-4 md:space-y-0"
          >
            <!-- Search -->
            <div class="w-full md:max-w-md">
              <jet-input
                id="search"
                type="text"
                placeholder="Search..."
                class="mt-1 block w-full"
                v-model="form.search"
              />
            </div>

            <div class="w-full md:w-auto">
              <inertia-link
                class="w-full"
                :href="route('organizations.create')"
              >
                <jet-button>
                  <span>Create</span>
                  <span class="hidden md:inline">Organization</span>
                </jet-button>
              </inertia-link>
            </div>
          </div>

          <div class="bg-white overflow-hidden shadow sm:rounded-lg">
            <app-table :class="{ 'animate-pulse': loading }">
              <template #head>
                <table-row :heading="true">
                  <table-heading
                    fieldName="name"
                    :sortable="true"
                    @sorted="onSort"
                  >
                    Name
                  </table-heading>
                  <table-heading
                    fieldName="city"
                    :sortable="true"
                    @sorted="onSort"
                  >
                    City
                  </table-heading>
                  <table-heading
                    fieldName="phone"
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
                  <table-cell>
                    <div class="flex items-center justify-between space-x-2">
                      <div class="text-sm font-medium text-gray-900">
                        {{ organization.phone }}
                      </div>

                      <div class="text-sm text-gray-500">
                        <inertia-link
                          :href="route('organizations.edit', organization.id)"
                        >
                          <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"
                            />
                          </svg>
                        </inertia-link>
                      </div>
                    </div>
                  </table-cell>
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
  import AppLayout from '@/Layouts/AppLayout';
  import JetButton from '@/Jetstream/Button';
  import JetInput from '@/Jetstream/Input';
  import AppTable from '@/Components/table/Table';
  import TableRow from '@/Components/table/Row';
  import TableHeading from '@/Components/table/Heading';
  import TableCell from '@/Components/table/Cell';
  import Pagination from '@/Components/Pagination.vue';
  import AlertMessage from '@/Components/AlertMessage';

  export default {
    name: 'OrganizationIndex',

    components: {
      AppLayout,
      JetButton,
      JetInput,
      AppTable,
      TableRow,
      TableHeading,
      TableCell,
      Pagination,
      AlertMessage,
    },

    props: ['filters', 'organizations'],

    data() {
      return {
        loading: false,
        form: {
          search: this.filters.search,
          sort: {
            sortField: this.filters.sortField,
            sortOrder: this.filters.sortOrder,
          },
        },
      };
    },

    watch: {
      form: {
        handler: 'handleSortSearch',
        deep: true,
      },
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
          onStart: (visit) => {
            this.loading = true;
          },
          onFinish: () => {
            this.loading = false;
          },
        };

        if (this.form.search != '') {
          data.search = this.form.search;
        }

        this.$inertia.get(route('organizations.index'), data, options);
      },
    },
  };
</script>

<style scoped></style>
