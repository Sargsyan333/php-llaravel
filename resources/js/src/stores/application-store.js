import React from "react";

const ApplicationContext = React.createContext();

class ApplicationStore extends React.Component {
    constructor() {
        super();
        this.state = {
            showMenu: false,
            continueText: 'Fortsæt bestilling',
            continueUrl: '/checkout/client-info',
            progress: 0,
            continueDisabled: false,
            token: localStorage.getItem("token") || '',
            user: localStorage.getItem("user") || '',
        };
        this.interObj = null;
    }

    toggleMenu(val) {
        let newVal = val !== undefined ? val : !this.state.showMenu;
        this.setState({ showMenu: newVal });
    }

    disableContinue = (val) => {
        this.setState({
            continueDisabled: val
        })
    }

    setContinue = (strText, strUrl) => {
        this.setState({
            continueText: strText,
            continueUrl: strUrl
        })
    }

    setProgress = (intProgress) => {
        this.setState({
            progress: intProgress
        })
    }

    setToken = (token) => {
        this.setState({
            token: token
        })
    }

    setUser = (user) => {
        this.setState({
            user: user
        })
    }

    render() {
        return (
            <ApplicationContext.Provider
                value={{
                    showMenu: this.state.showMenu,
                    continueText: this.state.continueText,
                    continueUrl: this.state.continueUrl,
                    toggleMenu: val => this.toggleMenu(val),
                    setContinue: this.setContinue,
                    setProgress: this.setProgress,
                    progress: this.state.progress,
                    continueDisabled: this.state.continueDisabled,
                    disableContinue: this.disableContinue,
                    setToken: this.setToken,
                    setUser: this.setUser,
                    getToken: this.state.token,
                    getUser: this.state.user
                }}
            >
                {this.props.children}
            </ApplicationContext.Provider>
        );
    }
}

export { ApplicationContext, ApplicationStore };
