import axios from 'axios'
import { API_BASE_URL } from '../../common/constants'
//import { getAccessToken } from '../AuthManager'
import Authfunc from '../../functions/authfunc'

function headerForRequest(headers = {}) {
  let token = Authfunc.getToken()
  if (token && !headers.Authorization) {
    headers['Authorization'] = `Bearer ${token}`
  }
  return headers
}

export async function sendGetRequest(
  relativeUrl,
  customHeaders = {},
  params = {}
) {
  const url = `${API_BASE_URL}${relativeUrl}`
  const response = await axios({
    method: 'GET',
    url,
    params,
    headers: headerForRequest(customHeaders)
  })
  return response
}

export async function sendPostRequest(
  relativeUrl,
  formData,
  customHeaders = {}
) {
  const url = `${API_BASE_URL}${relativeUrl}`
  const response = await axios({
    method: 'POST',
    url,
    headers: headerForRequest(customHeaders),
    data: formData
  })
  return response
}

export async function sendDeleteRequest(relativeUrl) {
  const url = `${API_BASE_URL}${relativeUrl}`

  const response = await axios({
    method: 'DELETE',
    url,
    headers: headerForRequest()
  })
  return response
}

export async function sendPutRequest(relativeUrl, formData) {
  const url = `${API_BASE_URL}${relativeUrl}`

  const response = await axios({
    method: 'PUT',
    url,
    data: formData,
    headers: headerForRequest()
  })
  return response
}
