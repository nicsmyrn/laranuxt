<template>
    <select
        class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" 
        aria-label="Default select example"
        :value="value"
        @input="updateValue($event.target.value)"
    >
        <option 
            v-for="(option, index) in options" 
            :key="index"
            :value="option"
        >
            {{ option }}
        </option>
  </select>
</template>

<script>
export default {
    props: {
        value: {
            type: String | Number | Object,
            required : true
        },

        options : {
            type: Array,
            default: []
        }
    },

    methods: {
        updateValue(value){
            this.$emit("input", Number(value))
        }
    }
}
</script>

<style>

</style>