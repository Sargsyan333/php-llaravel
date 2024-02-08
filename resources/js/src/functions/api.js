import {_get, _post, _put, _patch,_delete} from '../utils/http';

/*-------------- Authentication ---------------*/
export const register = (data) => _post('register',data);
export const login = (data) => _post('login',data);
export const logout = (data) => _post('logout',data);
export const recover = (data) => _post('recover',data);






