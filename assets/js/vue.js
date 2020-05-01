import Vue from 'vue';

new Vue(
    {
        el: '#app',
        delimiters : ['${', '}'],
        data: {
            message: 'Hello Vue!'
        }
    }
)
