// hiện mật khẩu
const passField = document.getElementById("password");
const showBtn = document.getElementById("showpassword");
const passwordIcon = document.getElementById("passwordIcon");

showBtn.addEventListener('click', (e) => {
    e.preventDefault();  // Ngăn chặn sự kiện submit form khi nhấn nút hiển thị mật khẩu

    if (passField.type === "password") {
        passField.type = "text";
        passwordIcon.classList.replace("bx-hide", "bx-show");
    } else {
        passField.type = "password";
        passwordIcon.classList.replace("bx-show", "bx-hide");
    }
});
// end hiện mật khẩu

// Start submit
const submit = document.getElementById('dangnhap');
submit.addEventListener('click', async (e)=>{
    e.preventDefault();

    //khôi phục lại các hiển thị thông báo
    document.getElementById('errorMessage').style.display = 'none';
    document.getElementById('successMessage').style.display = 'none';

    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;

    if(phone.trim() === "" || password.trim() === "") {
        
        e.preventDefault();

        // Hiển thị thông báo lỗi
        alert("Vui lòng nhập đầy đủ thông tin");
        exit();
    }

    try { 

        // const response = await fetch('http://192.168.1.8:3001/api/login', {

        const response = await fetch('http://localhost:3001/api/login', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({
                phone: phone,
                password: password
            })
        });
        console.log('post thanh cong');

        const data = await response.json();
        console.log(data);

        if (data.success) {
            // Hiển thị thông báo thành công
            localStorage.setItem('token', data.token);
            console.log(localStorage.getItem('token'));
            document.getElementById('successMessage').textContent = data.message;
            document.getElementById('successMessage').style.display = 'block';
            // window.location.href = "http://192.168.1.8"+data.URL;
            // history.replaceState(null, "", "http://192.168.1.8"+data.URL);
            window.location.href = "http://localhost/clinic-website"+data.URL;
            alert(localStorage.getItem('token'));
            alert('hello');
            history.replaceState(null, "", "http://localhost/clinic-website"+data.URL);
        } else {
            // hiển thị lỗi
            document.getElementById('errorMessage').textContent = data.message;
            document.getElementById('errorMessage').style.display = 'block';
        }
    } catch(error) {
        console.error('Error:', error);
        document.getElementById('errorMessage').textContent = 'Đã xảy ra lỗi khi đăng nhập';
        document.getElementById('errorMessage').style.display = 'block';
    }
});
