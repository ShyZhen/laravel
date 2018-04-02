test123 = function () {
    alert('test.js都在app.js引入即可，类似app.scss一样');
};

function test456() {
    alert('456不好使？');
}

$(function(){
    function test789() {
        alert('789不好使？');
    }
});