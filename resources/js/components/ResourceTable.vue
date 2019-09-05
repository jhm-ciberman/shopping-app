<template>
    <table class="table table-hover">
        <thead>
            <th v-for="column in columns">{{ column.label }}</th>
        </thead>
        <tbody>
            <tr v-for="model in models">
                <td v-for="column in columns">Value for {{ model[column] }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    mounted: function() {
        axios.get('/api/admin/get')
    },
    data: function() {
        return {
            columns: [
                {label: 'Name', prop: 'name'},
                {label: 'Email', prop: 'email'},
                {label: 'Is Admin', prop: 'Is Admin'},
            ],
            models: [],
        };
    },
}
</script>

<style>

</style>