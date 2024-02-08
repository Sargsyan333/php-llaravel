export const API_BASE_URL = process.env.REACT_APP_BACKEND_BASE_URL || '/api/'

export const DEAFULT_CHECKOUT = {
  products: {},
  userInfo: {
    name: '',
    address: '',
    city: '',
    zipcode: '',
    email: '',
    mobile: '',
    packagePlacement: '',
    packagePlacementOther: ''
  }
}
