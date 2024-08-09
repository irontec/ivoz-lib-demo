Cypress.Commands.add('before', (path = '') => {

  window.localStorage.setItem(
    'DEMO-appVersion',
    '20241018130640-123456'
  );

  window.localStorage.setItem(
    'DEMO-token',
    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NjYwOTg0MDksImV4cCI6MTY2NjEwMjAwOSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiYWRtaW4ifQ.o5dRLT0HkEM-vcDhC8-dyt6tJPJATu_VYGnH5KP1Lc0FZMJPEuaFNFuGCZOtG32-cj-h8e_nwTotpU9WsmCYLdeoJ0AZvdPQ9m8KZFaDI1oD2eva-IayKMCDpz0DjCPrO7zg7JipQfrsW_iy0S9V0lFAB0iZ1Sp0F364bu_bT-MMIJk72zgZXpvgcsPYR1OKhu9zedIvc5C-3pE7DSAfT0Uoy52Ccum-AaDNnq66wQikDq2a6FvFYl0td1m6DK-I8-w9XQ24Km1iQfLhEUFS25tOO7uNJYTFLDbSha1PaM54MndqQv2hUUOxjhjmuQq0YbgDU0jphzaTcFmiAueBVg'
  );

  window.localStorage.setItem(
    'DEMO-refreshToken',
    'fedfa7dc42a1a1940ff42b5f60d0d2325c7d62681a8495a3a898616a867ef1155406523ba04838c6f499faaee0af6a0eaec6056695ebbe4b6a5b0e5aa4180c31'
  );

  cy.visit(
    Cypress.env('APP_DOMAIN') + path,
    {
      retryOnStatusCodeFailure: true,
      retryOnNetworkFailure: true,
    }
  );
});
