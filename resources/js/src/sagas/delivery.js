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
  ADMIN_DELIVERIES_LOAD
  // FAILURE
} from '../actionTypes'
import {
  getAdminDeliveries,
} from '../utils/ApiManager'
import { makeApiCall } from './common'

function* adminCommonLoadDeliveries(params) {
  yield makeApiCall(ADMIN_DELIVERIES_LOAD, getAdminDeliveries, params)
}

function* watchAdminCommonLoadDeliveries() {
  yield takeLatest(ADMIN_DELIVERIES_LOAD[REQUEST], adminCommonLoadDeliveries)
}

export default [
  fork(watchAdminCommonLoadDeliveries)
]
