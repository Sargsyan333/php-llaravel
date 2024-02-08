import * as _ from 'lodash'
import {
  USER_FAQ_FIND,
  REQUEST,
  FAILURE,
  SUCCESS,
  PACKAGES_FIND
} from '../actionTypes'

const initialState = {
  faqs: {
    list: [],
    loading: false,
    loaded: false,
    error: null
  },
  packages: {
    list: [],
    loading: false,
    loaded: false,
    error: null
  },
  saving: false,
}

export function commons(state = _.cloneDeep(initialState), action) {
  switch (action.type) {

    case USER_FAQ_FIND[REQUEST]:
      return {
        ...state,
        faqs: { 
          ...state.faqs,
          loading: true 
        }
      }

    case USER_FAQ_FIND[SUCCESS]:
      return {
        ...state,
        faqs: {
          ...state.faqs,
          loading: false,
          loaded: true,
          list: action.data.data
        }
        
      }

    case USER_FAQ_FIND[FAILURE]:
      return {
        ...state,
        faqs: {
          ...state.faqs,
          loading: false,
          error: action.error
        }
      }
    
    case PACKAGES_FIND[REQUEST]:
      return {
        ...state,
        packages: { 
          ...state.packages,
          loading: true 
        }
      }

    case PACKAGES_FIND[SUCCESS]:
      return {
        ...state,
        packages: {
          ...state.packages,
          loading: false,
          loaded: true,
          list: action.data.data
        }
        
      }

    case PACKAGES_FIND[FAILURE]:
      return {
        ...state,
        packages: {
          ...state.packages,
          loading: false,
          error: action.error
        }
      }
    default:
      return state
  }
}
