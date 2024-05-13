<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex mt-1 justify-content-between">
                    <h5 class="pt-2"><i class="fa-solid fa-users mr-3 text-purple"></i>Applications</h5>
                    <a href="<?php echo base_url(); ?>apply/add" class="btn btn-primary pt-2">Add application</a>
                </div>
                <div class="mt-3">
                    <table id="tb_application" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Vacancy Name</th>
                                <th>Application Date</th>
                                <th>Application Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        load_application();
    });

    function render_action(data, type, row) {
        return `<a href="<?php echo base_url(); ?>apply/delete/${data.application_id}" class="btn btn-sm btn-danger">Delete</a>`;
    }

    function load_application() {
        $('#tb_application').DataTable({
            "processing": true,
            "serverSide": true,
            scrollX: true,
            ajax: {
                'url': "<?php echo base_url(); ?>apply/datatable",
                'type': "GET",
            },
            columns: [{
                    data: 'candidate_name'
                },
                {
                    data: 'vacancy_name'
                },
                {
                    data: 'application_date'
                },
                {
                    data: 'application_status',
                    render: function(data) {
                        if (data == 0) {
                            return 'On Process';
                        } else if (data == 1) {
                            return 'Passed';
                        } else {
                            return 'Failed';
                        }
                    }
                },
            ],
        });
    }
</script>