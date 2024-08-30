import { defineStore } from 'pinia';

export const useUserStore = defineStore('token', {
  state: () => ({
    token: null as string | null,
    user: null as object | null,
  }),
  actions: {
    setToken(token: string) {
      this.token = token;
    },
    clearToken() {
      this.token = null;
    },

    setUser(user: object) {
      this.user = user;
    },
    clearUser() {
      this.user = null;
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
  persist: {
    storage: persistedState.localStorage,
  },
});