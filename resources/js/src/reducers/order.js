import * as _ from 'lodash'
import {
  LOGOUT,
  ADMIN_ORDERS_CREATE,
  ADMIN_ORDERS_DELETE,
  ADMIN_ORDERS_LOAD,
  ADMIN_ORDERS_UPDATE,
  ADMIN_ORDERS_FETCH_SINGLE,
  ADMIN_UPDATE_CHECKOUT,
  USER_ORDERS_FIND,
  REQUEST,
  FAILURE,
  SUCCESS
} from '../actionTypes'
import { DEAFULT_CHECKOUT } from '../common/constants'

const initialState = {
  loaded: false,
  list: [],
  currentCheckout : _.cloneDeep(DEAFULT_CHECKOUT),
  loading: false,
  saving: false,
  error: null
}

export function orders(state = _.cloneDeep(initialState), action) {
  switch (action.type) {
    case LOGOUT:
      return _.cloneDeep(initialState)
    case ADMIN_ORDERS_FETCH_SINGLE[REQUEST]:
      return Object.assign({}, state, {
        loading: true,
        adminProduct: null,
        error: null
      })
    
    case ADMIN_ORDERS_FETCH_SINGLE[SUCCESS]:
      return Object.assign({}, state, {
        loading: false,
        adminProduct: action.data.products,
        error: null
      })

    case ADMIN_ORDERS_FETCH_SINGLE[FAILURE]:
      return Object.assign({}, state, {
        loading: false,
        saving: false,
        error: action.error
      })

    case ADMIN_ORDERS_CREATE[REQUEST]:
      return {
        ...state,
        saving: true
      }

    case ADMIN_ORDERS_CREATE[SUCCESS]:
      return {
        ...state,
        saving: false,
        loaded: false
      }

    case ADMIN_ORDERS_CREATE[FAILURE]:
      return {
        ...state,
        saving: false,
        error: action.error
      }

    case ADMIN_UPDATE_CHECKOUT:
      return {
        ...state,
        currentCheckout: {
          ...state.currentCheckout,
          ...action.data
        }
      }

    case USER_ORDERS_FIND[REQUEST]:
      return {
        ...state,
        loading: true
      }

    case USER_ORDERS_FIND[SUCCESS]:
      return {
        ...state,
        loading: false,
        loaded: true,
        list: action.data.data
      }

    case USER_ORDERS_FIND[FAILURE]:
      return {
        ...state,
        loading: false,
        error: action.error
      }
    
    default:
      return state
  }
}
