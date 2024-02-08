import { sendPostRequest, sendGetRequest } from './common'

export async function adminCreateOrderApi(formData) {
  const url = `orders/create`
  const response = await sendPostRequest(url, formData)
  return response
}

export async function userFindOrderApi(formData) {
  const url = `orders`
  const response = await sendGetRequest(url, formData)
  return response
}
