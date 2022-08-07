<template>
    <div class="max-w-lg m-6">
        <div class="relative">
            <input ref="tag" v-model="newInterest" @keypress.enter="addInterest" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter some interests">

            <div v-for="interest in interests" :key="interest.id" :class="interest.color" class="inline-flex items-center text-sm rounded mt-2 mr-1 overflow-hidden">
                <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1" x-text="tag">
                    {{ interest.label }}
                </span>
                <button @click="deleteInterest(interest.id)" :class="interest.color" class="w-6 h-8 inline-block align-middle text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"/></svg>
                </button>
            </div>
                     
        </div>
    </div>  
</template>

<script>
export default {
    data(){
        return {
            newInterest: '',
            interests : []
        }
    },

    async fetch(){
        let r = await this.$axios.get("interests")

        this.interests = r.data.data
    },

    methods: {
        async addInterest(){
            let r = await this.$axios.post("interests", { label :this.newInterest})

            this.interests.push(r.data.data)

            this.$toast.success('Your interest is added successfully!')
            
            this.newInterest = ''
            this.$refs.tag.focus()
        },

        async deleteInterest(id){
            await this.$axios.delete(`interests/${id}`)

            this.deleteNode(id)
        },

        deleteNode(id)
        {
            let index = this.interests.findIndex(interest => interest.id === id)

            this.interests.splice(index, 1)

            this.$toast.info('The interest is deleted!')
        }
    }
}
</script>

<style>

</style>