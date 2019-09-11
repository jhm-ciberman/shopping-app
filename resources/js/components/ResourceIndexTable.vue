<template>

    <table class="table my-0 table-hover">
        <thead>
            <tr class="px-2">
                <th v-for="column in columnNames" :key="column.attribute">
                    {{ column.name }}
                </th>
                <th class="col-actions"></th>
                <th class="col-actions"></th>
            </tr>

        </thead>
        <tbody>
            <tr v-for="(resource, index) in resources" :key="resource.id" class="px-2">
                <td v-for="column in columnNames" :key="column.attribute">
                    {{ resource[column.attribute] }}
                </td>
                <td class="col-actions">
                    <button @click="$emit('button-edit-pressed', resource, index)" class="btn d-inline-block btn-outline-secondary btn-sm" aria-label="Edit Product">
                        <i class="material-icons">visibility</i>
                    </button>
                </td>
                <td class="col-actions">
                    <button @click="$emit('button-delete-pressed', resource, index)" class="btn d-inline-block btn-outline-danger btn-sm" aria-label="Remove Product">
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

<style lang="scss">
    .col-actions {
        width: 2.9rem;
        i {
            font-size: 1.2rem;
            line-height: inherit;
        }
    }
</style>
