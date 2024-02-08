import {
  REQUEST,
  ADMIN_DELIVERIES_LOAD
} from "../actionTypes";

function action(type, data = {}) {
  return { type, data };
}

export const adminLoadDeliveries = formData =>
action(ADMIN_DELIVERIES_LOAD[REQUEST], formData);
