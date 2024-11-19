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

    //xử lý checkbox để xem thử có lưu vào cookie hay không
    const remember = document.getElementById('remember');
    // const result = checkbox.checked ? 'True' : 'False';

   

    try { 
        // const response = await fetch('http://192.168.56.1/api/login', {
        const response = await fetch('http://localhost:3001/api/login', {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({
                phone: phone,
                password: password
            })
        });
        console.log("post thanh cong");

        const data = await response.json();
        console.log(data);

        if (data.success) {
            // Hiển thị thông báo thành công
            sessionStorage.setItem('token', data.token);
            document.getElementById('successMessage').textContent = data.message;
            document.getElementById('successMessage').style.display = 'block';
            console.log('hello response');
            const currentUrl = window.location.href;
            const newUrl = currentUrl.replace("?mod=taikhoan&act=login", "?mod=home#home");
            window.location.href = newUrl;
            history.replaceState(null, "", "http://localhost/clinic-website/?mod=home#home");
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