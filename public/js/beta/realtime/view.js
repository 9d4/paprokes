const vm = new Vue({
    el: '#app',
    data: {
        records: [],
    },
    created() {
        this.fetchRecords();

        Echo.channel('record')
            .listen('NewRecord', (e) => {
                let record = e.record;
                this.records.unshift(record);
                this.shrink();
            });
    },
    methods: {
        fetchRecords() {
            axios.get('/dash/beta/records').then(res => {
                this.records = res.data.data;
            })
        },

        parseTime(time) {
            return moment(time).format("HH:mm:ss DD/MM/YY")
        },

        shrink() {
            if (this.records.length > 50) {
                this.records.pop();
                this.shrink();
            }
            return;
        }
    }
})