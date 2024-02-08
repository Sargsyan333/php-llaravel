import Authfunc from '../functions/authfunc'
import {
  REQUEST,
  SUCCESS,
  FAILURE,
  LOGIN,
  FETCH_PROFILE,
  AUTO_LOGIN,
  LOGOUT
} from '../actionTypes'

const initialState = {
  user: null,
  autoLoggingIn: true,
  signedUp: false,
  saving: false,
  loading: false,
  verifying: false,
  userData: null,
  error: null,
  info: null
}

export const auth = (state = initialState, action) => {
  switch (action.type) {
    case LOGIN[REQUEST]:
      return {
        ...state,
        error: null,
        loading: true
      }
    case FETCH_PROFILE[REQUEST]:
      return {
        ...state,
        error: null
      }
    case LOGIN[SUCCESS]:
      Authfunc.authenticateUser(action.data.user, action.data.token)
      return {
        ...state,
        error: null,
        user: action.data.user,
        loading: false
      }
    case AUTO_LOGIN[SUCCESS]:
      // AuthManager.saveAuthentication(action.data)
      return {
        ...state,
        error: null,
        user: action.data.user,
        loading: false,
        autoLoggingIn: false
      }
    case FETCH_PROFILE[SUCCESS]:
      return {
        ...state,
        loading: false,
        user: action.data.user,
      }
    case AUTO_LOGIN[FAILURE]:
      return {
        ...state,
        user: null,
        error: null,
        autoLoggingIn: false,
        loading: false
      }
    case LOGOUT:
      Authfunc.deauthenticateUser()
      return {
        ...state,
        user: null,
      }
    case FETCH_PROFILE[FAILURE]:
    case LOGIN[FAILURE]:
      return {
        ...state,
        error: "getErrorMessage(action.error)",
        loading: false
      }
    default:
      return state
  }
}
