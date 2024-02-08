import * as _ from 'lodash'
import {
  LOGOUT,
  ADMIN_PRODUCTS_FETCH_SINGLE,
  ADMIN_PRODUCTS_LOAD,
  REQUEST,
  FAILURE,
  SUCCESS
} from '../actionTypes'

const data = {
  loaded: false,
  list: [],
  product: null,
  loading: false,
  saving: false,
  error: null
}
export function products(state = _.cloneDeep(data), action) {
  switch (action.type) {
    case LOGOUT:
      return _.cloneDeep(data)
    case ADMIN_PRODUCTS_FETCH_SINGLE[REQUEST]:
      return Object.assign({}, state, {
        loading: true,
        adminProduct: null,
        error: null
      })
    case ADMIN_PRODUCTS_LOAD[REQUEST]:
      return Object.assign({}, state, {
        loading: true,
        error: null
      })
    case ADMIN_PRODUCTS_LOAD[SUCCESS]:
      return Object.assign({}, state, {
        loading: false,
        error: null,
        loaded: true,
        list: action.data.data
      })
    case ADMIN_PRODUCTS_FETCH_SINGLE[SUCCESS]:
      return Object.assign({}, state, {
        loading: false,
        adminProduct: action.data.products,
        error: null
      })
    case ADMIN_PRODUCTS_FETCH_SINGLE[FAILURE]:
    case ADMIN_PRODUCTS_LOAD[FAILURE]:
      return Object.assign({}, state, {
        loading: false,
        saving: false,
        error: action.error
      })
    default:
      return state
  }
}
