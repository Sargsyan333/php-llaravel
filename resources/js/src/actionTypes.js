export const REQUEST = 'REQUEST'
export const SUCCESS = 'SUCCESS'
export const FAILURE = 'FAILURE'

function createRequestTypes(base) {
  return [REQUEST, SUCCESS, FAILURE].reduce((acc, type) => {
    acc[type] = `${base}_${type}`
    return acc
  }, {})
}

/**
 * Auth Action Types
 */
export const AUTO_LOGIN = createRequestTypes('AUTO_LOGIN')
export const LOGIN = createRequestTypes('LOGIN')
export const FETCH_PROFILE = createRequestTypes('FETCH_PROFILE')
export const LOGOUT = 'LOGOUT'
export const ADMIN_PRODUCTS_LOAD = createRequestTypes('ADMIN_PRODUCTS_LOAD')
export const ADMIN_PRODUCTS_FETCH_SINGLE = createRequestTypes(
  'ADMIN_PRODUCTS_FETCH_SINGLE'
)

export const ADMIN_ORDERS_LOAD = createRequestTypes('ADMIN_ORDERS_LOAD')
export const ADMIN_ORDERS_CREATE = createRequestTypes(
  'ADMIN_ORDERS_CREATE'
)
export const ADMIN_ORDERS_UPDATE = createRequestTypes(
  'ADMIN_ORDERS_UPDATE'
)
export const ADMIN_ORDERS_DELETE = createRequestTypes(
  'ADMIN_ORDERS_DELETE'
)
export const ADMIN_ORDERS_FETCH_SINGLE = createRequestTypes(
  'ADMIN_ORDERS_FETCH_SINGLE'
)

export const ADMIN_UPDATE_CHECKOUT = 'ADMIN_UPDATE_CHECKOUT'

export const ADMIN_DELIVERIES_LOAD = createRequestTypes('ADMIN_DELIVERIES_LOAD')

export const USER_ORDERS_FIND = createRequestTypes(
  'USER_ORDERS_FIND'
)

export const USER_FAQ_FIND = createRequestTypes(
  'USER_FAQ_FIND'
)

export const PACKAGES_FIND = createRequestTypes(
  'PACKAGES_FIND'
)
