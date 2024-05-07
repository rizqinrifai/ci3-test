<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex px-3 mt-1">
                    <h5 class="pt-2"><i class="fa-solid fa-users mr-3 text-purple"></i>Vacancy Create</h5>
                </div>
                <div class="mt-3">
                    <form id="createForm">
                        <div>
                            <label for="vacancy_name">Vacancy Name:</label>
                            <input 
                                type="text" 
                                id="vacancy_name"
                                name="vacancy_name"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="minimum_exp">Minimum Experience:</label>
                            <input 
                                type="number
                                id="minimum_exp"
                                name="minimum_exp"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
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
        $('#createForm').submit(function(e){
            e.preventDefault();
            var url = "<?php echo base_url(); ?>vacancy/create/";
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