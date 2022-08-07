<template>
    <div class="container  max-w-7xl mx-auto mt-8">
        <div class="mb-4">
            <h1 class="font-serif text-3xl font-bold underline decoration-gray-400">My Skills</h1>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Title
                            </th>

                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Level
                            </th>
                            
                            <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50" colspan="2">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr v-for="skill in skills" :key="skill.id">
                            <td v-if="skill.id !== editableSkill.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    {{ skill.label }}
                                </div>
                            </td>

                            <td v-if="skill.id !== editableSkill.id" class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                <ResumeLevel :level="skill.level" />
                            </td>

                            <td v-if="skill.id !== editableSkill.id" class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <a href="#" @click="editSkill(skill)">
                                    <BaseIcon type="edit" />
                                </a>
                            </td>

                            <td v-if="skill.id !== editableSkill.id" class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <a href="#" @click="deleteSkill(skill.id)">
                                    <BaseIcon type="delete" />
                                </a>
                            </td>                            

                            <td v-if="skill.id === editableSkill.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseInput v-model="editableSkill.label" placeholder="Write a label..." />
                                </div>
                            </td>

                            <td v-if="skill.id === editableSkill.id" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">
                                    <BaseSelect v-model="editableSkill.level" :options="validateLevel" />                            
                                </div>
                            </td>

                            <td v-if="skill.id === editableSkill.id" class="text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <a v-if="validateEditableSkill" href="#" @click="saveEditableSkill">
                                    <BaseIcon type="save" />
                                </a>
                            </td>
                            <td v-if="skill.id === editableSkill.id">
                                <div class="text-sm leading-5 text-gray-900">
                                    <a href="#" @click="cancelSavingEditableSkill">
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
                                    <BaseInput v-model="newSkill.label" placeholder="Please, write your skill label"/>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                <BaseSelect v-model="newSkill.level" :options="validateLevel" />                            
                            </td>

                            <td colspan="2" class="text-sm text-center font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                <div v-if="validateNewSkill" @click="createSkill">
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
            newSkill : {
                label : '',
                level : 0
            },

            editableSkill : {
                id : null,
                label : '',
                level : 0
            },

            validateLevel : [0,1,2,3,4,5]
        }
    },


    computed: {
        ...mapState('resume', ['skills','test']),

        validateNewSkill(){
            return (this.validateLevel.includes(this.newSkill.level) && this.newSkill.label.length) ? true : false
        },

        validateEditableSkill(){
            return (this.validateLevel.includes(this.editableSkill.level) && this.editableSkill.label.length) ? true : false
        }
    },

    methods: {
        ...mapActions('resume', ['storeNewSkill', 'deleteSkillfromDB', 'updateEditableSkill']),

        createSkill(){
            this.storeNewSkill(this.newSkill)
            this.initSkills()
        },

        simple () {
            this.$modal.show({
                type: 'success',
                title: 'Add a new skill',
                body: 'This is the body property.',
                primary: {
                    label: 'OK',
                    theme: 'white',
                    action: () => this.$toast.success('New Skill added successfully!'),
                },
            })
        },

        deleteSkill(id){
            this.$modal.show({
                type: 'danger',
                title: 'Caution!',
                body: 'This skill is going to be deleted, are you sure!!',
                primary: {
                    label: 'Yes, delete it',
                    theme: 'red',
                    action: () => {
                        // await this.$axios.delete(`skills/${id}`)
                        this.deleteSkillfromDB(id)
                        this.$toast.success('The skill is deleted!')
                    },
                },
                secondary: {
                    label: 'Cancel',
                    theme: 'white',
                    action: () => {},
                },
            })
        },

        initSkills(){
            this.newSkill = {
                label : '',
                level : 0
            }

            this.editableSkill = {
                id : null,
                label : '',
                level : 0
            }

        },

        editSkill(skill){
            this.editableSkill.id = skill.id
            this.editableSkill.label =   skill.label
            this.editableSkill.level = skill.level
        },

        saveEditableSkill(){
            this.updateEditableSkill(this.editableSkill)
            this.initSkills()
            this.$toast.success('Skill updated successfully!')
        },

        cancelSavingEditableSkill(){
            this.initSkills()
        }
    }
}
</script>

<style>

</style>