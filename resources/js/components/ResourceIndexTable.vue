<template>

    <table class="table my-0 table-hover">
        <thead>
            <tr>
                <th v-for="column in columnNames" :key="column.key">
                    {{ column.name }}
                </th>
                <th></th>
            </tr>
            
        </thead>
        <tbody>
            <tr v-for="(resource, index) in resources" :key="resource.id">
                <td v-for="column in columnNames" :key="column.key">
                    {{ resource[column.key] }}
                </td>
                <td>
                    <button @click="$emit('resource-deleted', resource, index)" type="submit" class="btn btn-outline-danger btn-sm" aria-label="Remove Product">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>

        </tbody>
    </table>


</template>

<script>
export default {
    props: {
        columnNames: Array,
        resources: Array,
    },
}
</script>
