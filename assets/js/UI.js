// menu
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.getElementById('nav-menu');

// Lấy phần tử "Trang chủ"
const homeLink = navMenu.querySelector('li:first-child');

menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('show');

    // Kiểm tra nếu menu đang hiển thị
    if (navMenu.classList.contains('show')) {
        homeLink.style.display = 'none'; // Ẩn "Trang chủ" khi mở menu
    } else {
        homeLink.style.display = 'block'; // Hiện "Trang chủ" khi đóng menu
    }
});


const navItems = navMenu.querySelectorAll('li a');
    navItems.forEach(item => {
    item.addEventListener('click', () => {
        navMenu.classList.remove('show'); // Đóng menu khi nhấn vào một mục
    });
});


// phan slides
let slideIndex = 0;
    showSlides();
    
    function showSlides() {
        let slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        slides[slideIndex-1].style.display = "block";  
        setTimeout(showSlides, 10000); // Change image every 10 seconds
    }
// phan khoa
document.addEventListener('DOMContentLoaded', function() {
    const departmentListItems = document.querySelectorAll('.department-list li');
    const departmentTitle = document.getElementById('department-title');
    const departmentDescription = document.getElementById('department-description');
    const departmentImage = document.getElementById('department-image');

    const departmentData = {
        '1': {
            title: 'Khoa Nội',
            description: 'Chuyên khám và điều trị các bệnh lý về nội khoa, bao gồm các bệnh về tim mạch, hô hấp, tiêu hóa, và thần kinh.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '2': {
            title: 'Khoa Nhi',
            description: 'Chăm sóc sức khỏe cho trẻ em từ sơ sinh đến 18 tuổi với đội ngũ bác sĩ nhi khoa tận tâm và chuyên nghiệp.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '3': {
            title: 'Khoa Sản',
            description: 'Cung cấp dịch vụ chăm sóc sức khỏe cho phụ nữ mang thai, sinh nở và các bệnh lý phụ khoa.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '4': {
            title: 'Khoa Da Liễu',
            description: 'Chuyên khám và điều trị các bệnh lý về da, tóc, móng và các bệnh lý lây qua đường tình dục.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '5': {
            title: 'Khoa Mắt',
            description: 'Chăm sóc và điều trị các bệnh lý về mắt, bao gồm khúc xạ, viêm, và các vấn đề về thị lực.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '6': {
            title: 'Khoa Tai Mũi Họng',
            description: 'Khám và điều trị các vấn đề liên quan đến tai, mũi, họng, và các bệnh lý về đường hô hấp trên.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        }
    };

    function updateDepartmentInfo(departmentId) {
        const data = departmentData[departmentId];
        departmentTitle.textContent = data.title;
        departmentDescription.textContent = data.description;
        departmentImage.src = data.image;
    }

    // Cập nhật thông tin khoa Nội khi trang được tải
    updateDepartmentInfo('1');

    departmentListItems.forEach(item => {
        item.addEventListener('click', function() {
            const departmentId = this.getAttribute('data-department');
            updateDepartmentInfo(departmentId);
        });
    });
});


//đặt lịch hẹn

const datlich = document.getElementById("datlich").value;

datlich.addEventListener("click", async (e) => {
    e.preventDefault();

    const hovaten = document.getElementById("name").value;
    const CCCD = document.getElementById("CCCD").value;
    const gender = document.getElementById("gender").value;
    const dateofbitrh = document.getElementById("service").value;
    const address = document.getElementById("address").value;
    const message = document.getElementById("message").value;


    if(!hovaten || !CCCD || !gender || !dateofbirth || !address || !message){
        e.preventDefault();

        // Hiển thị thông báo lỗi
        alert("Vui lòng nhập đầy đủ thông tin");
        exit();
    }

    try { 
        // const response = await fetch('http://192.168.56.1/api/login', {
        const response = await fetch('http://localhost:3001/api/reservation', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type':'application/json',
            },
            body: JSON.stringify({
                token: sessionStorage.getItem['token'],
                hovaten: hovaten,
                CCCD: CCCD,
                gender: gender, 
                dateofbirth: dateofbirth, 
                address: address,
                message: message
            })
        });

        const data = await response.json();

        if (data.success) {
            // Hiển thị thông báo thành công
            sessionStorage.setItem('token', data.token);
            document.getElementById('successMessage').textContent = data.message;
            document.getElementById('successMessage').style.display = 'block';
            const currentUrl = window.location.href;
            window.location.href = "http://localhost/clinic-website"+data.URL;
            history.replaceState(null, "", "http://localhost/clinic-website"+data.URL);
        } else {
            // hiển thị lỗi
            document.getElementById('errorMessage').textContent = data.message;
            document.getElementById('errorMessage').style.display = 'block';
        }
    } catch(error) {
        console.error('Error:', error);
        document.getElementById('errorMessage').textContent = 'Đã xảy ra lỗi khi đặt lịch';
        document.getElementById('errorMessage').style.display = 'block';
    }
});

//xử lý li đặt lihc
function checkSession(){
    fetch('http://localhost:80/clinic-website/src/Controllers/CheckSession.php')
        .then(response => response.json())
        .then(data => {
            if (data.session_exists) {
                window.location.href = "http://localhost/clinic-website/?mod=home#appointment";
            } else {
                // Nếu session không tồn tại
                alert('Vui lòng đăng nhập');
                window.location.href = 'http://localhost/clinic-website/?mod=taikhoan&act=login';
            }
        });
}