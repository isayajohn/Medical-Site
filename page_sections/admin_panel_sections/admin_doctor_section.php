<?php
require_once '../../controller/Controller.php';
$doctors = getAllDoctors();
$categories = getAllCategory();
$services = getAllService();
?>

<div class="card">
    <div class="card-body">
        <div class="">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="total-admin-badge">Doctors <span class="badge badge-dark"> <?php echo $_SESSION['doctorsCounter'] ?></span> Total </h3>

                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary my-1" data-toggle="modal" data-target="#doctorModal">Create New Doctor</button>
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-md-6">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option value="" disabled selected>Select Service</option>
                    <?php
                    foreach ($services as $service) {
                        echo "<option>" . $service["service_name"] . "</option>";
                    } ?>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option selected>Ascending</option>
                    <option>Decending</option>
                </select>
            </div>
        </div>

        <br>


        <div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <td>#ID</td>
                                    <td>DOCTOR NAME</td>
                                    <td>SERVICE</td>
                                    <td>EMAIL</td>
                                    <td>PHONE NUMBER</td>

                                    <td></td>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                foreach ($doctors as $doctor) {
                                    echo "<form action='' method='post'>";
                                    echo "<tr>";
                                    echo "<td class='doctor-details'>" . $doctor["id"] . "</td>";
                                    echo "<td>  <img src='../../assets/images/uploaded_images/doctor_images/" . $doctor["profile_picture"] . "' class='doctor-avatar' alt=''> " . $doctor["full_name"] . "</td>";
                                    echo "<td class='doctor-details'>" . $doctor["service"]  . "</td>";
                                    echo "<td class='doctor-details'>" . $doctor["email"] . "</td>";
                                    echo "<td class='doctor-details'>" . $doctor["phone"] . "</td>";
                                    echo "<td class='doctor-details'>";
                                    echo "<button type='button' class='btn btn-outline-primary editDoctor_btn' id=" . $doctor["id"] . ">Edit</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "</form>";
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-labelledby="doctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointModalLabel">Create New Doctor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-2">
                            <img id="blah" class="doctor-avatar" src="https://dummyimage.com/450X300/cfcfcf.png" alt="" />
                        </div>
                        <div class="col-md-10 doctor-name-input">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="doctor_pic" id="inputGroupFile02" placeholder="Featured Image" onchange="readURL(this);" required>
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>

                        </div>
                    </div>
                    <br><br>
                    <input class="form-control" type="text" name="doctor_name" placeholder="Doctor Name" required>

                    <br>

                    <input class="form-control" type="email" name="doctor_email" placeholder="Email Address" required>
                    <br>
                    <input class="form-control" type="tel" name="doctor_phone" placeholder="Phone Number" required>
                    <br>
                    <select class="form-control" name="doctor_category" id="inlineFormCustomSelect" required>
                        <option value="" disabled selected>Select Category</option>

                        <?php
                        foreach ($categories as $category) {
                            echo "<option>" . $category["category_name"] . "</option>";
                        } ?>
                    </select>
                    <br>
                    <select class="form-control" name="doctor_service" id="exampleFormControlSelect1" required>
                        <option value="" disabled selected>Select Service</option>
                        <?php
                        foreach ($services as $service) {
                            echo "<option>" . $service["service_name"] . "</option>";
                        } ?>
                    </select>

                    <br>
                    <textarea id="" class="form-control" name="doctor_description" rows="5" cols="5" placeholder="Doctor Description" required></textarea>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="create_doctor_btn" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








<!-- Modal -->
<div class="modal fade" id="doctorEditModal" tabindex="-1" role="dialog" aria-labelledby="doctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointModalLabel">Edit Doctor Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="form-row">
                        <input type="hidden" name="id" id="doctor_edit_id" value="">

                    </div>
                    <input class="form-control" type="text" name="doctor_name" id="doctor_edit_name" value="" placeholder="Doctor Name" required>

                    <br>

                    <input class="form-control" type="email" name="doctor_email" id="doctor_edit_email" value="" placeholder="Email Address" required>
                    <br>
                    <input class="form-control" type="tel" name="doctor_phone" id="doctor_edit_phone" value="" placeholder="Phone Number" required>
                    <br>
                    <select class="form-control doctor_category_selector" name="doctor_category" id="doctor_edit_category" value="" id="doctor_category_selector" required>
                        <option value="" disabled>Select Category</option>
                        <?php
                        foreach ($categories as  $category) {
                            if ($category["category_name"] ==  $doctor_details["category"]) {
                                echo "<option selected>" . $category["category_name"] . "</option>";
                            } else {
                                echo "<option>" . $category["category_name"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <select class="form-control" name="doctor_service" id="doctor_edit_service" value="" required>
                        <option value="" disabled>Select Service</option>
                        <?php
                        foreach ($services as $service) {
                            if ($service["service_name"] ==  $doctor_details["service"]) {
                                echo "<option selected>" . $service["service_name"] . "</option>";
                            } else {
                                echo "<option>" . $service["service_name"] . "</option>";
                            }
                        } ?>
                    </select>

                    <br>
                    <textarea id="doctor_edit_description" class="form-control" name="doctor_description" value="" rows="5" cols="5" placeholder="Doctor Description" required></textarea>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="edit_doctor_btn" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(' #blah').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function() {
        $(".editDoctor_btn").click(function() {
            var doctor_id = $(this).attr("id");
            $.ajax({
                url: "../../controller/Controller.php",
                method: "post",
                dataType: "json",
                data: {
                    doctor_id: doctor_id,
                },
                success: function(data) {
                    console.log(doctor_id);
                    $('#doctor_edit_id').val(data.id);
                    $('#doctor_edit_name').val(data.full_name);
                    $('#doctor_edit_email').val(data.email);
                    $('#doctor_edit_phone').val(data.phone);
                    $('#doctor_edit_category').val(data.category);
                    $('#doctor_edit_service').val(data.service);
                    // $('#doctor_edit_pic').val(data.profile_picture);
                    $('#doctor_edit_description').val(data.description);
                    $("#doctorEditModal").modal("show");
                }
            });
        });
    });
</script>