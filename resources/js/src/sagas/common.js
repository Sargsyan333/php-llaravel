import { put, call } from 'redux-saga/effects'
import { SUCCESS, FAILURE } from '../actionTypes'

export function* makeApiCall(entity, apiFn, params = {}) {
  try {
    const response = yield call(apiFn, params)
    const { data } = response
    yield put({ type: entity[SUCCESS], data: data })
  } catch (err) {
    console.log('Er--', err)
    yield put({ type: entity[FAILURE], error: err })
  }
}
