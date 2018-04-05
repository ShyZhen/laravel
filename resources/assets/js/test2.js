define (function(){
    'use strict';

    var test123;
    var accountLogin;

    test123 = function () {
        alert('test2@!!!!!!!!!!!');
    };

    function test456() {
        alert('456 of test 2222222222');
    }

    function test789() {
        alert('789 of test 2222222222');
    }

    accountLogin = function () {
        alert('登录 of test 2222222222')
    };

    return {
        test456: test456,
        test123: test123,
        test789: test789,
        accountLogin: accountLogin,
    };

});
