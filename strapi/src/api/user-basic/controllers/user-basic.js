'use strict';

/**
 * user-basic controller
 */

const { createCoreController } = require('@strapi/strapi').factories;

module.exports = createCoreController('api::user-basic.user-basic');
