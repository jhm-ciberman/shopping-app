<template>
  <div>

        <div class="card">
            <resource-index-table
            :resources="resourcesData"
            :column-names="columns"
            @button-delete-pressed="deleteResource"
            @button-edit-pressed="editResource"
            >
            </resource-index-table>
        </div>


        <div class="m-4">
            <pagination :data="responseData" align="center" @pagination-change-page="getResults"></pagination>
        </div>

  </div>
</template>

<script>
export default {
    props: {
        columns: Array,
        endpointUrl: String,
    },

    data: function() {
        return {
            responseData: {},
        }
    },

    computed: {
        resourcesData: function() {
            return this.responseData ? this.responseData.data : null;
        }
    },

    created: function() {
        this.getResults();
    },

    methods: {

        getResults(page = 1) {
            axios.get(this.endpointUrl + '?page=' + page).then(response => {
                console.log(response.data);
                this.responseData = response.data;
            });
        },

        editResource(resource, index) {
            window.location = this.endpointUrl + "/" + resource.id;
        },

        deleteResource(resource, index) {
            if (!this.resourcesData) {
                return;
            }

            const id = resource['id'];

            if (id === undefined) {
                return;
            }

            axios.delete(this.endpointUrl + "/" + id).then(response => {
                this.resourcesData.splice(index, 1);
            });
        }
    }

}
</script>
