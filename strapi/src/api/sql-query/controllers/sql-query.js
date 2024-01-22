'use strict';

/**
 * sql-query controller
 */

const { createCoreController } = require('@strapi/strapi').factories;

module.exports = createCoreController('api::sql-query.sql-query');
