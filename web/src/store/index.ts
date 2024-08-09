import ApiClient from '@irontec/ivoz-ui/services/api/ApiClient';
import {
  IvozStore,
  StoreContainer,
  storeModel as ivozStoreModel,
} from '@irontec/ivoz-ui/store';
import { createStore, createTypedHooks } from 'easy-peasy';

import config from '../config';

ApiClient.API_URL = config.API_URL;

const store = createStore<IvozStore>(ivozStoreModel);
StoreContainer.store = store;

export default store;

const { useStoreActions, useStoreState, useStoreDispatch, useStore } =
  createTypedHooks<IvozStore>();

export { useStore, useStoreActions, useStoreDispatch, useStoreState };
