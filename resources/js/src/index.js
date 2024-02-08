import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux'
import configurestore from './store/configureStore'
import rootSaga from './sagas'
import './index.scss';
import App from './App';
import * as serviceWorker from './serviceWorker';

const store = configurestore()
store.runSaga(rootSaga)

const Component = () => (
    <Provider store={store}>
        <App />
    </Provider>
)

let render = () => {
    ReactDOM.render(<Component />, document.getElementById('root'));
}

render()
if (module.hot) {
    module.hot.accept(Component => {
        render()
    })
}
// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
