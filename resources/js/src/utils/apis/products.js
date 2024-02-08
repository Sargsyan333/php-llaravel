import {
  sendPostRequest,
  sendDeleteRequest,
  sendPutRequest,
  sendGetRequest
} from './common'

/*
 * Products Related APIs
 */

export async function getAdminProducts() {
  const url = `products`
  const response = await sendGetRequest(url)
  return response
}
