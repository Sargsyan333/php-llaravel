import { combineReducers } from 'redux'
import { connectRouter  } from 'connected-react-router'
import { auth } from './auth'
import { products } from './product'
import { orders } from './order'
import { deliveries } from './delivery'
import { commons } from './common'
import history from "../history";

const rootReducer = combineReducers({
  auth,
  products,
  orders,
  deliveries,
  commons,
  router: connectRouter(history)
})

export default rootReducer
