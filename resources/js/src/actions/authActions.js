import {
  REQUEST,
  AUTO_LOGIN,
  LOGIN,
  LOGOUT,
  FETCH_PROFILE,
} from '../actionTypes'
function action(type, data = {}) {
  return { type, ...data }
}

export const login = formData => action(LOGIN[REQUEST], formData)
export const autoLogin = () => action(AUTO_LOGIN[REQUEST])
export const fetchProfile = formData => action(FETCH_PROFILE[REQUEST], formData)
export const logout = formData => action(LOGOUT, formData)
