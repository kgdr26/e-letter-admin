<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/LogoStar_1.png') }}" alt="">
            {{-- class="d-none d-lg-block" --}}
            <span class="d-none d-lg-block fs-6 ps-3">Digital <br>Administration System </span>
            <br>
            {{-- <small>Digital Administration System</small> --}}
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar">

    </div>

    <nav class="header-nav ms-auto">
        <a class="nav-profile d-flex align-items-center pe-0 me-3" href="#" data-name="profile_show"
            data-item="{{ $idn_user->id }}">
            <img src="{{ asset('profile/' . $idn_user->foto) }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block ps-2">{{ $idn_user->name }}</span>
        </a>
    </nav>

</header>

{{-- Modal Edit Profile --}}
<div class="modal fade" id="modal_edit_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <div class="card-style">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" id="" placeholder="Name"
                                    data-name="profile_edit_name">
                                <input type="hidden" data-name="profile_edit_id">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">NPK</label>
                                <input type="text" class="form-control" id="" placeholder="NPK"
                                    data-name="profile_edit_npk">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">No TLP</label>
                                <input type="text" class="form-control" id="" placeholder="No TLP"
                                    data-name="profile_edit_no_tlp">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" id="" placeholder="Email"
                                    data-name="profile_edit_email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Role</label>
                                <select data-name="profile_edit_role_id" class="form-select select-2-edit" readonly>
                                    <option value="">-- Select Role --</option>
                                    @foreach ($role as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input type="text" class="form-control" id="" placeholder="Username"
                                    data-name="profile_edit_username">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" id="" placeholder="Password"
                                    data-name="profile_edit_password">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card-style">
                            <div class="card-foto">
                                <img src="" alt="user avatar" id="profile_img_edit">
                            </div>
                            <div class="input-type-file">
                                <input type="file" id="profile_edit_foto" name="profile_edit_foto"
                                    accept="image/*" />
                                <label for="profile_edit_foto">Choose File</label>
                            </div>
                            <input type="hidden" id="profile_edit_name_foto" data-name="profile_edit_foto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-name="save_edit_profile">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit Profile --}}

{{-- JS Edit Data --}}
<script>
    $(document).on("click", "[data-name='profile_show']", function(e) {
        var id = $(this).attr("data-item");
        var table = 'users';
        var field = 'id';

        $.ajax({
            type: "POST",
            url: "{{ route('actionshowdata') }}",
            data: {
                id: id,
                table: table,
                field: field
            },
            cache: false,
            success: function(data) {
                // console.log(data['data']);
                $("[data-name='profile_edit_id']").val(data['data'].id);
                $("[data-name='profile_edit_name']").val(data['data'].name);
                $("[data-name='profile_edit_npk']").val(data['data'].npk);
                $("[data-name='profile_edit_no_tlp']").val(data['data'].no_tlp);
                $("[data-name='profile_edit_email']").val(data['data'].email);
                $("[data-name='profile_edit_username']").val(data['data'].username);
                $("[data-name='profile_edit_password']").val(data['data'].pass);
                $("[data-name='profile_edit_role_id']").val(data['data'].role_id).trigger("change");
                $("[data-name='profile_edit_foto']").val(data['data'].foto);
                var show_foto = "{{ asset('profile') }}/" + data['data'].foto;
                $('#profile_img_edit').attr('src', show_foto);
                $("#modal_edit_profile").modal('show');
            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    title: 'Action Not Valid!',
                    icon: 'warning',
                    showConfirmButton: true,
                    // timer: 1500
                }).then((data) => {
                    // location.reload();
                })
            }
        });

    });

    $(document).on("click", "[data-name='save_edit_profile']", function(e) {
        var name = $("[data-name='profile_edit_name']").val();
        var npk = $("[data-name='profile_edit_npk']").val();
        var no_tlp = $("[data-name='profile_edit_no_tlp']").val();
        var email = $("[data-name='profile_edit_email']").val();
        var username = $("[data-name='profile_edit_username']").val();
        var password = $("[data-name='profile_edit_password']").val();
        var role_id = $("[data-name='profile_edit_role_id']").val();
        var foto = $("[data-name='profile_edit_foto']").val();
        if (foto === '') {
            var foto = 'default.jpg';
        } else {
            var foto = $("[data-name='profile_edit_foto']").val();
        }

        var table = "users";
        var whr = "id";
        var id = $("[data-name='profile_edit_id']").val();
        var dats = {
            name: name,
            npk: npk,
            no_tlp: no_tlp,
            email: email,
            username: username,
            password: password,
            role_id: role_id,
            foto: foto
        };

        // console.log(dats);

        if (name === '' || no_tlp === '' || email === '' || username === '' || password === '' || role_id ===
            '') {
            Swal.fire({
                position: 'center',
                title: 'Form is empty!',
                icon: 'error',
                showConfirmButton: false,
                timer: 1000
            })
        } else {
            $.ajax({
                type: "POST",
                url: "{{ route('actionedit') }}",
                data: {
                    id: id,
                    whr: whr,
                    table: table,
                    dats: dats
                },
                cache: false,
                success: function(data) {
                    // console.log(data);
                    Swal.fire({
                        position: 'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        location.reload();
                    })
                },
                error: function(data) {
                    Swal.fire({
                        position: 'center',
                        title: 'Action Not Valid!',
                        icon: 'warning',
                        showConfirmButton: true,
                        // timer: 1500
                    }).then((data) => {
                        // location.reload();
                    })
                }
            });
        }
    });

    $("#profile_edit_foto").on("change", function(e) {
        var ext = $("#profile_edit_foto").val().split('.').pop().toLowerCase();
        // console.log(ext)
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile = URL.createObjectURL(e.target.files[0]);
            $('#profile_img_edit').attr('src', uploadedFile);
            var photo = e.target.files[0];
            var formData = new FormData();
            formData.append('add_foto', photo);
            $.ajax({
                url: "{{ route('upload_profile') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
                    $('#profile_edit_name_foto').val(res);
                }
            })

        }
    });
</script>
{{-- End JS Edit Data --}}
