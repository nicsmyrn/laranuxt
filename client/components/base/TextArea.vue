<template>
    <div>
        <label v-if="label.length" for="formTextArea" class="form-label inline-block mb-2 text-gray-700">
            {{ label }}
        </label>
    
        <textarea
            :value="value"
            @input="updateValue($event.target.value)"
            id="formTextArea"
            :rows="rows"
            :placeholder="placeholder"
            class="
                form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
            "
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
        },

        rows : {
            type: Number,
            default: 3
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