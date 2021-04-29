require('./bootstrap');

import Vue from "vue/dist/vue.esm";
import moment from "moment";
import echo from './echo';

new Vue({
    el: '#app',
    data: {
        records: [],
        time: '',
        year: '',
    },
    created() {
        this.fetchRecords();

        echo.private('record')
            .listen('NewRecord', (e) => {
                let record = e.record;
                this.records.unshift(record);
                this.shrinkTable();
            });

        setInterval(() => {
            this.time = moment().format('HH:mm:ss');
        }, 1000);

        this.year = (new Date()).getFullYear();
    },
    methods: {
        fetchRecords() {
            axios.get('/dash/beta/records').then(res => {
                this.records = res.data.data;
            })
        },

        parseTime(time) {
            return moment(time).format("HH:mm:ss")
        },

        parseDate(time) {
            return moment(time).format("DD MMM")
        },

        shrinkTable() {
            if (this.records.length > 128) {
                this.records.pop();
                this.shrinkTable();
            }
            return;
        }
    }
})