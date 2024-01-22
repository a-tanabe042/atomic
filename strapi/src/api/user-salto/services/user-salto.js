'use strict';

/**
 * user-salto service
 */

const { createCoreService } = require('@strapi/strapi').factories;

module.exports = createCoreService('api::user-salto.user-salto');
