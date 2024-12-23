//dangxuat
const dangxuat = document.getElementById('logout');
dangxuat.addEventListener("click", async (e) =>{
    e.preventDefault();
    try {
        const response =  await fetch('http://'+port+':3001/api/logout', {

            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({
                token: localStorage.getItem('token')
            })
        });

        const data = await response.json();

        if (data.success) {
            // Hiển thị thông báo thành công
            localStorage.removeItem('token');
            window.location.href = "http://"+port;
            history.replaceState(null, "", "http://"+port);
        } else {
            // hiển thị lỗi
            alert('dang xuat khong thanh cong');
        }
    } catch(error) {
        console.error('Error:', error);
       
    }
});