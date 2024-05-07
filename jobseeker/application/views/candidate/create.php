<div class="app d-flex">
    <?php $this->load->view('includes/sidebar') ?>
    <div class="main-content">
        <div class="content mt-0">
            <div class="card p-3">
                <div class="d-flex px-3 mt-1">
                    <h5 class="pt-2"><i class="fa-solid fa-users mr-3 text-purple"></i>Candidate Create</h5>
                </div>
                <div class="mt-3">
                    <form id="createForm">
                        <div>
                            <label for="email">Email:</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="phone_number">Phone Number:</label>
                            <input 
                                type="text" 
                                id="phone_number" 
                                name="phone_number"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="full_name">Full Name:</label>
                            <input 
                                type="text" 
                                id="full_name" 
                                name="full_name"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="dob">Date of Birth:</label>
                            <input 
                                type="date" 
                                id="dob" name="dob"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="pob">Place of Birth:</label>
                            <input 
                                type="text" 
                                id="pob" 
                                name="pob"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="gender">Gender:</label>
                            <select 
                                id="gender" 
                                name="gender" 
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div>
                            <label for="year_exp">Years of Experience:</label>
                            <input 
                                type="number" 
                                id="year_exp" 
                                name="year_exp"
                                data-parsley-required="true" 
                                data-parsley-error-message="This field is required"
                            >
                        </div>
                        <div>
                            <label for="last_salary">Last Salary:</label>
                            <input 
                                type="text" 
                                id="last_salary" 
                                name="last_salary"
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
            var url = "<?php echo base_url(); ?>candidate/create/";
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