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
  REQUEST,
  ADMIN_ORDERS_CREATE,
  USER_ORDERS_FIND
} from '../actionTypes'

import {
  adminCreateOrderApi,
  userFindOrderApi
} from '../utils/ApiManager'

import { makeApiCall } from './common'

function* adminCreateOrder(params) {
  yield makeApiCall(ADMIN_ORDERS_CREATE, adminCreateOrderApi, params.data)
}

function* watchAdminCreateOrders() {
  yield takeLatest(ADMIN_ORDERS_CREATE[REQUEST], adminCreateOrder)
}

function* userFindOrder(params) {
  yield makeApiCall(USER_ORDERS_FIND, userFindOrderApi, params.data)
}

function* watchUserFindOrders() {
  yield takeLatest(USER_ORDERS_FIND[REQUEST], userFindOrder)
}

export default [
  fork(watchAdminCreateOrders),
  fork(watchUserFindOrders)
]
