module.exports = ({ env }) => ({
  host: env("HOST", "0.0.0.0"),
  port: env.int("PORT", 1337),
  app: {
    keys: env.array("APP_KEYS"),
  },
  webhooks: {
    populateRelations: env.bool("WEBHOOKS_POPULATE_RELATIONS", false),
  },
  url: env('PUBLIC_URL', 'https://api.frivo-online.net'),
  proxy: true,
  admin: {
    url: env('PUBLIC_ADMIN_URL', 'https://api.frivo-online.net/admin'),
    auth: {
      secret: env("ADMIN_JWT_SECRET"),
    },
  },
});
