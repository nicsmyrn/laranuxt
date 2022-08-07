import type { GetterTree, ActionTree, MutationTree } from 'vuex'
import { Info, Skill, Work } from '../types/api'


export interface RootState {
  skills : Array<Skill>,
  skill : Skill | null,
  works : Array<Work>
  work  : Work | null 
}

export const state = (): RootState => ({
  skills : [],
  skill : null,

  works : [],
  work  : null
})

export const getters: GetterTree<RootState, RootState> = {
}

export const MutationType = {
  SET_SKILLS  : 'setSkills',
  ADD_SKILL     : 'addSkill',
  REMOVE_SKILL  : 'removeSkill',
  SET_SKILL     : 'setSkill',
  UPDATE_SKILL  : 'updateSkillInState',

  SET_WORKS    : 'setWorks',
  ADD_WORK     : 'addWork',
  REMOVE_WORK  : 'removeWork',
  SET_WORK     : 'setWork',
  UPDATE_WORK  : 'updateWorkInState',
}

export const mutations: MutationTree<RootState> = {
  [MutationType.SET_SKILLS]: (state, skills: Array<Skill>) => { state.skills = skills },
  [MutationType.SET_SKILL]: (state, skill : Skill) => { state.skill = skill },
  [MutationType.ADD_SKILL]: (state, newSkill: Skill) => { state.skills.push(newSkill) },
  [MutationType.UPDATE_SKILL]: (state, editableSkill: Skill) => { 
      state.skills =  state.skills.map(s => s.id === editableSkill.id ? editableSkill : s)
  },
  [MutationType.REMOVE_SKILL]: (state, id : number) => { 
      const index = state.skills.findIndex(skill => skill.id === id)

      if(index > -1) 
        state.skills.splice(index, 1)
  },

  // ##########################################

  [MutationType.SET_WORKS]: (state, works: Array<Work>) => { state.works = works },
  [MutationType.SET_WORK]: (state, work : Work) => { state.work = work },
  [MutationType.ADD_WORK]: (state, newWork: Work) => { state.works.push(newWork) },
  [MutationType.UPDATE_WORK]: (state, editableWork: Work) => { 
      state.works =  state.works.map(s => s.id === editableWork.id ? editableWork : s)
  },
  [MutationType.REMOVE_WORK]: (state, id : number) => { 
      const index = state.works.findIndex(work => work.id === id)

      if(index > -1) 
        state.works.splice(index, 1)
  },

}

export const actions: ActionTree<RootState, RootState> = {
  //####################### Skills ####################################3
    async getSkills({commit}){
        let r = await this.$axios.get('skills')

        commit('setSkills', r.data.data)        
    },

    async getSkill({commit}, id){
        let r = await this.$axios.get(`skills/${id}`)

        commit('setSkill', r.data.data)
    },

    createSkill({commit}, skill){
        commit('addSkill', skill)
    },

    async storeNewSkill({commit}, newSkill){
      let r = await this.$axios.post('skills', newSkill)

      commit('addSkill', r.data.data)
    },

    async updateEditableSkill({commit}, editableSkill){
      let r = await this.$axios.patch(`skills/${editableSkill.id}`, editableSkill)

      commit('updateSkillInState', r.data.data)
    },

    async deleteSkillfromDB({commit}, id){
      let r = await this.$axios.delete(`skills/${id}`)

      commit('removeSkill', id)
    },

    //###############################################


    //####################### Working History ####################################3
    async getWorks({commit}){
        let r = await this.$axios.get('works')

        commit('setWorks', r.data.data)        
    },

    async getWork({commit}, id){
        let r = await this.$axios.get(`works/${id}`)

        commit('setWork', r.data.data)
    },

    createWork({commit}, work){
        commit('addWork', work)
    },

    async storeNewWork({commit}, newWork){
      let r = await this.$axios.post('works', newWork)

      commit('addWork', r.data.data)
    },

    async updateEditableWork({commit}, editableWork){
      let r = await this.$axios.patch(`works/${editableWork.id}`, editableWork)

      commit('updateWorkInState', r.data.data)
    },

    async deleteWorkfromDB({commit}, id){
      let r = await this.$axios.delete(`works/${id}`)

      commit('removeWork', id)
    },

    //###############################################    

}
