import { createStore, applyMiddleware, compose } from "redux";
// import { createLogger } from "redux-logger";
import createSagaMiddleware, { END } from "redux-saga";
import { connectRouter, routerMiddleware } from "connected-react-router";
import rootReducer from "../reducers";
import history from "../history";

export default function configureStore(initialState) {
  const sagaMiddleware = createSagaMiddleware();
  const composeEnhancers =
    typeof window === "object" && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__
      ? window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({
          // Specify extension’s options like name, actionsBlacklist, actionsCreators, serialize...
        })
      : compose;

  const store = createStore(
    // connectRouter(history)(rootReducer),
    rootReducer,
    initialState,
    composeEnhancers(
      applyMiddleware(routerMiddleware(history), sagaMiddleware) //, createLogger()
    )
  );

  if (module.hot) {
    // Enable Webpack hot module replacement for reducers
    module.hot.accept("../reducers", () => {
      const nextRootReducer = require("../reducers").default;
      store.replaceReducer(nextRootReducer);
    });
  }
  store.runSaga = sagaMiddleware.run;
  store.close = () => store.dispatch(END);
  return store;
}
