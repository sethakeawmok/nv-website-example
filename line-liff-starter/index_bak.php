<?php
    $config = (@$_GET['lang']==''||@$_GET['lang']=='th'?'config_th.php' : 'config_en.php');

    require_once('config/'.$config);
    require_once('config/connect.php');
    require_once('class/class_main.php');

    $cls = new Main($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ข้อมูลลูกค้า</title>

    <!-- Custom fonts for this template-->
    <link href="https://2jds.com/analytics/plugins/sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <!-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <link href="https://2jds.com/analytics/plugins/sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
    @font-face {
        font-family: 'prompt_lightregular';
        src: url('https://analytics.2jds.com/line-liff-starter/assets/fonts/prompt/prompt-light-webfont.woff2') format('woff2'),
            url('https://analytics.2jds.com/line-liff-starter/assets/fonts/prompt/prompt-light-webfont.woff') format('woff');
        font-weight: normal;
        font-style: normal;

    }

    body {
        font-family: 'prompt_lightregular';
    }
    </style>
</head>

<!-- <body class="bg-gradient-primary"> -->

<body class="">

    <div class="container">

        <div style="display:none;">
            <div class="buttongroup" >
                <div class="buttonrow">
                    <button id="openwindowbutton">Open Window</button>
                    <button id="closewindowbutton">Close Window</button>
                </div>
                <div class="buttonrow">
                    <button id="getaccesstoken">Get Access Token</button>
                    <button id="getprofilebutton">Get Profile</button>
                    <button id="sendmessagebutton">Send Message</button>
                </div>
            </div>

            <div id="accesstokendata" >
                <h2>Access Token</h2>
                <a href="#" onclick="toggleAccessToken()">Close Access Token</a>
                <table border="1">
                    <tr>
                        <th>accessToken</th>
                        <td id="accesstokenfield"></td>
                    </tr>
                </table>
            </div>

            <div id="profileinfo" >
                <h2>Profile</h2>
                <a href="#" onclick="toggleProfileData()">Close Profile</a>
                <div id="profilepicturediv">
                </div>
                <table border="1">
                    <tr>
                        <th>userId</th>
                        <td id="useridprofilefield"></td>
                    </tr>
                    <tr>
                        <th>displayName</th>
                        <td id="displaynamefield"></td>
                    </tr>
                    <tr>
                        <th>statusMessage</th>
                        <td id="statusmessagefield"></td>
                    </tr>
                </table>
            </div>

            <div id="liffdata" >
                <h2>LIFF Data</h2>
                <table border="1">
                    <tr>
                        <th>language</th>
                        <td id="languagefield"></td>
                    </tr>
                    <tr>
                        <th>context.viewType</th>
                        <td id="viewtypefield"></td>
                    </tr>
                    <tr>
                        <th>context.userId</th>
                        <td id="useridfield"></td>
                    </tr>
                    <tr>
                        <th>context.utouId</th>
                        <td id="utouidfield"></td>
                    </tr>
                    <tr>
                        <th>context.roomId</th>
                        <td id="roomidfield"></td>
                    </tr>
                    <tr>
                        <th>context.groupId</th>
                        <td id="groupidfield"></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">ข้อมูลลูกค้า</h1>
                                        <p class="mb-4"></p>
                                    </div>
                                    <form class="user" method="post" enctype="multipart/form-data"
                                        action="controller/users_controller.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="FirstName" name="FirstName"
                                                placeholder="ชื่อ" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="LastName" name="LastName"
                                                placeholder="นามสกุล" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" id="PhoneNo" name="PhoneNo" class="form-control"
                                                placeholder="เบอร์โทร" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea  id="Address" name="Address" class="form-control"
                                                placeholder="ที่อยู่ของคุณ"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" id="hid_line_userID" name="hid_line_userID" value="">
                                            <input type="hidden" id="hid_line_displayName" name="hid_line_displayName"
                                                value="">
                                            <input type="hidden" id="submit_form" name="submit_form" value="send">
                                            <input type="submit" class="form-control" name="btn_submit_form" value="ส่ง"
                                                style="background-color: #224abe;color: white;">
                                        </div>
                                    </form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="<?php path_root ?>assets/js/line-liff-sdk.js"></script>
    <script src="<?php path_root ?>assets/js/liff-starter.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://2jds.com/analytics/plugins/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://2jds.com/analytics//plugins/sb-admin-2/js/sb-admin-2.min.js"></script>


</body>

</html>