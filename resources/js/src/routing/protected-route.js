import React from 'react';
import { Route, Redirect } from "react-router-dom";
import { connect } from 'react-redux';
import Authfunc from '../functions/authfunc';

const PrivateRoute = ({ autoLoggingIn, currentUser, component: Component, ...props }) => 
<Route {...props} render={props => {
    if (autoLoggingIn) {
        return <div>Loading...</div>
    }
    return currentUser ? (<Component {...props} {...props} />) : (<Redirect to="/login" />)
}}/>
    // Authfunc.isUserAuthenticated() ? <Route { ...props } /> : <Redirect to="/login" />

const mapStateToProps = (state, ownProps) => {
    return {
        currentUser: state.auth.user,
        autoLoggingIn: state.auth.autoLoggingIn
    }
}

export default connect(mapStateToProps, null)(PrivateRoute)
