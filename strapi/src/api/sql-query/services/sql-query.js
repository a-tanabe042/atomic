'use strict';

/**
 * sql-query service
 */

const { createCoreService } = require('@strapi/strapi').factories;

module.exports = createCoreService('api::sql-query.sql-query');
