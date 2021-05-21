import Vue from "vue/dist/vue.esm";
import axios from "axios";
import moment from "moment";
import echo from "./echo";

new Vue({
    name: 'Realtime Page',
    el: '#realtimeTable',
    data: {
        records: [],
    },
    created() {
        this.fetchRecords();

        echo.private(app.channel).listen('NewRecord', (res) => {
            this.records.unshift(res.record);

        })
    },
    methods: {
        fetchRecords() {
            axios.get(app.baseUrl + '/api/' + app.device_id +'/all').then(({data}) => {
                this.records = data.data
            })
        },

        parseTime(datetime) {
            return moment(datetime).format('YYYY-MM-DD HH:mm')
        },

        shrink() {
            if (this.records.length > 128) {
                this.records.pop()
                return this.shrink()
            }
        }
    }
})