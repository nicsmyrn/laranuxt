<template>
    <div class="container  max-w-7xl mx-auto mt-8">
        <div class="mb-4">
            <h1 class="font-serif text-3xl font-bold underline decoration-gray-400">Work History!</h1>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Job title
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Employer
                            </th>
                            
                            <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                City
                            </th>                            
                            <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                Stard date
                            </th>

                            <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50">
                                End Date
                            </th>

                            <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="2">
                                Action
                            </th>                                                        
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr v-for="work in works" :key="work.id">

                            <td v-if="work.id !== editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ work.job_title }}
                                </div>
                            </td>

                            <td v-if="work.id !== editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ work.employer }}
                                </div>
                            </td>

                            <td v-if="work.id !== editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ work.city }}
                                </div>
                            </td>              

                            <td v-if="work.id !== editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ work.start_date }}
                                </div>
                            </td>                                          

                            <td v-if="work.id !== editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ work.end_date }}
                                </div>
                            </td>

                            <td v-if="work.id !== editableWork.id" class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <a href="#" @click="editWork(work)">
                                    <BaseIcon type="edit" />
                                </a>
                            </td>

                            <td v-if="work.id !== editableWork.id" class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <a href="#" @click="deleteWork(work.id)">
                                    <BaseIcon type="delete" />
                                </a>
                            </td>   

                            <!-- ##################################  -->                         

                            <td v-if="work.id === editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="editableWork.job_title" placeholder="Write a job Title..." />
                                </div>
                            </td>


                            <td v-if="work.id === editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="editableWork.employer" placeholder="Write the employer ..." />
                                </div>
                            </td>

                            <td v-if="work.id === editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="editableWork.city" placeholder="Write the city you have worked..." />
                                </div>
                            </td>

                            <td v-if="work.id === editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="editableWork.start_date" placeholder="Write the starting date..." />
                                </div>
                            </td>                                                        


                            <td v-if="work.id === editableWork.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="editableWork.end_date" placeholder="Write the ending date..." />
                                </div>
                            </td>                                                           

                            <td v-if="work.id === editableWork.id" class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <a v-if="validateEditableWork" href="#" @click="saveEditableWork">
                                    <BaseIcon type="save" />
                                </a>
                            </td>
                            <td v-if="work.id === editableWork.id">
                                <div class="text-sm leading-5 text-gray-900">
                                    <a href="#" @click="cancelSavingeditableWork">
                                        <BaseIcon type="cancel" />
                                    </a>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                    <tfoot>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="newWork.job_title" placeholder="Please, write your work title"/>
                                </div>
                            </td>


                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="newWork.employer" placeholder="Please, write your work employer"/>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="newWork.city" placeholder="Please, write your work city"/>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="newWork.start_date" placeholder="Please, write when you started to Work"/>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="newWork.end_date" placeholder="Please, write when your work ended!"/>
                                </div>
                            </td>                                                                                    

                            <td colspan="2" class="text-sm text-center font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <div v-if="validateNewWork" @click="createWork">
                                    <BaseIcon type="create" />
                                </div>
                                <div v-else>
                                    <BaseIcon type="create" :disabled="true" />
                                </div>
                          </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>

        <div class="flex flex-col">

        </div>
    </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'

export default {
    data(){
        return {
            newWork : {
                job_title : '',
                employer : '',
                city : '',
                start_date : '',
                end_date : '',
            },

            editableWork : {
                id : null,
                job_title : '',
                employer : '',
                city : '',
                start_date : '',
                end_date : '',
            },
        }
    },


    computed: {
        ...mapState('resume', ['works']),

        validateNewWork(){
            return (this.newWork.job_title.length &&
                    this.newWork.employer.length &&
                    this.newWork.city.length &&
                    this.newWork.start_date &&
                    this.newWork.end_date ) ? true : false
        },

        validateEditableWork(){
            return (this.editableWork.job_title.length &&
                    this.editableWork.employer.length &&
                    this.editableWork.city.length &&
                    this.editableWork.start_date.length &&
                    this.editableWork.end_date.length) ? true : false
        }
    },

    methods: {
        ...mapActions('resume', ['storeNewWork', 'deleteWorkfromDB', 'updateEditableWork']),

        createWork(){
            this.storeNewWork(this.newWork)
            this.initWorks()
        },

        simple () {
            this.$modal.show({
                type: 'success',
                title: 'Add a new work',
                body: 'This is the body property.',
                primary: {
                    label: 'OK',
                    theme: 'white',
                    action: () => this.$toast.success('New word added successfully!'),
                },
            })
        },

        deleteWork(id){
            this.$modal.show({
                type: 'danger',
                title: 'Caution!',
                body: 'This work is going to be deleted, are you sure!!',
                primary: {
                    label: 'Yes, delete it',
                    theme: 'red',
                    action: () => {
                        this.deleteWorkfromDB(id)
                        this.$toast.success('The work is deleted!')
                    },
                },
                secondary: {
                    label: 'Cancel',
                    theme: 'white',
                    action: () => {},
                },
            })
        },

        initWorks(){
            this.newWork = {
                job_title : '',
                employer : '',
                city : '',
                start_date : '',
                end_date : '',
            }

            this.editableWork = {
                id : null,
                job_title : '',
                employer : '',
                city : '',
                start_date : '',
                end_date : '',
            }

        },

        editWork(work){
            this.editableWork.id = work.id
            this.editableWork.job_title =   work.job_title
            this.editableWork.employer = work.employer
            this.editableWork.city = work.city
            this.editableWork.start_date = work.start_date
            this.editableWork.end_date = work.end_date
        },

        saveEditableWork(){
            this.updateEditableWork(this.editableWork)
            this.initWorks()
            this.$toast.success('Work updated successfully!')
        },

        cancelSavingeditableWork(){
            this.initWorks()
        }
    }
}
</script>

<style>

</style>