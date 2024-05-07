<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex mt-1 justify-content-between">
                    <h5 class="pt-2"><i class="fa-solid fa-users mr-3 text-purple"></i>Candidates</h5>
                    <a href="<?php echo base_url(); ?>candidate/add" class="btn btn-primary pt-2">Add candidate</a>
                </div>
                <div class="mt-3">
                    <table id="tb_candidate" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Place of Birth</th>
                                <th>Date of Birth</th>
                                <th>Gander</th>
                                <th>Experience</th>
                                <th>Last Salary</th>
                                <th>Action</th>
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
        load_candidate();
    });

    function render_action(data, type, row){
        return `<a href="<?php echo base_url(); ?>candidate/detail/${data.candidate_id}" class="btn btn-sm btn-primary">Detail</a>
                <a href="<?php echo base_url(); ?>candidate/delete/${data.candidate_id}" class="btn btn-sm btn-danger">Delete</a>`;
    }

    function load_candidate(){
        $('#tb_candidate').DataTable({
            "processing": true,
            "serverSide": true,
            scrollX: true,
            ajax: {
                'url': "<?php echo base_url(); ?>candidate/datatable",
                'type': "GET",
            },
            columns: [
                { data: 'full_name' },
                { data: 'email' },
                { data: 'phone_number' },
                { data: 'pob' },
                { data: 'dob' },
                { data: 'gender' },
                { data: 'year_exp' },
                { data: 'last_salary' },
                { data: function(data, type, row){
                    return render_action(data, type, row);
                }}
            ],
        });
    }

</script>