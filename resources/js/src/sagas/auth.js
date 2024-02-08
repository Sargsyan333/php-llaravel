/* eslint-disable no-constant-condition */
import {
  // take,
  put,
  call,
  fork,
  // select,
  // all,
  takeEvery
  // takeLatest
} from 'redux-saga/effects'
import {
  AUTO_LOGIN,
  LOGIN,
  REQUEST,
  SUCCESS,
  FAILURE,
  FETCH_PROFILE
} from '../actionTypes'
import {
  getProfile,
  login as loginApi,
} from '../utils/ApiManager'
//import * as AuthManager from '../utils/AuthManager'
import { makeApiCall } from './common'
import Authfunc from '../functions/authfunc'

function* autoLogin() {
  try {
    if (Authfunc.isUserAuthenticated()) {
      let { data } = yield call(getProfile)
      if (data.user) {
        yield put({ type: AUTO_LOGIN[SUCCESS], data: data })
        return
      }
    }
  } catch (err) {
    console.log('Error', err)
  }
  Authfunc.deauthenticateUser()
  yield put({ type: AUTO_LOGIN[FAILURE] })
}

function* login(formData) {
  yield makeApiCall(LOGIN, loginApi, formData)
}

function* watchAutoLogin() {
  yield takeEvery(AUTO_LOGIN[REQUEST], autoLogin)
}

function* watchLogin() {
  yield takeEvery(LOGIN[REQUEST], login)
}

function* fetchProfile() {
  yield makeApiCall(FETCH_PROFILE, getProfile)
}

function* watchFetchProfile() {
  yield takeEvery(FETCH_PROFILE[REQUEST], fetchProfile)
}

export default [
  fork(watchAutoLogin),
  fork(watchLogin),
  fork(watchFetchProfile)
]
