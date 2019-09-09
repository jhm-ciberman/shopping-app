<template>
  <div>
        <resource-index-table
            v-if="resourcesData"
            :resources="resourcesData"
            :column-names="columnNames"
            @resource-deleted="deleteResource"
            >
        </resource-index-table>

        <div class="m-4">
            <pagination :data="responseData" align="center" @pagination-change-page="getResults"></pagination>
        </div>
        
  </div>
</template>

<script>
export default {
    props: {
        endpointUrl: String,
    },

    data: function() {
        return {
            columnNames: [
                {key: 'id', name:'Id'},
                {key: 'name', name:'Name'},
                {key: 'email', name:'Email'},
            ],
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

<style>

</style>