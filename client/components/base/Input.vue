<template>
    <div>
        <label v-if="label.length" for="formInput" class="form-label inline-block mb-2 text-gray-700">
            {{ label }}
        </label>
        <input 
            type="text" 
            id="formInput"
            placeholder="Please type a label for the skill" 
            :value="value"
            @input="updateValue($event.target.value)"
            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"  
        />
    
    </div>
</template>

<script>
export default {
    props: {
        value : {
            type: String | Number,
            required: true
        },

        placeholder : {
            type: String,
            required: false,
            default: ''
        },

        label : {
            type: String,
            default: '',
            required: false
        }
    },

    methods: {
        updateValue(value){
            this.$emit("input", value)
        }
    }
}
</script>

<style>

</style>