import React from 'react';
import { ConnectedRouter } from 'connected-react-router'
import {
    BrowserRouter as Router,
    Route,
    Switch,
    Redirect
} from "react-router-dom";
import PageTransition from "react-router-page-transition";
import history from '../history'
import { connect } from 'react-redux';
// Stores
import { ApplicationStore } from "../stores/application-store";

// Components
import ProtectedRoute from "./protected-route";
import NonuserRoute from "./nonuserroute";

import Menu from "../components/menu/menu";
import Progress from "../components/progress/progress";
import Continue from "../components/continue/continue";

// Pages
import Login from "../pages/login/login";
import ResetPassword from "../pages/reset-password/reset-password";

// Authenticated Pages
import Faq from "../pages/faq/faq";
import Dashboard from "../pages/dashboard/dashboard";
import OrderFind from "../pages/order-find/order-find";
import Checkout from '../pages/checkout';
import { autoLogin } from '../actions/authActions';

class Master extends React.Component {

    componentDidMount() {
        const { autoLogin } = this.props;
        autoLogin()
    }

    render() {
        return (
            <main>
                <ApplicationStore>
                    <ConnectedRouter history={history}>
                        <div className="main">
                            <Menu />
                            <Progress />
                            <Switch>
                                <NonuserRoute exact path="/login" component={Login} />
                                <NonuserRoute exact path="/reset-password" component={ResetPassword} />
                                <ProtectedRoute path="/checkout" component={Checkout} />
                                <ProtectedRoute exact path="/order-find" component={OrderFind} />
                                <ProtectedRoute exact path="/faq" component={Faq} />
                                <ProtectedRoute exact path="/dashboard" component={Dashboard} />
                                <Redirect from="*" to="/login" />
                            </Switch>
                        </div>
                    </ConnectedRouter>
                </ApplicationStore>
            </main>
        )
    }
}

export default connect(null, { autoLogin })(Master)
