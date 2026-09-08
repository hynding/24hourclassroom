import { Config } from '@stencil/core';

export const config: Config = {
  namespace: 'app',
  globalStyle: 'src/global/app.css',
  env: {
    apiBaseUrl: process.env.API_BASE_URL ?? 'http://localhost:8000',
  },
  devServer: {
    // 0.0.0.0 so the dev server is reachable from outside its Docker container
    address: '0.0.0.0',
    port: 3333,
  },
  outputTargets: [
    {
      type: 'www',
      serviceWorker: null,
      copy: [{ src: 'assets/.htaccess', dest: '.htaccess' }],
    },
  ],
};
