<template>
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
        <h2 class="font-semibold text-3xl mb-5">Hello {{ name }}!</h2>

        <div class="grid grid-cols-2 gap-4">
            <div class="form-group mb-6">
                    <BaseInput label="City" v-model="info.city" />
            </div>
            <div class="form-group mb-6">
                    <BaseInput label="Zip" v-model="info.zip" />
            </div>
        </div>
        
        <div class="form-group mb-6">
            <ResumeInterests />  
        </div>
        
        <div class="form-group mb-6">
            <BaseInput label="Phone" v-model="info.phone" />
        </div>

        <div class="form-group form-check text-center mb-6">
            <BaseTextArea 
                label="Professional Summary" 
                v-model="info.professional_summary" 
                :rows="4"
            />
        </div>

        <button v-if="!basicInfoDBexists" type="submit"
                @click="storeInfo"    
                class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        >
            Save
        </button>

        <button v-else type="submit"
                @click="updateInfo"    
                class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        >
            Save
        </button>
    </div>
</template>

<script>

export default {
    data(){
        return {
            info : {
                professional_summary : '',
                city : '',
                phone : '',
                zip : '',
            },
            name : '',
            basicInfoDBexists : false
        }
    },

    async fetch(){
        let r = await this.$axios.get('basic-info')
        let infoDB = r.data.data['basic_info']

        if (infoDB != null){
            this.info = infoDB
            this.basicInfoDBexists = true
        }else{
            this.basicInfoDBexists = false
        }

        this.name = r.data.data['name']
    },

    methods: {
        async storeInfo(){
            let r = await this.$axios.post('basic-info/create', this.info)
            this.basicInfoDBexists = true
            this.$toast.info('Basic Info is saved !')
        },

        async updateInfo(){
            let r = await this.$axios.patch('basic-info/update', this.info)

            this.$toast.info('Basic Info is saved !')
        }
    }
}
</script>

<style>

</style>