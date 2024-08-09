import { StoreContainer } from '@irontec/ivoz-ui';
import { CssBaseline, LinearProgress } from '@mui/material';
import { LocalizationProvider } from '@mui/x-date-pickers';
import { AdapterDateFns } from '@mui/x-date-pickers/AdapterDateFns';
import { useEffect } from 'react';
import { BrowserRouter } from 'react-router-dom';
import store, { useStoreActions, useStoreState } from 'store';

import { StyledAppApiLoading } from './App.styles';
import AppRoutesGuard from './router/AppRoutesGuard';

export default function App(): JSX.Element {
  StoreContainer.store = store;

  const apiSpecStore = useStoreActions((actions) => {
    return actions.spec;
  });
  const authStore = useStoreActions((actions) => actions.auth);

  useEffect(() => {
    apiSpecStore.setSessionStoragePrefix('DEMO-');
    apiSpecStore.init();
    authStore.setSessionStoragePrefix('DEMO-');
    authStore.init();
  }, [apiSpecStore, authStore]);

  const apiSpec = useStoreState((state) => state.spec.spec);
  console.log("apiSpec", apiSpec);

  if (!apiSpec || Object.keys(apiSpec).length === 0) {
    return (
      <StyledAppApiLoading>
        <LinearProgress />
        <br />
        Loading API definition...
      </StyledAppApiLoading>
    );
  }

  return (
    <LocalizationProvider dateAdapter={AdapterDateFns}>
      <CssBaseline />
      <div>
        <BrowserRouter>
          <AppRoutesGuard apiSpec={apiSpec} />
        </BrowserRouter>
      </div>
    </LocalizationProvider>
  );
}
