
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//require('./test');  // 放在bootstrap中引入


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
//window.onload = function () {

Vue.component('my-component', {
    template: '<div><h1>全局组件测试</h1></div>'
});

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrfToken').getAttribute('content');

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

            accoutUsername: '',
            accoutPassword: '',
            accoutRemember: '',




        },

        methods: {
            toastMessage: function(type, msg){
                toastr.options = {
                    "closeButton":true,
                    "debug":false,
                    "newestOnTop":true,
                    "progressBar":false,
                    "positionClass":"toast-top-right",
                    "preventDuplicates":false,
                    "onclick":null,
                    "showDuration":"300",
                    "hideDuration":"500",
                    "timeOut":"2000",
                    "extendedTimeOut":"1000",
                    "showEasing":"swing",
                    "hideEasing":"linear",
                    "showMethod":"fadeIn",
                    "hideMethod":"fadeOut"
                };
                if (type == 'error') {
                    toastr.error(msg, '');
                }else{
                    toastr.success(msg, '');
                }
            },
            reverseMessage: function () {
                this.vonmessage = '转换后'
            },
            alertThisVal: function () {
                alert(this.message)
            },
            submitEvent: function () {
                this.isButtonDisabled = true;
            },
            checkboxSubmit: function () {
                console.log(this.check);
                console.log(this.radio.sex);
            },

            userLogin: function () {
                //test.test123();
                //test2.test123();

                var data = {
                    email: this.accoutUsername,
                    password: this.accoutPassword,
                    remember: this.accoutRemember,
                };

                if (this.accoutUsername && this.accoutPassword) {

                    this.$http.post('/auth/login', data).then(function(response){
                        if (response.body.status_code == 1) {
                            //toastr.success(response.body.message);
                            this.toastMessage('success', response.body.message);
                            setTimeout(function(){
                                location.href = response.body.url;
                            },1000);

                        } else {
                            //toastr.error(response.body.message);
                            this.toastMessage('error',response.body.message);
                        }
                    }, function (response){
                        //toastr.error('Server Error 500');
                        this.toastMessage('error','Server Error 500');
                    });

                } else {
                    this.toastMessage('error', '用户名和密码不为空!!');
                }
            }
        },

    });



//};

