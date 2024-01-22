'use strict';

/**
 * sql-query router
 */

const { createCoreRouter } = require('@strapi/strapi').factories;

module.exports = createCoreRouter('api::sql-query.sql-query');
