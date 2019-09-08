<template>
    <div class="input-group">
        <input type="text" v-model="displayedValue" name="street_number" id="street_number" class="form-control" :disabled="withoutNumber" :class="{'is-invalid': invalid}">
        <div class="input-group-append">
            <div class="input-group-text">
                <input type="checkbox" id="without_number" v-model="withoutNumber">
                <label class="ml-2 form-check-label" for="without_number">{{ withoutNumberText }}</label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        initialValue: String,
        initialWithoutNumber: Boolean,
        invalid: Boolean,
        withoutNumberText: String,
    },
    data: function() {
        return {
            value: this.initialValue,
            isInvalid: this.invalid,
            withoutNumber: this.initialWithoutNumber,
        };
    },
    computed: {
        displayedValue: {
            get: function() {
                return this.withoutNumber ? '' : this.value;
            },
            set: function(value) {
                this.value = value;
            }
        }
    },
}
</script>
