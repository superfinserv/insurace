$(document).ready(function () {

    $.validator.addMethod("username_regex", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]*$/i.test(value);
    }, "Please choise a username with only a-z A-Z.");

    $.validator.addMethod("gstno", function (value, element) {
        return this.optional(element) || /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i.test(value);
    }, "Please Enter valid GSTIN No.");

    $.validator.addMethod('minStrict', function (value, el, param) {
        return value > param;
    });
    $.validator.addMethod('minStrict1', function (value, el, param) {
        return value >= param;
    });
    $.validator.addMethod("dmy", function (value, element) {
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    }, "Please enter the format as  dd/mm/yyyy."
            );
    $.validator.addMethod("mdy", function (value, element) {
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    }, "Please enter the format as  mm/dd/yyyy."
            );
    $.validator.addMethod('usaphone', function (value, element) {
        return this.optional(element) || /^\d{3}-\d{3}-\d{4}$/.test(value);
    }, "Please enter a valid phone number");
    $.validator.addMethod("panno", function (value, element) {
        return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }, "Invalid Pan Number");

    $("#LoginForm").validate({

        rules: {

            'username': {
                required: true,
                //email: true,
            },

            'password': {
                required: true,
                minlength: 6
            },
            'token':{
                required:true,
            }

        },

        messages: {
            'username': {
                required: "Username is required!",
                //email: "Enter valid Email",

            },
            'password': {
                required: "The password field is mandatory!",
                minlength: "Please enter at least 6 characters!"
            },
            'token': {
                required: "Cptcha is required !",
             }
        },

        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: base_url + "login/getAuth",
                data: $(form).serialize(),
                timeout: 3000,
                success: function (result) {
                    //console.log(data);
                    var returnedData = JSON.parse(result);
                        var data = $.trim(returnedData['data']);
                        var cptimg   = returnedData['cpimg'];
                        var csrfName = returnedData['csrfName'];
                        var csrfHash = returnedData['csrfHash'];
                    if (data == 'success') {
                        $('.ajax_response').html('');
                        $('.ajax_response').html('<div class="alert alert-success alert-bordered"><span class="text-semibold">Login Success </span> Redirecting...</div>');

                        window.setTimeout(function () {
                            window.location.href = base_url + "dashboard";
                        }, 2000);
                    } else if(data == 'cptcha'){
                        $("#LoginForm").find('input[type=hidden]').first().attr('name', csrfName);
                        $("#LoginForm").find('input[type=hidden]').first().val(csrfHash);
                        $('#captImg').html(cptimg);
                        $('.ajax_response').html('');
                        $('.ajax_response').html('<div class="alert alert-warning alert-bordered"><span class="text-semibold">Opps Error ! </span> Invalid CAPTCHTA.</div>')
                    }else{
                        $("#LoginForm").find('input[type=hidden]').first().attr('name', csrfName);
                        $("#LoginForm").find('input[type=hidden]').first().val(csrfHash);
                        $('#captImg').html(cptimg);
                        $('.ajax_response').html('');
                        $('.ajax_response').html('<div class="alert alert-danger alert-bordered"><span class="text-semibold">Opps Error ! </span> Invalid credential.</div>')
                    }
                },
                    error: function () {
                }
            });
            return false;
        }

    });
    
    
    $("#ChangePasswordForm").validate({
        rules: {

            'opass': {
                required: true,
                remote: {
                    url: base_url + 'profile/checkPass',
                    type: "post",
                    data: {
                        current_pass: function () {
                            return $('#current_pass').val();
                        }
                    }
                }
            },

            'new_pass': {
                required: true,
                minlength: 6
            },
            'conf_pass': {
                equalTo: '#new_pass'
            }

        },

        messages: {
            'current_pass': {
                required: "Old Password is required!",
                remote: "Password not match!"
            },
            'new_pass': {
                required: " password field is mandatory!",
                minlength: "Please enter  at least 6 characters!"
            },

            'conf_pass': {

                equalTo: "password do not match!"

            }

        }

    });

   
    $("#updateProfileInfo").validate({

        rules: {
            'email': {
                required: true,
                email: true,
                remote: {
                    url: base_url + 'crud/checkUserExist',
                    type: "post",
                    data: {
                        email: function () {
                            return $('#email').val();
                        },
                        id: function () {
                            return $('#id').val();
                        }
                    }
                }
            },
            'mobile': {
                required: true,
                //number: true,
                remote: {
                    url: base_url + 'crud/checkUserExist',
                    type: "post",
                    data: {
                        mobile: function () {
                            return $('#mobile').val();
                        },
                        id: function () {
                            return $('#id').val();
                        }
                    }
                }

            },
            'username': {
                required: true,
                minlength: 5,
                maxlength: 10,
                remote: {
                    url: base_url + 'crud/checkUserExist',
                    type: "post",
                    data: {
                        username: function () {
                            return $('#username').val();
                        },
                        id: function () {
                            return $('#id').val();
                        }
                    }
                }

            },
        },

        messages: {
            'email': {
                required: "Enter email",
                email: "Enter valid email",
                remote: "Email  already exist"
            },
            'username': {
                required: "Enter username",
                minlength: "should be minimum 5 character",
                maxlength: "should be maximum 10 character",
                remote: "username  already exist"
            },
            'mobile': {
                required: "Enter mobile no",
                //number: "Enter valid no",
                remote: "Mobile no already exist"
            }

        }
    });
    
});


function include(file) {
    var script = document.createElement('script');
    script.src = base_url + "assets/" + file;
    script.type = 'text/javascript';
    script.defer = true;
    $('#scripttag').append(script);
}