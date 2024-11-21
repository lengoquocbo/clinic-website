
// script send mail
const btmail = document.getElementById("enteremail");
const email = document.getElementById("mail");
const emailvalue = email.value;

const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

btmail.addEventListener('click', async function(event) {
    document.getElementById('errorMessage1').style.display = 'none';
    if (email.value.trim() === "") {
        // Ngừng gửi form (ngừng hành động mặc định)
        event.preventDefault();

        // Hiển thị thông báo lỗi
        document.getElementById('errorMessage1').innerHTML = "Không được để trống ô nhập liệu";
        document.getElementById('errorMessage1').style.display = 'block';
        exit();
    }

    if(emailRegex.test(emailvalue)){
        
        event.preventDefault();
        document.getElementById('errorMessage1').innerHTML = "Email không hợp lệ";
        document.getElementById('errorMessage1').style.display = 'block';
        exit();
    }

    //khôi phục lại các hiển thị thông báo
    
    // const response = await fetch('http://192.168.56.1/api/mailchangepass', {

    const response = await fetch('http://localhost:3001/api/mailchangepass', {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            mail: email.value,
            inputtype: 'sendmail'
        })
    });

    const data = await response.json();

    if (!data.success) {
            // hiển thị lỗi
        document.getElementById('errorMessage1').textContent = data.message;
        document.getElementById('errorMessage1').style.display = 'block';

    } else {
        
        document.getElementById("formcode").classList.remove("hidden");
        document.getElementById("change").classList.add("hidden");
    }
});
//end script send mail

//start script code
const code = document.getElementById("code");
const btcode = document.getElementById("entercode");

btcode.addEventListener('click', async function(event) {
    if(code.value.trim() === "") {
        
        event.preventDefault();

        // Hiển thị thông báo lỗi
        alert("Vui lòng nhập mã xác nhận!");
        exit();
    } else {
        //code đối chiếu mã code
        document.getElementById('errorMessage2').style.display = 'none';

        // const response = await fetch('http://192.168.56.1:3001/api/checkcode', {

        const response = await fetch('http://localhost:3001/api/checkcode', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({
                mail: email.value,
                code: code.value,
                inputtype: 'checkcode'
            })
        });

        const data = await response.json();

        if (data.success) {
            // Hiển thị thông báo thành công
            document.getElementById("newpass").classList.remove("hidden");
            document.getElementById("formcode").classList.add("hidden");
                
        } else {
            // hiển thị lỗi
            document.getElementById("code").value = '';
            document.getElementById('errorMessage2').innerText = data.message;
            document.getElementById('errorMessage2').style.display = 'block';
        }
            
    }
});

const try_again = document.getElementById("tryagain");

try_again.addEventListener('click', (e) => {
    e.preventDefault();
    code.value = "";
    document.getElementById("formcode").classList.add("hidden");
    document.getElementById("change").classList.remove("hidden");
});
//end script code


//start script update
const passField = document.getElementById("password");
const repassField = document.getElementById("repassword")
const showBtn = document.getElementById("showpassword");
const passwordIcon = document.getElementById("passwordIcon");

showBtn.addEventListener('click', (e) => {
    e.preventDefault();  // Ngăn chặn sự kiện submit form khi nhấn nút hiển thị mật khẩu

    if (passField.type === "password") {
        passField.type = "text";
        repassField.type = "text";
        passwordIcon.classList.replace("bx-hide", "bx-show");
    } else {
        passField.type = "password";
        repassField.type = "password";
        passwordIcon.classList.replace("bx-show", "bx-hide");
    }
});

const btchange = document.getElementById("changepass");

document.getElementById('errorMessage3').style.display = 'none';
document.getElementById('successMessage').style.display = 'none';

btchange.addEventListener('click', async function(event) {
    if(passField.value.trim() === '' || repassField.value.trim() === ''){
        event.preventDefault();

        // Hiển thị thông báo lỗi
        alert("Vui lòng nhập đầy đủ thông tin!");
    } else {
        if(passField.value == repassField.value) {
            document.getElementById('errorMessage3').style.display = 'none';

            // const response = await fetch('http://192.168.56.1:3001/api/updatepass', {

            const response = await fetch('http://localhost:3001/api/updatepass', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type':'application/json',
                },
                body: JSON.stringify({
                    mail: email.value,
                    password: passField.value,
                    inputtype: 'updatepass'
                })
            });

            const data = await response.json();

            if (data.success) {
                // Hiển thị thông báo thành công
                document.getElementById('successMessage').textContent = data.message;
                document.getElementById('successMessage').style.display = 'block';
                    
            } else {
                // hiển thị lỗi
                document.getElementById('errorMessage3').textContent = data.message;
                document.getElementById('errorMessage3').style.display = 'block';
            }
        } else {
            document.getElementById('errorMessage3').innerText  = 'Mật khẩu không trùng khớp! Vui lòng nhập lại';
            document.getElementById('errorMessage3').style.display = 'block';
        }
    }
});
//end script update
