<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex px-3 mt-1">
                    <h5 class="pt-2"><i class="fa-solid fa-users mr-3 text-purple"></i>Application Form</h5>
                </div>
                <div class="mt-3">
                    <form id="createForm">
                        <div>
                            <label for="candidate_id">Candidate:</label>
                            <input type="number" id="candidate_id" name="candidate_id" data-parsley-required="true" data-parsley-error-message="This field is required">
                        </div>
                        <div>
                            <label for="vacancy_id">Vacancy:</label>
                            <input type="number" id="vacancy_id" name="vacancy_id" data-parsley-required="true" data-parsley-error-message="This field is required">
                        </div>
                        <div>
                            <label for="application_date">Application Date:</label>
                            <input type="date" id="application_date" name="application_date" data-parsley-required="true" data-parsley-error-message="This field is required">
                        </div>
                        <div>
                            <label for="application_status">Application Status:</label>
                            <select id="application_status" name="application_status" data-parsley-required="true" data-parsley-error-message="This field is required">
                                <option value="0">On Process</option>
                                <option value="1">Passed</option>
                                <option value="2">Failed</option>
                            </select>
                        </div>
                        <div>
                            <input type="submit" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#createForm').submit(function(e) {
            e.preventDefault();
            var url = "<?php echo base_url(); ?>apply/create/";
            var form = $('#createForm');

            // validate form
            form.parsley().validate();

            if (!form.parsley().isValid()) {
                return false;
            }

            var data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                dataType: "JSON",
                data: data,
                success: function(data) {
                    if (data.status) {
                        Swal.fire('Success', 'Data berhasil di tambah', 'success').then(
                            function() {
                                location.reload();
                            }
                        );
                    } else {
                        Swal.fire('Oops!', 'Data belum sesuai!', 'error').then(
                            function() {
                                location.reload();
                            }
                        );
                    }
                },
            });
        });
    });
</script>