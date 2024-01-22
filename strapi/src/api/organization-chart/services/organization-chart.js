'use strict';

/**
 * organization-chart service
 */

const { createCoreService } = require('@strapi/strapi').factories;

module.exports = createCoreService('api::organization-chart.organization-chart');
