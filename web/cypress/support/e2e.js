// ***********************************************************
// This example support/e2e.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

Cypress.on('uncaught:exception', (err, runnable) => {
    console.error('uncaught:exception', [err, runnable]);
    Cypress.log({
        name: 'uncaught:exception',
        message: err,
        consoleProps: () => [err, runnable],
    });

    // returning false here prevents Cypress from
    // failing the test
    return false;
});

Cypress.on('fail', (err, runnable) => {
    console.error('fail', [err, runnable]);
    Cypress.log({
        name: 'fail',
        message: err,
        consoleProps: () => [err, runnable],
    });

    throw err;
});

// Import commands using ES2015 syntax:
import './commands/before';
import './commands/prepareGenericPactInterceptors';
import './commands/create';
import './commands/fillTheForm';

// Import Cypress-Adapter plugin
import '@pactflow/pact-cypress-adapter';

// Alternatively you can use CommonJS syntax:
// require('./commands')
