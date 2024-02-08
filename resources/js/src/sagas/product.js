/* eslint-disable no-constant-condition */
import {
  // take,
  // put,
  // call,
  fork,
  // select,
  // all,
  takeEvery,
  takeLatest
} from 'redux-saga/effects'

import {
  ADMIN_PRODUCTS_FETCH_SINGLE,
  ADMIN_PRODUCTS_LOAD,
  REQUEST
  // FAILURE
} from '../actionTypes'
import {
  getAdminProducts,
} from '../utils/ApiManager'

import { makeApiCall } from './common'

function* adminLoadProducts(params) {
  yield makeApiCall(ADMIN_PRODUCTS_LOAD, getAdminProducts, params)
}

function* watchAdminLoadProducts() {
  yield takeLatest(ADMIN_PRODUCTS_LOAD[REQUEST], adminLoadProducts)
}

function* adminFetchSingleProducts(params) {

}

function* watchAdminFetchSingleProducts() {
  yield takeEvery(
    ADMIN_PRODUCTS_FETCH_SINGLE[REQUEST],
    adminFetchSingleProducts
  )
}

export default [
  fork(watchAdminLoadProducts),
  fork(watchAdminFetchSingleProducts),
]
