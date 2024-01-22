'use strict';

/**
 * user-basic router
 */

const { createCoreRouter } = require('@strapi/strapi').factories;

module.exports = createCoreRouter('api::user-basic.user-basic');
