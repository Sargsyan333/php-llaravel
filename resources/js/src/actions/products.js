import {
  REQUEST,
  ADMIN_PRODUCTS_FETCH_SINGLE,
  ADMIN_PRODUCTS_LOAD,
} from "../actionTypes";

function action(type, data = {}) {
  return { type, data };
}

export const adminLoadProducts = formData =>{
  return action(ADMIN_PRODUCTS_LOAD[REQUEST], formData);
}

export const adminFetchSingleProducts = formData =>
  action(ADMIN_PRODUCTS_FETCH_SINGLE[REQUEST], formData);
