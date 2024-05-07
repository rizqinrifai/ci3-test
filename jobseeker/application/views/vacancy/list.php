<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex mt-1 justify-content-between">
                    <h5 class="pt-2"><i class="fa-solid fa-briefcase mr-3 text-purple"></i>Vacancy</h5>
                    <a href="<?php echo base_url(); ?>vacancy/add" class="btn btn-primary pt-2">Add vacancy</a>
                </div>
                <div class="mt-3">
                    <table id="tb_vacancy" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Vacancy Name</th>
                                <th>Minimum Experience</th>
                                <th>Status</th>
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
        load_vacancy();
    });

    function render_action(data, type, row){
        return `<a href="<?php echo base_url(); ?>vacancy/detail/${data.vacancy_id}" class="btn btn-sm btn-primary">Detail</a>
                <a href="<?php echo base_url(); ?>vacancy/delete/${data.vacancy_id}" class="btn btn-sm btn-danger">Delete</a>`;
    }

    function load_vacancy(){
        $('#tb_vacancy').DataTable({
            "processing": true,
            "serverSide": true,
            scrollX: true,
            ajax: {
                'url': "<?php echo base_url(); ?>vacancy/datatable",
                'type': "GET",
            },
            columns: [
                { data: 'vacancy_name' },
                { data: 'minimum_exp' },
                { data: 'flag_status', render: function(data){
                    return data == 1 ? 'Active' : 'Inactive';
                }},
                { data: function(data, type, row){
                    return render_action(data, type, row);
                }}
            ],
        });
    }

</script>