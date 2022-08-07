<template>
    <h2>Page Skill ID : {{ id }}</h2>
</template>

<script>
import {mapState} from 'vuex'
export default {
    data(){
        return {
            id : this.$route.params.id
        }
    },

    async fetch({store, params}){
        await store.dispatch('resume/getSkill', params.id)
    },

    computed: {
        ...mapState('resume', ['skill'])
    }
}
</script>

<style>

</style>