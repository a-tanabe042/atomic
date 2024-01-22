// src/api/query-runner/routes/custom-routes.js

module.exports = {
    routes: [
      {
        method: 'POST',
        path: '/query-runner/run',
        handler: 'query-runner.runQuery',
        config: {
          policies: [],
          middlewares: [],
        },
      },
    ],
  };
  