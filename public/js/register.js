/**
 * Created by qq186 on 2017/1/7.
 */
$(document).ready(function () {

    $('#inputName').blur(function () {
        var inputName=$('#inputName').val();
        if(inputName==''){
            $('#label_username').html("姓名不能为空");
            $('#label_username').css("display","block");
        }else {
            $('#label_username').css("display","none");
        }
    });

    $('#inputPassword').blur(function () {
        var inputPassword=$('#inputPassword').val();
        if(inputPassword==''){
            $('#label_password').html("密码不能为空");
            $('#label_password').css("display","block");
        }else {
            $('#label_password').css("display","none");
        }
    });

    $('#inputPasswordAgain').blur(function () {
        var inputPassword=$('#inputPassword').val();
        var inputPasswordAgain=$('#inputPasswordAgain').val();
        if(inputPasswordAgain==''){
            $('#label_confirm_password').html("请确认密码");
            $('#label_confirm_password').css("display","block");
        }else if (inputPassword!=inputPasswordAgain){
            $('#label_confirm_password').html("两次密码不一致");
            $('#label_confirm_password').css("display","block");
        }else {
            $('#label_confirm_password').css("display","none");
        }
    });



    $('#register_button').click(function () {
        var inputEmail=$('#inputEmail').val();
        var inputName=$('#inputName').val();
        var inputPassword=$('#inputPassword').val();
        var inputID=$('#inputID').val();
        var inputPasswordAgain=$('#inputPasswordAgain').val();
        var inputCode=$('#inputCode').val();
        if(inputEmail!=''&&inputName!=''&&inputPassword!=''&&inputID!=''&&inputPasswordAgain!=''&&inputCode!=''
            &&$('#label_email').html()!='此邮箱已经被注册'&&$('#label_ID').html()!='身份证号不正确'
            &&$('#label_email').html()!='邮箱格式不正确'&&$('#label_ID').html()!='身份证号不正确'){
            $('#register_button').attr('type','submit');
        }
        else {
            alert('请按照要求填写');
            $('#register_button').attr('type','button');
        }
    });
});