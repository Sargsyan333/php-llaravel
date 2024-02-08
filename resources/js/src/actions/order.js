import {
  REQUEST,
  ADMIN_UPDATE_CHECKOUT,
  ADMIN_ORDERS_CREATE,
  USER_ORDERS_FIND,
} from "../actionTypes";

function action(type, data = {}) {
  return { type, data };
}

export const adminUpdateCheckout = formData =>
action(ADMIN_UPDATE_CHECKOUT, formData);

export const adminOrdersCreate = formData =>
action(ADMIN_ORDERS_CREATE[REQUEST], formData);

export const userOrdersFind = formData =>
action(USER_ORDERS_FIND[REQUEST], formData);