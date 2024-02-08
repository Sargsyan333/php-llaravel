import { all } from 'redux-saga/effects'
import AuthSagas from './auth'
import ProductSagas from './product';
import OrderSagas from './order';
import DeliverySagas from './delivery';
import CommonsSagas from './commonsaga';

export default function* root() {
  yield all([
    ...AuthSagas,
    ...ProductSagas,
    ...OrderSagas,
    ...DeliverySagas,
    ...CommonsSagas
  ])
}
