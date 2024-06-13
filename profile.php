<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_transpadang');
$id_member = $_GET["id_member"];
$result = mysqli_query($conn, "SELECT * FROM tb_login WHERE id_member='$id_member'");

if (isset($_POST["armada"])) {
    $username = $_POST['username'];
    $password = $_POST['ppassword'];
    $nama_member = $_POST['namaMember'];
    $no_telepon = $_POST['noTelepon'];
    $email = $_POST['email'];
    $filename = $_FILES['foto']['name'];
    $filetmpname = $_FILES['foto']['tmp_name'];
    $folder = 'images/';
    move_uploaded_file($filetmpname, $folder . $filename);

    $q = "UPDATE tb_login SET
 	username ='$username',
    password = '$password',
    nama_member = '$nama_member',
    no_telepon = '$no_telepon',
    email = '$email',
    foto = '$filename'

 	WHERE id_member = '$id_member'";
    mysqli_query($conn, $q);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>

		alert('Data telah berhasil diubah');
		document.location.href='beranda_user.php';
		</script>";
    } else {
        echo "<script>

		alert('Data tidak bisa diubah');
		document.location.href='beranda_user.php';
		</script>";
    }
}

?>

<!--Website: wwww.codingdung.com-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile/style-profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">Social links</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-connections">Connections</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-notifications">Notifications</a>
                    </div>
                </div>

                <?php while ($row = mysqli_fetch_assoc($result)) : ?>

                    <div class="col-md-9">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="account-general">
                                    <div class="card-body media align-items-center">
                                        <img width="100" src="./images/<?= $row["foto"]; ?>" alt class="d-block ui-w-80">
                                        <div class="media-body ml-4">
                                            <label class="btn btn-outline-primary">
                                                Upload new photo
                                                <input type="file" name="foto" class="account-settings-fileinput">
                                            </label> &nbsp;
                                            <button type="button" class="btn btn-default md-btn-flat">Reset</button>
                                            <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control mb-1" value="<?php echo $row['username']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="namaMember" value="<?php echo $row['nama_member']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">No Telepon</label>
                                            <input type="text" class="form-control" name="noTelepon" value="<?php echo $row['no_telepon']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">E-mail</label>
                                            <input type="text" class="form-control mb-1" name="email" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="account-change-password">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">password</label>
                                            <input type="password" class="form-control" name="ppassword" value="<?php echo $row['password']; ?>">
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="account-info">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">Bio</label>
                                            <textarea class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nunc arcu, dignissim sit amet sollicitudin iaculis, vehicula id urna. Sed luctus urna nunc. Donec fermentum, magna sit amet rutrum pretium, turpis dolor molestie diam, ut lacinia diam risus eleifend sapien. Curabitur ac nibh nulla. Maecenas nec augue placerat, viverra tellus non, pulvinar risus.</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Birthday</label>
                                            <input type="text" class="form-control" value="May 3, 1995">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <select class="custom-select">
                                                <option>USA</option>
                                                <option selected>Canada</option>
                                                <option>UK</option>
                                                <option>Germany</option>
                                                <option>France</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">Contacts</h6>
                                        <div class="form-group">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" value="+0 (123) 456 7891">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Website</label>
                                            <input type="text" class="form-control" value>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-social-links">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" class="form-control" value="https://twitter.com/user">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" class="form-control" value="https://www.facebook.com/user">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Google+</label>
                                            <input type="text" class="form-control" value>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">LinkedIn</label>
                                            <input type="text" class="form-control" value>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" class="form-control" value="https://www.instagram.com/user">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-connections">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-twitter">Connect to
                                            <strong>Twitter</strong></button>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <h5 class="mb-2">
                                            <a href="javascript:void(0)" class="float-right text-muted text-tiny"><i class="ion ion-md-close"></i> Remove</a>
                                            <i class="ion ion-logo-google text-google"></i>
                                            You are connected to Google:
                                        </h5>
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f9979498818e9c9595b994989095d79a9694">[email&#160;protected]</a>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-facebook">Connect to
                                            <strong>Facebook</strong></button>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-instagram">Connect to
                                            <strong>Instagram</strong></button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-notifications">
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">Activity</h6>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Email me when someone comments on my article</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Email me when someone answers on my forum
                                                    thread</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input">
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Email me when someone follows me</span>
                                            </label>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body pb-2">
                                        <h6 class="mb-4">Application</h6>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">News and announcements</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input">
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Weekly product updates</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher-input" checked>
                                                <span class="switcher-indicator">
                                                    <span class="switcher-yes"></span>
                                                    <span class="switcher-no"></span>
                                                </span>
                                                <span class="switcher-label">Weekly blog digest</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary" name="armada">Save changes</button>&nbsp;
            <button type="button" class="btn btn-default">Cancel</button>
        </div>
        </form>
        <?php endwhile; ?>>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>