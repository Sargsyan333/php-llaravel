import {
  sendGetRequest
} from './common'

/*
 * Products Related APIs
 */

export async function getAdminDeliveries() {
  const url = `deliveries`
  const response = await sendGetRequest(url)
  return response
}
