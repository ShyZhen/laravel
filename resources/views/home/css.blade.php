@extends('__layout.layout')



@section('content')

    @parent

    <br>
    <span >
        @{{ message }}
    </span>

    <br>
    <button id="" onclick="test.test123()">alert123</button>
    <button id="" onclick="test2.test456()">alert456</button>
    <button id="" onclick="test.test789()">alert789</button>
    <button id="" onclick="test2.test123()">alert789</button>
    <br>
    <div>

        <span v-bind:title="message">vue-bind 绑定元素特性,将这个元素节点的 title 特性和 Vue 实例的 message 属性保持一致</span> |
        <span title="message">原生绑定元素特性</span> |
        <span v-if="seen=='yes'">当前app.seen=yes</span>
    </div>
    <hr>
    <div>
        <li v-for="arrSingel in arr">
            {{--对象--}}
            {{--@{{arrSingel.s1}}--}}

            数组
            @{{arrSingel}}
        </li>
        <br>
        <li v-for="objSingel in obj">
            对象
            @{{objSingel}}
        </li>
    </div>
    <hr>

    <div>
        v-on
        <p>@{{ vonmessage }}</p>
        <button v-on:click="reverseMessage">v-on消息</button>
        <input type="text" v-model.trim="message" v-on:click="alertThisVal">
        <a href="" v-on:click.prevent="alertThisVal">点击连接不会跳转，使用prevent冒泡阻止</a>
        <input type="text" v-model="obj.c">
    </div>

    <div>
        <button v-bind:disabled="isButtonDisabled" v-on:click="submitEvent">点击之后disabled</button>
        <br>
        <a v-bind:href="cssBladeUrl">v-bind 绑定的地址</a>
    </div>

    <hr>

    <div>
        <label for="radio1">男</label>
        <input type="radio" id="radio1" value="男" v-model="radio.sex">
        <label for="radio1">女</label>
        <input type="radio" id="radio2" value="女" v-model="radio.sex">
        <span>单选选择结果:@{{ radio.sex }}</span>
    </div>
    <hr>
    <div>
        A<input type="checkbox" name="check[]" value="a" v-model="check">
        B<input type="checkbox" name="check[]" value="b" v-model="check">
        C<input type="checkbox" name="check[]" value="c" v-model="check">
        D<input type="checkbox" name="check[]" value="d" v-model="check">
        <span>复选选择了：@{{check}}</span>
        <input type="button" v-on:click="checkboxSubmit" value="提交">
    </div>
<hr>
    <div>
        <input type="checkbox" id="aa" value="aa" v-model="check2">
        <label for="aa">aa</label>
        <input type="checkbox" id="bb" value="bb" v-model="check2">
        <label for="bb">bb</label>
        <input type="checkbox" id="jack" value="jack" v-model="check2">
        <label for="jack">jack</label>
        <input type="checkbox" id="litblc" value="litblc" v-model="check2">
        <label for="litblc">litblc</label>
        <span>选择了：@{{check2}}</span>
    </div>
<hr>
    <span v-bind:class="{ active: active.isNew }">最新</span>
    <span v-bind:class="{ active: active.isHot }">最热</span>
    <hr>
单选下拉框
    <div>
        <select v-model="selected">
            <option disabled value="">请选择</option>
            <option>a</option>
            <option>b</option>
            <option value="设置了value的话">c</option>
        </select>
        <span>下拉选择了@{{ selected }}</span>
    </div>
    <br>
多选下拉框
    <div>
        <select v-model="selecteds" multiple>
            <option disabled value="">请选择</option>
            <option>a</option>
            <option>b</option>
            <option value="设置了value的话">c</option>
        </select>
        <span>下拉选择了@{{ selecteds }}</span>
    </div>
    <br>

    <select v-model="selectedFor">
        <option v-for="option in selectForOptions" v-bind:value="option.value">
            @{{ option.text }}
        </option>
    </select>
    <span>Selected: @{{ selectedFor }}</span>

<hr>
    <my-component></my-component>


@endsection

@section('js')

@endsection