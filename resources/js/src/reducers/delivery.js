import * as _ from 'lodash'
import {
  LOGOUT,
  REQUEST,
  FAILURE,
  SUCCESS,
  ADMIN_DELIVERIES_LOAD
} from '../actionTypes'

const data = {
  loaded: false,
  list: [],
  loading: false,
  error: null
}

export function deliveries(state = data, action) {
  switch (action.type) {
    case LOGOUT:
      return data
    case ADMIN_DELIVERIES_LOAD[REQUEST]:
      return Object.assign({}, state, {
        loading: true,
      })
    case ADMIN_DELIVERIES_LOAD[SUCCESS]:
      return Object.assign({}, state, {
        list: action.data.data,
        loading: false
      })
    case ADMIN_DELIVERIES_LOAD[FAILURE]:
      return {
        ...state,
        loading: false
      }
    default:
      return state
  }
}
