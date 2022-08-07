import type { GetterTree, ActionTree, MutationTree } from 'vuex'


export interface RootState {
  email: string,
  password : string
}

export const state = (): RootState => ({
  email: 'nicsmyrn@gmail.com',
  password: 'password'
})

export const getters: GetterTree<RootState, RootState> = {
  reversedName: (state): string => state.email.split('').reverse().join(''),
}

export const MutationType = {
  CHANGE_DESCRIPTION: 'changeDescription',
}

export const mutations: MutationTree<RootState> = {
  // [MutationType.CHANGE_DESCRIPTION]: (state, newDescription: string) => { state.description = newDescription },
}

export const actions: ActionTree<RootState, RootState> = {
  // nuxtServerInit ({ commit }, _context: Context) {
  //   commit(MutationType.CHANGE_DESCRIPTION, "I'm defined by server side")
  // },
}
