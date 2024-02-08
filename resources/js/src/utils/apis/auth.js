import { sendPostRequest, sendGetRequest } from './common'

export async function login(formData) {
  const url = `login`
  const response = await sendPostRequest(url, formData)
  return response
}

export async function getProfile(formData) {
  const url = `user`
  const response = await sendGetRequest(url, formData)
  return response
}

export async function logout(formData) {
  const url = `logout`
  const response = await sendPostRequest(url, formData)
  return response
}

