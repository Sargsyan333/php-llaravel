import { sendPostRequest, sendGetRequest } from './common'

export async function userFindFaqApi(formData) {
    const url = `faqs`
    const response = await sendGetRequest(url, formData)
    return response
}

export async function packagesFindAPI(formData) {
    const url = `packages`
    const response = await sendGetRequest(url, formData)
    return response
}
