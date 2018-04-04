
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./test');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

//window.onload = function () {

Vue.component('my-component', {
    template: '<div><h1>全局组件</h1></div>'
});

    const app = new Vue({
        el: '#main',

        data: {
            message: 'Hello Litblc!',
            seen: 'yes',
            isButtonDisabled: false,
            arr: [
                //对象形式
                //{s1 : 'a1'},
                //{s1 : 'a2'},
                //{s1 : 'a3'},

                //数组形式
                '大哥',
                '二哥',
                '三哥',

            ],
            vonmessage: '转换消息',
            username: 'huaixiu',
            obj: {
                a:'1aa',
                b:'2bb',
                c:'3cc',
            },
            cssBladeUrl: '/view/test1',
            radio:{
                sex: '男',
            },
            check: [],
            check2:['jack'],
            active:{
                isNew: true,
                isHot: [],
            },
            selected: '',
            selecteds: [],
            selectedFor: 'A',
            selectForOptions: [
                { text: 'One', value: 'A' },
                { text: 'Two', value: 'B' },
                { text: 'Three', value: 'C' }
            ],




        },

        methods: {
            reverseMessage:function () {
                this.vonmessage = '转换后'
            },
            alertThisVal:function () {
                alert(this.message)
            },
            submitEvent:function () {
                this.isButtonDisabled = true;
            },
            checkboxSubmit:function () {
                console.log(this.check);
                console.log(this.radio.sex);
            }
        },

    });



//};

