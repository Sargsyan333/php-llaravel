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
    USER_FAQ_FIND,
    PACKAGES_FIND
  } from '../actionTypes'
  
  import {
    userFindFaqApi,
    packagesFindAPI
  } from '../utils/ApiManager'
  
  import { makeApiCall } from './common'

  function* userFindFaq(params) {
    yield makeApiCall(USER_FAQ_FIND, userFindFaqApi, params.data)
  }
  
  function* watchUserFindFaqs() {
    yield takeLatest(USER_FAQ_FIND[REQUEST], userFindFaq)
  }

  function* packagesFind(params) {
    yield makeApiCall(PACKAGES_FIND, packagesFindAPI, params.data)
  }
  
  function* watchPackagesFind() {
    yield takeLatest(PACKAGES_FIND[REQUEST], packagesFind)
  }

  export default [
    fork(watchUserFindFaqs),
    fork(watchPackagesFind)
  ]
  