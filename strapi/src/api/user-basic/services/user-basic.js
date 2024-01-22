'use strict';

/**
 * user-basic service
 */

const { createCoreService } = require('@strapi/strapi').factories;

module.exports = createCoreService('api::user-basic.user-basic');
