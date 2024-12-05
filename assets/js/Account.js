        
const btupdate = document.getElementById('update');
btupdate.addEventListener('click', async (e)=>{
    e.preventDefault();

    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const token = localStorage.getItem('token');

    if(!emailRegex.test(email)){
        e.preventDefault();
        alert("Nhập sai định dạng email");
        exit();
    }

    try {

        const requestdt = {
            type : 'changeinfo',
            token : token,
            newphone : phone,
            newemail : email
        }
        
        const response = await fetch('http://192.168.42.108:3001/api/updateinfo', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify(requestdt)
        })

        const data = await response.json();

        if(data.success) {
            alert("Cập nhật thành công");
            document.location.reload();
        } else {
            alert("Cập nhật thất bại");
        }
    } catch(error) { 
        console.error('Error:', error);
    }
});

const tochange = document.getElementById("tochange");
tochange.addEventListener("click", async (e) =>{
    e.preventDefault();

    document.getElementById("profile").classList.add("hidden");
    document.getElementById("change").classList.remove("hidden");
});

const btchangepass = document.getElementById("changepass");
btchangepass.addEventListener('click', async (e)=>{
    e.preventDefault();

    const token = localStorage.getItem("token");
    const oldpw = document.getElementById("oldPassword").value;
    const newpw = document.getElementById("newPassword").value;
    const cfpw = document.getElementById("confirmPassword").value;

    if( !oldpw || !newpw || !cfpw ){
        e.preventDefault();

        alert("Không được để thiếu thông tin");
        exit();
    }

    if (newpw != cfpw){
        e.preventDefault();
        alert("Mật khẩu nhập lại không khớp");
        exit();
    }

    try{
        const requestdata = {
            type : 'resetpass',
            token : token,
            oldpassword : oldpw,
            newpassword : newpw
        }

        const response = await fetch('http://192.168.42.108:3001/api/resetpass', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify(requestdata)
        });

        const data = await response.json();

        if (data.success) {
            // Hiển thị thông báo thành công
            alert('Đổi mật khẩu thành công');
            location.reload();
        } else {
            alert('Đổi mật khẩu không thành công');
        }

    } catch(error) {

    }
});

const btback = document.getElementById("back");
btback.addEventListener('click', )