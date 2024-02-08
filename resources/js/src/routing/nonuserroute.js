import React from 'react';
import { Route, Redirect } from "react-router-dom";
import Authfunc from '../functions/authfunc';

const NonuserRoute = ({ isLoggedIn, ...props }) =>
    !Authfunc.isUserAuthenticated() ? <Route { ...props } /> : <Redirect to="/dashboard" />

export default NonuserRoute