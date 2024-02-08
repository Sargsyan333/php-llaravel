export function getErrorMessage(
  error,
  defaultMessage = 'Something went wrong'
) {
  if (typeof error === 'string') {
    return error
  }
  if (
    error &&
    error.response &&
    error.response.data &&
    error.response.data.message
  ) {
    return error.response.data.message
  }
  if (error.message && typeof error.message === 'string') {
    return error.message
  }
  return defaultMessage
}
