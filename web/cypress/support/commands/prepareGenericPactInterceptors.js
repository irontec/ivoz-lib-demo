
import apiSpec from '../../fixtures/apiSpec.json';

Cypress.Commands.add('prepareGenericPactInterceptors', (pactContextName) => {
  cy.setupPact(
    `demo-consumer-${pactContextName}`,
    `demo-provider-${pactContextName}`
  );

  cy.intercept('GET', '**/demo/api/docs.json', {
    body: apiSpec,
    headers: {
      'content-type': 'application/json; charset=utf-8',
    },
  }).as('getApiSpec');
});
