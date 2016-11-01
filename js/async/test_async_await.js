'use strict';

var _regenerator = require('babel-runtime/regenerator');

var _regenerator2 = _interopRequireDefault(_regenerator);

var _asyncToGenerator2 = require('babel-runtime/helpers/asyncToGenerator');

var _asyncToGenerator3 = _interopRequireDefault(_asyncToGenerator2);

var _promise = require('babel-runtime/core-js/promise');

var _promise2 = _interopRequireDefault(_promise);

/**
 * /!\ CAN'T throw error in async / await : (node:23852) UnhandledPromiseRejectionWarning: Unhandled promise rejection (rejection id: 1): ##ERROR##
 */
var trigger = function () {
    var _ref = (0, _asyncToGenerator3.default)(_regenerator2.default.mark(function _callee() {
        return _regenerator2.default.wrap(function _callee$(_context) {
            while (1) {
                switch (_context.prev = _context.next) {
                    case 0:
                        throw "erreur";

                    case 2:
                    case 'end':
                        return _context.stop();
                }
            }
        }, _callee, this);
    }));

    return function trigger() {
        return _ref.apply(this, arguments);
    };
}();

//trigger()
//.catch(function () {
//console.log('caught !');
//});


var asyncFun = function () {
    var _ref2 = (0, _asyncToGenerator3.default)(_regenerator2.default.mark(function _callee2() {
        var value;
        return _regenerator2.default.wrap(function _callee2$(_context2) {
            while (1) {
                switch (_context2.prev = _context2.next) {
                    case 0:
                        _context2.next = 2;
                        return _promise2.default.resolve(1).then(function (x) {
                            return x * 3;
                        }).then(function (x) {
                            return x + 5;
                        }).then(function (x) {
                            return x / 2;
                        });

                    case 2:
                        value = _context2.sent;
                        return _context2.abrupt('return', value);

                    case 4:
                    case 'end':
                        return _context2.stop();
                }
            }
        }, _callee2, this);
    }));

    return function asyncFun() {
        return _ref2.apply(this, arguments);
    };
}();

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var i = 0;
var max = 10;

/**
 * ASYNC / AWAIT are "iterator decorator"
 *
 * @see https://babeljs.io/docs/plugins/preset-stage-2/
 * @returns {Promise}
 */
function fetch() {
    throw Error('toto');
    return new _promise2.default(function (resolve, reject) {
        setTimeout(function () {
            resolve();
        }, 3000);
    });
}
asyncFun().then(function (x) {
    return console.log('x: ' + x);
});

