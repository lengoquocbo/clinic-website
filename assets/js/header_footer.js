//dangxuat
const dangxuat = document.getElementById('logout');
dangxuat.addEventListener("click", async (e) =>{
    e.preventDefault();
    try {
        const response =  await fetch('http://localhost:3001/api/logout', {

        // const response =  await fetch('http://192.168.42.108:3001/api/logout', {
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
            // window.location.href = "http://192.168.42.108";
            // history.replaceState(null, "", "http://192.168.42.108");
            window.location.href = "http://localhost";
            history.replaceState(null, "", "http://localhost");
        } else {
            // hiển thị lỗi
            alert('dang xuat khong thanh cong');
        }
    } catch(error) {
        console.error('Error:', error);
       
    }
});