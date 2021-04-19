<script>
    const app = new Vue({
        el: '#vue-root',
        data() {
            return {
                clients: [],
                apiclients: [],
                errors: [],
                form: {
                    name: '',
                    email: '',
                    company: ''
                }
            }
        },
        mounted() {
            axios
                .get('/getDatas')
                .then(response => {
                    this.clients = response.data.allClients;
                    setTimeout(() => {
                        $('#myTable').DataTable({
                            "order": [
                                [0, "desc"]
                            ]
                        });
                    }, 500)

                });
            axios
                .get('/getApiDatas')
                .then(response => {
                    this.apiclients = response.data.allapiClients;
                    setTimeout(() => {
                        $('#myTableApi').DataTable();
                    }, 500)

                });
        },
        methods: {
            checkForm: function(e) {
                if (this.form.name && this.form.email && this.form.company) {
                    return true;
                }

                this.errors = [];

                if (!this.form.name) {
                    this.errors.push('Name required.');
                }
                if (!this.form.email) {
                    this.errors.push('Email required.');
                }
                if (!this.form.company) {
                    this.errors.push('Company required.');
                }
            },
            submitForm: function(e) {
                if (this.checkForm()) {
                    this.errors = [];
                    axios
                        .post('/registration', this.form)
                        .then(response => {
                            if (response.data.success > 0) {
                                newClient = {
                                    "id": response.data.clientid,
                                    "name": this.form.name,
                                    "email": this.form.email,
                                    "company_name": this.form.company,
                                }
                                this.clients.unshift(newClient);
                                if ($.fn.DataTable.isDataTable('#myTable')) {
                                    $('#myTable').DataTable().destroy();
                                }
                                setTimeout(() => {
                                    $('#myTable').DataTable({
                                        "order": [
                                            [0, "desc"]
                                        ]
                                    });
                                }, 500);
                                this.form = {
                                    name: '',
                                    email: '',
                                    company: ''
                                };
                            }


                        });
                }

            }
        }
    });

</script>