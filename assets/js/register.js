
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


const submit = document.getElementById('submit');
submit.addEventListener('click', async (e)=>{
    e.preventDefault();

    //khôi phục lại các hiển thị thông báo
    document.getElementById('errorMessage').style.display = 'none';
    document.getElementById('successMessage').style.display = 'none';

    const phone = document.getElementById('phone').value;
    const name = document.getElementById('usrname').value;
    const mail = document.getElementById('mail').value;
    const password = document.getElementById('password').value;
    const repassword = document.getElementById('repassword').value;
    const remember = document.getElementById('remember').vlaue;
    
    console.log(phone, name, mail, password);
    

    //xử lý checkbox để xem thử có lưu vào cookie hay không
    // const remember = document.getElementById('remember');
    // const result = checkbox.checked ? 'True' : 'False';

    if(repassword == password) {
        const requestdata = {
            phone: phone,
            name: name,
            mail: mail,
            pass: password
        }
        try { 
            // const response = await fetch('http://192.168.35.234/api/register', {

            const response = await fetch('http://localhost:3001/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json',
                },
                body: JSON.stringify(requestdata)
            });

            const data = await response.json();
            
            if (data.success) {
                // Hiển thị thông báo thành công
                document.getElementById('successMessage').textContent = data.message;
                document.getElementById('successMessage').style.display = 'block';
                    
                // Redirect sau 1 giây
                setTimeout(() => {
                    window.location.href = 'index.php'; // Thay đổi URL theo nhu cầu
                }, 1000);
            } else {
                // hiển thị lỗi
                document.getElementById('errorMessage').textContent = data.message;
                document.getElementById('errorMessage').style.display = 'block';
            }
        } catch(error) {
            console.error('Error:', error);
            document.getElementById('errorMessage').textContent = 'Đã xảy ra lỗi khi đăng ký';
            document.getElementById('errorMessage').style.display = 'block';
        }
    } else {
        //
    }
});    