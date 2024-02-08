import { createStore, applyMiddleware } from "redux";
import createSagaMiddleware, { END } from "redux-saga";
import { connectRouter, routerMiddleware } from "connected-react-router";
import rootReducer from "../reducers";
import history from "../history";

export default function configureStore(initialState) {
  const sagaMiddleware = createSagaMiddleware();
  const store = createStore(
    connectRouter(history)(rootReducer),
    initialState,
    applyMiddleware(routerMiddleware(history), sagaMiddleware)
  );

  store.runSaga = sagaMiddleware.run;
  store.close = () => store.dispatch(END);
  return store;
}
