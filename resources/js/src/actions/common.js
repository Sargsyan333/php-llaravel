import {
    REQUEST,
    USER_FAQ_FIND,
    PACKAGES_FIND,
  } from "../actionTypes";
  
  function action(type, data = {}) {
    return { type, data };
  }

  export const userFaqFind = formData =>
  action(USER_FAQ_FIND[REQUEST], formData);

export const packagesFind = formData =>
  action(PACKAGES_FIND[REQUEST], formData);