function register(){
    let email = $("#email").val();
    let password = $("#password").val();
    let name = $("#name").val();
    let surname = $("#surname").val();
    let gender = $("#gender").val();
    let province = $("#province").val();

    if(email != "" && password != "" && name != "" && surname != "" && gender != "" && province != ""){
        $.post("api/register.php",{email:email,password:password,name:name,surname:surname,gender:gender,province:province},function(data){
            if(data.status == 200){
                Swal.fire(
                    'Good job!',
                    data.message,
                    'success'
                )
                setTimeout(function(){
                    window.location = "./login.php";
                },1000);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                  })
            }
        })
    }else{
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "กรอกข้อมูลให้ครบถ้วน",
          })
    }
}