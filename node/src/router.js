'use strict';

const Router = require('koa-router');
const router = new Router();

const noop = require('./api/noop');

router.get('/', noop);

module.exports = router;
