<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex px-3 mt-1">
                    <h5 class="pt-2"><i class="fa-solid fa-users mr-3 text-purple"></i>Vacancy Detail</h5>
                </div>
                <div class="mt-3">
                    <form id="updateForm">
                        <div>
                            <input type="text" id="vacancy_id" name="vacancy_id" value="<?php echo $vacancy->vacancy_id; ?>" hidden>
                        </div>
                        <div>
                            <label for="vacancy_name">Vacancy Name:</label>
                            <input 
                                type="text"
                                id="vacancy_name"
                                name="vacancy_name"
                                value="<?php echo $vacancy->vacancy_name; ?>"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="minimum_exp">Minimum Experience:</label>
                            <input 
                                type="number"
                                id="minimum_exp"
                                name="minimum_exp"
                                value="<?php echo $vacancy->minimum_exp; ?>"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="flag_status">Status:</label>
                            <select id="flag_status" name="flag_status" data-parsley-required="true" data-parsley-error-message="This field is required">
                                <option value="1" <?php echo $vacancy->flag_status == 1 ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?php echo $vacancy->flag_status == 0 ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div>
                            <input type="submit" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#updateForm').submit(function(e){
            e.preventDefault();
            var url = "<?php echo base_url(); ?>vacancy/update/<?php echo $vacancy->vacancy_id; ?>";
            var form = $('#updateForm');
            
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
                        Swal.fire('Success', 'Data Berhasil Di Update', 'success').then(
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